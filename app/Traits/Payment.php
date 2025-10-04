<?php

namespace App\Traits;

use App\Models\Charge;
use Illuminate\Support\Facades\Mail;
use App\Mail\referralBonus;

trait Payment {




    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateAddress(){
        $options = array(
            'http' => array(
                'header'  => 'Authorization: Bearer '.config('services.blockonomics.api_key'),
                'method'  => 'POST',
                'content' => '',
                'ignore_errors' => true
            )
        );

        $context = stream_context_create($options);
        $contents = file_get_contents(config('services.blockonomics.url')."new_address", false, $context);
       // $contents = file_get_contents($this->url."new_address?reset=1", false, $context);  // for testing purposes
        $object = json_decode($contents);

        // Check if address was generated successfully
        if (isset($object->address)) {
          $address = $object->address;
        } else {
          // Show any possible errors
          $address = $http_response_header[0]."\n".$contents;
        }
        return $address;
    }


    public function getBTCPrice($currency){
        $content = file_get_contents("https://www.blockonomics.co/api/price?currency=".$currency);
        $content = json_decode($content);
        $price = $content->price;
        return $price;
    }

    public function BTCtoUSD($amount){
        $price = $this->getBTCPrice("USD");
        return $amount * $price;
    }

    public function USDtoBTC($amount){
        $price = $this->getBTCPrice("USD");
        return $amount/$price;
    }


    public function getIp(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        }
        return $ip;
    }




    public function remove_from_wallet_and_update($user,$charge){

        $bal = $user->wallet - $charge;
        $user->wallet = $bal;
        $user->save();
    }

    public function check_if_there_is_enough_credit($wallet,$cost){
        if($wallet >= $cost){
            return true;
        }
        return false;
    }

    public function add_to_wallet_and_update($user,$cost){
        $bal = $user->wallet + $cost;
        $user->wallet = $bal;
        $user->save();
    }





    public function add_to_Download($bank,$amount,$balance,$user)
    {
        $user->downloads()->create([
            "bank"=>$bank,
            "amount"=>$amount,
            "balance"=>$balance,
        ]);
    }



    public function charges($slug)
    {
        $c = Charge::where('slug',$slug)->first();
        return $c->charge;
    }




    public function referral_bonus($user,$amount)
    {

        if($user->first_time_payment_status == null && $user->referrer_id != null){
            $percentage  = 0.25 * $amount;
            $upadted_amount = $user->referrer->referrer_bonus + $percentage;
            $user->referrer()->update([
                'referrer_bonus' => $upadted_amount
            ]);
            $user->first_time_payment_status = "paid";
            $user->save();
            $data = [
                'username'  => $user->referrer->username,
                'ref_username'   => $user->username,
                'amount'    => $percentage,
            ];

            $this->recordHistory("Received $".$percentage." as bonus ",$user->referrer,"referral_bonus");
            Mail::to($user->referrer->email)->send(new referralBonus($data));
        }

        return;

    }


    public function paymentBonusOn500Above1000($amount)
    {
        if($amount >= 500 && $amount < 1000){
            $percentage = 0.10*$amount;
        }elseif($amount >= 1000){
            $percentage  = 0.20*$amount;
        }else{
            $percentage =0;
        }
        return $percentage ;
    }



    public function recordHistory($des,$user,$cat)
    {

        // categories: referral_bonus,bonus,refund, customize,payment,license,statements,passport,ssn,1040,1099,w2,bank
        $user->histories()->create([
            'description'=> $des,
            'balance'=>  $user->wallet,
            'category'=> $cat,
            'ip'=>$this->getIp(),
          ]);
    }






}




?>
