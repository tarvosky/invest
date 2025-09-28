<?php

namespace App\Traits;

use Image;
use DNS1D;
use DNS2D;
use ZipArchive;
use File;
use App\Models\User;
use PDF;

trait UtilityTrait {

    // October 02, 1900
    public function monthFull_day_year($date){
        $bd = $date = strtotime($date);
        return ucwords(date('F j, Y', $bd));
    }

    public function monthFull_day($date){
        $bd = $date = strtotime($date);
        return ucwords(date('F j', $bd));
    }

    // Oct 02, 1900
    public function monthShort_day_year($date){
        $bd = $date = strtotime($date);
        return ucwords(date('M j, Y', $bd));
    }

    public function monthShort_day($date){
        $bd = $date = strtotime($date);
        return ucwords(date('M j', $bd));
    }

    /** @param string  date '2021-08-23'
     *  @param string '+30 days'
     */
    public function get_date_on($date,$n_days){
        return  date('Y-m-d', strtotime($n_days, strtotime($date)));
    }



    public function array_decimals(){
        $arr = [ 0.21,0.22,0.23,0.24,0.25,0.31,0.32,0.33,0.35,0.41,0.42,0.43,0.44,0.45,0.46,0.52,0.51,0.52,0.53,0.54,0.61,0.62,0.63,0.64,0.65,0.66,0.72,0.73,0.74,0.75,0.76,0.77,0.84,0.85,0.86,0.87,0.88,0.92,0.93,0.94,0.95,0.96]; 
        shuffle($arr);
        return $arr[0];
    } 
    

    public  $array_type = [
        "att" => "AT&T USA",
        "directv" => "DIRECTV USA",
        "spectrum" => "SPECTRUM USA",
        "xfinity" => "XFINITY USA",

    ];

    public function get_xfinity($data,$info){

      
       $boldFont = $info['boldFont'];
       $normalFont = $info['normalFont'];
       $ArialLightFont = $info['ArialLightFont'];
       $OCRAStdFont = $info['OCRAStdFont'];
       $time = $info['time'];
       $theme = "utilities/xfinity.png"; 
       $img = Image::make($theme);


       $from = $this->get_date_on($data->billing_date,'+5 days');
       $to = $this->get_date_on($data->billing_date,'+35 days');
       $ccp_date = $this->get_date_on($data->billing_date,'-15 days');
       $duedate = $this->get_date_on($data->billing_date,'+26 days');

       $rand = rand(175,210);
       $prev_balance = $rand - $this->array_decimals();
       $c2 = 9.53;
       $c1 = $prev_balance - $c2;

    
       $account_number = "17".$this->getRndInteger(11,99)." ".$this->getRndInteger(10,99)." ".$this->getRndInteger(100,999)." ".$this->getRndInteger(1000000,9999999);
       $img->text(strtoupper($account_number ), 1005, 200, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(30);
       });

       $img->text($this->monthShort_day_year($data->billing_date), 1430, 200, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(30);
       });
       $name = $data->first_name." ".$data->last_name.",";
       $img->text(ucwords($name), 350, 600, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(80);
       });
       $city_and_zip = "For ".strtoupper($data->street." ".$data->city." ".$data->state." ".$data->zip);
       $img->text($city_and_zip, 135, 870, function($font) use ( $normalFont){
           $font->file( $normalFont); 
           $font->color('#ffffff');
           $font->size(38);
       });
       $from_and_to = $this->monthShort_day_year($from)." to ".$this->monthShort_day_year($to);
       $img->text($from_and_to, 1725, 200, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(30);
       });
       $img->text("$".number_format($prev_balance,2), 1040, 945, function($font) use ( $normalFont){
           $font->file( $normalFont);
           $font->size(30);
       });
       $ccp_date = $this->monthShort_day($ccp_date);
       $img->text($ccp_date, 716, 1020, function($font) use ( $normalFont){
           $font->file( $normalFont);
           $font->size(33);
       });


       $img->text("-$".number_format($prev_balance,2), 1030, 1020, function($font) use ( $ArialLightFont){
           $font->file( $ArialLightFont);
           $font->size(30);
       });

       $img->text("$".number_format($c1,2), 1040, 1190, function($font) use ( $ArialLightFont){
           $font->file( $ArialLightFont);
           $font->size(30);
       });

       $img->text("$".number_format($c2,2), 1073, 1260, function($font) use ( $ArialLightFont){
           $font->file( $ArialLightFont);
           $font->size(30);
       });

       $img->text("$".number_format($prev_balance,2), 1010, 1325, function($font) use ( $boldFont){
           $font->file( $boldFont);
           $font->size(40);
       });
       $img->text( $this->monthShort_day_year($duedate), 460, 1467, function($font) use ( $boldFont){
           $font->file( $boldFont);
           $font->color('#ffffff');
           $font->size(50);
       });

       $img->text("$".number_format($prev_balance,2), 975, 1470, function($font) use ( $boldFont){
           $font->file( $boldFont);
           $font->color('#ffffff');
           $font->size(50);
       });

       $name = strtoupper($data->first_name." ".$data->last_name);
       $img->text(ucwords($name), 140, 2680, function($font) use ($normalFont){
           $font->file($normalFont);
           $font->size(30);
       });

       $img->text(strtoupper($data->street), 140, 2720, function($font) use ( $normalFont){
           $font->file( $normalFont); 
           $font->size(30);
       });
       $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
       $img->text($city_and_zip, 140, 2760, function($font) use ( $normalFont){
           $font->file( $normalFont); 
           $font->size(30);
       });

       $img->text(strtoupper($account_number ), 140, 3200, function($font) use ($OCRAStdFont){
           $font->file($OCRAStdFont);
           $font->size(40);
       });
       $img->text(strtoupper($account_number ), 1920, 2365, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(50);
       });
       $img->text($this->monthShort_day_year($duedate), 1920, 2435, function($font) use ($ArialLightFont){
           $font->file($ArialLightFont);
           $font->size(50);
       });
       $img->text("$".number_format($prev_balance,2), 1920, 2525, function($font) use ($boldFont){
           $font->file($boldFont);
           $font->size(70);
       });

       $first_part = substr($this->monthShort_day_year($data->billing_date),0,7);
       $sec_part = substr($this->monthShort_day_year($data->billing_date),7,5);


       $img->text(ucwords($first_part), 2210, 910, function($font) use ($normalFont){
           $font->file($normalFont);
           $font->size(35);
       });
       $img->text(ucwords($sec_part),  1395, 960, function($font) use ($normalFont){
           $font->file($normalFont);
           $font->size(35);
       });

       $img->save('utilities/completed/'.$time.'.png'); 
       $data = ['filename'=>$time.'.png']; // used this for image name In the page
       $pdf = PDF::loadView('utility/template/utility',compact('data'));
       return $pdf;
       

    } 



    public function get_att($data,$info){
        $boldFont = $info['boldFont'];
        $normalFont = $info['normalFont'];
        $ArialLightFont = $info['ArialLightFont'];
        $OCRAStdFont = $info['OCRAStdFont'];
        $time = $info['time'];
        $theme = "utilities/att.png"; 
        $img = Image::make($theme);


       $rand = rand(90,100);
       $payment = $rand - $this->array_decimals();
       $schedule = $this->get_date_on($data->billing_date,'+30 days');
       $diff = 6.89;
       $prev = $payment - $diff;

        $img->text(ucwords($this->monthShort_day_year($data->billing_date)), 830, 66, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(16);
        });

        $account_number = $this->getRndInteger(1000000000,9999999999);
        $img->text(strtoupper($account_number ), 830, 88, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(16);
        });

        $img->text("$".number_format($payment,2 ), 770, 320, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(55);
        });
        $img->text(ucwords($this->monthShort_day_year($schedule)), 800, 390, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(20);
        });

        $img->text("$".number_format($prev,2 ), 620, 520, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(20);
        });
        $img->text("-$".number_format($prev,2 ), 613, 560, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(20);
        });
        $img->text("$".number_format($payment,2 ), 620, 700, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(20);
        });
        $img->text("+$".number_format($diff,2 ), 640, 720, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(10);
        });
        $img->text("$".number_format($prev,2 ), 534, 720, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(10);
        });
        $img->text("$".number_format($payment,2 ), 610, 753, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(23);
        });
        $img->text("$".number_format($payment,2 ), 590, 840, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(26);
        });
        $img->text("Autopay is scheduled to charge your card on ".ucwords($this->monthShort_day_year($schedule)), 100, 855, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(13);
        });

        $img->text("Autopay of $".number_format($payment,2 )." is scheduled for", 607, 1317, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(18);
        });
        $img->text(ucwords($this->monthShort_day_year($schedule)), 608, 1342, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(18);
        });
        $img->text(strtoupper($account_number ), 715, 1361, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(15);
        });


        $name = strtoupper($data->first_name." ".$data->last_name);
        $img->text(ucwords($name), 270, 1320, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(14);
        });
 
        $img->text(strtoupper($data->street), 270, 1340, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(14);
        });
        $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
        $img->text($city_and_zip, 270, 1360, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(14);
        });
        
        $img->text(strtoupper($account_number ), 682, 1552, function($font) use ($OCRAStdFont){
            $font->file($OCRAStdFont);
            $font->size(14);
        });

        $img->save('utilities/completed/'.$time.'.png'); 
        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('utility/template/utility',compact('data'));
        return $pdf;
        

     } 

    

     public function get_spectrum($data,$info){
        $boldFont = $info['boldFont'];
        $normalFont = $info['normalFont'];
        $ArialLightFont = $info['ArialLightFont'];
        $OCRAStdFont = $info['OCRAStdFont']; 
        $arialMediumFont = $info['arialMediumFont'];
        $time = $info['time'];
        $theme = "utilities/spectrum.png"; 
        $img = Image::make($theme);

        $rand1 = rand(300,395);
        $prev = $rand1 - $this->array_decimals();
        $rand2 = rand(230,285);
        $payRev = $rand2 - $this->array_decimals();

        $c1 = rand(60,69) -  $this->array_decimals();
        $c2 = rand(70,79) - $this->array_decimals();
        $c3 = rand(8,9) - $this->array_decimals();
        $c4 = rand(11,12) - $this->array_decimals();
        $c5 = rand(4,6) - $this->array_decimals();
        $currCharge = $c1+$c2+$c3+$c4+$c5;
        $total_due = ($prev +  $currCharge) - $payRev; 

        $duedate = $this->get_date_on($data->billing_date,'+17 days');

        
        $from = $data->billing_date;
        $to = $this->get_date_on($data->billing_date,'+30 days');




        $img->text($this->monthFull_day_year($data->billing_date), 120,140, function($font) use ( $normalFont){
            $font->file( $normalFont);
            $font->size(19);
        });
        $account_number = $this->getRndInteger(100,999)." ".$this->getRndInteger(11,99)." ".$this->getRndInteger(100,999)." ".$this->getRndInteger(1000000,9999999);
        $img->text($account_number , 310, 170, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(18);
        });
        $code= $this->getRndInteger(1000,9999);
        $img->text($code, 310, 195, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(18);
        });
        $img->text(strtoupper($data->street), 310, 220, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
        $img->text($city_and_zip, 310, 245, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });

    
        $serA = "Service from ".date("m/d/y", strtotime($from))." through ".date("m/d/y", strtotime($to));
        $serB = "details on the following pages";

        $img->text($serA, 280, 470, function($font) use ( $arialMediumFont){
            $font->file( $arialMediumFont); 
            $font->size(15);
            $font->color('#ffffff');
        });
        $img->text($serB, 280, 495, function($font) use ( $arialMediumFont){
            $font->file( $arialMediumFont); 
            $font->size(15);
            $font->color('#ffffff');
        });


        $img->text(number_format($prev,2), 640, 535, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text("-".number_format($payRev,2), 635, 565, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text(number_format($c1,2), 650, 600, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text(number_format($c2,2), 650, 630, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text(number_format($c3,2), 660, 660, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text(number_format($c4,2), 650, 690, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text(number_format($c5,2), 660, 720, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });


        $img->text(date("m/d/y", strtotime($duedate)), 390, 750, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(19);
        });

        $img->text("$".number_format($currCharge,2), 630, 750, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text("$".number_format($total_due,2), 625, 795, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->color('#005bb4'); 
            $font->size(18);
        });

        $name = strtoupper($data->first_name." ".$data->last_name);
        $img->text(ucwords($name), 80, 1520, function($font) use ($ArialLightFont){
            $font->file($ArialLightFont);
            $font->size(17);
        });
        $img->text(strtoupper($data->street), 80, 1545, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
        $img->text($city_and_zip, 80, 1570, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });








        $img->text($this->monthFull_day_year($data->billing_date), 1000,1325, function($font) use ( $normalFont){
            $font->file( $normalFont);
            $font->size(17);
        });
        $name = strtoupper($data->first_name." ".$data->last_name);
        $img->text(ucwords($name), 1000, 1355, function($font) use ($boldFont){
            $font->file($boldFont);
            $font->size(17);
        });
        $img->text($account_number , 1000, 1385, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(18);
        });
        $img->text(strtoupper($data->street), 1000, 1410, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
        $img->text($city_and_zip, 1000, 1435, function($font) use ( $ArialLightFont){
            $font->file( $ArialLightFont); 
            $font->size(17);
        });
        $img->text("$".$total_due, 1330, 1485, function($font) use ($normalFont){
            $font->file($normalFont);
            $font->size(19);
        });















        $img->save('utilities/completed/'.$time.'.png'); 
        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('utility/template/utility',compact('data'));
        return $pdf;
     }







     public function get_directv($data,$info){
        $humboldFont = $info['humboldFont'];
        $humFont = $info['humFont'];
        $boldFont = $info['boldFont'];
        $normalFont = $info['normalFont'];
        $ArialLightFont = $info['ArialLightFont'];
        $OCRAStdFont = $info['OCRAStdFont'];
        $time = $info['time'];
        $theme = "utilities/directv.png"; 
        $img = Image::make($theme);


        $from = $data->billing_date;
        $to = $this->get_date_on($data->billing_date,'+30 days');
        $statement_date = $this->get_date_on($data->billing_date,'+1 days');
        $duedate = $this->get_date_on($data->billing_date,'+15 days');
 
        $rand = rand(180,199);
        $prev_balance = $rand - $this->array_decimals();
        $c1 = 46.99;
        $c2 = 13 - $this->array_decimals();
        $dc = $prev_balance - ($c1+$c2);

        
                  
        $duedate_day = date_format(date_create($duedate), 'd');
        $duedate_month = date_format(date_create($duedate), 'M');
        $duedate_year = date_format(date_create($duedate), 'Y');
        
       
      

        

        $account_number = $this->getRndInteger(10000000,99999999);
        $img->text(strtoupper($account_number ), 217, 227, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(19);
        });
        $name = strtoupper($data->first_name." ".$data->last_name);
        $img->text(ucwords($name), 253, 253, function($font) use ($humFont){
            $font->file($humFont);
            $font->size(19);
        });
        $img->text(strtoupper($data->street), 95, 280, function($font) use ( $humFont){
            $font->file( $humFont); 
            $font->size(19);
        });
        $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
        $img->text($city_and_zip, 95, 310, function($font) use ( $humFont){
            $font->file( $humFont); 
            $font->size(19);
        });

        $img->text(date("m/d/y", strtotime($statement_date)), 1360, 225, function($font) use ($humFont){
            $font->file($humFont);
            $font->size(19);
        });
        $xxx = date("m/d/y", strtotime($from))." to ".date("m/d/y", strtotime($to));
        $img->text($xxx, 1252, 253, function($font) use ($humFont){
            $font->file($humFont);
            $font->size(19);
        });
        
        $img->text("$".number_format($prev_balance,2), 1370, 425, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(18);
        });
        $img->text("-".number_format($prev_balance,2), 1375, 455, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(18);
        });
        $img->text( number_format($dc,2), 1380, 500, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(18);
        });
        $img->text( number_format($c1,2), 1390, 530, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(18);
        });
        $img->text( number_format($c2,2), 1390, 560, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(18);
        });
        $img->text(number_format($prev_balance,2), 1380, 590, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(18);
        });
        $img->text("$".number_format($prev_balance,2), 1370, 620, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(18);
        });
        $img->text("$".number_format($prev_balance,2), 170, 620, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(30);
        });

   
        $img->text($duedate_year, 530, 560, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(20);
        });
        $img->text($duedate_month, 530, 600, function($font) use ( $humFont){
            $font->file( $humFont);
            $font->size(20);
        });
        $img->text($duedate_day, 528, 640, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(40);
        });
        $img->text(strtoupper($account_number ), 548, 1495, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(19);
        });

        $img->text(date("m/d/y", strtotime($duedate)), 778, 1495, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(19);
        });
        $img->text("$".number_format($prev_balance,2), 1018, 1495, function($font) use ( $humboldFont){
            $font->file( $humboldFont);
            $font->size(19);
        });


        $name = strtoupper($data->first_name." ".$data->last_name);
        $img->text(ucwords($name), 90, 1600, function($font) use ($humFont){
            $font->file($humFont);
            $font->size(17);
        });
 
        $img->text(strtoupper($data->street), 90, 1620, function($font) use ( $humFont){
            $font->file( $humFont); 
            $font->size(17);
        });
        $city_and_zip = strtoupper($data->city." ".$data->state." ".$data->zip);
        $img->text($city_and_zip, 90, 1640, function($font) use ( $humFont){
            $font->file( $humFont); 
            $font->size(17);
        });




        $img->save('utilities/completed/'.$time.'.png'); 
        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('utility/template/utility',compact('data'));
        return $pdf;
    }


}



?>