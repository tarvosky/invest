<?php

namespace App\Http\Controllers;

use App\Models\Will;
use Illuminate\Http\Request;
use App\Models\Charge;
use App\Traits\FormatTrait;
use App\Traits\UtilityTrait;
use App\Traits\FontTrait;
use App\Traits\License;
use Image;
use PDF;
use App\Traits\Payment;
use NumberFormatter;
use Faker\Generator as Faker;




class WillController extends Controller
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
        $charge = Charge::where('slug','will')->first();
        $data = Will::where('user_id',auth()->user()->id)->orderBy('id','Desc')->get();
        return view('will.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('will.create');
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
            'law_firm_name' => 'required', 
            'law_firm_address' => 'required',
            'law_firm_country' => 'required',
            'testator' => 'required', 
            'testator_address' => 'required', 
            'lawyer' => 'required',
            'dating_name' => 'required',
            'dating_connection' => 'required',
            'client_name' => 'required',
            'client_connection' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required',
            'property' => 'required',
            'issued_date' => 'required',
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->wills()->create($request->all());
       return  redirect()->route('wills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Will  $will
     * @return \Illuminate\Http\Response
     */
    public function show(Will $will)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Will  $will
     * @return \Illuminate\Http\Response
     */
    public function edit(Will $will)
    {
        return view('will.edit')->with('data',$will);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Will  $will
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Will $will)
    {
        $this->validate($request, [ 
            'law_firm_name' => 'required', 
            'law_firm_address' => 'required',
            'law_firm_country' => 'required',
            'testator' => 'required', 
            'testator_address' => 'required', 
            'lawyer' => 'required',
            'dating_name' => 'required',
            'dating_connection' => 'required',
            'client_name' => 'required',
            'client_connection' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required',
            'property' => 'required',
            'issued_date' => 'required',
          ]);
       // dd($request->all());
       $will->update($request->except(['_token', '_method' ]));
       return  redirect()->route('wills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Will  $will
     * @return \Illuminate\Http\Response
     */
    public function destroy(Will $will)
    {
        $will->delete();
        return back();
    }



public function createDocument(Request $request,Faker $faker)
{
    $signFont = $this->font['signFont'];
    $signFont2 = $this->font['signFont2'];
    $signFont3 = $this->font['signFont3'];
    $signFont4 = $this->font['signFont4'];
    $data = Will::find($request->id);
    $time = time().$this->codeName().rand(1000,9999);    
    $codename = $this->codeName().time();
    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);




    $user = auth()->user();
    if($this->check_if_there_is_enough_credit($user->wallet,$request->cost) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
    }
    $this->remove_from_wallet_and_update($user,$request->cost);  //update cost 
    $this->recordHistory("Downloaded Will at $".$request->cost." #".$codename,$user,"will");// recording history
  
   
    if($data->currency == "Pounds"){
        $sign = "£"; 
    }elseif($data->currency == "Euros"){
        $sign = "€"; 
    }else{
        $sign = "$";
    }



    $signbg = Image::make("will/blank.png");
    $signbg->text($data->testator, 20, 90, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(35);
    });
    $signbg->save('will/sign/testator_'.$time.'.png'); 


    $probate_first_name = $faker->firstName;
    $probate_last_name =  $faker->lastName;
    $witness_first_name = $faker->firstName;
    $witness_last_name =  $faker->lastName;

    // Probate officer
    $signbg2 = Image::make("will/blank.png");
    $sign_name2 = ucwords(strtolower($probate_first_name)).".".ucwords(substr(strtoupper($probate_last_name),0,1));
    $signbg2->text($sign_name2, 5, 70, function($font) use ($signFont2){
        $font->file($signFont2); 
        $font->size(35);
    });
    $signbg2->save('will/sign/probate_'.$time.'.png'); 
    

    // Witness
    $signbg3 = Image::make("will/blank.png");
    $sign_name3 = ucwords(strtolower($witness_first_name)).".".ucwords(substr(strtoupper($witness_last_name),0,3));
    $signbg3->text($sign_name3, 5, 70, function($font) use ($signFont4){
        $font->file($signFont4); 
        $font->size(35);
    });
    $signbg3->save('will/sign/witness_'.$time.'.png'); 
    
    // Lawyer
    $signbg4 = Image::make("will/blank.png");
    $sign_name4 = ucwords(strtolower($data->lawyer));
    $signbg4->text($sign_name4, 5, 70, function($font) use ($signFont){
        $font->file($signFont); 
        $font->color("#1E90FF");
        $font->size(35);
    });
    $signbg4->save('will/sign/lawyer_'.$time.'.png'); 

    $info = [
        'amount_in_words' =>  $f->format(round($data->amount, 2)),
        'currency' => $sign,
        'testator_sign' => $data->property,
        'time' => $time,
        'probate_first_name'=> $probate_first_name,
        'probate_last_name'=> $probate_last_name,
        'witness_first_name'=> $witness_first_name,
        'witness_last_name'=> $witness_last_name,
        'comm' => $this->getRndInteger(10000000,99999999),
        'day_month'=> $this->monthFull_day($data->issued_date),
        'year_last_num'=> substr($data->issued_date,2,2),
        'law_expiry'=>  $this->monthShort_day_year($this->get_date_on($data->issued_date, "+5 years" ))
    ];

    $pdf = PDF::loadView('will/template/theme', compact('data','info'))
    ->setOptions(["header-html"=>"download.header"]);
    $pdf->getDomPDF()->set_option("enable_php", true);
    return $pdf->download('download.pdf');
    
}    




}