<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacate;
use App\Models\LateRent;
use App\Models\LeaseAgreement;
use App\Traits\FontTrait;
use App\Traits\Payment;
use App\Models\Charge;
use App\Traits\FormatTrait;
use App\Traits\License;
use App\Traits\RentalTrait;
use Image;
use PDF;
use DNS1D;
use DNS2D;
use NumberFormatter;


use Faker\Generator as Faker;

class RentalController extends Controller
{
    use License,Payment,FontTrait,FormatTrait,RentalTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        set_time_limit(8000000);
    }



    public function ntv()
    {
        $charge = Charge::where('slug','vacate')->first();
        $data = Vacate::where('user_id',auth()->user()->id)->get();
        return view('rental.ntv',compact('data','charge'));
    }


    public function createNtv()
    {
        return view('rental.create-ntv');
    }

    public function postNtv(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'landlord_first_name' => 'required', 
            'landlord_last_name' => 'required',   
            'form_date' => 'required' , 
            'vacating_date' => 'required' , 
            'street' => 'required' , 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required' , 
          ]);
        //dd($request->all());
       $user = auth()->user();
       $user->vacates()->create($request->all());
       return  redirect()->route('rental.ntv');
    }


    public function editNtv(Vacate $vacate)
    {
        return view('rental.edit-ntv')
        ->with('data',$vacate);
    }



    public function updateNtv(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'landlord_first_name' => 'required', 
            'landlord_last_name' => 'required',   
            'form_date' => 'required' , 
            'vacating_date' => 'required' , 
            'street' => 'required' , 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required' , 
          ]);
        //dd($request->all());
       $user = auth()->user();
       $user->vacates()->update( [
        'first_name'=> $request->first_name,
        'last_name'=> $request->last_name,
        'landlord_first_name'=> $request->landlord_first_name,
        'landlord_last_name'=> $request->landlord_last_name,
        'form_date'=> $request->form_date,
        'vacating_date'=> $request->vacating_date,
        'street'=>$request->street,
        'city'=>$request->city,
        'zip'=>$request->zip,
        'state'=>$request->state,
        'tenant_signature'=>$request->tenant_signature,
        'landlord_signature'=>$request->landlord_signature,
       ]   );
       return  redirect()->route('rental.ntv');
    }


    public function deleteNtv(Vacate $vacate)
    {
        $vacate->delete();
        return  back();
    }


    public function createDocumentNdv(Request $request,Faker $faker)
    {
        $data = Vacate::find($request->id);
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
            "signFont"   => $this->font['signFont'],  
            "signFont2"   => $this->font['signFont2'],  
            "signFont3"   => $this->font['signFont3'],  
        ];
        $user = auth()->user();
        $charge = Charge::where('slug','vacate')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  NOTICE TO VACATE at $".$charge->charge." #".$time,$user,"rental"); //update history
        $pdf = $this->get_ntv($data,$info,$faker);
        return $pdf->download($info['time'].'.pdf');


    } 








/**
 * 
 * 
 * 
 *    LATE RENT
 * 
 * */








    public function lr()
    {
        $charge = Charge::where('slug','rent')->first();
        $data = LateRent::where('user_id',auth()->user()->id)->get();
        return view('rental.lr',compact('data','charge'));
    }

    public function createLr()
    {
        return view('rental.create-lr');
    }


    public function postLr(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'landlord_first_name' => 'required', 
            'landlord_last_name' => 'required',             
            'form_date' => 'required' , 
            'street' => 'required' , 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required' , 
            'month' => 'required' ,
            'rent_fee' => 'required|numeric' ,
            'late_fee' => 'required|numeric' ,
            'account_number' => 'required' ,
            'routing_number'=> 'required' ,
            'bank_name' => 'required' ,


          ]);
        //dd($request->all());
       $user = auth()->user();
       $user->laterent()->create($request->all());
       return  redirect()->route('rental.lr');
    }


    public function editLr(LateRent $rent)
    {
        return view('rental.edit-lr')
        ->with('data',$rent);
    }


    
    public function updateLr(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'landlord_first_name' => 'required', 
            'landlord_last_name' => 'required',             
            'form_date' => 'required' , 
            'street' => 'required' , 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required' , 
            'month' => 'required' ,
            'rent_fee' => 'required|numeric' ,
            'late_fee' => 'required|numeric' ,
            'account_number' => 'required' ,
            'routing_number'=> 'required' ,
            'bank_name' => 'required' , 
          ]);
        //dd($request->all());
       $user = auth()->user();
       $user->laterent()->update( [
        'first_name'=> $request->first_name,
        'last_name'=> $request->last_name,
        'landlord_first_name'=> $request->landlord_first_name,
        'landlord_last_name'=> $request->landlord_last_name,
        'form_date'=> $request->form_date,
        'street'=>$request->street,
        'city'=>$request->city,
        'zip'=>$request->zip,
        'state'=>$request->state,
        'month' => $request->month,
        'rent_fee' => $request->rent_fee,
        'late_fee' => $request->late_fee,
        'account_number' => $request->account_number,
        'routing_number'=> $request->routing_number,
        'bank_name' => $request->bank_name,
       ]   );
       return  redirect()->route('rental.lr');
    }


    public function deleteLr(LateRent $rent)
    {
        $rent->delete();
        return  back();
    }



    public function createDocumentLr(Request $request)
    {
        $data = LateRent::find($request->id);
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
            "signFont"   => $this->font['signFont'],  
            "signFont2"   => $this->font['signFont2'],  
            'full_state' => strtoupper($this->state_arr[$data->state]),
        ];
        $user = auth()->user();
        $charge = Charge::where('slug','rent')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  LATE RENT at $".$charge->charge." #".$time,$user,"rental"); //update history
        $pdf = $this->get_lr($data,$info);
        return $pdf->download($info['time'].'.pdf');


    } 







/**
 * 
 * 
 * 
 *    LEASE AGREEMENT
 * 
 * */





    public function la()
    {
        $charge = Charge::where('slug','lease')->first();
        $data = LeaseAgreement::where('user_id',auth()->user()->id)->get();
        return view('rental.la',compact('data','charge'));
    }

    public function createLa()
    {
        return view('rental.create-la');
    }


    public function postLa(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'landlord_first_name' => 'required', 
            'landlord_last_name' => 'required',      
            'street' => 'required' , 
            'city' => 'required' , 
            'county' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required' , 
            'month' => 'required' ,
            'beginning_date' => 'required' ,
            'amount' => 'required' ,



          ]);
        //dd($request->all());
       $user = auth()->user();
       $user->leases()->create($request->all());
       return  redirect()->route('rental.la');
    }



    public function editLa(LeaseAgreement $lease)
    {
        return view('rental.edit-la')
        ->with('data',$lease);
    }

    
    public function updateLa(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'landlord_first_name' => 'required', 
            'landlord_last_name' => 'required',             
            'street' => 'required' , 
            'city' => 'required' , 
            'county' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required' , 
            'month' => 'required' ,
            'beginning_date' => 'required' ,
            'amount' => 'required' ,
          ]);
        //dd($request->all());
       $user = auth()->user();
       $user->leases()->update( [
        'first_name'=> $request->first_name,
        'last_name'=> $request->last_name,
        'landlord_first_name'=> $request->landlord_first_name,
        'landlord_last_name'=> $request->landlord_last_name,
        'street'=>$request->street,
        'city'=>$request->city,
        'county'=>$request->county,
        'zip'=>$request->zip,
        'state'=>$request->state,
        'month' => $request->month,
        'beginning_date' => $request->beginning_date,
        'amount' => $request->amount,
        'landlord_signature'=> $request->landlord_signature,
        'tenant_signature'=> $request->tenant_signature,
       ]   );
       return  redirect()->route('rental.la');
    }

    public function deleteLa(LeaseAgreement $lease)
    {
        $lease->delete();
        return  back();
    }


    public function createDocumentLa(Request $request)
    {


       
   

        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $lease = LeaseAgreement::find($request->id);
        $time = $this->codeName()."l-a".time();
        $user = auth()->user();
        $charge = Charge::where('slug','lease')->first();
        $date_format=  $this->birthday($lease->beginning_date);
        $signFont = $this->font['signFont'];
        $signFont2 = $this->font['signFont2']; 

        if($lease->tenant_signature == "YES"){
        $signbg = Image::make("rental/blank.png");
        $sign_name = substr(strtolower($lease->first_name),0,5);
        $signbg->text($sign_name, 30, 50, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(50);
        });
        $sign_name = substr(strtoupper($lease->last_name),0,1);
        $signbg->text($sign_name, 30, 55, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(50);
        });
        $signbg->save('rental/sign/'.$time.'.png'); 
        }

        if($lease->landlord_signature == "YES"){
        // lanlord sign
        $signbg2 = Image::make("rental/blank.png");
        $sign_name = ucwords(strtolower($lease->landlord_first_name)).".".ucwords(substr(strtoupper($lease->landlord_last_name),0,1));
        $signbg2->text($sign_name, 10, 70, function($font) use ($signFont2){
            $font->file($signFont2); 
            $font->color("#1E90FF");
            $font->size(36);
        });
        $signbg2->save('rental/landlord_sign/'.$time.'.png'); 
       }

       //calculations
       $monthly_fee = ceil($lease->amount /$lease->month);
       $end_date    = date('m/d/Y', strtotime($lease->beginning_date. "+".$lease->month." months") );
       $start_date  = date("m/d/Y", strtotime($lease->beginning_date));
       $remove_date = date('m/d/Y',(strtotime ( '-2 day' , strtotime ( $lease->beginning_date ) ) ));

       

        $data = [
            'dd'          =>  $this->getRndInteger(1,9).strtoupper($this->getRndLetter()).$this->getRndInteger(1000,9999).strtoupper($this->getRndLetter().$this->getRndLetter()).
                              "-".strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99).
                              "-".strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99).
                              "-".strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99).
                              $this->getRndInteger(100,999).strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).
                              $this->getRndInteger(100,999).strtoupper($this->getRndLetter()).$this->getRndInteger(1,9).strtoupper($this->getRndLetter()),
        'docucode'        =>  $this->getRndInteger(10,99).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(1000,9999).
                              strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(1000,9999),
        'full_state'      =>  strtoupper($this->state_arr[$lease->state]),
        'code'            =>  $time,
        'position'        =>  $this->position($date_format['birthDate']),
        'month_name'      =>  $this->full_months[$date_format['birthMonth']],
        'formated_year'   =>  substr($date_format['birthYear'],2,2),
        'end_date'        =>  $end_date,
        'lease_words'     =>  $f->format($lease->amount),
        'montly_fee'      =>  $monthly_fee,
        'montly_words'    =>  $f->format(round($monthly_fee, 2)),
        'start_date'      =>  $start_date,
        'remove_date'     =>  $remove_date,


        ];
        
   
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
            "signFont"   => $this->font['signFont'],  
            "signFont2"   => $this->font['signFont2'],  
        ];
 



              








        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  LEASE AGREEMENT at $".$charge->charge." #".$time,$user,"rental"); //update history




        $textUnderBarcode = substr($data['dd'],0,10);
        file_put_contents('rental/barcodes/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',1,50)));


        $pdf = PDF::loadView('rental/templates/lease', compact('data','lease'))
        ->setOptions(['defaultFont' => 'open-sans',"header-html"=>"download.header"]);
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->download($time.'.pdf');



    } 




}
