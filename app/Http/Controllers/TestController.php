<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Traits\TaxTrait;
use PDF;
use App\Traits\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\referralBonus;

class TestController extends Controller
{


use TaxTrait, Payment;


    // $photoImage->resize(403, 390); 
    // $photoImage->opacity(60); 
    // $photoImage->crop(280, 340, 58,0 );


    public function cropImage()
    {
       //echo date("Y");
        
        $time = time();    
        $picture = "license/photo/371.png";        
        $photoImage = Image::make($picture);
        $photoImage->resize(270, 270); 
       $photoImage->opacity(60); 
       $photoImage->crop(242, 270, 28,0 );
        $photoImage->greyscale();
        $photoImage->save('license/test/'.$time.'.png'); 
        return view('test.imagecrop')->with('image',$time.'.png');
        
    }

    public function tax()
    {
        //dd(100);
        //echo date("Y");
        $akFont = "fonts/arialbd.ttf";
        $time = time();    
        $picture = "tax/1040.jpg";       
        $img = Image::make($picture);
        $year="19";
        $img->text(strtoupper($year), 420, 280, function($font) use ($akFont){
            $font->file($akFont); 
            $font->size(50);
        });
        //$img->sharpen(30);
        $img->save('tax/completed/'.$time.'.png'); 
       $data = ['filename'=>$time.'.png'];
       $pdf = PDF::loadView('tax-template/1040',compact('data'));
        return $pdf->download('1040.pdf');
        
    }

    // referral bonus
    public function payment()
    {
        $user= auth()->user();
        $amount = 50;
        $this->referral_bonus($user,$amount);
        return "ook";
    }

    public function paymentBonusOn500Above1000()
    {

        $amount = 500;
        if($amount >= 500){
            $percentage = 0.10*$amount;
        }elseif($amount >= 1000){
            $percentage  = 0.20*$amount;
        }else{
            $percentage =0;
        }
        return $percentage;
    }


    public function checkDate()
    {

    
        if( strtotime("02/22/2020") < strtotime("02/23/2020") ) {
            dd("error");
        }

        dd("yes");
    
    }
    






}





// $photoImage->resize(343, 310); 
// $photoImage->opacity(60); 
// $photoImage->crop(250, 310, 40,0 );




// $photoImage->resize(403, 390); 
// $photoImage->opacity(70); 
// $photoImage->crop(270, 355, 68,0 );

// $photoImage->resize(300, 290); 
// $photoImage->opacity(60); 
//  $photoImage->crop(232, 290, 32,0 );

// $photoImage->resize(70, 105);
// $photoImage->crop(70, 90, 0,0 );

// $photoImage->resize(488, 440); 
// $photoImage->opacity(70); 
// $photoImage->crop(310, 380, 90,0 );

// $photoImage->resize(463, 440); 
// $photoImage->opacity(70); 
// $photoImage->crop(280, 380, 90,0 );

// $photoImage->resize(403, 390); 
// $photoImage->opacity(70); 
// $photoImage->crop(280, 380, 90,0 );


// $photoImage->resize(373, 300); 
// $photoImage->opacity(60); 
// $photoImage->crop(210, 270, 80,0 );