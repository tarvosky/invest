<?php

namespace App\Http\Controllers;

use App\Models\LawyerLicense;
use Illuminate\Http\Request;
use App\Traits\FontTrait;
use App\Traits\Payment;
use App\Models\Charge;
use App\Traits\FormatTrait;
use App\Traits\UtilityTrait;
use App\Traits\License;
use Image;

class LawyerLicenseController extends Controller
{
    use License,Payment,FontTrait,FormatTrait,UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        set_time_limit(8000000);
    }



    public function index()
    {
        $charge = Charge::where('slug','lawyer_license')->first();
        $data = LawyerLicense::where('user_id',auth()->user()->id)->orderBy('id','Desc')->get();
        return view('lawyers-license.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lawyers-license.create');
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
            'license_state' => 'required', 
            'issued_date' => 'required',
            'full_name' => 'required',
            'law_firm_name' => 'required',
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->lawyersLicenses()->create($request->all());
       return  redirect()->route('lawyers-license.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LawyerLicense  $lawyers_license
     * @return \Illuminate\Http\Response
     */
    public function show(LawyerLicense $lawyers_license)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LawyerLicense  $lawyers_license
     * @return \Illuminate\Http\Response
     */
    public function edit(LawyerLicense $lawyers_license)
    {
        return view('lawyers-license.edit')->with('data',$lawyers_license);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LawyerLicense  $lawyers_license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LawyerLicense $lawyers_license)
    {
        $this->validate($request, [ 
            'license_state' => 'required', 
            'issued_date' => 'required',
            'full_name' => 'required',
            'law_firm_name' => 'required',
          ]);
          $lawyers_license->update($request->except(['_token', '_method' ]));
       return  redirect()->route('lawyers-license.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LawyerLicense  $lawyers_license
     * @return \Illuminate\Http\Response
     */
    public function destroy(LawyerLicense $lawyers_license)
    {
        $lawyers_license->delete();
        return back();
    }







    public function createDocument(Request $request)
    {

        $data = LawyerLicense::find($request->id);
        $time = time().$this->codeName().rand(1000,9999);    
        $codename = $this->codeName().time();
        $user = auth()->user();
        if($this->check_if_there_is_enough_credit($user->wallet,$request->cost) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$request->cost);  //update cost 
        $this->recordHistory("Downloaded Lawyers License at $".$request->cost." #".$codename,$user,"lawyers_license");// recording history
      

        
        $ArialLightFont = $this->font['ArialLightFont'];
        $amrgranFont = $this->font['amrgranFont'];
        $amrgraFont = $this->font['amrgraFont'];
        $courbdFont = $this->font['courbdFont'];
        $courierFont = $this->font['courierFont'];
        $l_font = $this->myfont['boldFont'];
        $bg = "lawyer_license/templates/theme.png";
        $rand = $this->getRndInteger(100, 999)."/198".$this->getRndInteger(1,9)."/ADS/"."00".$this->getRndInteger(1, 9);
        $img = Image::make($bg); 

        $img->text(strtoupper($data->license_state), 390, 380, function($font) use ($amrgranFont){
            $font->file($amrgranFont); 
            $font->color("#2f7097");
            $font->size(30);
        });
        $img->text(strtoupper($data->full_name).", Esq", 1100, 840, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->align('center');
            $font->valign('top'); 
            $font->color("#ee0758");
            $font->size(35);
        });
        $img->text("of", 1070, 900, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->align('center');
            $font->valign('top'); 
            $font->color("#ee0758");
            $font->size(35);
        });
        $img->text(strtoupper($data->law_firm_name), 1100, 960, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->align('center');
            $font->valign('top'); 
            $font->color("#ee0758");
            $font->size(35);
        });
        $img->text($rand, 1070, 1047, function($font) use ($amrgraFont){
            $font->file($amrgraFont); 
            $font->color("#2f7097");
            $font->size(40);
        });
        $img->text("Issued Date: ".date("m/d/Y", strtotime($data->issued_date)), 1400, 340, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->color("#2f7097");
            $font->size(30);
        });
       
    
    
        $img->save('lawyer_license/destination/'.$time.'.png');   
        $file= public_path(). '/lawyer_license/destination/'.$time.'.png';
        return response()->download($file);

        
    }    
















}
