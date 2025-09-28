<?php

namespace App\Http\Controllers;

use App\Models\Utility;
use Illuminate\Http\Request;
use App\Traits\TaxTrait;
use App\Traits\FontTrait;
use App\Traits\Payment;
use App\Models\Charge;
use App\Models\Energy;
use App\Traits\FormatTrait;
use App\Traits\License;
use App\Traits\UtilityTrait;
use Image;
use PDF;

class UtilityController extends Controller
{
    use License,Payment,FontTrait,FormatTrait,UtilityTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        set_time_limit(8000000);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $charge = Charge::where('slug','1040')->first();
        $data = Utility::where('user_id',auth()->user()->id)->get();
        return view('utility.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('utility.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'billing_date' => 'required' ,  
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'type' => 'required', 
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->utilities()->create($request->all());
        return  redirect()->route('utility.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function show(Utility $utility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function edit(Utility $utility)
    {
        
        return view('utility.edit')->with('data', $utility)->with('array_type', $this->array_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utility $utility)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'billing_date' => 'required' ,  
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'type' => 'required', 
          ]);
       //$user = auth()->user();
       //$user->utilities()->update($request->except(['_token', '_method' ]));
       $utility->update($request->except(['_token', '_method' ]));
        return  redirect()->route('utility.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utility $utility)
    {
        //
    }

    public function delete(Utility $utility)
    {
        $utility->delete();
        return back();
    }





    public function createDocument(Request $request)
    {

        $data = Utility::find($request->id);
        $time = time().$this->codeName().rand(1000,9999);    

        $info = [
            "time" => $time,
            "ocrb_only" => $this->font['ocrb_only'],
            "ArialLightFont" => $this->font['ArialLightFont'],
            "courbdFont" => $this->font['courbdFont'],
            "courierFont" => $this->font['courierFont'],
            "normalFont" => $this->font['normalFont'],
            "boldFont" => $this->font['boldFont'],
            "OCRAStdFont" => $this->font['OCRAStdFont'],
            "BigFont" => $this->font['BigFont'],
            "arialMediumFont" => $this->font['arialMediumFont'],
            "humboldFont" => $this->font['humboldFont'],
            "humFont" => $this->font['humFont'],
            
        ];

        $user = auth()->user();
        $charge = Charge::where('slug','1040')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  ".$data->type." at $".$charge->charge." #".$time,$user,$data->type); //update history
        


        switch ($data->type) {
            case 'xfinity':
                $pdf = $this->get_xfinity($data,$info);
                return $pdf->download($info['time'].'.pdf');
                break;
            case 'att':
                $pdf = $this->get_att($data,$info);
                return $pdf->download($info['time'].'.pdf');
                break;
            case 'directv':
                $pdf = $this->get_directv($data,$info);
                return $pdf->download($info['time'].'.pdf');
                break; 
            case 'spectrum':
                $pdf = $this->get_spectrum($data,$info);
                return $pdf->download($info['time'].'.pdf');
                break;                                            
            default:
                # code...
                break;
        }
        

    }



    public function energy()
    {

        
        $charge = Charge::where('slug','energy')->first();
        $data = Energy::where('user_id',auth()->user()->id)->get();
        return view('utility.energy',compact('data','charge'));
    }


    public function energyCreate()
    {
        return view('utility.energy-create');
    }


    public function energyStore(Request $request)
    {
        $this->validate($request, [ 
            'name' => 'required', 
            'billing_date' => 'required' ,  
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->energies()->create($request->all());
        return  redirect()->route('utility.energy');
    }
    
    public function energyEdit(Energy $energy)
    {
        
        return view('utility.energy-edit')->with('data', $energy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function energyUpdate(Request $request, Energy $energy)
    {
        $this->validate($request, [ 
            'name' => 'required', 
            'billing_date' => 'required' ,  
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
          ]);
       //$user = auth()->user();
       //$user->utilities()->update($request->except(['_token', '_method' ]));
       $energy->update($request->except(['_token', '_method' ]));
        return  redirect()->route('utility.energy');
    }

    public function energyDelete(Energy $energy)
    {
        $energy->delete();
        return back();
    }


    public function createEnergyDocument(Request $request)
    {

        $data = Energy::find($request->id);
       

        // "id" => 1
        // "created_at" => "2021-10-22 21:09:29"
        // "updated_at" => "2021-10-22 21:35:56"
        // "name" => "Andy Smith"
        // "amount" => "2500"
        // "street" => "12 adway street"
        // "city" => "ville"
        // "zip" => "332222"
        // "state" => "CA"
        // "billing_date" => "2021-10-07"
        // "user_id" => 2

        $amount = rand(1400,2600);
        $bill_date_format = $this->monthFull_day_year($data->billing_date);
        $pay_date = $this->monthFull_day_year($this->get_date_on($bill_date_format,"+16 days"));
        $period1  = $this->monthFull_day_year($this->get_date_on($bill_date_format,"-31 days"));
        $period2  = $this->monthFull_day_year($this->get_date_on($bill_date_format,"-2 days"));
        $next_meter_reading = $this->monthFull_day_year($this->get_date_on($bill_date_format,"+27 days"));
        $pay_date_short = $this->monthShort_day_year($this->get_date_on($bill_date_format,"+16 days"));

        $short_period1  = $this->monthShort_day_year($this->get_date_on($bill_date_format,"-32 days"));
        $short_period2  = $this->monthShort_day_year($this->get_date_on($bill_date_format,"-2 days"));


        $ran = rand(1,9)/10;
        $ran2 = rand(10,90)/100;
        $mix = rand(300,400)+ $ran2;
        $account_no = "20".rand(100000,999999);
        $eletric = rand(5,9) + $ran;
        $gas = rand(59,90) + $ran;
        $balance_remain_sec_page = rand(170,200) + $ran2;


         $ave  =  $amount / 6;
         $mani = $ave/4;
         $mani2 = $ave/6;
         $r1 =  round($ave + $mani,2)   + $ran2;
         $r2 =  round($ave - $mani,2)   + $ran2  ;
         $r3 =  round($ave + $mani2,2)   + $ran2   ;
         $r4 =  round($mix,2);
         $r5 =  round($amount - ($r1+$r2+$r3),2);
         $rx5 = round($r5 +$r4,2) ;
         $t = $r1+$r2+$r3+$r5;
         $tx = $r1+$r2+$r3+$rx5;


        //dd($r4,$r1,$r2,$r3,$r5,$t,$tx);

        // 3rd and 4th page
        $gas_total = $t * 0.20;
        $electric_total = $t * 0.80;

        //dd($gas_total,$electric_total,$t,$amount);

        // Gas
        $gas_dc = $gas_total * 0.39;
        $gas_sc = $gas_total * 0.61;
        $gas_value = 4.982;
        $gas_terms = $gas_sc/$gas_value;

        $gc_month_sc = $gas_dc * 0.18;
        $gc_first = ($gas_dc * 0.82)/2 ;
        $gc_next = ($gas_dc * 0.82)/2 ;
        
        $g_value_f = 5.982;
        $g_value_n = 4.982;
        $gc_first_terms = $gc_first/$g_value_f;
        $gc_next_terms = $gc_next/$g_value_n;

        //dd($gas_dc,$gas_sc,$gc_month_sc,$gc_first,$gc_next,$gc_first_terms,$gc_next_terms );


        // Electric
        $ele_dc = $electric_total * 0.39;
        $ele_sc = $electric_total * 0.61;
        $ele_month_sc = $ele_dc * 0.18;
        $ele_first = ($ele_dc * 0.205) ;
        $ele_next1 = ($ele_dc * 0.105) ;
        $ele_next2 = ($ele_dc * 0.135) ;
        $ele_next3 = ($ele_dc * 0.375) ;
        $e_value_dc_f = 2.982;
        $e_value_dc_n1 = 1.132;
        $e_value_dc_n2 = 1.982;
        $e_value_dc_n3 = 0.842;
        $ele_first_terms = $ele_first/$e_value_dc_f;
        $ele_next1_terms = $ele_next1/$e_value_dc_n1;
        $ele_next2_terms = $ele_next2/$e_value_dc_n2;
        $ele_next3_terms = $ele_next3/$e_value_dc_n3;





        $ele_first_sc = ($ele_sc * 0.205) ;
        $ele_next1_sc = ($ele_sc * 0.135) ;
        $ele_next2_sc = ($ele_sc * 0.285) ;
        $ele_next3_sc = ($ele_sc * 0.375) ;
        $e_value_sc_f  = 2.282;
        $e_value_sc_n1 = 0.992;
        $e_value_sc_n2 = 1.982;
        $e_value_sc_n3 = 0.842;
        $ele_first_terms_sc = $ele_first_sc/$e_value_sc_f;
        $ele_next1_terms_sc = $ele_next1_sc/$e_value_sc_n1;
        $ele_next2_terms_sc = $ele_next2_sc/$e_value_sc_n2;
        $ele_next3_terms_sc = $ele_next3_sc/$e_value_sc_n3;


      
        $codename = $this->codeName().time();
        $user = auth()->user();
        if($this->check_if_there_is_enough_credit($user->wallet,$request->cost) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$request->cost);  //update cost 
        $this->recordHistory("Downloaded Energy Bill at $".$request->cost." #".$codename,$user,"energy");// recording history
      

        $formated_acc = substr($account_no,0,2)." ".substr($account_no,2,3)." ".substr($account_no,5,3)." ".substr($account_no,8,2);


        $info = [
            "bill_date_format" =>$bill_date_format,
            "pay_date" =>$pay_date ,
            "period" =>$period1." to ".$period2,
            "account_no" =>$account_no,
            "formated_acc" => $formated_acc,
            "invoice_no" =>rand(100000000,999999999),
            "balance_remain_sec_page" => $balance_remain_sec_page,
            "r1" => $r1,
            "r2" => $r2,
            "r3" => $r3,
            "r4" => $r4,
            "r5" => $r5,
            "rx5" => $rx5,
            "t" => $t,
            "gas_dc" => $gas_dc,
            "gas_sc" => $gas_sc, 
            "gas_value" => $gas_value,
            "gas_terms"     => $gas_terms,
            "next_meter_reading" => $next_meter_reading,
            "pay_date_short" => $pay_date_short,
            "short_period1" =>$short_period1,
            "short_period2" =>$short_period2 , 
            "gc_month_sc"=>$gc_month_sc,
            "gc_first"=>$gc_first,
            "gc_next"=>$gc_next,
            "gc_first_terms"=>$gc_first_terms,
            "gc_next_terms"=>$gc_next_terms,
            "g_value_f" => $g_value_f,
            "g_value_n" => $g_value_n,
            "amount" => $amount,
            "gas_total" => $gas_total,
            "electric_total" => $electric_total,
            'ele_next1' => $ele_next1,
            'ele_sc' => $ele_sc,
            'ele_dc' => $ele_dc,
            'ele_month_sc' => $ele_month_sc,
            'ele_first' => $ele_first,
            'ele_next1' => $ele_next1,
            'ele_next2' => $ele_next2,
            'ele_next3' => $ele_next3,
            'e_value_dc_f' => $e_value_dc_f,
            'e_value_dc_n1' => $e_value_dc_n1,
            'e_value_dc_n2' => $e_value_dc_n2,
            'e_value_dc_n3' => $e_value_dc_n3,
            'ele_first_terms' => $ele_first_terms,
            'ele_next1_terms' => $ele_next1_terms,
            'ele_next2_terms' => $ele_next2_terms,
            'ele_next3_terms' => $ele_next3_terms,

            'ele_first_sc' => $ele_first_sc,
            'ele_next1_sc' => $ele_next1_sc,
            'ele_next2_sc' => $ele_next2_sc,
            'ele_next3_sc' => $ele_next3_sc,
            'e_value_sc_f' => $e_value_sc_f,
            'e_value_sc_n1' => $e_value_sc_n1,
            'e_value_sc_n2' => $e_value_sc_n2,
            'e_value_sc_n3' => $e_value_sc_n3,
            'ele_first_terms_sc' => $ele_first_terms_sc,
            'ele_next1_terms_sc' => $ele_next1_terms_sc,
            'ele_next2_terms_sc' => $ele_next2_terms_sc,
            'ele_next3_terms_sc' => $ele_next3_terms_sc,




        ];


        if($data['state'] == "NJ"){
            $pdf = PDF::loadView('utility/energy/test', compact('data','info'))
            ->setOptions(["header-html"=>"download.header"]);
            $pdf->getDomPDF()->set_option("enable_php", true);
        }else{
            $pdf = PDF::loadView('utility/energy/general', compact('data','info'))
            ->setOptions(["header-html"=>"download.header"]);
            $pdf->getDomPDF()->set_option("enable_php", true);
        }
         return $pdf->download('download.pdf');


    }



    




}
