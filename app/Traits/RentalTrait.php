<?php

namespace App\Traits;

use Image;
use DNS1D;
use DNS2D;
use ZipArchive;
use File;
use App\Models\User;
use PDF;
use Faker\Generator as Faker;

trait RentalTrait {

 

    public function get_ntv($data,$info,$faker){


       $boldFont = $info['boldFont'];
       $normalFont = $info['normalFont'];
       $ArialLightFont = $info['ArialLightFont'];
       $OCRAStdFont = $info['OCRAStdFont'];
       $signFont =$info['signFont'];
       $signFont2 =$info['signFont2'];
       $signFont3 =$info['signFont3'];
       $time = $info['time'];
       $theme = "rental/vacate.png"; 
       $img = Image::make($theme);

       $name = $data->first_name." ".$data->last_name;
       $img->text(strtoupper($name), 500, 610, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(50);
       });
       $add = strtoupper($data->street." ".$data->city).", ". strtoupper($data->state).", ". $data->zip;
       $img->text($add, 350, 710, function($font) use ($boldFont){
        $font->file($boldFont);
        $font->size(50);
       });


       $name = $data->landlord_first_name." ".$data->landlord_last_name;
       $img->text(strtoupper($name), 850, 840, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(50);
       });



       $vd = date("m/d/Y", strtotime($data->vacating_date));
       $img->text($vd, 500, 970, function($font) use ($boldFont){
        $font->file($boldFont);
        $font->size(50);
       });
  

       if($data->tenant_signature == "YES"){
            $sign_name = substr(strtolower($data->first_name),0,5);
            $img->text($sign_name, 1000, 2035, function($font) use ($signFont){
                $font->file($signFont); 
                $font->size(100);
            });
            $sign_name = substr(strtoupper($data->last_name),0,1);
            $img->text($sign_name, 1000, 2040, function($font) use ($signFont){
                $font->file($signFont); 
                $font->size(100);
            });
       }

       if($data->landlord_signature == "YES"){
        $sign_name = ucwords(strtolower($data->landlord_first_name)).".".ucwords(substr(strtoupper($data->landlord_last_name),0,1));
        $img->text($sign_name, 860, 2270, function($font) use ($signFont2){
            $font->file($signFont2); 
            $font->size(85);
            $font->color("#1E90FF");
        });
      
   }


       $vd = date("m/d/Y", strtotime($data->form_date));
       $img->text($vd, 1990, 2040, function($font) use ($boldFont){
        $font->file($boldFont);
        $font->size(50);
       });

       $vd = date("m/d/Y", strtotime($data->form_date));
       $img->text($vd, 1990, 2270, function($font) use ($boldFont){
        $font->file($boldFont);
        $font->size(50);
       });


    

       $img->save('rental/completed/'.$time.'.png'); 
       $data = ['filename'=>$time.'.png']; // used this for image name In the page
       $pdf = PDF::loadView('rental/templates/theme',compact('data'));
       return $pdf;
       

    } 





    public function get_lr($data,$info){
        $boldFont = $info['boldFont'];
        $normalFont = $info['normalFont'];
        $ArialLightFont = $info['ArialLightFont'];
        $OCRAStdFont = $info['OCRAStdFont'];
        $signFont =$info['signFont'];
        $signFont2 =$info['signFont2'];
        $time = $info['time'];
        $theme = "rental/rent.png"; 
        $img = Image::make($theme);
        $date_format=  $this->birthday($data->form_date);


        $sealImage = Image::make('rental/seals/'.$data['state'].".png");
        $sealImage->resize(350, 350); 
        $img->insert($sealImage,'top-right',200, 30); 


        $sealImage->resize(1300, 1300); 
        $sealImage->opacity(7); 
        $img->insert($sealImage,'center',0,0); //picture y + up

        $img->text(strtoupper($info['full_state']), 500, 350, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(50);
        });


        $name = $data->first_name." ".$data->last_name;
        $img->text(ucwords($name), 500, 973, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(50);
        });


        $add = ucwords($data->street." ".$data->city).", ". strtoupper($data->state).", ". $data->zip;
        $img->text($add, 500, 1103, function($font) use ($boldFont){
         $font->file($boldFont);
         $font->size(50);
        });

        $img->text($date_format['birthMonth']."/".$date_format['birthDate'], 420, 1223, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(50);
        });


        $img->text(substr($date_format['birthYear'],2,2), 720, 1220, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(50);
        });


        $img->text($data->month, 500, 1582, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(40);
        });    


        $img->text(number_format($data->rent_fee,2), 1460, 1587, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(40);
        }); 

        $img->text("x", 1710, 1575, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(40);
        }); 


        $img->text(number_format($data->late_fee,2), 530, 1645, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(40);
        });   

        $img->text($data->account_number, 700, 1890, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(45);
        }); 
        $img->text($data->routing_number, 650, 1950, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(45);
        }); 
        $img->text(strtoupper($data->bank_name), 570, 2010, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(45);
        });      
        
        $name = $data->landlord_first_name." ".$data->landlord_last_name;
        $img->text(ucwords($name), 500, 2645, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(50);
        });

        // $add = ucwords($data->street." ".$data->city).", ". strtoupper($data->state).", ". $data->zip;
        // $img->text($add, 500, 2753, function($font) use ($boldFont){
        //  $font->file($boldFont);
        //  $font->size(50);
        // });

        $sign_name = ucwords(strtolower($data->landlord_first_name)).".".ucwords(substr(strtoupper($data->landlord_last_name),0,1));
        $img->text($sign_name, 500, 2753, function($font) use ($signFont2){
            $font->file($signFont2); 
            $font->size(85);
            $font->color("#1E90FF");
        });
        

        $img->text("State of ".ucwords(strtolower($info['full_state'])).": Official Late Rent Notice", 700, 3158, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(50);
           });
 
        $img->save('rental/completed/'.$time.'.png'); 
        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('rental/templates/theme',compact('data'));
        return $pdf;
        
 
     } 



     public function position($number) {

        if(substr($number,0,1) == "0"){
            $number = substr($number,1,5);
        }
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

    public $full_months = array(
        '01' =>'January',
        '02' =>'February',
        '03' =>'March',
        '04' =>'April',
        '05' =>'May',
        '06' =>'June',
        '07' =>'July ',
        '08' =>'August',
        '09' =>'September',
        '10' =>'October',
        '11' =>'November',
        '12' =>'December',
    );












    



}



?>