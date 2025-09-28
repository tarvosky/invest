<?php

namespace App\Http\Controllers;
use App\Traits\FontTrait;
use App\Traits\Payment;
use App\Models\Charge;
use App\Traits\FormatTrait;
use App\Traits\PaystubTrait;
use App\Traits\License;
use Image;
use PDF;
use DNS1D;
use DNS2D;
use NumberFormatter;
use App\Models\Paystub;
use Illuminate\Http\Request;

class PaystubController extends Controller
{
    use License,Payment,FontTrait,FormatTrait,PaystubTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
       //$this->middleware('auth');
        set_time_limit(8000000);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charge = Charge::where('slug','paystub')->first();
        $data = Paystub::where('user_id',auth()->user()->id)->get();
        return view('paystubs.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paystubs.create');
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
            'company_street' => 'required', 
            'company_city' => 'required' , 
            'company_state' => 'required' , 
            'company_zip' => 'required', 
            'name' => 'required', 
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'type' => 'required',
            'ssn' => 'required|numeric',
            'pay_date' => 'required',
            'pay_type' => 'required',
            'annual_pay' => 'required|numeric',
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->paystubs()->create($request->all());
       return  redirect()->route('paystubs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paystub  $paystub
     * @return \Illuminate\Http\Response
     */
    public function show(Paystub $paystub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paystub  $paystub
     * @return \Illuminate\Http\Response
     */
    public function edit(Paystub $paystub)
    {
        return view('paystubs.edit')->with('data', $paystub);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paystub  $paystub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paystub $paystub)
    {
        $this->validate($request, [ 
            'company_name' => 'required', 
            'company_street' => 'required', 
            'company_city' => 'required' , 
            'company_state' => 'required' , 
            'company_zip' => 'required', 
            'name' => 'required', 
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'type' => 'required',
            'ssn' => 'required|numeric',
            'pay_date' => 'required',
            'pay_type' => 'required',
            'annual_pay' => 'required|numeric',
          ]);
          //$user = auth()->user();
         // $user->paystubs()->update($request->except(['_token', '_method' ])); for  upating all to same values
          $paystub->update($request->except(['_token', '_method' ]));
          return  redirect()->route('paystubs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paystub  $paystub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paystub $paystub)
    {
        //
    }

    public function delete(Paystub $paystub)
    {
        $paystub->delete();
        return back();
    }

    public function createDocument(Request $request)
    {
        $data = Paystub::find($request->id);
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

        $figures = $this->figures($data);
        $user = auth()->user();
        $charge = Charge::where('slug','paystub')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  ".$data->type." of Paystub at $".$charge->charge." #".$time,$user,$data->type); //update history
        





        switch($data->type){
            case "type1":
                $pdf = $this->typeOne($figures,$info);
                return response()->download( $pdf);
                break;
            case "type2":
                $pdf = $this->typeTwo($figures,$info);
                return response()->download( $pdf);
                break;
            default:
            $pdf = $this->typeThree($figures,$info);
            return response()->download( $pdf);
            break; 
        }


    }

}
