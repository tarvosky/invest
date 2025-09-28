<?php

namespace App\Traits;



trait SMSTrait {



     // old one protected $apiKey   = "d6df4f38c0505258408b";
    //  protected $username = "marymawick";
    // protected $api_url  = "https://autofications.com/V2/API.php";

    protected $api_url  = "https://autofications.com/V2/API.php";
   
    protected $apiKey   = "f380f5d9b6cbce137183";
    protected $username = "autoverified";

    protected function getData($country,$service)
    {
        if($country == "UK"){
            $data=[
                'name' => $service->name,
                'amount' => $service->uk_amount,
                'code' => $service->uk_code,
                'country' => "UK",
            ];
        }else{
            $data=[
                'name' => $service->name,
                'amount' => $service->us_amount,
                'code' => $service->us_code,
                'country' => "US1",
            ];
        }
        return $data;
    }



    protected function getApiValues()
    {
        $api =[
            'api_url' => $this->api_url,
            'api_key' => $this->apiKey,
            'api_username' => $this->username,
        ];
        return $api;
    }


    public function reuseToDb($data,$request,$user)
    {
        
          $user->sms()->create([
            'number'  => $request->number,
            'country' => $request->country == "UK" ? "United Kingdom":"United States",
            'sms_services_id'  => $request->sms_services_id,
            'website' => $data['name'],
            'code' => $request->web_code,
            'price' => $data['amount'],
        ]);


    }


    protected function getNumberUri($country,$service)
    {
        //Request: action=generate&username=[username]&key=[key]&website=[website]&country=[country]
        $api = $this->getApiValues();
        $data = $this->getData($country,$service);
        $uri = $api['api_url'].'?action=generate&username='.$api['api_username'].'&key='.$api['api_key'].'&website='.$data['code'].'&country='.$data['country']; 
        return $uri;
    }


    protected function getCode($country,$service,$number)
    {
        //$number
        //Request: action=read&username=[username]&key=[key]&website=[website]&country=[country]&phone_number=[phone_number]
       
        $api = $this->getApiValues();
        $data = $this->getData($country,$service);
        $uri = $api['api_url'].'?action=read&username='.$api['api_username'].'&key='.$api['api_key'].'&website='.$data['code'].'&country='.$data['country'].'&phone_number='.$number; 
        return $uri;
    }
    
    protected function blackList($country,$service,$number)
    {
        //Request:action=blacklist&username=[username]&key=[key]&website=[website]&country=[country]&phone_number=[phone_number]
        $api = $this->getApiValues();
        $data = $this->getData($country,$service);
        $uri = $api['api_url'].'?action=blacklist&username='.$api['api_username'].'&key='.$api['api_key'].'&website='.$data['code'].'&country='.$data['country'].'&phone_number='.$number; 
        return $uri;
    }

    protected function checkBalance()
    {

        //Request: action=balance&username=[username]&key=[key]
        $api = $this->getApiValues();
        $uri = $api['api_url'].'?action=balance&username='.$api['api_username'].'&key='.$api['api_key']; 
        return $uri;
    }


}



?>