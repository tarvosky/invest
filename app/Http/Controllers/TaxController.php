<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Charge;
use App\Models\Contractor;
use App\Models\Tax;
use App\Traits\Payment;
use App\Traits\TaxTrait;
use App\Traits\FontTrait;
use App\Traits\License;
use Image;
use PDF;
use App\Traits\FormatTrait;

class TaxController extends Controller
{

    use Payment,FontTrait,TaxTrait,License,FormatTrait;

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
        $data = Tax::where('user_id',auth()->user()->id)->get();
        return view('tax.index',compact('data','charge'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tax.create');
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
            'year' => 'required', 
            'full_name' => 'required' , 
            'business_name' => 'required' , 
            'business_description' => 'required' , 
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'security' => 'required' ,  
            'security_value' => 'required|digits:9|numeric' ,   
            'instruction_code' => 'required' , 
            'total_income' => 'required', 
            'total_expenses' => 'required',
        ],[
            'security.required' => 'Select SSN or EIN',
            'security_value.required' => 'SSN or EIN Required',
        ]);


        if($request->security == "ssn"){
          $value =  $this->numberToSSN($request->security_value);
        }else{
            $value =  $this->numberToEIN($request->security_value);
        }


        $user = auth()->user();
        $data =  $user->taxes()->create([
            'year' => $request->year, 
            'full_name' => $request->full_name , 
            'business_name' => $request->business_name , 
            'business_description' => $request->business_description , 
            'street' => $request->street, 
            'city' => $request->city , 
            'state' => $request->state , 
            'zip' => $request->zip, 
            'security' => $request->security ,  
            'security_value' => $value, 
            'instruction_code' => $request->instruction_code , 
            'total_income' => $request->total_income, 
            'total_expenses' => $request->total_expenses,
        ]);
        return  redirect()->route('tax-documents.index');

    }







    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Tax $tax_document)
    {


         $value =  $this->ConvertToNumber($tax_document->security_value);
    
          //dd($tax_document->security."  ==  ".$value."  == ".$tax_document->security_value);

        return view('tax.edit')->with('data', $tax_document)
                               ->with('value', $value);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [ 
            'year' => 'required', 
            'full_name' => 'required' , 
            'business_name' => 'required' , 
            'business_description' => 'required' , 
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'security' => 'required' ,  
            'security_value' => 'required|digits:9|numeric', 
            'instruction_code' => 'required' , 
            'total_income' => 'required', 
            'total_expenses' => 'required',
        ],['security.required' => 'Select SSN or EIN']);


        if($request->security == "ssn"){
            $value =  $this->numberToSSN($request->security_value);
          }else{
              $value =  $this->numberToEIN($request->security_value);
          }


        $user = auth()->user();
        //$data =  $user->taxes()->update($request->except(['_token', '_method' ]));
        $data =  $user->taxes()->update([
            'year' => $request->year, 
            'full_name' => $request->full_name , 
            'business_name' => $request->business_name , 
            'business_description' => $request->business_description , 
            'street' => $request->street, 
            'city' => $request->city , 
            'state' => $request->state , 
            'zip' => $request->zip, 
            'security' => $request->security ,  
            'security_value' => $value, 
            'instruction_code' => $request->instruction_code , 
            'total_income' => $request->total_income, 
            'total_expenses' => $request->total_expenses,
        ]);
        return  redirect()->route('tax-documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax_document)
    {
        $tax_document->delete();
        return back();
    }

    public function delete(Tax $tax_document)
    {
        $tax_document->delete();
        return back();
    }




    public function createDocument(Request $request)
    {

        


        // $info =[
        //     "myFont" => $myFont,
        //     "cash" => $cash,
        //     "perforated" => $perforated,
        //     "perforated_bold" => $perforated_bold,
        //     "signFont" => $signFont,
        //     "sign_medium" =>$sign_medium,
        //     "time" =>$time,
        // ];


        $tax = Tax::find($request->id);
        $normalFont = $this->myfont['normalFont'];
        $boldFont= $this->myfont['boldFont'];
        $time = time().$this->codeName();    
        $tax_theme = "tax/1040.jpg";       
        $img = Image::make($tax_theme);
        if($tax->security == "ssn"){
            $ssn= $tax->security_value;
            $img->text(strtoupper($ssn), 1330, 285, function($font) use ($boldFont){
                $font->file($boldFont); 
                $font->size(25);
            });
        }else{
            $num = str_split($tax->security_value);
            $word ="";
            for($i=0;$i<count($num);$i++){
                $word .= $num[$i]."    ";
            }
            $img->text(strtoupper($word), 1250, 430, function($font) use ($boldFont){
                $font->file($boldFont); 
                $font->size(25);
            });

        }

        
        $num = str_split($tax->instruction_code);
        $word ="";
        for($i=0;$i<count($num);$i++){
            $word .= $num[$i]."    ";
        }

        $img->text(strtoupper($word), 1372, 360, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });





        $year = substr($tax->year,2,2);
        $img->text(strtoupper($year), 1480, 180, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(60);
        });
        $img->text(strtoupper($tax->full_name), 100, 295, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(strtoupper($tax->business_description), 100, 360, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(strtoupper($tax->business_name), 100, 425, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(strtoupper($tax->street), 680, 465, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $city_and_zip = strtoupper($tax->city).", ".strtoupper($tax->state)." ".strtoupper($tax->zip);
        $img->text($city_and_zip, 680, 495, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });

        $img->text(number_format($tax->total_income,2), 1430, 760, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($tax->total_income,2), 1430,830, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($tax->total_income,2), 1430, 895, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($tax->total_income,2), 1430, 962, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });

        $t = $tax->total_income;
        $ex = $tax->total_expenses;

        $r= round($ex/7, 2);

 
        
        $r1= rand(1,$r) - 0.11;
        $r2= rand(1,$r) - 0.22;
        $r8= rand(1,$r) - 0.11;
        $r4= rand(1,$r) - 0.12;
        $r5= rand(1,$r) - 0.50;
        $r6= rand(1,$r) - 0.36;
        $r7= rand(1,$r) - 0.21;

    
        
        $sum = $r1+$r2+$r8+$r4+$r5+$r6+$r7;
        $r3 = $ex- $sum;
        $img->text(number_format($r1,2), 650, 1025, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($r2,2), 650, 1100, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($r3,2), 650, 1160, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($r4,2), 650, 1395, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });

        $img->text(number_format($r5,2), 1430, 1025, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($r6,2), 1430, 1130, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($r7,2), 1430, 1160, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($r8,2), 1430, 1425, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($ex,2), 1430, 1560, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $remain = $t-$ex;
        $img->text(number_format($remain,2), 1430, 1590, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });
        $img->text(number_format($remain,2), 1430, 1863, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(25);
        });



        $img->save('tax/completed/'.$time.'.png'); 




        $user = auth()->user();
        $charge = Charge::where('slug','1040')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  1040 at $".$charge->charge." #".$time,$user,"1040"); //update history




        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('tax-template/1040',compact('data'));
        return $pdf->download($time.'.pdf');



    }


}
