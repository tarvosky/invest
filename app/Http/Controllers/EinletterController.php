<?php

namespace App\Http\Controllers;

use App\Models\Einletter;
use Illuminate\Http\Request;
use App\Traits\TaxTrait;
use App\Traits\FontTrait;
use App\Traits\Payment;
use App\Models\Charge;
use App\Traits\FormatTrait;
use App\Traits\License;
use Image;
use PDF;

class EinletterController extends Controller
{


    use License,Payment,FontTrait,FormatTrait;

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
        $data = Einletter::where('user_id',auth()->user()->id)->get();
        return view('einletter.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('einletter.create');
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
            'company_name' => 'required', 
            'ein' => 'required|digits:9|numeric' ,  
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'ein_issued_date' => 'required',
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->einletter()->create([
        'company_name' => $request->company_name, 
        'ein' => $this->numberToEIN($request->ein) ,  
        'street' => $request->street, 
        'city' => $request->city , 
        'state' => $request->state , 
        'zip' => $request->zip, 
        'ein_issued_date' => $request->ein_issued_date,
       ]);
        return  redirect()->route('einletter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Einletter  $einletter
     * @return \Illuminate\Http\Response
     */
    public function show(Einletter $einletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Einletter  $einletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Einletter $einletter)
    {
        $ein=  $this->ConvertToNumber($einletter->ein);
        return view('einletter.edit')->with('data', $einletter)
                             ->with('ein', $ein);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Einletter  $einletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Einletter $einletter)
    {
        $this->validate($request, [ 
            'company_name' => 'required', 
            'ein' => 'required|digits:9|numeric' ,  
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'ein_issued_date' => 'required', 
          ]);
          $einletter->company_name= $request->company_name; 
          $einletter->ein= $this->numberToEIN($request->ein) ; 
          $einletter->street=  $request->street; 
          $einletter->city= $request->city; 
          $einletter->state= $request->state; 
          $einletter->zip= $request->zip; 
          $einletter->ein_issued_date= $request->ein_issued_date; 
          $einletter->save();
          return  redirect()->route('einletter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Einletter  $einletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Einletter $einletter)
    {
        //
    }

    public function delete(Einletter $einletter)
    {
        $einletter->delete();
        return back();
    }

    public  function format_date($date,$sign) {
        $Year  = substr($date,0,4);
        $Date= substr($date,5,2);
        $Month  = substr($date,8,2);
        $formatted =  $Date.$sign.$Month.$sign. $Year;
         // 2020-23-01"
        
        return $formatted;
    }



    public function createDocument(Request $request)
    {
        
        $einletter = Einletter::find($request->id);
        $ocrb_only = $this->font['ocrb_only'];
        $courbdFont = $this->font['courbdFont'];
        $courierFont = $this->font['courierFont'];
        $ocrbFont = $this->font['ocrbFont'];
        $time = time().$this->codeName();    
        $theme = "tax/ein_verification.png";       
        $img = Image::make($theme);

        $img->text(strtoupper($einletter->company_name), 198, 430, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(25);
        });

        $img->text(strtoupper($einletter->street), 198, 460, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(25);
        });

        $city_and_zip = $einletter->city.", ".$einletter->state." ".$einletter->zip;
        $img->text(strtoupper($city_and_zip), 198, 490, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(25);
        });

        $iss = $this->format_date($einletter->ein_issued_date,"-");
        $img->text(strtoupper($iss), 1055, 200, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(22);
        });

        $img->text(strtoupper($einletter->ein), 790, 270, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(22);
        });

        
        $num = "00".$this->getRndInteger(1111,9999);
        $img->text($num, 35, 530, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(21);
        });


        $img->text(strtoupper($einletter->ein."."), 189, 700, function($font) use ($courierFont){
            $font->file($courierFont);
            $font->color('#000000'); 
            $font->size(22);
        });


        $img->save('tax/completed/'.$time.'.png'); 

        $user = auth()->user();
        $charge = Charge::where('slug','1040')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  EIN Verification Letter at $".$charge->charge." #".$time,$user,"ein"); //update history




        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('einletter/template/einletter',compact('data'));
        return $pdf->download($time.'.pdf');

    }    
}
