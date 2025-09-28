<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use Illuminate\Http\Request;
use App\Traits\SMSTrait;
use App\Models\SmsService;
use Illuminate\Support\Facades\Http;
use App\Traits\Payment;
use App\Models\User;

class SMSController extends Controller
{

    use SMSTrait,Payment;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('postSmsService');
    }




    public function index()
    {
        $data = SMS::where('user_id',auth()->user()->id)->orderBy('id','Desc')->get();
        return view('sms.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function show(SMS $sMS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SMS $sMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sMS)
    {
        //
    }



// working part


    public function getSms()
    {
        $service = SmsService::orderBy('name')->get();
        return view('sms.get-sms',compact('service'));
    }







    public function getNumber(SmsService $service,$country)
    {
        $data = $this->getData($country,$service);
        $api  = $this->getApiValues();
        $user = auth()->user();
        if($this->check_if_there_is_enough_credit($user->wallet,$data['amount']) === false){
            return  redirect('verification/get-sms')->withErrors(array('cost' => "insufficient funds!"));
        }
        return view('sms.get-number',compact('data','api','service'));
    }


    public function reuseNumber($thetime,$number,SmsService $service,$country)
    {
        $date1 = urldecode($thetime);
        $date2 = date('Y-m-d H:i:s');
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        $hour = abs($timestamp2 - $timestamp1)/(60*60);
        if($hour > 20){
            return  redirect('sms')->withErrors(array('cost' => "The phone number is unavailable and cannot be reused!"));
        }
        $data = $this->getData($country,$service);
        $api  = $this->getApiValues();
        $user = auth()->user();
        if($this->check_if_there_is_enough_credit($user->wallet,$data['amount']) === false){
            return  redirect('verification/get-sms')->withErrors(array('cost' => "insufficient funds!"));
        }
        return view('sms.reuse-number',compact('data','api','service','number'));
    }


    









    public function getNumberAjax(SmsService $service,$country)
    {
        $uri = $this->getNumberUri($country,$service); 
        $response = Http::get($uri);
        return response()->json([
            'data' => $response->body(),
        ]);
    }
    
    public function getBalanceAjax()
    {
        $uri = $this->checkBalance(); 
        $response = Http::get($uri);
        return response()->json([
            'data' => $response->body(),
        ]);
    }
    

    public function requestCodeAjax(SmsService $service,$country,$number)
    {
        // http://dl.local/sms-ajax/request-code/17/UK/447951063599
        $uri = $this->getCode($country,$service,$number);
        $response = Http::get($uri);
        return response()->json([
            'data' => $response->body(),
        ]);
    }




    public function check_error($error)
    {
        $ans = FALSE;
        if($error == "Balance_error" || 
          $error == "Not_received" || 
          $error == "Number_zero" || 
          $error == "Website_error" || 
          $error == "Number_error" || 
          $error == "Request_limited" 
        ){
        $ans = TRUE;
        }

        return $ans;

    }
    




    public function postSmsService(Request $request)
    {

        $user = User::find($request->user_id);
        $userAdmin = User::where('username','adminxxx101')->first();
        $service = SmsService::find($request->sms_services_id);
        $data = $this->getData($request->country,$service);
        $state = "Reuse";
        if($request->state == "use"){   // There are two options use or reuse, use ->get-number page while reuse is in reuse page
                    if($this->check_error($request->web_code) === true){
                        // there is error so dont debit but put history for admin
                        
                        $state = "";
                        //$this->reuseToDb($data,$request,$user); // no need to add to db the user doent need to have it stored
                        $this->recordHistory("Error  ".$request->web_code.": ".$request->number." SMS Verification for ".$data['name']." by ".$user->username." ".$state." at $".$data['amount'],$userAdmin,"sms"); //update history
                    }else{
                        // there is no error is so debit and put history
                        
                        
                        $state = "";
                        $this->reuseToDb($data,$request,$user);
                        $this->remove_from_wallet_and_update($user,$data['amount']);  //update cost
                        $this->recordHistory("Requested SMS Verification for ".$data['name']." ".$state." ".$request->number."/".$request->web_code." at $".$data['amount'],$user,"sms"); //update history
                    }
        }else{
                    if($this->check_error($request->web_code) === true){
                        // there is error so dont debit just put history for admin
                        // no need to add to admin sms
                        $state = "";
                        //$this->remove_from_wallet_and_update($user,$data['amount']);  //update cost
                        $this->recordHistory("Error  ".$request->web_code.": ".$request->number." SMS Verification for ".$data['name']." by ".$user->username." ".$state." at $".$data['amount'],$userAdmin,"sms"); //update history

                    }else{
                        // there is no error so debit and put history
                        // no need to update sms you cant reuse a reuse 
                        
                        $state = "";
                        $this->remove_from_wallet_and_update($user,$data['amount']);  //update cost
                        $this->recordHistory("Requested SMS Verification for ".$data['name']." ".$state." ".$request->number."/".$request->web_code." at $".$data['amount'],$user,"sms"); //update history
                    }
        }
        return response()->json([
            'data' => 'success',
        ]);

    }


}
