<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Statement;
use App\Models\Bank;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\Charge;
use App\Models\Download;
use PDF;
use Illuminate\Support\Facades\Auth;
use App\Traits\Payment;
use App\Traits\License;
use Session;

class TransactionController extends Controller
{

    use Payment,License;

    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
     set_time_limit(8000000);
    }

   

    // Get the currently authenticated user...

    public function storePdf(Request $request)
    {

       
        $codename = $this->codeName().time();
        $user = Auth::user();
        if($this->check_if_there_is_enough_credit($user->wallet,$request->cost) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $statement = Statement::where('id',$request->statement_id)->first();
        $bank = Bank::where('id',$statement->bank_id)->first();
        $transactions = Transaction::where('statement_id',$statement->id);
        
        // check if dates doesnt tallies
        foreach($transactions->get() as $value){
            $status = $this->test_if_dates_are_inbetween($statement->fromDate,$statement->toDate,$value->theDate);
            if(!$status){
              return  redirect()->back()->withErrors(array('mydate' => "selected date does not fall within the from & to date"));
            }
        }



        if($statement->bank->slug == "customize-any-bank" &&  $statement->logo == null){
            return  redirect()->back()->withErrors(array('errorlogo' => "Upload Logo required"));
        }

        $currency = $this->get_currency_symbol($statement->currency);
        $calculation = $this->calculate_total($transactions->get(),$statement->opening_balance);
        $this->remove_from_wallet_and_update($user,$request->cost);  //update cost 
        $this->recordHistory("Downloaded ".$bank->name." at $".$request->cost." #".$codename,$user,"statements");// recording history
         $pdf = PDF::loadView('download/'.$bank->slug, compact('bank', 'statement','transactions','currency','calculation'))
         ->setOptions(['defaultFont' => 'open-sans',"header-html"=>"download.header"]);
         $pdf->getDomPDF()->set_option("enable_php", true);
         return $pdf->download($codename.'.pdf');
         

    }



    // public function downloadPdf(Order $statement)
    // {
    //     $bank = Bank::where('id',$statement->bank_id)->first();

    //     $transactions = Transaction::where('order_id',$request->order_id)->orderBy('id', 'DESC')->get();
    //     $currency = $this->get_currency_symbol($statement->currency);
    //      $pdf = PDF::loadView('download/'.$bank->slug, compact('bank', 'order','transactions','currency'))->setOptions(['defaultFont' => 'open-sans']);
    //      $pdf->getDomPDF()->setHttpContext(
    //         stream_context_create([
    //             'ssl' => [
    //                 'allow_self_signed'=> TRUE,
    //                 'verify_peer' => FALSE,
    //                 'verify_peer_name' => FALSE,
    //             ]
    //         ])
    //     );
    //      return $pdf->download('pdf_file.pdf');

    // }
    

    public function index(Statement $statement)
    {
        
        // $transactions = Transaction::where('order_id',$statement->id)->orderBy('id', 'DESC')->simplePaginate(2);
        $transactions = Transaction::where('statement_id',$statement->id)->orderBy('id', 'DESC')->get();
        $calculation = $this->calculate_total($transactions,$statement->opening_balance);
        $currency = $this->get_currency_symbol($statement->currency);
        $charge = Charge::where('slug','statement')->first();
        $calendar = $this->get_days_months_and_price($statement->fromDate,$statement->toDate,$charge->charge);
        return view('transactions.index')->with('statement', $statement)
        ->with('transactions', $transactions)
        ->with('currency',$currency)
        ->with('calendar',$calendar)
        ->with('charge',$charge)
        ->with('calculation',$calculation);
        

    }


    protected function calculate_bal_by_key($key,$data,$opening_balance){
        $inSum =$opening_balance;
        $outSum =0;
        for($i=0; $i <= $key ; $i++){
            $inSum += $data['paidin'];
            $outSum += $data['paidout'];
        }
        $result = $inSum - $outSum;
        return $result ;
    }



    protected function add_to_withdrawal($user,$amount,$bank){
        $w = $user->withdrawals()->create([
            'amount' => $amount,
            'bank' => $bank
        ]);
    }




    protected function calculate_total($data,$opening_balance){
        $inSum_bal =$opening_balance;
        $inSum = 0;
        $outSum =0;
        foreach($data as $value){

            $inSum_bal += $value->paidin;
            $inSum += $value->paidin;
            $outSum += $value->paidout;
        }
        $result_bal = $inSum_bal - $outSum;
        $result     = $inSum     - $outSum;

        $data =[
            'credit_and_bal'   =>$inSum_bal,
            'credit'           =>$inSum,
            'debit'            =>$outSum,
            'total'            =>$result,
            'total_bal'        =>$result_bal
        ];


        return $data;
    }


    protected function get_currency_symbol($currency){
        switch ($currency) {
            case 'pounds':
                return "£";
                break;                      
            case 'euros':
                return "€";
                break; 
            default:
                return "$";
                break;
        }
    }


    public function test_if_dates_are_inbetween($fromDate,$toDate,$theDate){
        $entered_date = strtotime(date($theDate));
        $from = strtotime($fromDate);
        $to = strtotime($toDate);
        
        if($entered_date >= $from && $entered_date <= $to) {
            return true;
        } else {
            return false ;
        }  
     }

    protected function get_days_months_and_price($from,$date,$cost){
        $date1=date_create($from);
        $date2=date_create($date);
        $diff=date_diff($date1,$date2);
        $months = (int) $diff->format('%m');
        $days = (int) $diff->format('%d');
    
       $price = $cost;
       if($months < 1){
        $data =[
            'days'=>$days,
            'months'=>$months,
            'price'=>$price,
            'total_months'=>$months + 1
        ];
        return $data;
       }else{
        $totalMonths = $months + 1;
        $data =[
            'days'=>$days,
            'months'=>$months,
            'price'=>$price*$totalMonths,
            'total_months'=>$totalMonths 
        ];
        return $data;
       }
    }






  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $statement
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Statement $statement)
    {




        $this->validate($request, [
            'theDate' => ['required'], 
            'paidin' => ['required'], 
            'paidout' => ['required' ], 
            'description' => ['required'], 
          ],[
            'theDate.required' => "Date Required", 
            'paidin.required' => "Paid in required", 
            'paidout.required' => "Paidout required", 
            'description.required' => "Description required", 
          ]);

          $status = $this->test_if_dates_are_inbetween($statement->fromDate,$statement->toDate,$request->theDate);
          if(!$status){
            return  redirect()->back()->withInput()->withErrors("selected date does not fall within the from & to date");
          }

          $statement->transactions()->create([
            'theDate' => $request->theDate , 
            'paidin' => $request->paidin , 
            'paidout' => $request->paidout , 
            'description' =>$request->description, 
        ]);

        
            

       return  redirect()->route('transactions.index',$statement->id);

    }


    public function edit(Transaction $transaction)
    {
        return view('transactions.edit')->with('data', $transaction);

    }


  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $statement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'theDate' => ['required'], 
            'paidin' => ['required'], 
            'paidout' => ['required' ], 
            'description' => ['required'], 
          ],[
            'theDate.required' => "Date Required", 
            'paidin.required' => "Paid in required", 
            'paidout.required' => "Paidout required", 
            'description.required' => "Description required", 
          ]);

          $transaction->theDate = $request->theDate; 
          $transaction->paidin = $request->paidin; 
          $transaction->paidout = $request->paidout; 
          $transaction->description = $request->description; 
          $transaction->save();
  
          Session::flash('message', 'Successfully updated!');
          return  redirect()->route('transactions.index',$transaction->statement_id);

    }

    public function destroyOrder(Statement $statement)
    {
        
        $statement->delete();
        return  back();
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return  back();
    }



}
