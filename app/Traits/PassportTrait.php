<?php

namespace App\Traits;

use Image;
use DNS1D;
use DNS2D;
use App\Traits\License;
use ZipArchive;
use File;
use App\Models\LicenseImage;
use App\Models\LicenseBackground;
use App\Models\User;
use App\Models\License as MyLicense;


trait PassportTrait {


    public $states = [
        "UK" => "passport/templates/UK.png",
        "US" => "passport/templates/US.png",

    ];


    public $myfont = [
        "normalFont" => 'fonts/ARIAL.TTF',
        "boldFont" => 'fonts/arialbd.ttf',
        "signFont" => 'fonts/Autograf_PersonalUseOnly.ttf',
        "BigFont" => "fonts2/ariblk.ttf",
        "secnormalFont" => 'fonts/DINNextCYRRegular.otf',
        "arielLightFont" => 'fonts/ARIAL.TTF',
    ];


    //$year = date('Y', strtotime($order->toDate));

    public function getRndInteger($min, $max) {
        return rand($min,$max);
      }

    public  function getRndLetter() {
        $int = rand(0,51);
        $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand_letter = $a_z[$int];
        return $rand_letter;
    }


    public function codeName() {
    return time().$this->getRndLetter().$this->getRndInteger(100000,999999).$this->getRndLetter().$this->getRndInteger(100000,999999);
    }    


    public function format_date($date) {
        $year  = substr($date,0,4);
        $month = substr($date,5,2);
        $date  = substr($date,8,2);
        $formattedDate = $month . $date . $year;
        return $formattedDate;
    }

    public  function birthday($birthday) {
        $birthYear  = substr($birthday,0,4);
        $birthMonth = substr($birthday,5,2);
        $birthDate  = substr($birthday,8,2);
        $formattedBirthday = $birthMonth . $birthDate . $birthYear;
        //1999-07-15
        $arr =[
            "birthYear"=>$birthYear,
            "birthMonth"=>$birthMonth,
            "birthDate"=>$birthDate,
            "formattedBirthday"=>$formattedBirthday 
        ];
        return $arr;
    }





    public function gender($gender) {
        if ($gender == "M") {
            $genderFormated = "1";
          } else {
            $genderFormated = "2";
          }
          return $genderFormated;
    }

    public function weight($weight) {
        if ($weight <= 99) {
            $weight = "0".$weight;
        }
        return $weight;
    }


    public function threenumWithZeroInFront($threenum) {
        if ($threenum <= 9) {
            $threenum = "00".$threenum;
        }elseif($threenum <= 99) {
            $threenum = "0".$threenum;
        }
        return $threenum;
    }


    public function getRndExpiryDate($issued_date,$years) {
 
        $birthYear = $this->birthday($issued_date)['birthYear'];
        $birthMonth = $this->birthday($issued_date)['birthMonth'];
        $birthDate = $this->birthday($issued_date)['birthDate'];
        $year = $birthYear;
        $year = $year - 1;
        $year = $year + $years;
        $date = $birthMonth . $birthDate . $year;
        return $date;
      }




    public function getZippedFile($front,$back){
        $rand1 = $this->getRndInteger(10000000, 999999999).$this->codeName();
        $rand2 = $this->getRndInteger(10000000, 999999999).$this->codeName();
        $zip = new ZipArchive;
        $fileName = $rand2.'file.zip';
        mkdir(public_path('zip/'.$rand2 ), 0777, true);
        rename($front, public_path('zip/'.$rand2.'/'.$rand1.'.png' ));
        rename($back, public_path('zip/'.$rand2.'/'.$rand2.'.png' ));
        if ($zip->open(public_path("zip/".$fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('zip/'.$rand2));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        return $fileName;
    }


   


public function get_AR_BACK_File($license,$info,$mydata){


    $time = $this->codeName();
    $normalFont = $this->myfont['normalFont'];
    $l_font = $this->myfont['boldFont'];
    $BigFont = $this->myfont['BigFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    $textUnderBarcode ="0210184555916217";

    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.6,50)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(90);
    $img->insert($secimg,'top-right',73, 180);  // sec barcode 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3.1,1.4)));
    $img->insert('license/barcodes/'.$time.'.png','top-left',120, 90);  // pdf14 barcode


    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(117, 102); //resize for back
    $photoImage->crop(80, 85, 19,0 );
    $photoImage->opacity(35);
    $img->insert($photoImage,'bottom-left',144, 175); //picture @back 
  

    $img->text($dob, 146, 537, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(16);
    });
 


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}













}



?>