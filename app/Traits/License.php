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


trait License {


    public $states = [
        "AL_FRONT" => "license/templates/AL/DLAL_FRONT.png",
        "AL_BACK" => "license/templates/AL/DLAL_BACK.png",
        "AK_FRONT" => "license/templates/AK/DLAK_FRONT.png",
        "AK_BACK" => "license/templates/AK/DLAK_BACK.png",
        "AR_FRONT" => "license/templates/AR/DLAR_FRONT.png",
        "AR_BACK" => "license/templates/AR/DLAR_BACK.png",
        "AZ_FRONT" => "license/templates/AZ/DLAZ_FRONT.png",
        "AZ_BACK" => "license/templates/AZ/DLAZ_BACK.png",
        "CA_FRONT" => "license/templates/CA/DLCA_FRONT.png",
        "CA_BACK" => "license/templates/CA/DLCA_BACK.png",
        "CO_FRONT" => "license/templates/CO/DLCO_FRONT.png",
        "CO_BACK" => "license/templates/CO/DLCO_BACK.png",        
        "CT_FRONT" => "license/templates/CT/DLCT_FRONT.png",
        "CT_BACK" => "license/templates/CT/DLCT_BACK.png",
        "DE_FRONT" => "license/templates/DE/DLDE_FRONT.png",
        "DE_BACK" => "license/templates/DE/DLDE_BACK.png",
        "FL_FRONT" => "license/templates/FL/DLFL_FRONT.png",
        "FL_BACK" => "license/templates/FL/DLFL_BACK.png",
        "GA_OLD_FRONT" => "license/templates/GA/DLGA_OLD_FRONT.png",
        "GA_OLD_BACK" => "license/templates/GA/DLGA_OLD_BACK.png",
        "GA_FRONT" => "license/templates/GA/DLGA_FRONT.png",
        "GA_BACK" => "license/templates/GA/DLGA_BACK.png",
        "HI_FRONT" => "license/templates/HI/DLHI_FRONT.png",
        "HI_BACK" => "license/templates/HI/DLHI_BACK.png",
        "IA_FRONT" => "license/templates/IA/DLIA_FRONT.png",
        "IA_BACK" => "license/templates/IA/DLIA_BACK.png",
        "ID_FRONT" => "license/templates/ID/DLID_FRONT.png",
        "ID_BACK" => "license/templates/ID/DLID_BACK.png",
        "IN_FRONT" => "license/templates/IN/DLIN_FRONT.png",
        "IN_BACK" => "license/templates/IN/DLIN_BACK.png",        
        "IL_FRONT" => "license/templates/IL/DLIL_FRONT.png",
        "IL_BACK" => "license/templates/IL/DLIL_BACK.png",
        "KY_FRONT" => "license/templates/KY/DLKY_FRONT.png",
        "KY_BACK" => "license/templates/KY/DLKY_BACK.png",
        "KS_FRONT" => "license/templates/KS/DLKS_FRONT.png",
        "KS_BACK" => "license/templates/KS/DLKS_BACK.png",
        "LA_FRONT" => "license/templates/LA/DLLA_FRONT.png",
        "LA_BACK" => "license/templates/LA/DLLA_BACK.png",
        "MA_FRONT" => "license/templates/MA/DLMA_FRONT.png",
        "MA_BACK" => "license/templates/MA/DLMA_BACK.png",
        "ME_FRONT" => "license/templates/ME/DLME_FRONT.png",
        "ME_BACK" => "license/templates/ME/DLME_BACK.png",
        "MD_FRONT" => "license/templates/MD/DLMD_FRONT.png",
        "MD_BACK" => "license/templates/MD/DLMD_BACK.png",
        "MI_FRONT" => "license/templates/MI/DLMI_FRONT.png",
        "MI_BACK" => "license/templates/MI/DLMI_BACK.png",
        "MO_FRONT" => "license/templates/MO/DLMO_FRONT.png",
        "MO_BACK" => "license/templates/MO/DLMO_BACK.png",
        "MN_FRONT" => "license/templates/MN/DLMN_FRONT.png",
        "MN_BACK" => "license/templates/MN/DLMN_BACK.png",
        "MS_FRONT" => "license/templates/MS/DLMS_FRONT.png",
        "MS_BACK" => "license/templates/MS/DLMS_BACK.png",
        "MT_FRONT" => "license/templates/MT/DLMT_FRONT.png",
        "MT_BACK" => "license/templates/MT/DLMT_BACK.png",
        "NC_FRONT" => "license/templates/NC/DLNC_FRONT.png",
        "NC_BACK" => "license/templates/NC/DLNC_BACK.png",  
        "NE_FRONT" => "license/templates/NE/DLNE_FRONT.png",
        "NE_BACK" => "license/templates/NE/DLNE_BACK.png",      
        "NJ_FRONT" => "license/templates/NJ/DLNJ_FRONT.png",
        "NJ_BACK" => "license/templates/NJ/DLNJ_BACK.png",
        "NH_FRONT" => "license/templates/NH/DLNH_FRONT.png",
        "NH_BACK" => "license/templates/NH/DLNH_BACK.png",
        "NM_FRONT" => "license/templates/NM/DLNM_FRONT.png",
        "NM_BACK" => "license/templates/NM/DLNM_BACK.png",  
        "NV_FRONT" => "license/templates/NV/DLNV_FRONT.png",
        "NV_BACK" => "license/templates/NV/DLNV_BACK.png",                  
        "OH_FRONT" => "license/templates/OH/DLOH_FRONT.png",
        "OH_BACK" => "license/templates/OH/DLOH_BACK.png",
        "OK_FRONT" => "license/templates/OK/DLOK_FRONT.png",
        "OK_BACK" => "license/templates/OK/DLOK_BACK.png",
        "OR_FRONT" => "license/templates/OR/DLOR_FRONT.png",
        "OR_BACK" => "license/templates/OR/DLOR_BACK.png",
        "PA_FRONT" => "license/templates/PA/DLPA_FRONT.png",
        "PA_BACK" => "license/templates/PA/DLPA_BACK.png",
        "RI_FRONT" => "license/templates/RI/DLRI_FRONT.png",
        "RI_BACK" => "license/templates/RI/DLRI_BACK.png",
        "SC_FRONT" => "license/templates/SC/DLSC_FRONT.png",
        "SC_BACK" => "license/templates/SC/DLSC_BACK.png",
        "SD_FRONT" => "license/templates/SD/DLSD_FRONT.png",
        "SD_BACK" => "license/templates/SD/DLSD_BACK.png",
        "TN_FRONT" => "license/templates/TN/DLTN_FRONT.png",
        "TN_BACK" => "license/templates/TN/DLTN_BACK.png",      
        "TX_FRONT" => "license/templates/TX/DLTX_FRONT.png",
        "TX_BACK" => "license/templates/TX/DLTX_BACK.png",                
        "VT_FRONT" => "license/templates/VT/DLVT_FRONT.png",
        "VT_BACK" => "license/templates/VT/DLVT_BACK.png",
        "UT_FRONT" => "license/templates/UT/DLUT_FRONT.png",
        "UT_BACK" => "license/templates/UT/DLUT_BACK.png",
        "WA_FRONT" => "license/templates/WA/DLWA_FRONT.png",
        "WA_BACK" => "license/templates/WA/DLWA_BACK.png", 
        "WV_FRONT" => "license/templates/WV/DLWV_FRONT.png",
        "WV_BACK" => "license/templates/WV/DLWV_BACK.png", 
        "WY_FRONT" => "license/templates/WY/DLWY_FRONT.png",
        "WY_BACK" => "license/templates/WY/DLWY_BACK.png",               
    ];






    public $myfont = [
        "normalFont"     =>  'fonts/ARIAL.TTF',
        "boldFont"       =>  'fonts/arialbd.ttf',
        "signFont"       =>  'fonts/Autograf_PersonalUseOnly.ttf',
        "BigFont"        =>  "fonts2/ariblk.ttf",
        "secnormalFont"  =>  'fonts/DINNextCYRRegular.otf',
        "arielLightFont" =>  'fonts/ARIAL.TTF',
        "futuramFont"    =>  "fonts/futuram.TTF",
        "optimistFont"   =>  "fonts/optimist-bold.ttf",
        "wcashFont"      =>  "fonts/wcash.org.ttf",
        "HelveticaBold"  =>  "fonts2/HelveticaBold.ttf",
        "cheapinkFont"   =>  "fonts/cheap-ink.ttf",
        "dinFont"        =>  "fonts/din.otf",
        "arialnbFont"    =>  "fonts2/arialnb.ttf",
        "treFont"        =>  "fonts/tre.ttf",
        "trebFont"       =>  "fonts/treb.ttf",
        "segoeFont"      =>  "fonts/segoe.ttf",   
        "arialnFont"     =>   "fonts/arialn.ttf"   
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

    public function fit($word,$num) {
        return substr(($word . "****************************"),0,$num);
    }

    public function codeName() {
    return time().$this->getRndLetter().$this->getRndInteger(100000,999999).$this->getRndLetter().$this->getRndInteger(100000,999999);
    }    

    public  function inventoryNum() {
    $data = $this->getRndLetter() . $this->getRndLetter() . $this->getRndInteger(100000, 999999) . $this->getRndLetter() . $this->getRndInteger(1000, 9999) . $this->getRndLetter();
    return $data;
    } 

    public  function docid() {
        $data = $this->getRndLetter() . $this->getRndLetter() . $this->getRndInteger(100000, 999999) . $this->getRndLetter() . $this->getRndInteger(1000, 9999) . $this->getRndLetter();
        return $data;
    } 

    public  function audit() {
        $data = $this->getRndLetter() . $this->getRndLetter() . $this->getRndInteger(100000, 999999) . $this->getRndLetter() . $this->getRndInteger(1000, 9999) . $this->getRndLetter();
        return $data;
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


    public  function birthday_edit_for_CA($birthday) {
        $birthYear  = substr($birthday,2,2);
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


    public  function birthday_edit_with_sign_IA($birthday,$sign) {
        $birthYear  = substr($birthday,8,2);
        $birthMonth = substr($birthday,3,2);
        $birthDate  = substr($birthday,0,2);
        $formattedBirthday = $birthDate .$sign.$birthMonth .$sign.  $birthYear;
        //15/07/1999
        $arr =[
            "birthYear"=>$birthYear,
            "birthMonth"=>$birthMonth,
            "birthDate"=>$birthDate,
            "formattedBirthday"=>$formattedBirthday 
        ];
        return $arr;
    }  



    //04012028
    public  function format_date_by_sign($date,$sign) {
        $Year  = substr($date,4,4);
        $Date= substr($date,2,2);
        $Month  = substr($date,0,2);
        $formatted = $Month .$sign. $Date .$sign. $Year;
         // from 04012028 to "01/01/2028"
        
        return $formatted;
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

    public function formatInches($in) {
        if ($in <= 9) {
            $in = "0".$in;
        }
        return $in;
    }


    public function threenumWithZeroInFront($threenum) {
        if ($threenum <= 9) {
            $threenum = "00".$threenum;
        }elseif($threenum <= 99) {
            $threenum = "0".$threenum;
        }
        return $threenum;
    }


    public function getRndExpiryDate($issued_date,$license,$years) {
 
        $issuedYear = $this->birthday($issued_date)['birthYear'];
        $issuedMonth = $this->birthday($issued_date)['birthMonth'];
        $issuedDate = $this->birthday($issued_date)['birthDate'];
        $year = $issuedYear;
        $year = $year - 1;
        $year = $year + $years;

        $birthYear = $this->birthday($license->birth_date)['birthYear'];
        $birthMonth = $this->birthday($license->birth_date)['birthMonth'];
        $birthDate = $this->birthday($license->birth_date)['birthDate'];

        $date = $birthMonth . $birthDate . $year;

        return $date;
      }




    public function getZippedFile($front,$back,$codename){
        $rand1 = $codename."XXX".$this->getRndInteger(10000000, 999999999);
        $rand2 = $codename."XXX".$this->getRndInteger(10000000, 999999999);
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


    // =====================================================================================================
    
    public function getStateCredentials($state,$license,$issue){



        if ($state == 'AL') {
            $iin = "636033";
            $lin = $this->getRndInteger(1000000, 9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,4);
            $classification = "D";
        }

        if ($state == 'AK') {
            $iin = "636059";
            $lin = "9".$this->getRndInteger(1000000, 9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,5);
            $classification = "D";
        }

        if ($state == 'AR') {
            $iin = "636021";
            $lin = "9".$this->getRndInteger(1000000, 9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "D";
        }


        if ($state == 'AZ') {
            $iin = "636026";
            $list = "ABDY";
            $shuffled = str_shuffle($list);
            $res = substr($shuffled,0,1);
            $lin = $res.$this->getRndInteger(10000000, 99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,12);
            $classification = "D";
        }


        if ($state == 'CA') {
            $iin = "636014";
            $lin = $this->getRndLetter().$this->getRndInteger(1000000, 9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,5);
            $classification = "C";
        }

        if ($state == 'CO') {
            $iin = "636020";
            $lin = $this->getRndInteger(10, 99)."-".$this->getRndInteger(100, 999)."-".$this->getRndInteger(1000, 9999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,5);
            $classification = "R";
        }

        if ($state == 'CT') {

            $birthYear = $this->birthday($license->birth_date)['birthYear'];
            $birthMonth = $this->birthday($license->birth_date)['birthMonth'];
            $iin = "636006";
            if (($birthYear % 2) == 0) {
                $lin = $birthMonth . $this->getRndInteger(1000000, 9999999);
              } else {
                $newBirthMonth = $birthMonth . "12";
                $lin = $newBirthMonth + $this->getRndInteger(1000000, 9999999);
              }
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        }

        if ($state == 'DE') {
            $iin = "636011";
            $lin = $this->getRndInteger(10000000, 99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,9);
            $classification = "D";
        }
        

       if ($state == 'FL') {
            $iin = "636010";
            $lin = substr(  strtoupper($license->last_name),0,1) . $this->getRndInteger(100, 999)  . "-" . $this->getRndInteger(100, 999)   . substr(  $this->birthday($license->birth_date)['formattedBirthday'],2,5)  . "-" . $this->getRndInteger(100, 999) . "-" . $this->getRndInteger(0, 1)  ;
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "E";
        }

        if ($state == 'GA_OLD') {
            $iin = "636055";
            $lin =  $this->getRndInteger(100000000, 999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "C";
        }

        if ($state == 'GA') {
            $iin = "636055";
            $lin =  $this->getRndInteger(100000000, 999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "C";
        }
        
        if ($state == 'HI') {
            $iin = "636047";
            $lin =  "H" . $this->getRndInteger(10000000, 99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "3";
        }

        if ($state == 'IA') {
            $iin = "636018";
            $lin = $this->getRndInteger(100000000, 999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,5);
            $classification = "C";
        }

        if ($state == 'ID') {
            $iin = "636050";
            $lin = $this->getRndLetter().$this->getRndLetter().$this->getRndInteger(100000, 999999).$this->getRndLetter();
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "B";
        }

        if ($state == 'IL') {
            $iin = "636035";
            $lin = substr(strtoupper($license->last_name),0,1) .  $this->getRndInteger(100, 999) . "-" . $this->getRndInteger(1000, 9999) . "-" . $this->getRndInteger(1000, 9999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,4);
            $classification = "D";
        }

        if ($state == 'IN') {
            $iin = "636037";
            $lin = $this->getRndInteger(1000, 9999)."-".$this->getRndInteger(10, 99)."-".$this->getRndInteger(1000, 9999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,7);
            $classification = "D";
        }


        if ($state == 'KS') {
            $iin = "636022";
            $lin = "K".$this->getRndInteger(10, 99)."-".$this->getRndInteger(10, 99)."-".$this->getRndInteger(1000, 9999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,9);
            $classification = "A";
        }


        if ($state == 'KY') {
            $iin = "636046";
            $lin = substr(strtoupper($license->last_name),0,1).$this->getRndInteger(10, 99) ."-".$this->getRndInteger(100, 999)."-".$this->getRndInteger(100, 999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,9);
            $classification = "D";
        }

        if ($state == 'LA') {
            $iin = "636007";
            $lin = "00".$this->getRndInteger(1000000, 9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,7);
            $classification = "E";
        }

        if ($state == 'MA') {
            $iin = "636002";
            $lin = "S".$this->getRndInteger(10000000, 99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        }

        if ($state == 'ME') {
            $iin = "636041";
            $lin = $this->getRndInteger(1000000, 9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "C";
        }
        if ($state == 'MD') {
            $iin = "636003";
            $lin = substr(strtoupper($license->last_name),0,1) . "-" . $this->getRndInteger(100, 999) . "-" . $this->getRndInteger(100, 999) . "-" . $this->getRndInteger(100, 999) . "-" . $this->getRndInteger(100, 999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "C";
        }
        if ($state == 'MI') {
            $iin = "636032";
            $lin = substr(strtoupper($license->last_name),0,1) . " " . $this->getRndInteger(100, 999) . " " . $this->getRndInteger(100, 999) . " " . $this->getRndInteger(100, 999) . " " . $this->getRndInteger(100, 999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,4);
            $classification = "D";
        }


        if ($state == 'MN') {
            $iin = "636038";
            $lin = strtoupper($this->getRndLetter()) . $this->getRndInteger(100, 999)."-". $this->getRndInteger(100, 999)."-". $this->getRndInteger(100, 999)."-". $this->getRndInteger(100, 999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,4);
            $classification = "D";
        }

        if ($state == 'MO') {
            $iin = "636030";
            $lin = strtoupper($this->getRndLetter()) . $this->getRndInteger(100000000, 999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "F";
        }

        if ($state == 'MS') {
            $iin = "636051";
            $lin = $this->getRndInteger(100000000, 999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "R";
        }

        if ($state == 'MT') {
            $birthDate = $this->birthday($license->birth_date)['birthDate'];
            $birthMonth = $this->birthday($license->birth_date)['birthMonth'];
            $birthYear = $this->birthday($license->birth_date)['birthYear'];

            $iin = "636008";
            $lin = $birthMonth.$this->getRndInteger(100, 999).$birthYear."41".$birthDate;
            $expiryDate = $this->getRndExpiryDate($issue,$license,9);
            $classification = "D";
        }

        if ($state == 'NE') {
            $iin = "636054";
            $list = "ABCEGHV";
            $shuffled = str_shuffle($list);
            $res = substr($shuffled,0,1);
            $lin = $res.$this->getRndInteger(10000000, 99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "O";
        }

        if ($state == 'NV') {
            $iin = "636049";
            $lin =  $this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10, 99);
            $expiryDate = $this->getRndExpiryDate($issue,$license,5);
            $classification = "A";
        }
        

        if ($state == 'NH') {
            $birthDate = $this->birthday($license->birth_date)['birthDate'];
            $birthMonth = $this->birthday($license->birth_date)['birthMonth'];
            $birthYear = $this->birthday($license->birth_date)['birthYear'];

            $iin = "636039";
            $lnamelength = strlen($license->last_name);
            $lin =  $this->getRndInteger(10,99).strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10000,99999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        }

        if ($state == 'NJ') {
            $iin = "636036";
            $lin =  strtoupper($this->getRndLetter()).$this->getRndInteger(1000, 9999) ." ".$this->getRndInteger(10000, 99999)." ".$this->getRndInteger(10000, 99999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        }


        if ($state == 'NM') {
            $iin = "636009";
            $lin =  $this->getRndInteger(100000000, 999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,9);
            $classification = "D";
        }

        if ($state == 'NY') {
            $iin = "636001";
            $lin =  $this->getRndInteger(100, 999)." ".$this->getRndInteger(100, 999)." ".$this->getRndInteger(100, 999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "D";
        }

        if ($state == 'NC') {
            $iin = "636004";
            $lin =  $this->getRndInteger(100000000000, 999999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "C";
        }   

          if ($state == 'ND') {
            $iin = "636034";
            $lin =  strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter())."-".$this->getRndInteger(10,99)."-".$this->getRndInteger(1000,9999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        }  

        if ($state == 'OH') {
            $iin = "636023";
            $lin =  strtoupper($this->getRndLetter().$this->getRndLetter())." ".$this->getRndInteger(100000,999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,4);
            $classification = "D";
        }

        if ($state == 'OK') {
            $iin = "636058";
            $lin =  strtoupper($this->getRndLetter()).$this->getRndInteger(100000000,999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        }       

        if ($state == 'OR') {
            $iin = "636029";
            $lin =  "A".$this->getRndInteger(100000,999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "C";
        }   

        if ($state == 'PA') {
            $iin = "636025";
            $lin = $this->getRndInteger(10, 99) . " " . $this->getRndInteger(100, 999) . " " . $this->getRndInteger(100, 999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,4);
            $classification = "C";
        }
        if ($state == 'RI') {
            $iin = "636052";
            $lin = $this->getRndInteger(1000000,9999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,5);
            $classification = "10";
        }
        if ($state == 'SC') {
            $iin = "636005";
            $lin = $this->getRndInteger(10000000000,99999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,11);
            $classification = "D";
        }

        if ($state == 'SD') {
            $iin = "636042";
            $lin = $this->getRndInteger(10000000,99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "1";
        }   

        if ($state == 'TN') {
            $iin = "636053";
            $lin = $this->getRndInteger(100000000,999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "D";
        }   

        if ($state == 'TX') {
            $iin = "636015";
            $lin = $this->getRndInteger(10000000,99999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,7);
            $classification = "C";
        } 

        if ($state == 'UT') {
            $iin = "636040";
            $lin = $this->getRndInteger(100000000,999999999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "D";
        } 

        if ($state == 'VT') {
            $iin = "636024";
            $randoms = rand(0,1);
            if($randoms== 0){
                $lin = $this->getRndInteger(10000000,99999999);
              } else {
                $lin = $this->getRndInteger(1000000,9999999).$this->getRndLetter();
              }
            $expiryDate = $this->getRndExpiryDate($issue,$license,6);
            $classification = "1";
        } 

        if ($state == 'VA') {
            $iin = "636000";
            $lin = $this->getRndLetter().$this->getRndInteger(10,99)."-".$this->getRndInteger(10,99)."-".$this->getRndInteger(1000,9999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "D";
        } 


        if ($state == 'WA') {
            $iin = "636045";
            $lin =  $this->fit($license->last_name,5). substr(strtoupper($license->first_name),0,1). substr(strtoupper($license->middle_name),0,1).$this->getRndInteger(10000,99999);
            $expiryDate = $this->getRndExpiryDate($issue,$license,7);
            $classification = "D";
        } 

        if ($state == 'WV') {
            $iin = "636061";
            $randoms = rand(0,1);
            if($randoms== 0){
                $lin = $this->getRndLetter().$this->getRndInteger(100000,999999);
              } else {
                $lin = $this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10000,99999);
              }
            $expiryDate = $this->getRndExpiryDate($issue,$license,7);
            $classification = "E";
           } 


        if ($state == 'WI') {
            $iin = "636031";
            $lin = $this->getRndLetter().$this->getRndInteger(100,999)."-".$this->getRndInteger(1000,9999).$this->getRndInteger(1000,9999).$this->getRndInteger(10,99);
            $expiryDate = $this->getRndExpiryDate($issue,$license,8);
            $classification = "D";
        } 

  
      if ($state == 'WY') {
        $iin = "636060";
        $lin = $this->getRndInteger(100000,999999)."-".$this->getRndInteger(100,999);
        $expiryDate = $this->getRndExpiryDate($issue,$license,5);
        $classification = "B";
       } 

        return $arr=[
            "iin"=>$iin,
            "lin"=>$lin,
            "expiryDate"=> $expiryDate,
            "classification"=>$classification,
        ];
    }


    // =====================================================================================================

/*

    insert->()
    top-left (default)
    top
    top-right
    left
    center
    right
    bottom-left
    bottom
    bottom-right        
 *  
 * 
 *   AK
 * 
 * 
 */
public function get_AL_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999)." ".$this->getRndInteger(1000, 9999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 450, 575, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        // $font->color('#3d3d3d');
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 450, 580, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        // $font->color('#3d3d3d');
    });


    $photoImage = Image::make('license/photo/'.$license->picture);
    // $photoImage->resize(373, 350); 
    // $photoImage->opacity(60); 
    // $photoImage->crop(270, 290, 50,0 );
    $photoImage->resize(340, 330); 
    $photoImage->opacity(60); 
     $photoImage->crop(300, 330, 20,0 );
    $img->insert($photoImage,'bottom-left',84, 148); //picture y + up


    $img->text(strtoupper($info['dl_number']), 540, 258, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(40);
    });
    $img->text(strtoupper($dob), 490, 290, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(35);
    });

    $img->text($classification, 850,258, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(35);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 790, 290, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(35);
    });


    $img->text($info['last_name'], 405, 330, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(32);
    });
    $img->text($info['first_name']." ".$info['middle_name'], 405, 360, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(32);
    });

    $img->text($info['street'].",", 405, 392, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(28);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 405, 423, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(28);
    });
    $changeDate = date("m-d-Y", strtotime($license->issued_date));
    $img->text($changeDate, 450, 487, function($font) use ( $futuramFont){
            $font->file( $futuramFont); 
            $font->size(35);
    });
$img->text($license->gender, 740, 486, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(35);
    });
    $height = $license->foot."-".$license->inches;
    $img->text($height, 820, 486, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(35);
    });
    $img->text($license->eye_color, 960,486, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(32);
    });

    $img->text($license->weight,820, 515, function($font) use ( $futuramFont){
        $font->file( $futuramFont); 
        $font->size(32);
    });

$img->text($license->hair_color, 960, 515, function($font) use ( $futuramFont){
    $font->file( $futuramFont); 
    $font->size(32);
});





    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}




public function get_AL_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 

   // create secondBarcode 
   $textUnderBarcode =  $this->getRndInteger(1000000000,9999999999) .$this->getRndInteger(1000000000,9999999999); // text under secong barcode
   // text under secong barcode
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.5,56)));

   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3,1.7)));

    //03420752  CODE39
   $img->insert('license/barcodes/additional/'.$time.'.png','top',170, 40);  // normal barcode
   $img->insert('license/barcodes/'.$time.'.png','bottom-left',65, 70);  // pdf14 barcode
   $img->text($textUnderBarcode, 100, 70, function($font) use ($l_font){
   $font->file($l_font); 
   $font->size(14);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}





    /**
 *  
 * 
 *   AK
 * 
 * 
 */
public function get_AK_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999)." ".$this->getRndInteger(1000, 9999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 115, 435, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        $font->color('#3d3d3d');
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 115, 440, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        $font->color('#3d3d3d');
    });


    $photoImage = Image::make('license/photo/'.$license->picture);
    // $photoImage->resize(373, 350); 
    // $photoImage->opacity(60); 
    // $photoImage->crop(270, 290, 50,0 );
    $photoImage->resize(300, 290); 
    $photoImage->opacity(60); 
    $photoImage->crop(270, 290, 23,0 );
    $img->insert($photoImage,'bottom-left',58, 258); //picture y + up
    // $photoImage->resize(80, 115);
    // $photoImage->crop(80, 115, 0,0 );
    $photoImage->resize(70, 80);
    $photoImage->crop(70, 80, 0,0 );
    $photoImage->opacity(32);
    $img->insert($photoImage,'bottom-right',70, 175); //picture 

    $img->text(strtoupper($info['dl_number']), 730, 190, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(44);
        $font->color('#3d3d3d');
    });
    $img->text(strtoupper($dob), 350, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });
$img->text($license->gender, 550, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });
    $height = $license->foot."-".$license->inches;
    $img->text($height, 620, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });
    $img->text($license->weight, 745, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });
    $img->text($license->eye_color, 860, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });
    $changeDate = date("m-d-Y", strtotime($license->issued_date));
    $img->text($changeDate, 350, 440, function($font) use ($akFont){
            $font->file($akFont); 
            $font->size(27);
            $font->color('#3d3d3d');
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 350, 500, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });

    $name =$info['first_name']." ".$info['last_name'];
    $img->text($name, 62, 543, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
        $font->color('#3d3d3d');
    });
    $img->text($info['street'].",", 62, 565, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
        $font->color('#3d3d3d');
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 62, 587, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
        $font->color('#3d3d3d');
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}




public function get_AK_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $l_font = $this->myfont['boldFont'];
    $BigFont = $this->myfont['BigFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = "DOB:".date("m/d/Y", strtotime($license->birth_date));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    $textUnderBarcode = $this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9)."     ".$this->getRndInteger(0, 9);
    $none = "NONE";

   
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',0.48,50)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(-90);
    $img->insert($secimg,'top-left',85, 110);  // sec barcode 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2,1.6)));
    $img->insert('license/barcodes/'.$time.'.png','top-left',300, 90);  // pdf14 barcode



    $img->text($dob, 200, 110, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(18);
        $font->angle(-90);
        $font->color('#3d3d3d');
    });

    $img->text($textUnderBarcode, 65, 125, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
        $font->angle(-90);
        $font->color('#3d3d3d');
    });

    $img->text($none, 448, 363, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
        $font->color('#3d3d3d');
    });
    $img->text($none, 465, 460, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
        $font->color('#3d3d3d');
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}






    /**
 *  
 * 
 *   AR
 * 
 * 
 */
public function get_AR_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999)." ".$this->getRndInteger(1000, 9999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 141, 505, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 141, 510, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    $img->text($double, 753, 396, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(60);
        $font->color(array(51, 51, 51, 0.5));  //http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/colors/colors_picker.asp-colorhex=FFFFFF.html
    });
    // photos first

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(270, 320); 
    $photoImage->opacity(60); 
    //$photoImage->crop(270, 320, 0,0 );
    $img->insert($photoImage,'bottom-left',100, 168); //picture y + up
    $photoImage->resize(80, 115);
    $photoImage->crop(80, 115, 0,0 );
    $photoImage->opacity(45);
    $img->insert($photoImage,'bottom-right',140, 155); //picture 




        $img->text($classification, 748, 135, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
        $font->color('#004d94');
    });

    $img->text(strtoupper($info['dl_number']), 460, 168, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(28);
    });
    $img->text(strtoupper($dob), 730, 170, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(28);
    });

    $img->text($info['last_name'], 390, 203, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });
    $img->text($info['first_name'], 390, 233, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });
    $img->text($info['street'], 390, 293, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 389, 313, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 400, 375, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(18);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 580, 380, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->gender, 400, 433, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 503, 433, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $img->text($license->eye_color, 610, 433, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($end, 455, 468, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $img->text($rest, 490, 497, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(21);
    });
    $img->text($dd, 450, 537, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

public function get_AR_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
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









    /**
 *  
 * 
 *   AZ
 * 
 * 
 */

public function get_AZ_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1300, 800);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999)." ".$this->getRndInteger(1000, 9999);
    $double = $this->getRndInteger(1000,9999).strtoupper($this->getRndLetter()).$this->getRndInteger(1000,9999).strtoupper($this->getRndLetter()).$this->getRndInteger(1000,9999).strtoupper($this->getRndLetter()).$this->getRndInteger(1,9);
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 210, 595, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 210, 600, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(343, 335); 
    $photoImage->opacity(55); 
    $photoImage->crop(283, 320, 40,0 );
    $img->insert($photoImage,'bottom-left',155, 155); //picture y + up
    $photoImage->resize(145, 170);
    $photoImage->crop(140, 170, 3,0 );
    $photoImage->opacity(30);
    $img->insert($photoImage,'bottom-right',150, 225); //picture 



    $img->text(strtoupper($info['dl_number']), 810, 249, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text(strtoupper($dob), 810, 287, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });

    $img->text($classification, 576, 230, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });

    $img->text($end, 555, 260, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($rest, 555, 286, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($info['last_name'], 480, 326, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text($info['first_name'], 480, 360, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text($info['street'], 480, 390, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 480, 423, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 540, 465, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 820, 465, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    $img->text($license->gender, 540, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 540, 523, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(25);
    });

    $img->text($license->weight."lb", 540, 548, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->eye_color, 725, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->hair_color, 725, 523, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($double, 535, 624, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
    $img->text($edbdy['formattedBirthday'], 830, 580, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(50);
    });
    


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }


public function get_AZ_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1300, 800);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $textUnderBarcode =$this->getRndInteger(100000, 999999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(100000000, 999999999);
    $classification = $info['classification'];
    $rev = "Rev 02/14/2014";
    $dob = date("m/d/Y", strtotime($license->birth_date));
    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',3,50)));
    $img->insert('license/barcodes/additional/'.$time.'.png','top-right',200, 63);  // normal barcode
   //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3.2,1.3)));
    $img->insert('license/barcodes/'.$time.'.png','bottom-right',180, 100);  // pdf14 barcode
    
    $img->text($dob, 160, 530, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
    $img->text($textUnderBarcode, 150, 600, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(14);
     });
     $img->text($rev, 805, 290, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(19);
     });
  
    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}



















    /**
 *  
 * 
 *   CA
 * 
 * 
 */

public function get_CA_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $BigFont = "fonts2/ariblk.ttf";
    $l_font = 'fonts/arialbd.ttf';
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $changeDate = date("m/d/Y", strtotime($license->birth_date));


    $bd_edit_left = $this->birthday_edit_for_CA($license->birth_date);
    $img->text($bd_edit_left['formattedBirthday'], 125, 470, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(40);
        $font->color("#7a7a7a");
    });

    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 300); 
    $photoImage->opacity(60); 
    //$photoImage->crop(280, 340, 58,0 );
    $img->insert($photoImage,'bottom-left',70, 140); //picture y + up
    $photoImage->resize(100, 100);
    $photoImage->opacity(45);
    //$photoImage->crop(100, 130, 0,0 );
    $photoImage->greyscale();
    $img->insert($photoImage,'bottom-right',280, 135); //picture 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 111, 535, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 111, 540, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });


    $bd_edit_right = $this->birthday($license->birth_date);
    $img->text($bd_edit_right['formattedBirthday'], 800, 432, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(26);
        $font->color("#72706e");
    });

    $img->text(strtoupper($info['dl_number']), 395, 185, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(45);
        $font->color('#b30c18');
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 410, 230, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
        $font->color('#b30c18');
    });
    $img->text($info['last_name'], 395, 271, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['first_name'], 395, 305, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['street'], 355, 330, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 355, 356, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $img->text($changeDate, 415, 397, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
        $font->color("#b30c18");
    });
    $img->text("A", 425, 425, function($font) use ($l_font){
        $font->file($l_font);
        $font->size(25);
    });
    $img->text($classification, 760, 170, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text("NONE", 730, 232, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($license->gender, 500, 512, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->hair_color, 670, 512, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->eye_color, 840, 512, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 510, 540, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($license->weight."lb", 660, 540, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });


    $dd = $this->getRndInteger(10,99) ."/". $this->getRndInteger(10,99) ."/".$this->getRndInteger(10000,99999) ."/".strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter())."/".strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter())."/".$this->getRndInteger(10,99); 
    $img->text($dd, 490, 570, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 820, 570, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

public function get_CA_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $rand_top_left = "R".$this->getRndInteger(1000000, 9999999);
    $rand_bottom = $this->getRndInteger(10000000, 99999999);
    $textUnderBarcode ="102". $this->getRndInteger(1000000000000, 9999999999999);
    $classification = $info['classification'];
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',4,60)));
   //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.55,1.3)));

    $img->insert('license/barcodes/additional/'.$time.'.png','top-right',170, 10);  // normal barcode
    $img->insert('license/barcodes/'.$time.'.png','bottom-left',55, 118);  // pdf14 barcode
    $img->text($rand_top_left, 100, 40, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($classification, 235, 257, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(20);
    });
    $img->text($rand_bottom, 662, 586, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(24);
        $font->angle(90);
        $font->color("#7e7e7e");
    });
    $img->text($rev, 825, 590, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(17);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}





    /**
 *  
 * 
 *   CO
 * 
 * 
 */



public function get_CO_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $BigFont = "fonts2/ariblk.ttf";
    $l_font = 'fonts/arialbd.ttf';
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $changeDate = date("m/d/Y", strtotime($license->birth_date));

    $curve =$info['first_name'].$info['last_name'];

    $curve1 = "S";
    $curve2 = "A";
    $curve3 = "N";
    $curve4 = "T";
    $curve5 = "A";
    $curve6 = "C";
    $curve7 = "L";
    $curve8 = "A";
    $curve9 = "U";
    $curve10 = "S";
    $curve11 = "0";
    $curve12 = "0";
    $curve13 = "/";
    $curve14 = "0";
    $curve15 = "0";
    $curve16 = "/";
    $curve17 = "0";
    $curve18 = "0";
    $curve19 = "0";
    $curve20 = "0";



    $img->text(strtoupper($curve1), 440, 560, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(1);
        $font->size(20);
    });
    $img->text(strtoupper($curve2), 449, 560, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-8);
        $font->size(20);
    });
    $img->text(strtoupper($curve3), 460, 562, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-16);
        $font->size(20);
    });
    $img->text(strtoupper($curve4), 470, 564, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-26);
        $font->size(20);
    });
    $img->text(strtoupper($curve5), 480, 568, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-36);
        $font->size(20);
    });
    $img->text(strtoupper($curve6), 490, 575, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-43);
        $font->size(20);
    });
    $img->text(strtoupper($curve7), 498, 581, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-47);
        $font->size(20);
    });
    $img->text(strtoupper($curve8), 504, 588, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-44);
        $font->size(20);
    });
    $img->text(strtoupper($curve9),513, 597, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-34);
        $font->size(20);
    });
    $img->text(strtoupper($curve10), 523, 602, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-33);
        $font->size(20);
    });
    $img->text(strtoupper($curve11), 533, 607, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-27);
        $font->size(20);
    });
    $img->text(strtoupper($curve12), 541, 610, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-20);
        $font->size(20);
    });
    $img->text(strtoupper($curve13), 549, 612, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-15);
        $font->size(20);
    });
    $img->text(strtoupper($curve14), 556, 614, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-3);
        $font->size(20);
    });
    $img->text(strtoupper($curve15), 564, 614, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-6);
        $font->size(20);
    });
    $img->text(strtoupper($curve16), 572, 614, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-6);
        $font->size(20);
    });
    $img->text(strtoupper($curve17), 580, 613, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(9);
        $font->size(23);
    });
    $img->text(strtoupper($curve18), 591, 610, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(14);
        $font->size(25);
    });
    $img->text(strtoupper($curve19), 602, 607, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(16);
        $font->size(27);
    });
    $img->text(strtoupper($curve20), 615, 604, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(18);
        $font->size(30);
    });


    // $bd_edit_left = $this->birthday_edit_for_CA($license->birth_date);
    // $img->text($bd_edit_left['formattedBirthday'], 125, 470, function($font) use ($BigFont){
    //     $font->file($BigFont); 
    //     $font->size(40);
    //     $font->color("#7a7a7a");
    // });

    // // photos first
    // $photoImage = Image::make('license/photo/'.$license->picture);
    // $photoImage->resize(280, 300); 
    // $photoImage->opacity(60); 
    // //$photoImage->crop(280, 340, 58,0 );
    // $img->insert($photoImage,'bottom-left',70, 140); //picture y + up
    // $photoImage->resize(100, 100);
    // $photoImage->opacity(45);
    // //$photoImage->crop(100, 130, 0,0 );
    // $photoImage->greyscale();
    // $img->insert($photoImage,'bottom-right',280, 135); //picture 
    // /// signature
    // $sign_name = substr(strtolower($license->first_name),0,5);
    // $img->text($sign_name, 111, 535, function($font) use ($signFont){
    //     $font->file($signFont); 
    //     $font->size(70);
    // });
    // $sign_name = substr(strtoupper($license->last_name),0,1) ;
    // $img->text($sign_name, 111, 540, function($font) use ($signFont){
    //     $font->file($signFont); 
    //     $font->size(70);
    // });


    // $bd_edit_right = $this->birthday($license->birth_date);
    // $img->text($bd_edit_right['formattedBirthday'], 800, 432, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(26);
    //     $font->color("#72706e");
    // });

    // $img->text(strtoupper($info['dl_number']), 395, 185, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(45);
    //     $font->color('#b30c18');
    // });
    // $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    // $img->text($changeDate, 410, 230, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(30);
    //     $font->color('#b30c18');
    // });
    // $img->text($info['last_name'], 395, 271, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(27);
    // });
    // $img->text($info['first_name'], 395, 305, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(27);
    // });
    // $img->text($info['street'], 355, 330, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(21);
    // });
    // $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    // $img->text($city_and_zip, 355, 356, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(21);
    // });
    // $changeDate = date("m/d/Y", strtotime($license->birth_date));
    // $img->text($changeDate, 415, 397, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(30);
    //     $font->color("#b30c18");
    // });
    // $img->text("A", 425, 425, function($font) use ($l_font){
    //     $font->file($l_font);
    //     $font->size(25);
    // });
    // $img->text($classification, 760, 170, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });
    // $img->text("NONE", 730, 232, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });

    // $img->text($license->gender, 500, 512, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });
    // $img->text($license->hair_color, 670, 512, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });
    // $img->text($license->eye_color, 840, 512, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });

    // $height = $license->foot."'-".$license->inches.'"';
    // $img->text($height, 510, 540, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(27);
    // });

    // $img->text($license->weight."lb", 660, 540, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(27);
    // });


    // $dd = $this->getRndInteger(10,99) ."/". $this->getRndInteger(10,99) ."/".$this->getRndInteger(10000,99999) ."/".strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter())."/".strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter())."/".$this->getRndInteger(10,99); 
    // $img->text($dd, 490, 570, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(18);
    // });

    // $changeDate = date("m/d/Y", strtotime($license->issued_date));
    // $img->text($changeDate, 820, 570, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(18);
    // });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}





public function get_CO_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $rand_top_left = "R".$this->getRndInteger(1000000, 9999999);
    $rand_bottom = $this->getRndInteger(10000000, 99999999);
    $textUnderBarcode ="102". $this->getRndInteger(1000000000000, 9999999999999);
    $classification = $info['classification'];
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',4,60)));
   //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.55,1.3)));

    // $img->insert('license/barcodes/additional/'.$time.'.png','top-right',170, 10);  // normal barcode
    // $img->insert('license/barcodes/'.$time.'.png','bottom-left',55, 118);  // pdf14 barcode
    // $img->text($rand_top_left, 100, 40, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(24);
    // });
    // $img->text($classification, 235, 257, function($font) use ($normalFont){
    //     $font->file($normalFont); 
    //     $font->size(20);
    // });
    // $img->text($rand_bottom, 662, 586, function($font) use ($normalFont){
    //     $font->file($normalFont); 
    //     $font->size(24);
    //     $font->angle(90);
    //     $font->color("#7e7e7e");
    // });
    // $img->text($rev, 825, 590, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(17);
    // });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}



  

  
    /**
 *  
 * 
 *   CT
 * 
 * 
 */



public function get_CT_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $BigFont = "fonts2/ariblk.ttf";
    $l_font = 'fonts/arialbd.ttf';
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $arialnbFont = $this->myfont['arialnbFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $dob = date("m/d/Y", strtotime($license->birth_date));



    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 295); 
    $photoImage->opacity(60); 
    $photoImage->crop(278, 295, 2,0 );
    $img->insert($photoImage,'bottom-left',155, 141); //picture y + up
    
    $photoImage->resize(145, 160);
    $photoImage->opacity(40);
    $photoImage->crop(140, 160, 5,0 );
    //$photoImage->greyscale();
    $img->insert($photoImage,'bottom-right',166, 182); //picture 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 210, 605, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 210, 610, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });




    $img->text(strtoupper($info['dl_number']), 515, 305, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(45);
    });
    $img->text($dob, 515, 348, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(45);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 515, 391, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(45);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 510, 435, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(30);
    });

    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 513, 462, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(23);
    });
    $dd = $this->getRndInteger(10000000,99999999).$this->getRndInteger(1000000009,9999999999); 
    $img->text($dd, 513, 489, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(23);
    });

    $img->text($info['last_name'], 455, 525, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $img->text($info['first_name'], 455, 554, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $img->text($info['street'], 455, 580, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 455, 608, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });

    $img->text($classification, 900, 295, function($font) use ($arialnbFont){
        $font->file($arialnbFont);
        $font->size(25);
    });
    $img->text("NONE", 900, 320, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(25);
    });
        $img->text("NONE", 900, 350, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(25);
    });

    $img->text($license->gender, 750, 435, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
   $img->text($license->eye_color,750, 462, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    // $img->text($license->hair_color, 670, 512, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });



    // $img->text($license->weight."lb", 660, 540, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(27);
    // });








    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

 

public function get_CT_BACK_File($license,$info,$mydata){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $classification = $info['classification']."-Operator";
    $end ="None";
    $rest ="A-Corrective Lenses";
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $dd1 = $this->getRndInteger(100000000,999999999);
    $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
   // create secondBarcode 
   $textUnderBarcode =  $dd1.$dd2;
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.9,50)));
   $img->insert('license/barcodes/additional/'.$time.'.png','top-right',250, 64);  // normal barcode
   
   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,0.9)));
   $img->insert('license/barcodes/'.$time.'.png','top-right',190, 130);  // pdf14 barcode



    $img->text($dob, 200, 165, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(15);
    });
    $img->text($dd1, 230, 105, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(13);
    });
    $img->text($dd2, 230, 118, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(13);
    });

   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}




    /**
 *  
 * 
 *   DE
 * 
 * 
 */




public function get_DE_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $BigFont = "fonts2/ariblk.ttf";
    $l_font = 'fonts/arialbd.ttf';
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $arialnbFont = $this->myfont['arialnbFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $dob = date("m/d/Y", strtotime($license->birth_date));



    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 295); 
    $photoImage->opacity(60); 
    //$photoImage->crop(279, 295, 1,0 );
    $img->insert($photoImage,'bottom-left',148, 164); //picture y + up
    
    $photoImage->resize(145, 160);
    $photoImage->opacity(40);
    $photoImage->crop(140, 160, 5,0 );
    //$photoImage->greyscale();
    $img->insert($photoImage,'bottom-right',380, 95); //picture 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 230, 595, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 230, 600, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });




    $img->text(strtoupper($info['dl_number']), 540, 226, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($classification, 540, 259, function($font) use ($l_font){
        $font->file($l_font);
        $font->size(30);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 495, 288, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 830, 288, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

        $img->text($info['last_name'], 455, 330, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $others = $info['first_name']."   ".$info['middle_name'];
    $img->text($others , 455, 355, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($info['street'], 455, 388, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 455, 413, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($license->gender, 462, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 540, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->weight." lb", 635, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
   $img->text($license->eye_color,735, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($dob, 840, 496, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
        $font->color("#a71b00");

    });


    $img->text("NONE", 515, 550, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
        $img->text("NONE", 580, 578, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });



    $dd = $this->getRndInteger(100000000,999999999).$this->getRndInteger(1000000,9999999); 
    $img->text($dd, 565, 604, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });







    // $img->text($license->hair_color, 670, 512, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(25);
    // });












    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}



public function get_DE_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
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
    $textUnderBarcode1 =$this->getRndInteger(10000000,99999999);
    $textUnderBarcode2 ="0000".$this->getRndInteger(1000,9999);
    $textUnderBarcode = $textUnderBarcode1.$textUnderBarcode2;


    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.6,50)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(90);
    $img->insert($secimg,'top-right',120, 180);  // sec barcode 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3.6,1.4)));
    $img->insert('license/barcodes/'.$time.'.png','top-right',250, 90);  // pdf14 barcode


    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(117, 102); //resize for back
    $photoImage->crop(80, 85, 19,0 );
    $photoImage->opacity(35);
    $img->insert($photoImage,'bottom-left',144, 175); //picture @back 
  

    $img->text($textUnderBarcode1, 970, 90, function($font) use ($l_font){
        $font->file($l_font); 
        $font->angle(-90);
        $font->size(15);
    });
    $img->text($textUnderBarcode2, 950, 90, function($font) use ($l_font){
        $font->file($l_font); 
        $font->angle(-90);
        $font->size(15);
    });

    $img->text($dob, 850, 400, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
 


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}




  
    /**
 *  
 * 
 *   FL
 * 
 * 
 */


public function get_FL_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $l_font = 'fonts/arialbd.ttf';
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);



    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 150, 595, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        $font->color('#3d3d3d');
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 150, 600, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        $font->color('#3d3d3d');
    });


    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 300); 
    $photoImage->opacity(80); 
    //$photoImage->crop(280, 380, 90,0 );
    $img->insert($photoImage,'bottom-left',108, 160); //picture y + up
    $photoImage->resize(117, 142); //resize for back
    $photoImage->opacity(50);
    $photoImage->crop(117, 142, 0,0 );
    $img->insert($photoImage,'bottom-right',125, 155); //picture 


    // values


    $img->text($info['dl_number'], 470, 210, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(40);
    });
    $img->text($classification, 990, 182, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['last_name'], 403, 248, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $others = $info['first_name']."   ".$info['middle_name'];
    $img->text($others, 403, 273, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($info['street'], 403, 298, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 403, 318, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $img->text($changeDate, 465, 360, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 465, 390, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text("AB", 480, 420, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text("NONE", 684, 420, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($license->gender, 728, 357, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });


    $img->text("SAFE DRIVER", 815, 357, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 728, 392, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });


    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 460, 510, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $dd = strtoupper($this->getRndLetter()).$this->getRndInteger(100000, 999999).$this->getRndInteger(100000, 999999);
    $img->text($dd, 445, 542, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });

    $replace =  $this->birthday($license->issued_date);
    $yr = $replace['birthYear'] - 1;
    $replaced =   $this->getRndInteger(10, 12) ."/" .$this->getRndInteger(10, 30) ."/".$yr;
    $img->text($replaced, 502, 572, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });





    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}





public function get_FL_BACK_File($license,$info,$mydata){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 


    $exp = date("m/d/Y", strtotime($license->birth_date));
    $textUnderBarcode = "0100272464683465"; 
    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.8,60)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(-90);
    $img->insert($secimg,'top-right',30, 170);  // normal barcode



   //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.1)));  
    $img->insert('license/barcodes/'.$time.'.png','top-left',195, 64);  // pdf14 barcode


    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(117, 102); //resize for back
    $photoImage->crop(90, 90, 15,0 );
    $photoImage->opacity(35);
    $img->insert($photoImage,'bottom-left',120, 155); //picture @back 

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}








// GA   


public function get_GA_FRONT_OLD_File($license,$info,$classification){

    
   $time = $info['codename']."xxx".$license->state.time();
   $akFont = "fonts/arialbd.ttf";
   $normalFont = $this->myfont['normalFont'];
   $secnormalFont = $this->myfont['secnormalFont'];
   $BigFont = $this->myfont['BigFont'];
   $l_font = $this->myfont['boldFont'];
   $futuramFont = $this->myfont['futuramFont'];
   $optimistFont = $this->myfont['optimistFont'];
   $signFont  = $this->myfont['signFont'];
   $wcashFont  = $this->myfont['wcashFont'];
   $HelveticaBold = $this->myfont['HelveticaBold'];
   $bg = "license/background/".$license->background;
   $background = Image::make($bg);
   $background->resize(1200, 700);
   $side =  $license->state."_FRONT";
   $bgImage = $this->states[$side];
   $img = Image::make($bgImage);
   $dob = date("m/d/Y", strtotime($license->birth_date));
   $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
   $dup = $this->weight($this->getRndInteger(0, 1));
   $classification = $info['classification'];
   $end ="NONE";
   $rest ="NONE";
   $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10000, 99999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10, 99);
   $randnum = "0".$this->getRndInteger(10000,99999);

   /// signature
   $sign_name = substr(strtolower($license->first_name),0,5);
   $img->text($sign_name, 180, 595, function($font) use ($signFont){
       $font->file($signFont); 
       $font->size(70);
       // $font->color('#3d3d3d');
   });
   $sign_name = substr(strtoupper($license->last_name),0,1) ;
   $img->text($sign_name, 180, 600, function($font) use ($signFont){
       $font->file($signFont); 
       $font->size(70);
       // $font->color('#3d3d3d');
   });



   $photoImage = Image::make('license/photo/'.$license->picture);
   $photoImage->resize(340, 330); 
   $photoImage->opacity(75); 
   $photoImage->crop(287, 320, 37,0 );
   $img->insert($photoImage,'bottom-left',100, 148); //picture y + up

   $sign_name = substr(strtolower($license->first_name),0,5);
   $img->text($sign_name,310, 525, function($font) use ($signFont){
       $font->file($signFont); 
       $font->size(70);
       // $font->color('#3d3d3d');
   });
   $sign_name = substr(strtoupper($license->last_name),0,1) ;
   $img->text($sign_name,310, 530, function($font) use ($signFont){
       $font->file($signFont); 
       $font->size(70);
       // $font->color('#3d3d3d');
   });


   $photoImage->resize(145, 170); //resize for back
   $photoImage->opacity(50);
   $img->insert($photoImage,'bottom-right',90, 154); //picture 


   $photoImage->resize(145, 170); //resize for back
   $photoImage->opacity(50);
   $photoImage->greyscale();
   $img->insert($photoImage,'bottom-right',215, 103); //picture 


   $img->text($randnum, 305, 205, function($font) use ( $HelveticaBold){
    $font->file( $HelveticaBold); 
    $font->color("#808080"); 
    $font->size(20);
   });

   $img->text(strtoupper($info['dl_number']), 500, 215, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(25);
   });
   $img->text($classification, 500,245, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(25);
   });

   $img->text(strtoupper($dob), 810, 218, function($font) use ( $HelveticaBold){
    $font->file( $HelveticaBold); 
    $font->size(25);
   });
   $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
   $img->text($changeDate, 810, 244, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(25);
   });


   $img->text($info['last_name'], 405, 270, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(25);
   });
   $img->text($info['first_name']." ".$info['middle_name'], 405, 300, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(30);
   });

   $img->text($info['street'].",", 405, 350, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(22);
   });
   $city_and_zip = $info['city'].", ".substr($license->state,0,2)." ".$license->zip;
   $img->text($city_and_zip, 405, 380, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(25);
   });

    $img->text("A", 560, 440, function($font) use ( $HelveticaBold){
    $font->file( $HelveticaBold); 
    $font->size(25);
    });
    $img->text("NONE", 724, 440, function($font) use ( $HelveticaBold){
        $font->file( $HelveticaBold); 
        $font->size(25);
    });

   $changeDate = date("m/d/Y", strtotime($license->issued_date));
   $img->text($changeDate, 450, 467, function($font) use ( $HelveticaBold){
           $font->file( $HelveticaBold); 
           $font->size(25);
   });
$img->text($license->gender, 545, 510, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(28);
   });
   $height = $license->foot."'-".$this->formatInches($license->inches).'"';
   $img->text($height, 545, 540, function($font) use ( $l_font){
       $font->file( $l_font); 
       $font->size(26);
   });
   $img->text($license->eye_color, 690,510, function($font) use ( $HelveticaBold){
       $font->file( $HelveticaBold); 
       $font->size(28);
   });

   $img->text($license->weight."lb",690, 540, function($font) use ( $l_font){
       $font->file( $l_font); 
       $font->size(26);
   });

$img->text($dd, 470, 575, function($font) use ( $l_font){
   $font->file( $l_font); 
   $font->size(18);
});

$img->text($randnum, 462, 590, function($font) use ( $l_font){
    $font->file( $l_font); 
    $font->color("#808080"); 
    $font->angle(-270);
    $font->size(10);
   });




   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';

   return $file;
}




public function get_GA_BACK_OLD_File($license,$info,$mydata){

   $time = $info['codename']."xxx".$license->state.time();
   $normalFont = 'fonts/ARIAL.TTF';
   $l_font = 'fonts/arialbd.ttf';
   $bg = "license/background/".$license->background;
   $background = Image::make($bg);
   $background->resize(1200, 700);
   $side =  $license->state."_BACK";
   $bgImage = $this->states[$side];
   $img = Image::make($bgImage); 
   $dob = date("m/d/Y", strtotime($license->birth_date));


  $textUnderBarcode =  $this->getRndInteger(1000000000,9999999999) .$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(1,9).strtoupper($this->getRndLetter()); // text under secong barcode
  // text under secong barcode
  file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.3,69)));

  //create barcode and save 
  file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.7,1.5)));

   
  $img->insert('license/barcodes/additional/'.$time.'.png','top-right',130, 42);  // normal barcode
  $img->insert('license/barcodes/'.$time.'.png','top-right',105, 140);  // pdf14 barcode
  $img->text($textUnderBarcode, 350, 112, function($font) use ($l_font){
  $font->file($l_font); 
  $font->size(16);
   });

    $img->text($dob, 85, 635, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(17);
    });

    $img->text("None", 270, 530, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
    $img->text("None", 250, 582, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });


   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}





// GA   NEW


public function get_GA_FRONT_File($license,$info,$classification){

    
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $wcashFont  = $this->myfont['wcashFont'];
    $cheapinkFont = $this->myfont['cheapinkFont'];
    $HelveticaBold = $this->myfont['HelveticaBold'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(1000000000, 9999999999);
    $randnum = "0".$this->getRndInteger(10000,99999);
 

    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 180, 540, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(57);
        // $font->color('#3d3d3d');
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 180, 545, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(57);
        // $font->color('#3d3d3d');
    });
  
    $img->text($dd,185, 576, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
 
;
 
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(270, 280); 
    $photoImage->opacity(70); 
    $photoImage->crop(236, 280);
    $photoImage->greyscale();
    $img->insert($photoImage,'bottom-left',146, 148); //picture y + up

    $photoImage->resize(105, 115);
    $photoImage->opacity(40);
    $img->insert($photoImage,'bottom-right',195, 100); //picture 


    $img->text($info['dl_number'], 510, 180, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text("CM", 507, 210, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($info['last_name'],430, 275 , function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(28);
    });
    $others = $info['first_name']."   ".$info['middle_name'];
    $img->text($others,430, 245 , function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($info['street'], 430, 330, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 430, 365, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text("NONE", 490, 405, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
        $img->text("B", 490, 430, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 490, 460, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(28);
    });

    $img->text($license->gender, 490, 490, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 490, 520, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->eye_color, 700, 490, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->weight." lb", 700, 520, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });


    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $img->text($changeDate, 760, 180, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 760, 210, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    
    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $img->text($changeDate, 820, 520, function($font) use ($cheapinkFont){
        $font->file($cheapinkFont); 
        $font->color("#808080"); 
        $font->size(20);
    });




    // $img->text("SAFE DRIVER", 815, 357, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(27);
    // });






   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';

   return $file;
}



public function get_GA_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m/d/Y", strtotime($license->birth_date));
 
 
   $textUnderBarcode =  "1 0 0 0 0 ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ";
   // text under secong barcode
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',1.09,40)));
 
   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.2,1.179)));
 
    
 
   $img->insert('license/barcodes/'.$time.'.png','top-left',273, 98);  // pdf14 barcode


    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(-90);
    $img->insert($secimg,'top-left',175, 90);  // normal barcode

    $img->text($textUnderBarcode, 155, 150, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->angle(-90);
        $font->size(20);
    });

    $changeDate = date("m/d/Y", strtotime("2019-02-22"));
    $img->text($changeDate, 810, 105, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });

    $img->text("DOB: ".$dob, 770, 580, function($font) use ($l_font){
     $font->file($l_font); 
     $font->size(23);
     });
 

 
 
    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
 }







  
    /**
 *  
 * 
 *   HI
 * 
 * 
 */


public function get_HI_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $arFont  = $this->myfont['arielLightFont'];
    $l_font = 'fonts/arialbd.ttf';
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);


    
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 390, 500, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 390, 505, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 180, 175, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });
    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(300, 310); 
    $photoImage->opacity(70); 
    // $photoImage->crop(300, 350, 50,0 );
    $img->insert($photoImage,'bottom-left',50, 172); //picture y + up
    $photoImage->resize(175, 190);
    $photoImage->opacity(45);
    $photoImage->crop(155, 190, 10,0 );
    $img->insert($photoImage,'bottom-right',250, 72); //picture 


    // values


    $img->text($info['dl_number'], 410, 267, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(55);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 510, 333, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(30);
    });
    $changeDate = date("m/d/Y", strtotime($license->birth_date));
    $img->text($changeDate, 520, 390, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(30);
    });

    $dd = $this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(1000, 9999).strtoupper($this->getRndLetter()).strtoupper($this->getRndLetter()).$this->getRndInteger(100, 999);
    $img->text($dd, 408, 423, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(18);
    });

    $img->text($info['last_name'], 155, 565, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(25);
    });
    $others = $info['first_name']."   ".$info['middle_name'];
    $img->text($others, 155, 595, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(25);
    });
    $img->text($info['street'], 155, 625, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state.", ".$license->zip;
    $img->text($city_and_zip, 155, 645, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(25);
    });


    $height = $license->foot."-".$license->inches;
    $img->text($height, 965, 307, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });
    $img->text($license->weight, 965, 347, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });
    $img->text($license->eye_color, 965, 390, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });
    $img->text($license->gender, 965, 428, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });

    $img->text($classification, 940, 472, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });

    $img->text("NONE", 958, 502, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });
    $img->text("NONE", 958, 532, function($font) use ($arFont){
        $font->file($arFont); 
        $font->size(27);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}





public function get_HI_BACK_File($license,$info,$mydata){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $secnormalFont = $this->myfont['secnormalFont'];
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $img = Image::make($bgImage); 
    $exp = date("m/d/Y", strtotime($license->birth_date));
    $textUnderBarcode = $this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9)."   ".$this->getRndInteger(0, 9);
    $textinsideBarcode = "24000".$this->getRndInteger(00000000000, 99999999999);
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.5)));  
    $img->insert('license/barcodes/'.$time.'.png','top-right',130, 64);  // pdf14 barcode

    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textinsideBarcode, 'C128',2.5,44)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(-90);
    $img->insert($secimg,'bottom-left',105, 90);  // normal barcode

    $img->text($textUnderBarcode, 70, 330, function($font) use ($secnormalFont){
        $font->file($secnormalFont); 
        $font->size(27);
        $font->angle(-90);
    });

    $img->text($dob, 245, 415, function($font) use ($secnormalFont){
        $font->file($secnormalFont); 
        $font->size(27);
        $font->angle(-90);
    });

    $img->text("NONE", 393, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text("NONE", 770, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}

















    /**
 *  
 * 
 *   IA
 * 
 * 
 */
public function get_IA_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("d/m/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";          
    $dd =$this->getRndInteger(1000000000000, 9999999999999).$this->getRndInteger(1000000000, 9999999999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 131, 595, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 131, 600, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    
    // photos first

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(265, 300); 
    $photoImage->opacity(70); 
   // $photoImage->crop(270, 325, 68,0 );
    $img->insert($photoImage,'bottom-left',92, 210); //picture y + up

    $photoImage->resize(105, 115);
    //$photoImage->crop(105, 115, 0,0 );
    $photoImage->opacity(30);
    $img->insert($photoImage,'bottom-right',185, 180); //picture 


    $photoImage->resize(105, 115);
    $photoImage->crop(105, 115, 0,0 );
    $photoImage->opacity(30);
    $img->insert($photoImage,'bottom-right',100, 225); //picture 


    $img->text($info['last_name'], 385, 221, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($info['first_name'], 385, 251, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });

    $img->text($info['street'], 385, 299, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 385, 319, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text(strtoupper($info['dl_number']), 470, 385, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
   $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 430, 423, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(23);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 670, 423, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });

    $img->text($license->gender, 433, 450, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 528, 450, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($license->eye_color, 694, 450, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });


    $img->text($classification, 452, 487, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($end, 580, 485, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($rest, 445, 520, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text(strtoupper($dob), 475, 611, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($dd, 475, 642, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(17);
    });

    $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
    $img->text($edbdy['formattedBirthday'], 850, 630, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
        $font->color("#595f64");
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

public function get_IA_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
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
    $textUnderBarcode ="438AA4549173650101";

    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.9,50)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $img->insert($secimg,'top-right',230, 60);  // sec barcode 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.7,1.4)));
    $img->insert('license/barcodes/'.$time.'.png','top-right',90, 145);  // pdf14 barcode



    $img->text($dob, 850, 620, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });
 


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}





 
    
    /**
 *  
 * 
 *   ID
 * 
 * 
 */



public function get_ID_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $arialnbFont = $this->myfont['arialnbFont'];
    $arialnFont  = $this->myfont['arialnFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("d/m/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="M";
    $rest ="B";          
    $dd =$this->getRndInteger(100000000000, 999999999999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 555, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 200, 560, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    
    // photos first

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(285, 300);
    $photoImage->opacity(60); 
   $photoImage->crop(255, 300, 20,0 );
    $img->insert($photoImage,'bottom-left',160, 210); //picture y + up

    $photoImage->resize(80, 95);
    //$photoImage->crop(105, 115, 0,0 );
    $photoImage->opacity(40);
    $img->insert($photoImage,'bottom-right',185, 100); //picture 

    $img->text(strtoupper($info['dl_number']), 870, 203, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 910, 232, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 910, 262, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($dob, 900, 292, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });



    $img->text($info['last_name'], 480, 330, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 480, 358, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });

    $img->text($info['street'], 480, 420, function($font) use ($arialnFont){
        $font->file($arialnFont); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 480, 450, function($font) use ($arialnFont){
        $font->file($arialnFont); 
        $font->size(25);
    });



    $img->text($license->gender, 455, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 520, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });
    $img->text($license->weight." lb", 600, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });
    $img->text($license->eye_color, 710, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });

    $img->text($license->hair_color, 790, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });
    $img->text($dd, 520, 597, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(25);
    });

    $img->text($classification, 600, 220, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(28);
    });
    $img->text($end, 570, 250, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(28);
    });
    $img->text($rest, 550, 280, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(28);
    });
//     $img->text(strtoupper($dob), 475, 611, function($font) use ($l_font){
//         $font->file($l_font); 
//         $font->size(30);
//     });


//     $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
//     $img->text($edbdy['formattedBirthday'], 850, 630, function($font) use ($l_font){
//         $font->file($l_font); 
//         $font->size(30);
//         $font->color("#595f64");
//     });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}





public function get_ID_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $classification = $info['classification']."-Operator";
    $end ="None";
    $rest ="A-Corrective Lenses";
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $dd1 = $this->getRndInteger(100000000,999999999);
    $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
   // create secondBarcode 
   $textUnderBarcode =  $dd1.$dd2;
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2,40)));
   $img->insert('license/barcodes/additional/'.$time.'.png','top-right',170, 60);  // normal barcode
   
   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.8)));
   $img->insert('license/barcodes/'.$time.'.png','top-left',440, 140);  // pdf14 barcode

    $img->text($dob, 210, 105, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });


   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}










  
    
    /**
 *  
 * 
 *   IL
 * 
 * 
 */


    public function get_IL_FRONT_File($license,$info,$classification){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/DINNextCYRRegular.otf';
        $l_font = 'fonts/arialbd.ttf';
        $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        // photos first
        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(285, 300); 
        $photoImage->opacity(70); 
        //$photoImage->crop(280, 380, 90,0 );
        $img->insert($photoImage,'bottom-left',60, 115); //picture y + up
        $photoImage->resize(145, 160);
        $photoImage->opacity(45);
        //$photoImage->crop(140, 160, 0,0 );
        $img->insert($photoImage,'bottom-right',62, 80); //picture 


        // values


        $img->text($info['dl_number'], 464, 185, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
            $font->color('#1e329d');
        });
        $img->text($info['last_name'], 383, 295, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });
        $img->text($info['first_name'], 383, 325, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });
        $img->text($info['street'], 383, 350, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(21);
        });
        $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 383, 370, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(21);
        });


        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate,440, 260 , function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
            $font->color('#1e329d');
        });

        $changeDate = date("m/d/Y", strtotime($license->birth_date));
        $img->text($changeDate, 440, 220, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
            $font->color('#1e329d');
        });

        $changeDate = date("m/d/Y", strtotime($license->issued_date));
        $img->text($changeDate, 780, 260, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
            $font->color('#1e329d');
        });



        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 101, 563, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1) ;
        $img->text($sign_name, 101, 563, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });


        $img->text($classification, 459, 430, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });

        $by = substr($license->birth_date,0,4);
        $cy = date("Y");
        $sub = $cy-$by;
        $res = $sub > 50 ? "B": "NONE";
        $img->text($res, 448, 460, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(21);
        });
        //end 2nd res
        $end ="NONE";
        $img->text($res, 630, 430, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(21);
        });

        $img->text($license->gender, 442, 520, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });
        $height = $license->foot."'-".$license->inches.'"';
        $img->text($height, 630, 520, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });

        $img->text($license->weight." lbs", 442, 548, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });

        $img->text($license->eye_color, 630, 548, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });
        $org = "ORG";
        $img->text($org, 795, 548, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(27);
        });
        $DD = substr($info['revDate'],4,4) .  $this->getRndInteger(1000000,9999999) . strtoupper($this->getRndLetter()). strtoupper($this->getRndLetter()).  $this->getRndInteger(1000,9999) ; 
        $img->text($DD, 410, 578, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });

        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
    }

    public function get_IL_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 

        $first_value = strtoupper($this->getRndLetter()) .  $this->getRndInteger(1000000000,9999999999) . strtoupper($this->getRndLetter()); 
        $sec_value   = $license->state . strtoupper($this->getRndLetter()) .  $this->getRndInteger(0,9) . strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter()) .  $this->getRndInteger(10,90);
        $rev = "Rev.".$this->format_date_by_sign($info['revDate'],"/");
        $exp = date("m/d/Y", strtotime($license->birth_date));
        $textUnderBarcode = $first_value.$sec_value; 
        // create Barcode for maryland
        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.8,60)));
       //create pdf14 barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.3)));



        $img->insert('license/barcodes/additional/'.$time.'.png','top-right',140, 10);  // normal barcode
        $img->insert('license/barcodes/'.$time.'.png','top-right',95, 84);  // pdf14 barcode
        $img->text($first_value, 50, 60, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(16);
        });
        $img->text($sec_value, 50, 75, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(16);
        });
        $img->text($rev, 50, 95, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $img->text($exp, 50, 115, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
    }






    /**
 *  
 * 
 *   IN
 * 
 * 
 */

    public function get_IN_FRONT_File($license,$info,$classification){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/DINNextCYRRegular.otf';
        $l_font = 'fonts/arialbd.ttf';
        $arialnbFont = $this->myfont['arialnbFont'];
        $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $BigFont = $this->myfont['BigFont'];
        $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(1000, 9999);
        $img = Image::make($bgImage);
        // photos first
        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(285, 300); 
        $photoImage->greyscale();
        $photoImage->opacity(70); 
        $photoImage->crop(245, 300, 20,0 );
        $img->insert($photoImage,'bottom-left',130, 195); //picture y + up
        $photoImage->resize(90, 110); 
        $photoImage->greyscale();
        $photoImage->opacity(30);
        $img->insert($photoImage,'bottom-right',200, 180); //picture 

// values


    $img->text($info['dl_number'], 450, 230, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(43);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate,840, 230 , function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(43);
    });
    $img->text($info['last_name'], 400, 263, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($info['first_name'], 400, 287, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($info['street'], 400, 332, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 400, 354, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });


    $img->text($license->gender, 450, 458, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $height =  $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 560, 458, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($license->weight." lb", 703, 458, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($license->eye_color, 460, 483, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->hair_color, 610, 483, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });




    $img->text("B", 670, 406, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $dob = date("m/d/Y", strtotime($license->birth_date));
    $img->text($dob, 450, 530, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(43);
    });
    $img->text($dd, 440, 559, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(24);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 692, 509, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
    $img->text($edbdy['formattedBirthday'], 850, 590, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(36);
    });

        /// signature
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 181, 575, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1) ;
        $img->text($sign_name, 181, 580, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });


        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
    }


    public function get_IN_BACK_File($license,$info,$mydata){


        $time = $info['codename']."xxx".$license->state.time();
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
        $textUnderBarcode1 =$this->getRndInteger(10000000000,99999999999) ;
        $textUnderBarcode2 =$this->getRndInteger(10000,99999) ;
        $fulltext = $textUnderBarcode1.$textUnderBarcode2;
    
        // create Barcode for maryland
        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($fulltext, 'C128',2.7,50)));
        $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
        $secimg->rotate(90);
        $img->insert($secimg,'top-right',123, 180);  // sec barcode 
        //create pdf14 barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.7,1)));
        $img->insert('license/barcodes/'.$time.'.png','top-right',250, 90);  // pdf14 barcode
    
    
        $photoImage = Image::make('license/photo/'.$license->picture); 
        $photoImage->resize(117, 102); //resize for back
        $photoImage->crop(80, 102, 19,0 );
        $photoImage->greyscale();
        $photoImage->opacity(40);
        $img->insert($photoImage,'bottom-left',195, 173); //picture @back 
      

        $img->text($textUnderBarcode1, 970, 93, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(13);
            $font->angle(-90);
        });
        $img->text($textUnderBarcode2, 957, 93, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(13);
            $font->angle(-90);
        });

    
        $img->text($dob, 149, 600, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(18);
        });
     
    
    
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
    }
    








    /**
 *  
 * 
 *   KS
 * 
 * 
 */


public function get_KS_FRONT_File($license,$info,$classification){

        $time = $info['codename']."xxx".$license->state.time();
        $akFont = "fonts/arialbd.ttf";
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $futuramFont = $this->myfont['futuramFont'];
        $optimistFont = $this->myfont['optimistFont'];
        $signFont  = $this->myfont['signFont'];
        $wcashFont  = $this->myfont['wcashFont'];
        $HelveticaBold = $this->myfont['HelveticaBold'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 800);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
        $dup = $this->weight($this->getRndInteger(0, 1));
        $classification = $info['classification'];
        $end ="NONE";
        $rest ="NONE";
        $dd1 = strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(100000000, 999999999);
        $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(100, 999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(100, 999).strtoupper($this->getRndLetter().$this->getRndLetter());
        $randnum = "0".$this->getRndInteger(10000,99999);


        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(340, 325);  
        $photoImage->opacity(50); 
        $photoImage->crop(278, 325, 40,0 );
        $img->insert($photoImage,'bottom-left',87, 162); //picture y + up
        $photoImage->resize(149, 170);
        $photoImage->greyscale();
        $photoImage->opacity(35);
        $photoImage->crop(136, 170, 10,0 );
        $img->insert($photoImage,'bottom-right',80,78); //picture 






        /// signature
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 170, 590, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1);
        $img->text($sign_name, 170, 593, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });




        $img->text(strtoupper($info['dl_number']), 540, 205, function($font) use ($l_font){
            $font->file($l_font); 
            $font->color('#2d2c6e');
            $font->size(40);
        });
        $img->text(strtoupper($dob), 500, 245, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(35);
            
        });

        $iss = date("m/d/Y", strtotime($license->issued_date));
        $img->text($iss, 890, 205, function($font) use ($l_font){
                $font->file($l_font); 
                $font->size(30);
        });
        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate, 890, 245, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
        });

        $img->text($info['last_name'], 440, 285, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(35);
        });
        $name = $info['first_name'];
        $img->text($name, 440, 315, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(35);
        });
        $img->text($info['street'], 440, 345, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(30);
        });
        $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 440, 375, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(30);
        });
        // $img->text($dd, 500, 454, function($font) use ($l_font){
        // $font->file($l_font); 
        // $font->size(17);
        // });
        $img->text($classification, 530, 434, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
        });
        $img->text($end, 720, 433, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
        });
        $img->text($rest, 720, 461, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });

        $img->text($license->gender, 510, 490, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });
        $height = $license->foot."'-".$this->formatInches($license->inches).'"';
        $img->text($height, 510, 518, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });

        $img->text($license->weight." lb", 510, 548, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });
        $img->text($license->eye_color, 510, 575, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });
        $img->text($dd1, 505,609, function($font) use ( $l_font){
            $font->file( $l_font); 
            $font->size(20);
        });
        $img->text($dd2, 475,629, function($font) use ( $l_font){
            $font->file( $l_font); 
            $font->size(20);
        });

        $img->text($dob, 649,546, function($font) use ( $l_font){
            $font->file( $l_font); 
            $font->color("#525660");
            $font->size(45);
        });


        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;

    }


    public function get_KS_BACK_File($license,$info,$mydata){

        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $classification = $info['classification']."-Operator";
        $end ="None";
        $rest ="A-Corrective Lenses";
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $dd1 = $this->getRndInteger(100000000,999999999);
        $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
       // create secondBarcode 
       $textUnderBarcode =  $dd1.$dd2;
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.57,50)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top-left',440, 37);  // normal barcode
       
       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.3)));
       $img->insert('license/barcodes/'.$time.'.png','top-left',440, 110);  // pdf14 barcode
    
        $img->text($dob, 200, 130, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });

    
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }
    











    /**
 *  
 * 
 *   KY
 * 
 * 
 */



public function get_KY_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/DINNextCYRRegular.otf';
    $l_font = 'fonts/arialbd.ttf';
    $arialnbFont = $this->myfont['arialnbFont'];
    $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $BigFont = $this->myfont['BigFont'];
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $dd = strtoupper($info['dl_number'].$this->getRndLetter().$this->getRndInteger(10000, 99999)." ".$this->getRndInteger(100, 999)."-".$this->getRndInteger(1, 9));
    $img = Image::make($bgImage);
    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(285, 280); 
    $photoImage->greyscale();
    $photoImage->opacity(70); 
    $photoImage->crop(245, 280, 20,0 );
    $img->insert($photoImage,'bottom-left',125, 195); //picture y + up
    $photoImage->resize(90, 105); 
    $photoImage->greyscale();
    $photoImage->opacity(30);
    $img->insert($photoImage,'bottom-right',200, 140); //picture 

// values


$img->text($info['dl_number'], 450, 217, function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(43);
});

$img->text($info['last_name'], 400, 268, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(30);
});
$img->text($info['first_name'], 400, 292, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(30);
});
$img->text($info['street'], 400, 317, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
});
$city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
$img->text($city_and_zip, 400, 339, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
});

$img->text($dob,660, 405 , function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(43);
});

$changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
$img->text($changeDate,660, 445 , function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(43);
});


$img->text($classification, 670, 480, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
});

$img->text("NONE", 660, 505, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
});

$img->text("1", 660, 530, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
});



$img->text($license->gender, 450, 580, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
});
$height =  $license->foot."'-".$this->formatInches($license->inches).'"';
$img->text($height, 570, 580, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
});
$img->text($license->eye_color, 760, 580, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
});
$changeDate = date("m/d/Y", strtotime($license->issued_date));
$img->text($changeDate, 850, 610, function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(27);
});
$img->text($dd, 450, 610, function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(22);
});
$img->text("ADO", 760, 610, function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(22);
});
$changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
$img->text($changeDate,840, 190 , function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->color("#787878");
    $font->size(35);
});
$word =  strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10, 99));
$img->text($word, 870, 190, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(35);
});
$img->text($word,  445, 435, function($font) use ($l_font){
    $font->file($l_font); 
    $font->color("#787878");
    $font->size(25);
});









// $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
// $img->text($edbdy['formattedBirthday'], 850, 590, function($font) use ($BigFont){
//     $font->file($BigFont); 
//     $font->size(36);
// });

    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 181, 575, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 181, 580, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}


    public function get_KY_BACK_File($license,$info,$mydata){

        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m-d-Y", strtotime($license->birth_date));
    
       // create secondBarcode 
       $textUnderBarcode =  $this->getRndInteger(100000,99999) .$this->getRndInteger(100000,999999).$this->getRndInteger(1000,9999); // text under secong barcode
       // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',1.1,60)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',250, 60);  // normal barcode
       //create barcode and save 
       
       
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4.2,1.5)));
       $img->insert('license/barcodes/'.$time.'.png','top-right',150, 160);  // pdf14 barcode

       $img->text($textUnderBarcode, 400, 115, function($font) use ($normalFont){
       $font->file($normalFont); 
       $font->size(14);
        });
        $img->text($dob, 140, 105, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(16);
        });
        // $img->text($rest, 70, 505, function($font) use ($l_font){
        //     $font->file($l_font); 
        //     $font->size(12);
        // });
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }
    
    





    /**
 *  
 * 
 *   LA
 * 
 * 
 */



    public function get_LA_FRONT_File($license,$info,$classification){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $l_font = $this->myfont['boldFont'];
        $BigFont = $this->myfont['BigFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        //photos first
        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(285, 300); 
        $photoImage->opacity(70); 
        $photoImage->crop(246, 300, 20,0 );
        $img->insert($photoImage,'bottom-left',172, 153); //picture y + up

        $photoImage->resize(120, 140);
        $photoImage->opacity(40);
        // $photoImage->crop(120, 130, 0,0 );
        $img->insert($photoImage,'bottom-right',178, 130); //picture 


        // values


        $img->text($info['dl_number'], 480, 255, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });

        $img->text($classification, 660, 255, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });

        $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
        $img->text($changeDate, 730, 255, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });

        $changeDate = date("m-d-Y", strtotime($license->birth_date));
        $img->text($changeDate, 470, 288, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });

        $changeDate = date("m-d-Y", strtotime($license->issued_date));
        $img->text($changeDate, 790, 288, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($info['last_name'], 425, 310, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $name = $info['first_name']." ".$info['middle_name'];
        $img->text($name, 425, 330, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $img->text($info['street'], 425, 350, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 425, 370, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
       
        $img->text("NONE", 520, 430, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $img->text("NONE", 760, 430, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $img->text($license->gender, 435, 472, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $height = $license->foot."' ".$license->inches.'"';
        $img->text($height, 480, 472, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });

        $img->text($license->weight, 535, 472, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });

        $img->text($license->eye_color, 633, 472, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $audit = $this->getRndInteger(1000,9999);
        $img->text($audit, 690, 472, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $office= $this->getRndInteger(100,999);
        $img->text($office, 770, 472, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
        $parish = $this->getRndInteger(10,99);
        $img->text($parish, 740, 525, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });


        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 440, 535, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1) ;
        $img->text($sign_name, 440, 535, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });




        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
    }



    public function get_LA_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m-d-Y", strtotime($license->birth_date));
        $textUnderBarcode = "007".$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(100,999); 
        // create Barcode for maryland
        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.3,40)));
       //create pdf14 barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.294,1)));



        $img->insert('license/barcodes/additional/'.$time.'.png','top-left',350, 60);  // normal barcode
        $img->insert('license/barcodes/'.$time.'.png','bottom-left',147, 200);  // pdf14 barcode

        $img->text( $textUnderBarcode, 150, 90, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(10);
        });

        $img->text($dob, 927, 455, function($font) use ($l_font){
            $font->file($l_font); 
            $font->angle(-90);
            $font->size(15);
        });
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
    }

















    /**
 *  
 * 
 *   MA
 * 
 * 
 */


 
public function get_MA_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $treFont = $this->myfont['treFont'];
    $trebFont = $this->myfont['trebFont'];
    $segoeFont = $this->myfont['segoeFont'];  
    $arialnbFont = $this->myfont['arialnbFont'];   

    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd =  "00".$this->getRndInteger(10000000,99999999).$this->getRndInteger(100000,999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 250, 580, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 250, 583, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });


    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(352, 355); 
    $photoImage->opacity(70); 
    //$photoImage->crop(323, 390, 40,0 );
    $img->insert($photoImage,'bottom-left',143, 166); //picture y + up
    // $photoImage->resize(145, 165); //resize for back
    // $photoImage->opacity(27);
    // $photoImage->crop(135, 165, 3,0 );
    // $img->insert($photoImage,'bottom-right',200,250); //picture 


    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 638, 273, function($font) use ($arialnbFont){
            $font->file($arialnbFont); 
            $font->size(30);
    }); 

    $img->text(strtoupper($info['dl_number']), 835, 273, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(35);
    });


    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 638, 325, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(30);
    });
        $img->text(strtoupper($dob),835, 325,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    $img->text($classification, 630, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($rest, 735, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($end, 870, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($info['last_name'], 510, 412, function($font) use ($l_font){
        $font->file($l_font); 
        $font->color('#2a4177');
        $font->size(35);
    });
     $img->text($info['first_name'], 510, 440, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($info['street'], 510, 472, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 510, 500, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
    });

    $img->text($license->eye_color, 600, 555, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($license->gender, 590, 588, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 690, 588, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    // $img->text($license->weight, 830, 397, function($font) use ($arialnbFont){
    //     $font->file($arialnbFont); 
    //     $font->size(27);
    // });

    // $img->text($license->hair_color, 830, 430, function($font) use ($arialnbFont){
    //     $font->file($arialnbFont); 
    //     $font->size(27);
    // });
    

    $ddnow = $changeDate = date("m/d/Y", strtotime($license->issued_date))." Rev 02/22/2016";
    $img->text($ddnow, 580, 612, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });

    $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
    $img->text($edbdy['formattedBirthday'], 860, 610, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(36);
        $font->color("#696c6c");
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}


    public function get_MA_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $classification = $info['classification']."-Operator";
        $end ="None";
        $rest ="A-Corrective Lenses";
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $dd1 = $this->getRndInteger(10000000,99999999);
        $dd2 = $this->getRndInteger(10000000,99999999);
       // create secondBarcode 
       $textUnderBarcode =  $dd1.$dd2;
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',4.7,65)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',195, 59);  // normal barcode
       
       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3,1.2)));
       $img->insert('license/barcodes/'.$time.'.png','top-right',140, 160);  // pdf14 barcode
    
    
    
        $img->text($dob, 90, 262, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $img->text($dd1, 150, 150, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(15);
        });
        $img->text($dd2, 150, 165, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(15);
        });
    
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }
    
    
    





    /**
 *  
 * 
 *   MI
 * 
 * 
 */
public function get_MI_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $sign_medium = 'fonts/sign_medium.ttf';
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $type ="O";
    $six =$this->getRndInteger(100000, 999999);
    $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(1000, 9999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 130, 565, function($font) use ($signFont  ){
        $font->file($signFont  ); 
        $font->size(60);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 130, 570, function($font) use ($signFont ){
        $font->file($signFont ); 
        $font->size(60);
    });


    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(300, 310);
    $photoImage->opacity(60); 
    $photoImage->crop(256, 310, 20,0 );
    $img->insert($photoImage,'bottom-left',75, 180); //picture y + up
    // // $photoImage->resize(80, 115);
    // // $photoImage->crop(80, 115, 0,0 );


    $photoImage->resize(117, 140); //resize for back
    $photoImage->crop(117, 140, 0,0 );
    $photoImage->opacity(50);
    $img->insert($photoImage,'bottom-right',120, 200); //picture @back 


    $img->text(strtoupper($info['dl_number']), 345, 207, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(30);
        $font->color('#6161a0');
    });


    $img->text(strtoupper($dob), 403, 243, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });

    $changeDate = date("m-d-Y", strtotime($license->issued_date));
    $img->text($changeDate, 725, 207, function($font) use ($akFont){
            $font->file($akFont); 
            $font->size(27);
    });

    
    $img->text($six, 905, 230, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(18);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 725, 243, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });
    $name =$info['first_name']." ".$info['last_name'];
    $img->text($name, 345, 280, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($info['street'], 345, 310, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 345, 340, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });

$img->text($license->gender, 395, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });
    $height = $license->foot.$license->inches;
    $img->text($height, 610, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });

    $img->text($license->eye_color, 790, 380, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
        $font->color('#3d3d3d');
    });

    $img->text($type, 450, 415, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });

    $img->text($end, 610, 415, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });
    $img->text($rest, 575, 452, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(27);
    });
    $img->text($dd, 470, 600, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(25);
    });
    $img->text($rev, 830, 595, function($font) use ($akFont){
        $font->file($akFont); 
        $font->size(16);
    });
//     $img->text($license->weight, 745, 380, function($font) use ($akFont){
//         $font->file($akFont); 
//         $font->size(27);
//         $font->color('#3d3d3d');
//     });






    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}




public function get_MI_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $l_font = $this->myfont['boldFont'];
    $BigFont = $this->myfont['BigFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    $textUnderBarcode = "A201".$this->getRndInteger(1000000000, 99999999999).$this->getRndInteger(1000000000, 99999999999).$this->getRndInteger(100, 999);
    $none = "NONE";

   
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.2,70)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $img->insert($secimg,'top-right',80, 87);  // sec barcode 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2,1.2)));
    $img->insert('license/barcodes/'.$time.'.png','top-right',80,270);  // pdf14 barcode

    
        $img->text($textUnderBarcode, 50, 155, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(10);
    });


    $img->text($dob, 230, 280, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(13);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}




    /**
 *  
 * 
 *   ME
 * 
 * 
 */


public function get_ME_FRONT_File($license,$info,$classification){

    // dd($license->background);
    
     $time = $info['codename']."xxx".$license->state.time();
     $normalFont = 'fonts/DINNextCYRRegular.otf';
     $l_font = 'fonts/arialbd.ttf';
     $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
     $bg = "license/background/".$license->background;
     $background = Image::make($bg);
     $background->resize(1200, 700);
     $side =  $license->state."_FRONT";
     $bgImage = $this->states[$side];
     $img = Image::make($bgImage);
     // photos first
     $photoImage = Image::make('license/photo/'.$license->picture);
     $photoImage->resize(260, 280); 
     $photoImage->opacity(60); 
     $photoImage->crop(232, 280, 12,0 );

     $img->insert($photoImage,'bottom-left',58, 132); //picture y + up 
     $photoImage->resize(117, 130); //resize for back
     $photoImage->opacity(70);
     $photoImage->crop(117, 130, 0,0 );
     $img->insert($photoImage,'bottom-right',83, 205); //picture 




         /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 110, 585, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(65);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 110, 588, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(65);
    });



     $img->text($info['dl_number'], 340, 423, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(33);
     });
     $img->text($info['last_name'], 320, 288, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(25);
     });

     $name = $info['first_name']." ".$info['middle_name'];
     $img->text($name, 320, 310, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(25);
     });


     $img->text($info['street'], 320, 335, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(23);
     });
     $city_and_zip = $info['city']." ".$license->state." ".$license->zip;
     $img->text($city_and_zip, 320, 355, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(23);
     });

     $changeDate = date("m/d/Y", strtotime($license->issued_date));
     $img->text($changeDate, 328, 490, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(25);
     });
          $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
     $img->text($changeDate, 500, 490, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(25);
     });
     $changeDate = date("m/d/Y", strtotime($license->birth_date));
     $img->text($changeDate, 665, 490, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(25);
     });
     

     $img->text($license->gender, 328, 540, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(27);
     });
     $height = $license->foot."'-".$license->inches.'"';
     $img->text($height, 440, 540, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(27);
     });
     $img->text($license->weight, 546, 540, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(27);
     });
    $img->text($license->eye_color, 654, 540, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->hair_color, 745, 540, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });


     $img->text($classification, 400, 573, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(27);
     });
    //  $random_alphanum = "000".$this->getRndInteger(1000, 9999)."DAE";
    //  $img->text($random_alphanum, 35, 400, function($font) use ($l_font){
    //      $font->file($l_font); 
    //      $font->size(19);
    //      $font->angle(90);
    //  });
    //  $sign_name = substr($license->first_name,0,5);
    //  $img->text($sign_name, 99, 538, function($font) use ($signFont){
    //      $font->file($signFont); 
    //      $font->size(55);
    //  });
    //  $sign_name = substr($license->last_name,0,1) ;
    //  $img->text($sign_name, 101, 538, function($font) use ($signFont){
    //      $font->file($signFont); 
    //      $font->size(55);
    //  });


     
    //  $by = substr($license->birth_date,0,4);
    //  $cy = date("Y");
    //  $sub = $cy-$by;
    //  $res = $sub > 50 ? "B": "NONE";
    //  $img->text($res, 315, 560, function($font) use ($normalFont){
    //      $font->file($normalFont); 
    //      $font->size(27);
    //  });

    //  // second dateof birth small one


     $img->save('license/destination/'.$time.'.png');  
     $background->insert('license/destination/'.$time.'.png','center');
     $background->save('license/final/'.$time.'.png');  
     $file= public_path(). '/license/final/'.$time.'.png';

     return $file;
 }



 public function get_ME_BACK_File($license,$info,$mydata){



     $time = $info['codename']."xxx".$license->state.time();
     $normalFont = 'fonts/ARIAL.TTF';
     $l_font = 'fonts/arialbd.ttf';
     $bg = "license/background/".$license->background;
     $background = Image::make($bg);
     $background->resize(1200, 700);
     $side =  $license->state."_BACK";
     $bgImage = $this->states[$side];
     $img = Image::make($bgImage); 
     $dob = date("m/d/Y", strtotime($license->birth_date));
     $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    //create barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.1,1.4)));
    // create secondBarcode for maryland
    $textUnderBarcode = "1521".$this->getRndInteger(10000000000,99999999999); // text under secong barcode
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',1.3,60)));
     //03420752  CODE39
    $img->insert('license/barcodes/additional/'.$time.'.png','top-right',150, 110);  // normal barcode
    $img->insert('license/barcodes/'.$time.'.png','top-right',130, 210);  // pdf14 barcode
    $img->text($dob, 530, 500, function($font) use ($l_font){
     $font->file($l_font); 
     $font->size(30);
     });
    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;

 }



    



    /**
 *  
 * 
 *   MD
 * 
 * 
 */

    public function get_MD_FRONT_File($license,$info,$classification){

       // dd($license->background);
       
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/DINNextCYRRegular.otf';
        $l_font = 'fonts/arialbd.ttf';
        $signFont  = 'fonts/Autograf_PersonalUseOnly.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        // photos first
        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(300, 305); 
        $photoImage->opacity(60); 
        $photoImage->crop(263, 305, 25,0 );
        $photoImage->greyscale();
        

        $img->insert($photoImage,'bottom-left',38, 138); //picture y + up
        //$photoImage->resize(130, 145); 
        $photoImage->resize(120, 130);
        $photoImage->opacity(20);
        $photoImage->crop(120, 130, 0,0 );
        $img->insert($photoImage,'top-right',70, 76); //picture 

        $img->text($info['dl_number'], 310, 200, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(33);
        });
        $img->text($info['last_name'], 310, 285, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });

        $name = $info['first_name']." ".$info['middle_name'];
        $img->text($name, 310, 348, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });


        $img->text($info['street'], 310, 410, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });
        $city_and_zip = $info['city']." ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 310, 438, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });
        $changeDate = date("m/d/Y", strtotime($license->birth_date));
        $img->text($changeDate, 310, 503, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        

        $img->text($license->gender, 470, 503, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });
        $height = $license->foot."'-".$license->inches.'"';
        $img->text($height, 525, 503, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });
        $img->text($license->weight, 680, 503, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });
        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate, 815, 503, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $changeDate = date("m/d/Y", strtotime($license->issued_date));
        $img->text($changeDate, 815, 560, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(22);
        });
        $img->text($classification, 525, 560, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });
        $random_alphanum = "000".$this->getRndInteger(1000, 9999)."DAE";
        $img->text($random_alphanum, 35, 400, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(19);
            $font->angle(90);
        });
        
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 99, 538, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(55);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1);
        $img->text($sign_name, 101, 538, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(55);
        });


        
        $by = substr($license->birth_date,0,4);
        $cy = date("Y");
        $sub = $cy-$by;
        $res = $sub > 50 ? "B": "NONE";
        $img->text($res, 315, 560, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(27);
        });

        // second dateof birth small one
        $changeDate = date("m/d/Y", strtotime($license->birth_date));
        $img->text($changeDate, 815, 153, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->color('#cccccc');
            $font->size(22);
        });

        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
    }



    public function get_MD_BACK_File($state,$ls_bg,$picture,$mydata,$info){
        $time = $info['codename']."xxx".$state.time();
         //create card as bg
        $normalFont = 'fonts/ARIAL.TTF';
        $bg = "license/background/".$ls_bg;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        //create barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.3,1)));
        // create secondBarcode for maryland
        $textUnderBarcode = 'MD10000'.$this->getRndInteger(10000, 55555); // text under secong barcode
        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.4,50)));

        //add text on the bg under the card
        $img->text($textUnderBarcode, 43, 205, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(30);
            $font->align('center'); // left, right and center
            $font->valign('top'); // top, bottom and middle
            $font->angle(-90);  
        });
        $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
        $secimg->rotate(-90);
        $photoImage = Image::make('license/photo/'.$picture); 
        $photoImage->resize(117, 102); //resize for back
        $photoImage->opacity(70);
        $img->insert($photoImage,'bottom-left',56, 62); //picture @back 
        $img->insert($secimg,'top-left',45, 50);  // sec barcode 
        $img->insert('license/barcodes/'.$time.'.png','bottom',3, 40); // normal barcode
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;

    }








    /**
 *  
 * 
 *   MN
 * 
 * 
 */

public function get_MN_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $cheapinkFont = $this->myfont['cheapinkFont'];
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";            
    $dd =$this->getRndInteger(100000,999999).$this->getRndInteger(10000000,99999999);

     // photos first
     $photoImage = Image::make('license/photo/'.$license->picture);
     $photoImage->resize(260, 280); 
     $photoImage->opacity(60); 
     $photoImage->crop(255, 280, 5,0 );
     $img->insert($photoImage,'bottom-left',114, 175); //picture y + up 
     
     $photoImage->resize(117, 130); //resize for back
     $photoImage->greyscale();
     $photoImage->opacity(50);
     $photoImage->crop(100, 130, 10,0 );
     $img->insert($photoImage,'bottom-right',138, 120); //picture 




    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 170, 580, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 170, 583, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $img->text($info['last_name'], 395, 215, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 395, 242, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($info['street'], 395, 265, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 390, 290, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(22);
    });
    $img->text(strtoupper($info['dl_number']), 450, 352, function($font) use ($l_font){
        $font->color("#32366f"); 
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text($dob, 460, 382, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(34);
    });
    $img->text($classification, 477, 407, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($end, 695, 407, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($rest, 477, 433, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 830, 352, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 830, 382, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    $img->text($license->gender, 470, 517, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 470, 541, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->weight." lb", 700, 517, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->eye_color, 700, 541, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($dd, 462, 584, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
    $img->text($edbdy['formattedBirthday'], 700, 600, function($font) use ($cheapinkFont){
        $font->file($cheapinkFont); 
        $font->size(30);
        $font->color('#666666');  //http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/colors/colors_picker.asp-colorhex=FFFFFF.html
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }


    public function get_MN_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $classification = $info['classification']."-Operator";
        $dob = date("m-d-Y", strtotime($license->birth_date));

       // create secondBarcode 
       $textUnderBarcode =  "D".$this->getRndInteger(1000000000,9999999999) .$this->getRndLetter().$this->getRndInteger(1000,9999); // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',1.8,40)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top',80, 58);  // normal barcode


       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.5,0.5)));
       $img->insert('license/barcodes/'.$time.'.png','top-left',100, 550);  // pdf14 barcode

       $img->text($dob, 900, 290, function($font) use ($l_font){
       $font->file($l_font); 
       $font->size(14);
        });

        
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }







    /**
 *  
 * 
 *   MO
 * 
 * 
 */





    public function get_MO_FRONT_File($license,$info,$classification){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $signFont  = $this->myfont['signFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
        $dup = $this->weight($this->getRndInteger(0, 1));
        $classification = $info['classification'];
        $end ="NONE";             
        $rest ="A";           
        $dd =$this->getRndInteger(100000,999999).$this->getRndInteger(100000,999999);
        /// signature
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 130, 590, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1) ;
        $img->text($sign_name, 130, 593, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        // photos first
        $photoImage = Image::make('license/photo/'.$license->picture);
        //$photoImage->resize(488, 440); 
        $photoImage->resize(270, 270); 
        $photoImage->opacity(60); 
        $photoImage->crop(226, 270, 20,0 );
        $img->insert($photoImage,'bottom-left',91, 205); //picture y + up
        $photoImage->resize(116, 125); //resize for back
        $photoImage->opacity(45);
        //$photoImage->crop(120, 150, 20,0 );
        $img->insert($photoImage,'bottom-right',107, 209); //picture 



        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate,680, 299,  function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });
        $img->text(strtoupper($dob),680, 331,  function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });
        $img->text($classification, 420, 297, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(23);
        });
        $img->text(strtoupper($info['dl_number']), 420, 329, function($font) use ($l_font){
            $font->color("#ac2101"); 
            $font->file($l_font); 
            $font->size(25);
        });
        $img->text($info['last_name'], 340, 362, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });
        $name = $info['first_name']." ".$info['middle_name'];
        $img->text($name, 340, 389, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });
        $img->text($info['street'], 340, 418, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 340, 438, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
        });

        $img->text($end, 397, 482, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($rest, 500, 505, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->gender, 397, 528, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $height = $license->foot."'-".$license->inches.'"';
        $img->text($height, 397, 550, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->weight." lb", 550, 528, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->eye_color, 555, 550, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($dd,390, 605, function($font) use ($l_font){
                $font->file($l_font); 
                $font->size(18);
        });
        $changeDate = date("m/d/Y", strtotime($license->issued_date));
        $img->text($changeDate, 690, 530, function($font) use ($l_font){
                $font->file($l_font); 
                $font->size(22);
        });
        //  // with red on the sec pic
        // $img->text($dob, 870, 510, function($font) use ($secnormalFont){
        //     $font->file($secnormalFont); 
        //     $font->size(19);
        //     $font->color('#8a0202');
        // });



        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
    }






    public function get_MO_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $classification = $info['classification']."-Operator";
        $end ="None";
        $rest ="A-Corrective Lenses";

       // create secondBarcode 
       $textUnderBarcode =  strtoupper($this->getRndInteger(10000,99999) .$this->getRndLetter().$this->getRndInteger(100000,999999).$this->getRndInteger(1000000,9999999)); // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',1.8,40)));

       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3,0.9)));

        //03420752  CODE39
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',80, 85);  // normal barcode
       $img->insert('license/barcodes/'.$time.'.png','top-right',80, 135);  // pdf14 barcode
       $img->text($textUnderBarcode, 110, 123, function($font) use ($normalFont){
       $font->file($normalFont); 
       $font->size(12);
        });

       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }




  

  
    /**
 *  
 * 
 *   MS
 * 
 * 
 */


public function get_MS_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd = $this->getRndInteger(1,9).$this->getRndLetter().$this->getRndInteger(1000000,9999999).$this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10000,99999).$this->getRndLetter().$this->getRndInteger(1000,9999).$this->getRndLetter();
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 135, 610, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 135, 613, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    //$photoImage->resize(488, 440); 
    $photoImage->resize(302, 310); 
    $photoImage->opacity(60); 
    $photoImage->crop(270, 310, 20,0 );
    $img->insert($photoImage,'bottom-left',83, 130); //picture y + up
    $photoImage->resize(149, 160); //resize for back
    $photoImage->opacity(45);
    $photoImage->crop(140, 160, 9,0 );
    $img->insert($photoImage,'bottom-right',101,150); //picture 

    $img->text(strtoupper($info['dl_number']), 520, 280, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text(strtoupper($dob),590,322,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 810, 280, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->size(26);
    });

    $img->text($info['last_name'], 380, 362, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 380, 389, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($info['street'], 380, 418, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 380, 438, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(18);
    });

   $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 430, 488, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(24);
    }); 


    $img->text($classification, 450, 523, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(25);
    });
    $img->text($end, 600, 523, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $img->text($rest, 812, 523, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });

    $img->text($license->gender, 475, 560, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 605, 560, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });

    $img->text($license->eye_color, 490, 595, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });

    $img->text(strtoupper($dd), 420, 629, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(18);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}








public function get_MS_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 

   // create secondBarcode 
   $textUnderBarcode =  $this->getRndInteger(100000,99999) .$this->getRndInteger(100000,999999).$this->getRndInteger(1000,9999); // text under secong barcode
   // text under secong barcode
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',1.25,60)));

   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4.19,1.7)));

    //03420752  CODE39
   $img->insert('license/barcodes/additional/'.$time.'.png','top-right',170, 35);  // normal barcode
   $img->insert('license/barcodes/'.$time.'.png','top-right',137, 105);  // pdf14 barcode
   $img->text($textUnderBarcode, 400, 95, function($font) use ($normalFont){
   $font->file($normalFont); 
   $font->size(12);
    });
    // $img->text($end, 70, 398, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(12);
    // });
    // $img->text($rest, 70, 505, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(12);
    // });
   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}












    /**
 *  
 * 
 *   MT
 * 
 * 
 */



public function get_MT_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd =  date('Y', strtotime($license->issued_date)).$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(100000,999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 230, 560, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 230, 563, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });


    $img->text($classification, 540, 255, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($end, 755, 255, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($rest, 910, 255, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });





    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(300, 310); 
    $photoImage->opacity(60); 
    $photoImage->crop(263, 310, 30,0 );
    $img->insert($photoImage,'bottom-left',173, 170); //picture y + up
    $photoImage->resize(149, 160); //resize for back
    $photoImage->opacity(27);
    $photoImage->crop(132, 160, 10,0 );
    $img->insert($photoImage,'bottom-right',192,149); //picture 

    $img->text(strtoupper($info['dl_number']), 530, 303, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
    });
    $img->text(strtoupper($dob),530, 337,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 530, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
    });

   $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 530, 403, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
    }); 


    $img->text($info['last_name'], 470, 452, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 470, 475, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($info['street'], 470, 505, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 470, 530, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
    });

    $img->text(strtoupper($dd), 500, 575, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });




    $img->text($license->gender, 910, 300, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 910, 325, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($license->weight." lb", 910, 350, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text($license->eye_color, 920, 375, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}





public function get_MT_BACK_File($license,$info,$mydata){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $classification = $info['classification']."-Operator";
    $end ="None";
    $rest ="A-Corrective Lenses";
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $dd1 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
    $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(1,9).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
   // create secondBarcode 
   $textUnderBarcode =  $dd1.$dd2;
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.8,50)));
   $img->insert('license/barcodes/additional/'.$time.'.png','top-right',250, 61);  // normal barcode
   
   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.3,1)));
   $img->insert('license/barcodes/'.$time.'.png','top-right',185, 130);  // pdf14 barcode

   $img->text($dd1, 170, 120, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(10);
   });
   $img->text($dd2, 170, 130, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(10);
   });

   $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
   $img->text($changeDate, 390, 340, function($font) use ($l_font){
       $font->file($l_font); 
       $font->angle(90);
       $font->size(25);
   });

    $img->text($dob, 880, 403, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });



    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->greyscale();
    $photoImage->resize(149, 160); //resize for back
    $photoImage->opacity(40); 
    $img->insert($photoImage,'top-left',220, 203); //picture y + up




   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}

















    /**
 *  
 * 
 *   NC
 * 
 * 
 */




public function get_NC_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="1";           
    $dd = $this->getRndInteger(1000000000,9999999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 195, 585, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 195, 588, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });


    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(305, 300); 
    $photoImage->opacity(65); 
    $photoImage->crop(255, 300, 30,0 );
    $img->insert($photoImage,'bottom-left',140, 174); //picture y + up
    $photoImage->resize(149, 170); //resize for back
    $photoImage->opacity(40);
    $photoImage->crop(130, 170, 9,0 );
    $img->insert($photoImage,'bottom-right',248,204); //picture 


    $photoImage->resize(130, 170); //resize for back
    $photoImage->greyscale();
    $photoImage->opacity(35);
    $img->insert($photoImage,'bottom-right',162,100); //picture 




    $img->text(strtoupper($info['dl_number']), 485, 233, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });

    $img->text(strtoupper($dob),850,235,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(32);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 850, 263, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(32);
    });


    $img->text($info['last_name'], 425, 295, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 425, 320, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['street'], 425, 350, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 425, 380, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(23);
    });

    $img->text($classification, 505, 455, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($end, 650, 455, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($rest, 505, 478, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($license->gender, 475, 507, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 475, 530, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(23);
    });
    $img->text($license->eye_color, 635, 507, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($license->hair_color, 635, 530, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 465, 574, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
    });
    $img->text($dd, 465, 598, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text(strtoupper($dob),685,600,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(40);
        $font->color("#525660");
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }



public function get_NC_BACK_File($license,$info,$mydata){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 

    $first_value = "00".$this->getRndInteger(1000000000,9999999999); 
    $sec_value   = $license->state . strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter())  . strtoupper($this->getRndLetter()) .  $this->getRndInteger(10,90);
    $rev = "Rev.".$this->format_date_by_sign($info['revDate'],"/");
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $textUnderBarcode = $first_value.$sec_value; 
    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.7,60)));
   //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,0.9)));



    $img->insert('license/barcodes/additional/'.$time.'.png','top-right',230, 60);  // normal barcode
    $img->insert('license/barcodes/'.$time.'.png','top-right',150, 140);  // pdf14 barcode
    $img->text($first_value, 155, 115, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });
    $img->text($sec_value, 155, 130, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });

    $img->text($dob, 155, 170, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });
    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}



    /**
 *  
 * 
 *   NE
 * 
 * 
 */


public function get_NE_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $treFont = $this->myfont['treFont'];
    $trebFont = $this->myfont['trebFont'];
    $segoeFont = $this->myfont['segoeFont'];  
    $arialnbFont = $this->myfont['arialnbFont'];   

    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd =  "00".$this->getRndInteger(10000000,99999999).$this->getRndInteger(100000,999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 580, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 200, 583, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });


    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(340, 330); 
    $photoImage->opacity(60); 
    $photoImage->crop(272, 330, 40,0 );
    $img->insert($photoImage,'bottom-left',145, 166); //picture y + up
    $photoImage->resize(145, 165); //resize for back
    $photoImage->opacity(27);
    $photoImage->crop(135, 165, 3,0 );
    $img->insert($photoImage,'bottom-right',200,250); //picture 

    $img->text(strtoupper($info['dl_number']), 585, 210, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(30);
    });
    $changeDate = date("m-d-Y", strtotime($license->issued_date));
    $img->text($changeDate, 830, 210, function($font) use ($arialnbFont){
            $font->file($arialnbFont); 
            $font->size(25);
    }); 

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 830, 250, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(25);
    });
        $img->text(strtoupper($dob),535, 250,  function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->color("#b82d2d");
        $font->size(33);
    });

     $img->text($end, 500, 293, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(25);
    });
    $img->text($rest, 515, 330, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(25);
    });
    $img->text($classification, 850, 295, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->gender, 500, 397, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $height = $license->foot.$this->formatInches($license->inches);
    $img->text($height, 660, 397, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $img->text($license->weight, 830, 397, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $img->text($license->eye_color, 520, 433, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $img->text($license->hair_color, 830, 430, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $name = $info['first_name']." ".$info['middle_name']." ".$info['last_name'];
    $img->text($name, 455, 490, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $img->text($info['street'], 455, 520, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(27);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 455, 550, function($font) use ($arialnbFont){
    $font->file($arialnbFont); 
    $font->size(27);
    });











    $img->text(strtoupper($dd), 490, 608, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });




    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

public function get_NE_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $classification = $info['classification']."-Operator";
    $end ="None";
    $rest ="A-Corrective Lenses";
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $dd1 = $this->getRndInteger(100000000,999999999);
    $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
   // create secondBarcode 
   $textUnderBarcode =  $dd1.$dd2;
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.57,70)));
   $img->insert('license/barcodes/additional/'.$time.'.png','top-right',200, 64);  // normal barcode
   
   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.7,1.3)));
   $img->insert('license/barcodes/'.$time.'.png','top-left',140, 170);  // pdf14 barcode

    $img->text($dob, 364, 128, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });


   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}



    /**
 *  
 * 
 *   NH
 * 
 * 
 */




public function get_NH_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $treFont = $this->myfont['treFont'];
    $trebFont = $this->myfont['trebFont'];
    $segoeFont = $this->myfont['segoeFont'];     

    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd =  "00".$this->getRndInteger(100000,999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 560, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 200, 563, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });







    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(300, 310); 
    $photoImage->opacity(60); 
    $photoImage->crop(277, 310, 23,0 );
    $img->insert($photoImage,'bottom-left',133, 195); //picture y + up
    $photoImage->resize(93, 110); //resize for back
    $photoImage->opacity(27);
    #$photoImage->crop(132, 160, 10,0 );
    $img->insert($photoImage,'bottom-right',218,139); //picture 



    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 433, 213, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(37);
    });
    $img->text(strtoupper($info['dl_number']), 670, 216, function($font) use ($trebFont){
        $font->file($trebFont); 
        $font->size(45);
    });
    $img->text($info['last_name'], 433, 265, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 433, 320, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['street'], 433, 372, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 433, 402, function($font) use ($normalFont){
    $font->file($normalFont); 
    $font->size(25);
    });
    $img->text($license->gender, 445, 480, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(25);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 510, 480, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $img->text($license->weight." lb", 590, 480, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });

    $img->text($license->eye_color, 680, 480, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $img->text($license->hair_color, 780, 480, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });


   $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 433, 530, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(25);
    }); 
    $img->text(strtoupper($dob),640, 540,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });

    $img->text($classification, 510, 568, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });
    $img->text($end, 433, 625, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });
    $img->text($rest, 640, 625, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(27);
    });


    $img->text(strtoupper($dd), 1020, 470, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
        $font->angle(-90);
    });








    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

public function get_NH_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $signFont  = $this->myfont['signFont'];
    $dob = date("m/d/Y", strtotime($license->birth_date));


        /// signature
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 850, 585, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1);
        $img->text($sign_name, 850, 588, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
 
 
   $textUnderBarcode =  "1 0 0 0 0 ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ";
   // text under secong barcode
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',0.7,70)));
   $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
   $secimg->rotate(-90);
   $img->insert($secimg,'top-left',160, 90);  // normal barcode



   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.5,0.9)));
   $img->insert('license/barcodes/'.$time.'.png','top-left',325, 117);  // pdf14 barcode


   $photoImage = Image::make('license/photo/'.$license->picture);
   $photoImage->resize(117, 102);
   $photoImage->opacity(45);
   $photoImage->crop(95, 102, 15,0 );
   $img->insert($photoImage,'bottom-left',198,145); //picture 

 
    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
 }








    /**
 *  
 * 
 *   NJ
 * 
 * 
 */


public function get_NJ_FRONT_File($license,$info,$classification){

    
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $wcashFont  = $this->myfont['wcashFont'];
    $HelveticaBold = $this->myfont['HelveticaBold'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 800);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10000, 99999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10, 99);
    $randnum = "0".$this->getRndInteger(10000,99999);
 

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(403, 390); 
    $photoImage->opacity(70); 
    $photoImage->crop(323, 390, 40,0 );
    $img->insert($photoImage,'bottom-left',100, 105); //picture y + up
    $photoImage->resize(163, 180);
    $photoImage->opacity(45);
    $photoImage->crop(158, 180, 2,0 );
    $img->insert($photoImage,'bottom-right',99,100); //picture 






    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 820, 630, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 820, 633, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });





    $img->text(strtoupper($info['dl_number']), 540, 292, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
        $font->color('#af1122');
    });
    $img->text($classification , 1040, 292, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $img->text(strtoupper($dob), 540, 330, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
        $font->color('#af1122');
    });
    $iss = date("m-d-Y", strtotime($license->issued_date));
    $img->text($iss, 540, 365, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(35);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 925, 365, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });

    $img->text($info['last_name'], 430, 400, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 430, 430, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($info['street'], 430, 460, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 430, 490, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(20);
    });
    $img->text($end, 500, 530, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(20);
    });
    $img->text($rest, 530, 560, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(20);
    });

    $img->text($license->gender, 500, 670, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 605, 670, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text($license->eye_color, 780, 670, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text("CM", 435, 695, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });
    $date = substr($iss,-4); 
    $tl = strtoupper($this->getRndLetter().$this->getRndLetter()).$date.$this->getRndInteger(100000, 999999).$this->getRndInteger(10000, 99999);
    $img->text($tl, 610, 695, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });

    $img->text("REN", 870, 695, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
    });

    $img->text("24", 960, 695, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(18);
        $font->color('#5c594e');
    });

    
    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}






public function get_NJ_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $textUnderBarcode1 =  $this->getRndInteger(10000000,99999999);
    $textUnderBarcode2 =  $this->getRndInteger(10000000,99999999);

    //create barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.9,1.7)));
    $img->insert('license/barcodes/'.$time.'.png','top-right',85, 95);  // pdf14 barcode


    $img->text($textUnderBarcode1, 110, 150, function($font) use ($BigFont){
    $font->file($BigFont); 
    $font->angle(90);
    $font->size(12);
     });
    $img->text($textUnderBarcode2, 120, 150, function($font) use ($BigFont){
    $font->file($BigFont); 
    $font->angle(90);
    $font->size(12);
    });

    $img->text("DF".$dob, 380, 330, function($font) use ($BigFont){
    $font->file($BigFont); 
    $font->size(15);
    $font->angle(90);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
 }
 





    /**
 *  
 * 
 *   NM
 * 
 * 
 */



public function get_NM_FRONT_File($license,$info,$classification){

    
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $wcashFont  = $this->myfont['wcashFont'];
    $HelveticaBold = $this->myfont['HelveticaBold'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 800);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10000, 99999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10, 99);
    $randnum = "0".$this->getRndInteger(10000,99999);
 

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 295); 
    $photoImage->opacity(70); 
    $photoImage->crop(255, 295, 20,0 );
    $img->insert($photoImage,'bottom-left',125, 192); //picture y + up
    $photoImage->resize(145, 155);
    $photoImage->opacity(45);
    $photoImage->crop(125, 155, 10,0 );
    $img->insert($photoImage,'bottom-right',210,130); //picture 






    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 170, 590, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 170, 593, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });




    $img->text(strtoupper($info['dl_number']), 510, 237, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $img->text(strtoupper($dob), 540, 272, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
        $font->color('#d3262d');
    });
    // $img->text($classification , 1040, 292, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(35);
    // });

    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 845, 300, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(33);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 848, 339, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });

    $img->text($info['last_name'], 390, 310, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $name = $info['first_name'];
    $img->text($name, 390, 345, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $img->text($info['street'], 390, 405, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 390, 435, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
    });


    $img->text($license->gender, 500, 510, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 785, 510, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($license->weight, 540, 545, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($license->eye_color, 755, 545, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($classification, 530, 580, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
    });
    $img->text($end, 890, 580, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
    });
    $img->text($rest, 870, 610, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}



 public function get_NM_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $l_font = $this->myfont['boldFont'];
    $BigFont = $this->myfont['BigFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    $textUnderBarcode = $this->getRndInteger(1000000000, 99999999999).$this->getRndInteger(1000000000, 99999999999);
    $none = "NONE";

   
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',1.2,42)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $img->insert($secimg,'top-right',270, 62);  // sec barcode 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1)));
    $img->insert('license/barcodes/'.$time.'.png','top-right',200,450);  // pdf14 barcode

    $img->text($dob, 885, 350, function($font) use ($BigFont){
        $font->file($BigFont); 
        $font->angle(90);
        $font->size(13);
    });



    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}







    /**
 *  
 * 
 *   NV
 * 
 * 
 */




public function get_NV_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $arialnbFont = $this->myfont['arialnbFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd = "0000".$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(1000000,9999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 135, 590, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 135, 593, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(302, 310); 
    $photoImage->opacity(50); 
    $photoImage->crop(260, 310, 25,0 );
    $img->insert($photoImage,'bottom-left',75, 185); //picture y + up
    $photoImage->resize(149, 170); //resize for back
    $photoImage->opacity(35);
    $photoImage->crop(130, 160, 12,0 );
    $img->insert($photoImage,'bottom-right',90,270); //picture 


    $img->text($info['last_name'], 365, 300, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(30);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 365, 332, function($font) use ($arialnbFont){
        $font->file($arialnbFont); 
        $font->size(30);
    });
        $img->text($info['street'], 365, 362, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 365, 387, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(23);
    });


    $img->text($license->gender, 420, 446, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 540, 446, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
$img->text($license->weight, 690, 446, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(22);
});

$img->text($license->eye_color, 840, 446, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(22);
});
    $img->text($classification, 435, 477, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text($rest, 423, 505, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($end, 600, 477, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($license->hair_color, 760, 477, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
       $changeDate = date("m/d/Y", strtotime($license->issued_date));
        $img->text($changeDate, 905, 477, function($font) use ($l_font){
                $font->file($l_font); 
                $font->size(18);
        }); 


    $img->text(strtoupper($info['dl_number']), 580, 552, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(43);
    });
    $img->text(strtoupper($dob),580, 592,  function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(43);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 580, 633, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(43);
    });

    $img->text(strtoupper($dd), 710, 503, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}







public function get_NV_BACK_File($license,$info,$mydata){



    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
   //create barcode and save 



   $textUnderBarcode = "1521".$this->getRndInteger(10000000000,99999999999); // text under secong barcode
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',1.3,70)));
   $img->insert('license/barcodes/additional/'.$time.'.png','top-right',150, 49);  // normal barcode


   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.5)));
   $img->insert('license/barcodes/'.$time.'.png','top-left',270, 150);  // pdf14 barcode
   $img->text($dob, 145, 92, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(20);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 145, 115, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
    });
   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;

}









    /**
 *  
 * 
 *   OH
 * 
 * 
 */

public function get_OH_FRONT_File($license,$info,$classification,$dd){
    $time = $info['codename']."xxx".$license->state.time();
    $ohFont = "fonts/OCR-B10BT.ttf";
    $emFont = "fonts/Iloveyou.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="None";             
    $rest ="None";        

    
    $tbg = Image::make('license/templates/OH/tbg.png');
    $tbg->opacity(5);
    $tbg->text($dob, 10, 70, function($font) use ($ohFont){
        $font->file($ohFont); 
        $font->size(90);
    });
    $tbg->save('license/destination/'.$time.'.png');

    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 177, 612, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(65);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 177, 615, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(65);
    });
    // // photos first


    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(300, 310); 
    $photoImage->opacity(60); 
    $photoImage->crop(250, 290, 25,0 );
    $photoImage->greyscale();
    $img->insert($photoImage,'bottom-left',120, 220); //picture y + up
    $photoImage->resize(70, 95);
    $photoImage->opacity(35);
    $photoImage->crop(70, 90, 0,0 );
    $photoImage->greyscale();
    $img->insert($photoImage,'bottom-right',140, 156); //picture 

    $img->text(strtoupper($dob), 180, 665, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    $img->text($info['dl_number'], 450, 230, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text($info['last_name'], 430, 269, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(24);
    });
    $name = $info['first_name'];
    $img->text($name, 430, 292, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(24);
    });
    $img->text($info['street'], 430, 336, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 430, 361, function($font) use ($normalFont){
    $font->file($normalFont); 
    $font->size(22);
    });
    $img->text($classification, 410, 415, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 475, 415, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $img->text("M", 626, 415, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $img->text($end, 740, 415, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $img->text($license->gender, 410, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 475, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
        $img->text($license->eye_color, 553, 550, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
    $changeDate = date("m-d-Y", strtotime($license->issued_date));
    $img->text($changeDate, 475, 585, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(22);
    });
    $img->text($dd, 474, 620, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(22);
    });
// secind side
    $img->text($info['dl_number'], 730, 555, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 735, 582, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(40);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 735, 585, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(40);
    });
    $img->text($dob, 730, 610, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(24);
    });
    $img->text($dob, 115, 585, function($font) use ($emFont){
        $font->file($emFont); 
        $font->size(60);
        $font->angle(90);
        $font->color(array(51, 51, 51, 0.3));  //http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/colors/colors_picker.asp-colorhex=FFFFFF.html
    });




    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;


}



public function get_OH_BACK_File($license,$info,$mydata,$dd){



    $time = $info['codename']."xxx".$license->state.time();
    $ohFont = "fonts/OCR-B10BT.ttf";
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $tohoma = 'fonts/Tahoma.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 800);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $classification = $info['classification']." - License to operate motor vehicle";
    $end = "M - Motorcycle";
    $rest = "B - Corrective Lenses";
   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3.5,1)));

   
    $img->insert('license/barcodes/'.$time.'.png','bottom-left',90, 120);  // pdf14 barcode
    $img->text($dd, 770, 320, function($font) use ($ohFont){
        $font->file($ohFont); 
        $font->size(45);
    });
    $img->text($classification, 105, 323, function($font) use ($tohoma){
        $font->file($tohoma); 
        $font->size(13);
    });
    $img->text($end, 105, 415, function($font) use ($tohoma){
        $font->file($tohoma); 
        $font->size(13);
    });
    $img->text($rest, 415, 440, function($font) use ($tohoma){
        $font->file($tohoma); 
        $font->size(13);
    });
    $photoImage = Image::make('license/photo/'.$license->picture); 
    $photoImage->resize(117, 102); //resize for back
    $photoImage->opacity(50);
    $img->insert($photoImage,'bottom-right',80, 120); //picture @back 

   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}








    /**
 *  
 * 
 *   OK
 * 
 * 
 */


public function get_OK_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m-d-Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $dd = strtoupper($this->getRndLetter()).$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10000000000, 99999999999).strtoupper($this->getRndLetter());
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
 
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 220, 605, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        // $font->color('#3d3d3d');
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 220, 610, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
        // $font->color('#3d3d3d');
    });


    $photoImage = Image::make('license/photo/'.$license->picture);

    $photoImage->resize(340, 330); 
    $photoImage->opacity(60); 
     $photoImage->crop(250, 330, 50,0 );
    $img->insert($photoImage,'bottom-left',165, 148); //picture y + up

    $photoImage->resize(120, 150);
    $photoImage->opacity(40);
    #$photoImage->crop(120, 145, 0,0 );
    //$photoImage->greyscale();
    $img->insert($photoImage,'bottom-right',162, 116); //picture 


    $img->text(strtoupper($info['dl_number']), 530, 234, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(35);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"-");
    $img->text($changeDate, 840, 234, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(35);
    });
    $img->text(strtoupper($dob), 500, 270, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(35);
    });

    $img->text($info['last_name'], 460, 310, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $img->text($info['first_name']." ".$info['middle_name'], 460, 340, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });

    $img->text($info['street'].",", 460, 368, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 460, 398, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $img->text($classification, 510, 437, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $img->text($end, 510, 462, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $img->text($rest, 510, 492, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 725, 462, function($font) use ( $l_font){
            $font->file( $l_font); 
            $font->size(22);
    });







$img->text($license->gender, 560, 550, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $img->text($license->eye_color, 560, 578, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $img->text($license->weight." lb",720, 550, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });
    $height = $license->foot."-".$this->formatInches($license->inches);
    $img->text($height, 720, 578, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(29);
    });


$img->text($dd, 540, 610, function($font) use ( $l_font){
    $font->file( $l_font); 
    $font->size(20);
});





    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}






public function get_OK_BACK_File($license,$info,$mydata){


    $time = $info['codename']."xxx".$license->state.time();
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

 
    //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4.2,1.8)));
    $img->insert('license/barcodes/'.$time.'.png','top-left',80, 70);  // pdf14 barcode


    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',3.8,)));
    $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
    $secimg->rotate(90);
    $img->insert($secimg,'top-right',90, 120);  // sec barcode 



    // $img->text($dob, 146, 537, function($font) use ($BigFont){
    //     $font->file($BigFont); 
    //     $font->size(16);
    // });
 


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}














    /**
 *  
 * 
 *   OR
 * 
 * 
 */




public function get_OR_FRONT_File($license,$info,$mydata){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $wcashFont  = $this->myfont['wcashFont'];
    $HelveticaBold = $this->myfont['HelveticaBold'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 800);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];    
    $textUnderBarcode =  strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter()) ."0000".$this->getRndInteger(1,9).$this->getRndInteger(1,9).$this->getRndInteger(1,9); // text under secong barcode
  
    


    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 550, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(65);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 200, 553, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(65);
    });
    // // photos first


    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(300, 310); 
    $photoImage->opacity(60); 
    $photoImage->crop(250, 290, 30,0 );
    //$photoImage->greyscale();
    $img->insert($photoImage,'bottom-left',150, 180); //picture y + up
    $photoImage->resize(90, 110); 
    $photoImage->opacity(35);
    //$photoImage->crop(70, 95, 0,0 );
    $photoImage->greyscale();
    $img->insert($photoImage,'bottom-right',145, 100); //picture 



    $img->text($info['dl_number'], 490, 207, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $name = $info['first_name'];
    $img->text($name, 465, 245, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 465, 275, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($info['street'], 465, 307, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 465, 380, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(24);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 510, 412, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 510, 443, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
    });
    $img->text($textUnderBarcode, 510, 510, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($classification, 510, 543, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text("M", 510, 573, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

        $img->text("NONE", 510, 610, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

        $img->text(strtoupper($dob), 220, 610, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });

    $img->text($license->gender, 840, 412, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 840, 443, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->weight."lb", 840, 475, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $img->text($license->eye_color, 840, 510, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    // $img->text($license->hair_color, 825, 645, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(22);
    // });

 

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;


    }


public function get_OR_BACK_File($license,$info,$mydata){

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = 'fonts/ARIAL.TTF';
    $l_font = 'fonts/arialbd.ttf';
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m/d/Y", strtotime($license->birth_date));

   // create secondBarcode 
   $textUnderBarcode =  strtoupper($this->getRndLetter()) ." ". strtoupper($this->getRndLetter()) ." 0 0 0 0 ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9)." ".$this->getRndInteger(1,9); // text under secong barcode
   // text under secong barcode
   file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',2,40)));
   $img->insert('license/barcodes/additional/'.$time.'.png','top-left',165, 80);  // normal barcode


   //create barcode and save 
   file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4.19,1)));
   $img->insert('license/barcodes/'.$time.'.png','top-right',137, 130);  // pdf14 barcode

   $img->text($textUnderBarcode, 850, 280, function($font) use ($normalFont){
   $font->file($normalFont); 
   $font->size(22);
    });
    $img->text($dob, 500, 600, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
   $img->save('license/destination/'.$time.'.png');  
   $background->insert('license/destination/'.$time.'.png','center');
   $background->save('license/final/'.$time.'.png');  
   $file= public_path(). '/license/final/'.$time.'.png';
   return $file;
}









    /**
 *  
 * 
 *   PA
 * 
 * 
 */
public function get_PA_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="None";
    $rest ="None";
    $dd1 =$this->getRndInteger(100000000000, 999999999999);
    $dd2 =$this->getRndInteger(10000000000, 99999999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 151, 605, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1) ;
    $img->text($sign_name, 151, 610, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    // photos first

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 300); 
    $photoImage->opacity(60); 
   // $photoImage->crop(280, 340, 58,0 );
    $img->insert($photoImage,'bottom-left',100, 168); //picture y + up
    $photoImage->resize(145, 150);
    $photoImage->opacity(45);
    $photoImage->crop(140, 150, 0,0 );
    $img->insert($photoImage,'bottom-right',97, 90); //picture 


    $img->text($double, 110, 250, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(15);
        $font->angle(90);
    });

    $img->text(strtoupper($info['dl_number']), 475, 227, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text(strtoupper($dob), 475, 264, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 475, 302, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text($info['last_name'], 405, 340, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($info['first_name'], 405, 362, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($info['street'], 405, 390, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 405, 410, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($license->gender, 470, 463, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $height = $license->foot."'-".$license->inches.'"';
    $img->text($height, 470, 490, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($license->eye_color, 600, 463, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($classification, 500, 515, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($end, 470, 540, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($rest, 500, 563, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 805, 302, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(33);
    });
    $img->text($dup, 835, 228, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(33);
    });
    $img->text($dd1, 550, 610, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });
    $img->text($dd2, 550, 627, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}

public function get_PA_BACK_File($license,$info,$mydata){


    

    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $l_font = $this->myfont['boldFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_BACK";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage); 
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    $double = "21";
    $textUnderBarcode ="02".$this->getRndInteger(4,7)."000".$this->getRndInteger(1000000000, 9999999999);
    $rand_bottom = $this->getRndInteger(10000000, 99999999);
    $classification = "CLASS: ".$info['classification']."-Single/Comb < 26,001";
    $end ="END: None";
    $rest ="RESTR: None";

    // create Barcode for maryland
    file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',3,60)));
   //create pdf14 barcode and save 
    file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4,1.3)));

    $img->insert('license/barcodes/additional/'.$time.'.png','top-right',170, 50);  // normal barcode
    $img->insert('license/barcodes/'.$time.'.png','top',55, 150);  // pdf14 barcode

    $img->text($textUnderBarcode, 360, 110, function($font) use ($normalFont){
        $font->file($normalFont); 
        $font->size(13);
    });
    $img->text($double, 330, 110, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(14);
    });
    $img->text($dob, 100, 117, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });
    $img->text($rev, 100, 135, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
    });
    $img->text($classification, 240, 465, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(19);
    });
    $img->text($end, 240, 485, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(19);
    });
    $img->text($rest, 240, 505, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(19);
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}













    /**
 *  
 * 
 *   RI
 * 
 * 
 */

    public function get_RI_FRONT_File($license,$info,$classification){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $signFont  = $this->myfont['signFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
        $dup = $this->weight($this->getRndInteger(0, 1));
        $classification = $info['classification'];
        $end ="None";             
        $rest ="None";           
        $dd =$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(1000000000,9999999999);
        /// signature
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 153, 652, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1);
        $img->text($sign_name, 153, 655, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        // photos first

        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(320, 320); 
        $photoImage->opacity(70); 
        $photoImage->crop(310, 320, 0,0 );
        $img->insert($photoImage,'bottom-left',85, 190); //picture y + up
        $photoImage->resize(163, 180);
        $photoImage->opacity(45);
        $photoImage->crop(148, 180, 10,0 );
        $img->insert($photoImage,'bottom-right',105, 138); //picture 

        $img->text(strtoupper($dob), 477, 293, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
        });
        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate, 477, 322, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
        });
        $img->text($info['last_name'], 420, 378, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
        });
        $name = $info['first_name']." ".substr($info['middle_name'],0,1);
        $img->text($name, 420, 409, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
        });
        $img->text($info['street'], 418, 440, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 418, 468, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
        });
        $img->text($classification, 500, 525, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($end, 480, 553, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($rest, 500, 580, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->gender, 475, 615, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $height = $license->foot."'-".$license->inches.'"';
        $img->text($height, 475, 645, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->weight."lb", 645, 645, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->eye_color, 825, 613, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($license->hair_color, 825, 645, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($dd,460, 676, function($font) use ($l_font){
                $font->file($l_font); 
                $font->size(21);
        });

        $img->text(strtoupper($info['dl_number']), 780, 290, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });

        $changeDate = date("m/d/Y", strtotime($license->issued_date));
        $img->text($changeDate, 780, 320, function($font) use ($l_font){
                $font->file($l_font); 
                $font->size(29);
        });
         // with red on the sec pic
        $img->text($dob, 870, 510, function($font) use ($secnormalFont){
            $font->file($secnormalFont); 
            $font->size(19);
            $font->color('#8a0202');
        });
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
    }


    public function get_RI_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1)));
       // create secondBarcode for maryland
       $textUnderBarcode = $this->getRndInteger(1000000,9999999); // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',4.1,47)));
        //03420752  CODE39
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',200, 84);  // normal barcode
       $img->insert('license/barcodes/'.$time.'.png','top-right',95, 150);  // pdf14 barcode
       $img->text($dob, 115, 197, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
        });
       $img->text($rev, 115, 177, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }



  /**
   * 
   *    TN
   * 
   * */

  public function get_TN_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="01";           
    $dd =$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(100000,999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 220, 590, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 220, 595, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    // photos first
    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(320, 320); 
    $photoImage->opacity(70); 
    $photoImage->crop(278, 320, 22,0);
    $img->insert($photoImage,'bottom-left',163, 153);  //picture y + up
    $photoImage->resize(160, 170);
    $photoImage->opacity(50);
    $photoImage->crop(140, 170, 10,0 );
    $img->insert($photoImage,'bottom-right',160, 217); //picture 

    $img->text(strtoupper($info['dl_number']), 550, 305, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
    });
    $img->text($dob, 820, 305, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
        $font->color('#8a0202');
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 550, 335, function($font) use ($l_font){
        $font->file($l_font); 
        $font->color('#8a0202');
        $font->size(24);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 800, 335, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
    });
    $img->text($end, 720, 370, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($classification, 550, 370, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($rest, 550, 400, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
    });
    $img->text($license->gender, 525, 443, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 606, 443, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text($license->eye_color, 740, 443, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($dd, 515, 473, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($info['last_name'], 480, 510, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(26);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 480, 535, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $img->text($info['street'],480, 560, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 480, 600, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(20);
    });




    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }











    public function get_TN_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");

       $textUnderBarcode = "05".$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(10,99); // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C39E',1.5,55)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',205, 64);  // normal barcode

       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.4,0.9)));
       $img->insert('license/barcodes/'.$time.'.png','top-right',200, 140);  // pdf14 barcode

       $img->text($dob, 163, 170, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(18);
        });
       $img->text($textUnderBarcode, 430, 120, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(13);
        });
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }









  /**
   * 
   *    TXX
   * 
   * */




  public function get_TX_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="01";           
    $dd =$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(1000000000,9999999999);
    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 170, 540, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 170, 545, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

        // photos first
        $photoImage = Image::make('license/photo/'.$license->picture);
        $photoImage->resize(270, 285);
        $photoImage->greyscale(); 
        $photoImage->opacity(85); 
        $photoImage->crop(246, 285, 20,0);
        $img->insert($photoImage,'bottom-left',108, 170);  //picture y + up
        $photoImage->resize(80, 90);
        $photoImage->opacity(35);
        #$photoImage->crop(140, 170, 10,0 );
        $img->insert($photoImage,'bottom-right',185, 127); //picture 

    $img->text(strtoupper($info['dl_number']), 430, 240, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(29);
    });
    $img->text($dob, 430, 290, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 725, 265, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 725, 290, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(23);
    });
    $img->text($info['last_name'], 380, 330, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(34);
    });
    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 380, 370, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(32);
    });
    $img->text($info['street'],380, 400, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(21);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 380, 428, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(21);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 440, 493, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text($license->gender, 605, 493, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });

    $img->text($license->eye_color, 735, 493, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });


    $img->text($dd, 420, 522, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });


    $img->text($dob, 830, 507, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
        $font->color('#8e989b');
    });


    // $img->text($classification, 550, 370, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(24);
    // });
    // $img->text($rest, 550, 400, function($font) use ($l_font){
    //     $font->file($l_font); 
    //     $font->size(24);
    // });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }






    public function get_TX_BACK_File($license,$info,$mydata){

        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $dinFont = $this->myfont['dinFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m/d/Y", strtotime($license->birth_date));
     

       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.4,1.1)));
       $img->insert('license/barcodes/'.$time.'.png','bottom-right',310, 117);  // pdf14 barcode

     
       $textUnderBarcode =  "10000".$this->getRndInteger(1,9).$this->getRndInteger(1,9).$this->getRndInteger(1,9).$this->getRndInteger(1,9).$this->getRndInteger(1,9).$this->getRndInteger(1,9);
       // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',1.5,57)));
        $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
        $secimg->rotate(-90);
        $img->insert($secimg,'top-left',160, 260);  // normal barcode
    
        $img->text($textUnderBarcode, 125, 270, function($font) use ($dinFont){
            $font->file($dinFont); 
            $font->angle(-90);
            $font->size(25);
        });
    
        // $changeDate = date("m/d/Y", strtotime("2019-02-22"));
        // $img->text($changeDate, 810, 105, function($font) use ($l_font){
        //     $font->file($l_font); 
        //     $font->size(23);
        // });

        $img->text($dob,  275, 510, function($font) use ($l_font){
         $font->file($l_font); 
         $font->size(20);
         $font->angle(90);
         });
     
    
     
     
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
     }
    
    


  /**
   * 
   *    UT
   * 
   * */








  public function get_UT_FRONT_File($license,$info,$classification){

    
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $futuramFont = $this->myfont['futuramFont'];
    $optimistFont = $this->myfont['optimistFont'];
    $signFont  = $this->myfont['signFont'];
    $wcashFont  = $this->myfont['wcashFont'];
    $HelveticaBold = $this->myfont['HelveticaBold'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 800);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="MZ";
    $best ="A";
    $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10000000000, 99999999999);
    $randnum = "0".$this->getRndInteger(10000,99999);
 

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(280, 280); 
    $photoImage->opacity(70); 
    $photoImage->crop(273, 280, 7,0 );
    $img->insert($photoImage,'bottom-left',145, 148); //picture y + up
    $photoImage->resize(120, 130);
    $photoImage->opacity(45);
    $photoImage->crop(110, 130, 10,0 );
    $img->insert($photoImage,'bottom-right',171,93); //picture 






    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 600, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 200, 603, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });




    $img->text(strtoupper($info['dl_number']), 470, 252, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $img->text(strtoupper($dob), 530, 286, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
        $font->color('#a03f3d');
    });

    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 845, 252, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(33);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 848, 286, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });

    $img->text($info['last_name'], 450, 325, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $name = $info['first_name'];
    $img->text($name, 450, 355, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $img->text($info['street'], 450, 406, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(23);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 450, 433, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(23);
    });
    $img->text($dd, 500, 454, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(17);
    });
    $img->text($classification, 530, 487, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
    });
    $img->text($end, 680, 487, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
    });
    $img->text($best, 680, 514, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($license->gender, 520, 520, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 520, 553, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($license->weight." lb", 520, 578, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->eye_color, 520, 603, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->hair_color, 520, 630, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(27);
    });

    $edbdy = $this->birthday_edit_with_sign_IA($dob,"/");
    $img->text($edbdy['formattedBirthday'], 690, 604, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(40);
    });


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';
    return $file;
}






     public function get_UT_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $BigFont = $this->myfont['BigFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $classification = $info['classification']."-Operator";
        $end ="None";
        $rest ="A-Corrective Lenses";
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $dd1 = $this->getRndInteger(100000000,999999999);
        $dd2 = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(10,99);
       // create secondBarcode 
       $textUnderBarcode =  $dd1.$dd2;
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',2.9,50)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',250, 64);  // normal barcode
       
       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.6,1.2)));
       $img->insert('license/barcodes/'.$time.'.png','top-right',190, 130);  // pdf14 barcode
    
    
    
        $img->text($dob, 140, 195, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(18);
        });
        $img->text($dd1, 200, 125, function($font) use ($BigFont){
            $font->file($BigFont); 
            $font->size(13);
        });
        $img->text($dd2, 200, 138, function($font) use ($BigFont){
            $font->file($BigFont); 
            $font->size(13);
        });
    
       $img->save('license/destination/'.$time.'.png');  
       $background->insert('license/destination/'.$time.'.png','center');
       $background->save('license/final/'.$time.'.png');  
       $file= public_path(). '/license/final/'.$time.'.png';
       return $file;
    }
    
    
    
    





  /**
   * 
   *    VT
   * 
   * */


    public function get_VT_FRONT_File($license,$info,$classification){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $signFont  = $this->myfont['signFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_FRONT";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage);
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
        $dup = $this->weight($this->getRndInteger(0, 1));
        $classification = $info['classification'];
        $end ="None";             
        $rest ="None";           
        $dd =$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(10000000,99999999);


        $img->text(strtoupper($info['dl_number']), 570, 335, function($font) use ($BigFont){
            $font->file($BigFont); 
            $font->size(29);
        });
        $img->text($dob, 830, 335, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(29);
        });
        $img->text($info['last_name'], 440, 374, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
        });
        $name = $info['first_name']." ".substr($info['middle_name'],0,1);
        $img->text($name, 440, 400, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
        });

        $img->text($info['street'], 440, 445, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
        });
        $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
        $img->text($city_and_zip, 440, 475, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(24);
        });
        $img->text($license->gender, 537, 580, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $height = $license->foot."'-".$this->formatInches($license->inches).'"';
        $img->text($height, 496, 615, function($font) use ( $l_font){
            $font->file( $l_font); 
            $font->size(22);
        });
        $img->text($license->eye_color, 510,645, function($font) use ( $l_font){
            $font->file( $l_font); 
            $font->size(22);
        });
        $img->text($license->weight."lb", 500, 680, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $img->text($dd, 475, 715, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(22);
        });
        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate, 710, 590, function($font) use ($l_font){
            $font->file($l_font); 
            $font->color('#1e2e23');
            $font->size(30);
        });
        $changeDate = date("m/d/Y", strtotime($license->issued_date));
        $img->text($changeDate, 710, 630, function($font) use ($l_font){
                $font->file($l_font); 
                $font->color('#1e2e23');
                $font->size(30);
        });
        /// signature
        $sign_name = substr(strtolower($license->first_name),0,5);
        $img->text($sign_name, 200, 652, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($license->last_name),0,1);
        $img->text($sign_name, 200, 655, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        // photos first

        $photoImage = Image::make('license/photo/'.$license->picture);
        //$photoImage->resize(488, 440); 
        $photoImage->resize(320, 320); 
        $photoImage->opacity(90); 
        $photoImage->crop(260, 320, 37,0 );
        $photoImage->greyscale();
        $img->insert($photoImage,'bottom-left',150, 210); //picture y + up

        $photoImage->resize(120, 140);
        $photoImage->opacity(60);
        //$photoImage->crop(148, 180, 10,0 );
        $photoImage->greyscale();
        $img->insert($photoImage,'bottom-right',105, 145); //picture 

        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';

        return $file;
        }


    public function get_VT_BACK_File($license,$info,$mydata){

        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m-d-Y", strtotime($license->birth_date));
        $textUnderBarcode =  $this->getRndInteger(10000000,99999999).$this->getRndInteger(1000000000,9999999999);
    
        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',3,47)));
        $img->insert('license/barcodes/additional/'.$time.'.png','top-right',180, 84);  // normal barcode


        //create barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2.9,1)));
        $img->insert('license/barcodes/'.$time.'.png','top-right',200, 150);  // pdf14 barcode
    
        $img->text($dob, 180, 620, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
        });
        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate, 900, 620, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
    
        $img->text($textUnderBarcode, 400, 120, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(16);
         });
    
        $img->text($dob, 180, 620, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(20);
        });
        $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
        $img->text($changeDate, 900, 620, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
    
    
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
     }
     








  /**
   * 
   *    SC
   * 
   * */


  public function get_SC_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd = "01000".$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(1000,9999);



    $img->text(strtoupper($info['dl_number']), 535, 250, function($font) use ($l_font){
        $font->file($l_font);
        $font->color('#760209'); 
        $font->size(27);
    });
    $img->text($info['last_name'], 440, 283, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $name = $info['first_name']." ".substr($info['middle_name'],0,1);
    $img->text($name, 440, 310, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['street'], 440, 340, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 440, 370, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(30);
    });

    $img->text($dob, 530, 405, function($font) use ($l_font){
        $font->file($l_font); 
        $font->color('#760209'); 
        $font->size(24);
    });
    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 555, 435, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(24);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 570, 465, function($font) use ($l_font){
        $font->file($l_font); 
        $font->color('#760209');
        $font->size(24);
    });
    $img->text($license->gender, 509, 500, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 625, 500, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($license->weight."lb", 509, 532, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($license->eye_color, 705,530, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($classification, 534,564, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($end, 690,564, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($rest, 625,600, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($dd, 180,626, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(18);
    });
    $img->text($dob, 130, 310, function($font) use ($l_font){
        $font->file($l_font); 
        $font->color('#760209'); 
        $font->angle(-90);
        $font->size(23);
    });
    $photoImage = Image::make('license/photo/'.$license->picture);
    //$photoImage->resize(488, 440); 
    $photoImage->resize(260, 270); 
    $photoImage->opacity(90); 
    $photoImage->crop(250, 270, 10,0 );
    $img->insert($photoImage,'bottom-left',155, 230); //picture y + up

    $photoImage->resize(145, 155);
    $photoImage->opacity(60);
    //$photoImage->crop(148, 180, 10,0 );
    $img->insert($photoImage,'bottom-right',200, 175); //picture 

    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 500, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 200, 500, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }





    public function get_SC_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $micFont = $this->font['micFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m-d-Y", strtotime($license->birth_date));
        $textUnderBarcode =  $this->getRndInteger(100000,999999).$this->getRndInteger(1000000000,9999999999);


        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3.9,1.7)));
        $img->insert('license/barcodes/'.$time.'.png','top-right',160, 130);  // pdf14 barcode

        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',3,75)));
        $img->insert('license/barcodes/additional/'.$time.'.png','bottom-right',270, 63);  // normal barcode

        $img->text("None", 140, 470, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });
        $img->text("None", 670, 470, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(20);
        });


        $img->text($textUnderBarcode, 210, 623, function($font) use ($micFont){
            $font->file($micFont); 
            $font->size(30);
        });
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
       
    }





  /**
   * 
   *    SD
   * 
   * */


  public function get_SD_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $akFont = "fonts/arialbd.ttf";
    $sign_medium = 'fonts/sign_medium.ttf';
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";
    $rest ="NONE";
    $type ="O";
    $six =$this->getRndInteger(100000, 999999);
    $dd =$this->getRndInteger(1000000000, 9999999999).$this->getRndInteger(10000000000, 99999999999);
    $double = strtoupper($this->getRndLetter().$this->getRndLetter().$this->getRndInteger(10,99));
    $rev = "Rev ".$this->format_date_by_sign($info['revDate'],"/");
    /// signature
    // $sign_name = substr(strtolower($license->first_name),0,5);
    // $img->text($sign_name, 130, 565, function($font) use ($signFont  ){
    //     $font->file($signFont  ); 
    //     $font->size(60);
    // });
    // $sign_name = substr(strtoupper($license->last_name),0,1) ;
    // $img->text($sign_name, 130, 570, function($font) use ($signFont ){
    //     $font->file($signFont ); 
    //     $font->size(60);
    // });


    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(370, 350); 
    $photoImage->opacity(90); 
    $photoImage->crop(285, 350, 50,0 );
    $img->insert($photoImage,'bottom-left',70, 145); //picture y + up
    // // $photoImage->resize(80, 115);
    // // $photoImage->crop(80, 115, 0,0 );


    $photoImage->resize(148, 170); //resize for back
    $photoImage->crop(140, 170, 0,0 );
    $photoImage->opacity(60);
    $img->insert($photoImage,'bottom-right',92, 90); //picture @back 


    $img->text(strtoupper($info['dl_number']), 495, 240, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(45);
        $font->color('#bf0000');
    });


    $img->text(strtoupper($dob),  498, 278, function($font) use ($l_font){
        $font->file($l_font); 
        $font->color('#bf0000');
        $font->size(35);
    });

    $changeDate = date("m/d/Y", strtotime($license->issued_date));
    $img->text($changeDate, 810, 240, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(35);
    });

    
//     $img->text($six, 905, 230, function($font) use ($l_font){
//             $font->file($l_font); 
//             $font->size(18);
//     });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 810, 278, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $name =$info['last_name'];
    $img->text($name, 400, 320, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $name =$info['first_name'];
    $img->text($name, 400, 355, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $img->text($info['street'], 400, 425, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 400, 455, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($end, 735, 497, function($font) use ($l_font){
        $font->file($l_font);
        $font->size(33);
    });
    $img->text($rest, 580, 535, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });


    $img->text($license->gender, 975, 500, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 460, 579, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });
  $img->text($license->weight." lb", 690, 579, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
       // $font->color('#3d3d3d');
    });

    $img->text($license->eye_color, 938, 579, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(33);
    });




    $img->text($dd, 450, 622, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
//     $img->text($rev, 830, 595, function($font) use ($akFont){
//         $font->file($akFont); 
//         $font->size(16);
//     });







    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
}



    public function get_SD_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $secnormalFont = $this->myfont['secnormalFont'];
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $img = Image::make($bgImage); 
        $exp = date("m/d/Y", strtotime($license->birth_date));
        $textUnderBarcode = $this->getRndInteger(00000000000, 99999999999).$this->getRndInteger(0000, 9999);
        $textinsideBarcode = "24000".$this->getRndInteger(00000000000, 99999999999);
        //create pdf14 barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4.01,2.5)));  
        $img->insert('license/barcodes/'.$time.'.png','top-right',97, 95);  // pdf14 barcode
    
        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textinsideBarcode, 'C128',2.5,75 )));
        $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
        $secimg->rotate(-90);
        $img->insert($secimg,'bottom-left',75, 120);  // normal barcode
    
        $img->text($textUnderBarcode, 137, 105, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
            $font->angle(-90);
        });
    
        $img->text($dob, 895, 535, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(17);
        });
    
        // $img->text("NONE", 393, 375, function($font) use ($l_font){
        //     $font->file($l_font); 
        //     $font->size(25);
        // });
        // $img->text("NONE", 770, 375, function($font) use ($l_font){
        //     $font->file($l_font); 
        //     $font->size(25);
        // });
    
    
    
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
    }
    
    
    
    











  /**
   * 
   *    WA
   * 
   * */




  public function get_WA_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";           
    $dd = $info['dl_number'].$this->getRndInteger(1000000,9999999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(1000,9999);
    $first = $this->getRndInteger(10,99);
    $sec = $this->getRndInteger(1000000,9999999).strtoupper($this->getRndLetter().$this->getRndLetter()).$this->getRndInteger(1000,9999);
   
    $photoImage = Image::make('license/photo/'.$license->picture);
    //$photoImage->resize(488, 440); 
    $photoImage->resize(340, 330); 
    $photoImage->opacity(70); 
    $photoImage->crop(270, 330, 40,0 );
    $img->insert($photoImage,'bottom-left',148, 153 ); //picture y + up

    $photoImage->resize(135, 170); 
    $photoImage->opacity(60);
    //$photoImage->crop(148, 180, 10,0 );
    $img->insert($photoImage,'bottom-right',170, 160); //picture 


    $img->text($first, 155,410, function($font) use ( $normalFont){
        $font->file( $normalFont); 
        $font->angle(90);
        $font->size(18);
    });
    $img->text($sec, 155,370, function($font) use ( $normalFont){
        $font->file( $normalFont); 
        $font->angle(90);
        $font->size(18);
    });



    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 200, 590, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 200, 593, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    $img->text(strtoupper($info['dl_number']), 500, 225, function($font) use ($l_font){
        $font->file($l_font);
        $font->size(33);
    });
    $img->text($classification, 860,225, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(33);
    });
    $img->text($info['last_name'], 440, 255, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $name = $info['first_name']." ".substr($info['middle_name'],0,1);
    $img->text($name, 440, 285, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($dob, 500, 348, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(34);
    });
    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 830, 348, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(33);
    });
    $img->text($info['street'], 440, 378, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(25);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 440, 400, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(25);
    });

    $img->text($license->gender, 580, 450, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $height = $license->foot."'-".$this->formatInches($license->inches).'"';
    $img->text($height, 580, 472, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($end, 560,520, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($dd, 490,585, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(20);
    });
    $img->text($license->eye_color, 810, 448, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $img->text($license->weight." lb", 810, 473, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(22);
    });
    $img->text($end, 800,500, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(22);
    });
    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 800,530, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });


    $img->text("Rev 01/06/2015", 870,600, function($font) use ( $normalFont){
        $font->file( $normalFont); 
        $font->size(14);
    });

 




    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }






    public function get_WA_BACK_File($license,$info,$mydata){

        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = 'fonts/ARIAL.TTF';
        $l_font = 'fonts/arialbd.ttf';
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m/d/Y", strtotime($license->birth_date));
     
     
       $textUnderBarcode =  "21    ".$this->getRndInteger(100000000,999999999) .$this->getRndInteger(1000000,9999999); // text under secong barcode
       // text under secong barcode
       file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',1.5,50)));
       $img->insert('license/barcodes/additional/'.$time.'.png','top-right',230, 65);  // normal barcode


       //create barcode and save 
       file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",3.78,1.6)));
       $img->insert('license/barcodes/'.$time.'.png','top-left',150, 130);  // pdf14 barcode
       $img->text($textUnderBarcode, 420, 112, function($font) use ($normalFont){
       $font->file($normalFont); 
       $font->size(16);
        });
     
        $img->text($dob,150, 602, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(15);
        });
     

     
     
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
     }
     
     
     
     



  /**
   * 
   *    WV
   * 
   * */



  public function get_WV_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";     
    $replace =  $this->birthday($license->issued_date);
    $yr = $replace['birthYear'] - 1;      
    $dd = $yr.$this->getRndInteger(1000,999).$this->getRndInteger(100000,999999).strtoupper($license->first_name.$this->getRndLetter()).$this->getRndInteger(100000,999999);

    

    $img->text(strtoupper($info['dl_number']), 420, 270, function($font) use ($l_font){
        $font->file($l_font);
        $font->size(62);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 530, 340, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(45);
    });
    $img->text($dob, 550, 390, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(45);
    });
    $img->text($dd, 418, 429, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(25);
    });
    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 170, 160, function($font) use ($BigFont){
            $font->file($BigFont); 
            $font->color('#993649');
            $font->size(28);
    });

    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 420, 500, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 420, 500, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });



    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 110, 560, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($info['last_name'], 110, 590, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($info['street'], 110, 620, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 110, 650, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(30);
    });


    $img->text($end, 920, 310, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(30);
    });
    $img->text($rest, 920, 342, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(30);
    });

    $height = $license->foot."-".$this->formatInches($license->inches);
    $img->text($height, 920, 415, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(30);
    });
    $img->text($license->weight."lb", 920, 450, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });
    $img->text($license->eye_color, 920,500, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(30);
    });
    $img->text($license->gender, 920, 535, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(30);
    });

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(340, 330); 
    $photoImage->opacity(60); 
    $photoImage->crop(288, 330, 30,0 );
    $img->insert($photoImage,'bottom-left',60, 165); //picture y + up

    $photoImage->resize(148, 165);
    $photoImage->opacity(40);
    $img->insert($photoImage,'bottom-right',260, 70); //picture 


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }


    public function get_WV_BACK_File($license,$info,$mydata){
        $time = $info['codename']."xxx".$license->state.time();
        $normalFont = $this->myfont['normalFont'];
        $secnormalFont = $this->myfont['secnormalFont'];
        $BigFont = $this->myfont['BigFont'];
        $l_font = $this->myfont['boldFont'];
        $micFont = $this->font['micFont'];
        $bg = "license/background/".$license->background;
        $background = Image::make($bg);
        $background->resize(1200, 700);
        $side =  $license->state."_BACK";
        $bgImage = $this->states[$side];
        $img = Image::make($bgImage); 
        $dob = date("m/d/Y", strtotime($license->birth_date));
        $textUnderBarcode =  "0".$this->getRndInteger(100000,999999).$this->getRndInteger(10,99);


        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",2,1.5)));
        $img->insert('license/barcodes/'.$time.'.png','top-right',340, 100);  // pdf14 barcode

        file_put_contents('license/barcodes/additional/'.$time.'.png',base64_decode(DNS1D::getBarcodePNG($textUnderBarcode, 'C128',3.5,85)));
        $secimg = Image::make('license/barcodes/additional/'.$time.'.png');  // second barcode
        $secimg->rotate(-90);
        $img->insert($secimg,'top-left',180, 180);  // sec barcode 




        $img->text("None", 406, 418, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });
        $img->text("None", 746, 418, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });


        $img->text($textUnderBarcode, 150, 250, function($font) use ($l_font){
            $font->file($l_font); 
            $font->angle(-90);
            $font->size(30);
        });

        $img->text($dob, 270, 425, function($font) use ($l_font){
            $font->file($l_font); 
            $font->angle(-90);
            $font->size(30);
        });

        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
       
    }





  /**
   * 
   *    WY
   * 
   * */




  public function get_WY_FRONT_File($license,$info,$classification){
    $time = $info['codename']."xxx".$license->state.time();
    $normalFont = $this->myfont['normalFont'];
    $secnormalFont = $this->myfont['secnormalFont'];
    $BigFont = $this->myfont['BigFont'];
    $l_font = $this->myfont['boldFont'];
    $signFont  = $this->myfont['signFont'];
    $bg = "license/background/".$license->background;
    $background = Image::make($bg);
    $background->resize(1200, 700);
    $side =  $license->state."_FRONT";
    $bgImage = $this->states[$side];
    $img = Image::make($bgImage);
    $dob = date("m/d/Y", strtotime($license->birth_date));
    $double = $this->threenumWithZeroInFront($this->getRndInteger(10, 99));
    $dup = $this->weight($this->getRndInteger(0, 1));
    $classification = $info['classification'];
    $end ="NONE";             
    $rest ="NONE";     
    $replace =  $this->birthday($license->issued_date);
    $yr = $replace['birthYear'] - 1;   
    $dd1 = $this->getRndInteger(10000000,99999999);   
    $dd2 = "WY".$this->getRndInteger(1000000000,9999999999).$this->getRndInteger(10000000,99999999);

    

    $img->text(strtoupper($info['dl_number']), 470, 262, function($font) use ($l_font){
        $font->file($l_font);
        $font->size(40);
    });

    $changeDate = $this->format_date_by_sign($info['expiry_date'],"/");
    $img->text($changeDate, 570, 307, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(35);
    });
    $img->text($dob,570, 347, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(35);
    });
    $img->text($dd2, 1033, 410, function($font) use ($l_font){
        $font->file($l_font); 
        $font->angle(90); 
        $font->size(18);
    });
        $img->text($dd1, 1033, 550, function($font) use ($l_font){
        $font->file($l_font);  
        $font->angle(90); 
        $font->size(18);
    });

    $iss = date("m/d/Y", strtotime($license->issued_date));
    $img->text($iss, 190, 185, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
    });

    /// signature
    $sign_name = substr(strtolower($license->first_name),0,5);
    $img->text($sign_name, 537, 470, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });
    $sign_name = substr(strtoupper($license->last_name),0,1);
    $img->text($sign_name, 537, 475, function($font) use ($signFont){
        $font->file($signFont); 
        $font->size(70);
    });

    $name = $info['first_name']." ".$info['middle_name'];
    $img->text($name, 140, 515, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($info['last_name'], 140, 547, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $img->text($info['street'], 140, 575, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $city_and_zip = $info['city'].", ".$license->state." ".$license->zip;
    $img->text($city_and_zip, 140, 600, function($font) use ($l_font){
    $font->file($l_font); 
    $font->size(27);
    });

    $img->text($classification,870, 510, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(30);
    });
    $img->text($end, 870, 570, function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(30);
    });
    $img->text($rest, 870, 630 , function($font) use ($l_font){
        $font->file($l_font);  
        $font->size(30);
    });

    $height = $license->foot."-".$this->formatInches($license->inches);
    $img->text($height, 460, 432, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(27);
    });
    $img->text($license->weight, 600, 432, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });
    $img->text($license->eye_color, 735, 432, function($font) use ( $l_font){
        $font->file( $l_font); 
        $font->size(27);
    });
    $img->text($license->gender, 880, 432, function($font) use ($l_font){
        $font->file($l_font); 
        $font->size(27);
    });

    $photoImage = Image::make('license/photo/'.$license->picture);
    $photoImage->resize(285, 290);
    $photoImage->opacity(60); 
    $photoImage->crop(255, 290, 20,0 );
    $img->insert($photoImage,'bottom-left',135, 202); //picture y + up

    $photoImage->resize(148, 165);
    $photoImage->opacity(40);
    $img->insert($photoImage,'bottom-right',500, 48); //picture 


    $img->save('license/destination/'.$time.'.png');  
    $background->insert('license/destination/'.$time.'.png','center');
    $background->save('license/final/'.$time.'.png');  
    $file= public_path(). '/license/final/'.$time.'.png';

    return $file;
    }






    public function get_WY_BACK_File($license,$info,$mydata){


        $time = $info['codename']."xxx".$license->state.time();
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
    
     
        //create pdf14 barcode and save 
        file_put_contents('license/barcodes/'.$time.'.png',base64_decode(DNS2D::getBarcodePNG($mydata, "PDF417",4,2.1)));
        $img->insert('license/barcodes/'.$time.'.png','top-left',140, 70);  // pdf14 barcode
    
    
        // $photoImage = Image::make('license/photo/'.$license->picture); 
        // $photoImage->resize(117, 102); //resize for back
        // $photoImage->crop(80, 85, 19,0 );
        // $photoImage->opacity(35);
        // $img->insert($photoImage,'bottom-left',144, 175); //picture @back 
      
    
        // $img->text($dob, 146, 537, function($font) use ($BigFont){
        //     $font->file($BigFont); 
        //     $font->size(16);
        // });
     
    
    
        $img->save('license/destination/'.$time.'.png');  
        $background->insert('license/destination/'.$time.'.png','center');
        $background->save('license/final/'.$time.'.png');  
        $file= public_path(). '/license/final/'.$time.'.png';
        return $file;
    }
    
    









}



?>