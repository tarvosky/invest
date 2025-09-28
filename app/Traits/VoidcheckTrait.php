<?php

namespace App\Traits;

use Image;
use DNS1D;
use DNS2D;
use ZipArchive;
use File;
use App\Models\User;
use PDF;

trait VoidcheckTrait {

    public  $array_type = [
        "void1" => "VOID 1",
        "void2" => "VOID 2",
        "void3" => "VOID 3",
        "void4" => "VOID 4",

    ];

    public function void1($data,$info){

        $normalFont = $info['normalFont'];
        $micFont = $info['micFont'];
        $boldFont = $info['boldFont'];
        $micRegularFont = $info['micRegularFont'];
        $OCRAStdFont = $info['OCRAStdFont'];
        $time = $info['time'];
        $theme = "voidchecks/templates/void1.png";
        $bg = "license/background/".$data->background;
        $background = Image::make($bg); 
        $background->resize(1400, 1500);
        $img = Image::make($theme);
        $check_no = "00".$this->getRndInteger(1000, 9999);

        $img->text(strtoupper($data->company_name), 175, 880, function($font) use ( $boldFont){
        $font->file( $boldFont); 
        $font->size(18);
        });
        $img->text(strtoupper($data->company_street).",", 175, 900, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(16);
        });
        $city_and_zip = $data->company_city.", ".$data->company_state." ".$data->company_zip;
        $img->text(strtoupper($city_and_zip), 175, 917, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(16);
        });
        $img->text($check_no, 1030, 860, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(23);
        });

        $photoImage = Image::make('voidchecks/logos/'.$data->logo);
        $width = $photoImage->width();
        $height = $photoImage->height();
        $photoImage->greyscale();
        if($height > 70){
           $photoImage->resize(null, 70); 
           $img->insert($photoImage,'bottom-left',210, 240); //picture y + up
           
        }else{
            $img->insert($photoImage,'bottom-left',210, 260); //picture y + up
          
        }
       
        


        $num = $width + 205 + 10;
        $img->text(ucwords($data->bank_name), $num, 1122, function($font) use ( $normalFont){
           $font->file( $normalFont); 
           $font->size(13);
           // $font->angle(0.5);
       });
       $img->text(ucwords($data->bank_street).",", $num, 1134, function($font) use ( $normalFont){
           $font->file( $normalFont); 
           $font->size(13);
           // $font->angle(0.5);
       });
       $city_and_zip = $data->bank_city.", ".$data->bank_state." ".$data->bank_zip;
       $img->text(ucwords($city_and_zip), $num, 1146, function($font) use ( $normalFont){
           $font->file( $normalFont); 
           $font->size(13);
           // $font->angle(0.5);
       });



        $down_number = " c ".$data->routing_no."c a".$data->account_no." a".$check_no." c";
        $img->text($down_number, 230, 1240, function($font) use ($micFont){
            $font->file($micFont); 
            $font->size(42);
        });
       
       $img->save('voidchecks/destination/'.$time.'.png');  
       $background->insert('voidchecks/destination/'.$time.'.png','center');
       $background->save('voidchecks/final/'.$time.'.png');  
       $file= public_path(). '/voidchecks/final/'.$time.'.png';
       return $file;


    } 



    public function void2($data,$info){
        
        $normalFont = $info['normalFont'];
        $micFont = $info['micFont'];
        $boldFont = $info['boldFont'];
        $micRegularFont = $info['micRegularFont'];
        $time = $info['time'];
        $theme = "voidchecks/templates/void2.png";
        $bg = "license/background/".$data->background;
        $background = Image::make($bg); 
        $background->resize(1200, 1200);
        $img = Image::make($theme);
        $check_no = "00".$this->getRndInteger(1000, 9999);


        $img->text(strtoupper($data->company_name), 205, 720, function($font) use ( $boldFont){
            $font->file( $boldFont); 
            $font->size(14);
        });
        $img->text(strtoupper($data->company_street).",", 205, 735, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(12);
        });
        $city_and_zip = $data->company_city.", ".$data->company_state." ".$data->company_zip;
        $img->text(strtoupper($city_and_zip), 205, 750, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(12);
        });
        $img->text($check_no, 920, 720, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(18);
        });

        $down_number = " c".$data->routing_no." a ".$data->account_no."c   c".$check_no."c";
        $img->text($down_number, 205, 1020, function($font) use ($micFont){
            $font->file($micFont); 
            $font->size(30);
        });
        $photoImage = Image::make('voidchecks/logos/'.$data->logo);
        $width = $photoImage->width();
        $height = $photoImage->height();
        $photoImage->greyscale();
        if($height > 70){
           $photoImage->resize(null, 70); 
           $img->insert($photoImage,'bottom-left',210, 230); //picture y + up
        }else{
            $img->insert($photoImage,'bottom-left',210, 245); //picture y + up
        }
       
       


        $num = $width + 205 + 10;
        $img->text(ucwords($data->bank_name), $num, 912, function($font) use ( $boldFont){
           $font->file( $boldFont); 
           $font->size(9);
           // $font->angle(0.5);
       });
       $img->text(ucwords($data->bank_street).",", $num, 924, function($font) use ( $boldFont){
           $font->file( $boldFont); 
           $font->size(9);
           // $font->angle(0.5);
       });
       $city_and_zip = $data->bank_city.", ".$data->bank_state." ".$data->bank_zip;
       $img->text(ucwords($city_and_zip), $num, 936, function($font) use ( $boldFont){
           $font->file( $boldFont); 
           $font->size(9);
           // $font->angle(0.5);
       });


        $img->save('voidchecks/destination/'.$time.'.png');  
        $background->insert('voidchecks/destination/'.$time.'.png','center');
        $background->save('voidchecks/final/'.$time.'.png');  
        $file= public_path(). '/voidchecks/final/'.$time.'.png';
        return $file;
 
 
     } 

    

    public function void3($data,$info){
        
        $normalFont = $info['normalFont'];
        $micFont = $info['micFont'];
        $boldFont = $info['boldFont'];
        $micRegularFont = $info['micRegularFont'];
        $time = $info['time'];
        $theme = "voidchecks/templates/void3.png";
        $bg = "license/background/".$data->background;
        $background = Image::make($bg); 
        $background->resize(1600, 1600);
        $img = Image::make($theme);
        $check_no = "00".$this->getRndInteger(1000, 9999);

        $img->text(strtoupper($data->company_name), 405, 930, function($font) use ( $boldFont){
            $font->file( $boldFont); 
            $font->size(17);
            $font->angle(-0.2);
        });
        $img->text(strtoupper($data->company_street).",", 405, 950, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(15);
            $font->angle(-0.2);
        });
        $city_and_zip = $data->company_city.", ".$data->company_state." ".$data->company_zip;
        $img->text(strtoupper($city_and_zip), 405, 966, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(15);
            $font->angle(-0.2);
        });
        $img->text($check_no, 1250, 930, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(18);
            $font->angle(1);
        });

        $down_number = " c ".$data->routing_no." a ".$data->account_no." c ".$check_no." c";
        $img->text($down_number, 360, 1365, function($font) use ($micFont){
            $font->file($micFont); 
            $font->size(42);
            $font->angle(1);
        });



         $photoImage = Image::make('voidchecks/logos/'.$data->logo);
         $width = $photoImage->width();
         $height = $photoImage->height();
         $photoImage->greyscale();
         if($height > 70){
            $photoImage->resize(null, 70); 
            $img->insert($photoImage,'bottom-left',390, 370); //picture y + up
         }else{
            $img->insert($photoImage,'bottom-left',390, 400); //picture y + up
         }
         
         





        //dd($height);
        $num = $width + 390 + 10;
         $img->text(strtoupper($data->bank_name), $num, 1190, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(10);
            // $font->angle(0.5);
        });
        $img->text(strtoupper($data->bank_street).",", $num, 1202, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(10);
            // $font->angle(0.5);
        });
        $city_and_zip = $data->bank_city.", ".$data->bank_state." ".$data->bank_zip;
        $img->text(strtoupper($city_and_zip), $num, 1214, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(10);
            // $font->angle(0.5);
        });

        
        $img->save('voidchecks/destination/'.$time.'.png');  
        $background->insert('voidchecks/destination/'.$time.'.png','center');
        $background->save('voidchecks/final/'.$time.'.png');  
        $file= public_path(). '/voidchecks/final/'.$time.'.png';
        return $file;
     } 






     public function void4($data,$info){
        
        $normalFont = $info['normalFont'];
        $micFont = $info['micFont'];
        $boldFont = $info['boldFont'];
        $micRegularFont = $info['micRegularFont'];
        $time = $info['time'];
        $theme = "voidchecks/templates/void4.png";
        $bg = "license/background/".$data->background;
        $background = Image::make($bg); 
        $background->resize(1200, 1200);
        $img = Image::make($theme);
        $check_no = $this->getRndInteger(1000, 9999);

        $img->text(strtoupper($data->company_name), 205, 650, function($font) use ( $boldFont){
            $font->file( $boldFont); 
            $font->size(14);
        });
        $img->text(strtoupper($data->company_street).",", 205, 665, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(14);
        });
        $city_and_zip = $data->company_city.", ".$data->company_state." ".$data->company_zip;
        $img->text(strtoupper($city_and_zip), 205, 680, function($font) use ( $normalFont){
            $font->file( $normalFont); 
            $font->size(14);
        });
        $img->text($check_no, 840, 670, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(24);
        });
        $photoImage = Image::make('voidchecks/logos/'.$data->logo);
        $width = $photoImage->width();
        $height = $photoImage->height();
        $photoImage->greyscale();
        if($height > 50){
           $photoImage->resize(null, 50); 
           $img->insert($photoImage,'bottom-left',240, 190); //picture y + up
        }else{
            $img->insert($photoImage,'bottom-left',240, 200); //picture y + up
        }
        
        

   
        $num = $width + 238 + 10;
        $img->text(ucwords($data->bank_name), $num, 850, function($font) use ( $boldFont){
           $font->file( $boldFont); 
           $font->size(9);
           // $font->angle(0.5);
       });
       $img->text(ucwords($data->bank_street).",", $num, 862, function($font) use ( $boldFont){
           $font->file( $boldFont); 
           $font->size(9);
           // $font->angle(0.5);
       });
       $city_and_zip = $data->bank_city.", ".$data->bank_state." ".$data->bank_zip;
       $img->text(ucwords($city_and_zip), $num, 874, function($font) use ( $boldFont){
           $font->file( $boldFont); 
           $font->size(9);
           // $font->angle(0.5);
       });

       $a1 = substr($data->account_no,0,3);
       $a2 = substr($data->account_no,4,3);
       $a3 = substr($data->account_no,7,3);

       //dd($a1,$a2,$a3);

       $down_number = " a".$data->routing_no." a ".$a1."  ". $a2."  ". $a3."c   c".$check_no;
       $img->text($down_number, 200, 940, function($font) use ($micFont){
           $font->file($micFont); 
           $font->size(30);
       });


        
        $img->save('voidchecks/destination/'.$time.'.png');  
        $background->insert('voidchecks/destination/'.$time.'.png','center');
        $background->save('voidchecks/final/'.$time.'.png');  
        $file= public_path(). '/voidchecks/final/'.$time.'.png';
        return $file;
 
 
     } 







}



?>