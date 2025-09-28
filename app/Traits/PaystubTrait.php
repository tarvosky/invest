<?php

namespace App\Traits;

use Image;
use DNS1D;
use DNS2D;
use App\Traits\License;
use ZipArchive;
use File;
use App\Models\User;
use PDF;
use DateTime;

trait PaystubTrait {

   

    public function get_weeks_from_Jan($yourdate){
        $date = new DateTime($yourdate);
        $week = $date->format("W");
        return  $week;
    }


    public function reporting_period($date,$n_days){
        $first = date('m/d/Y', strtotime($n_days, strtotime($date)));
        $second = date('m/d/Y', strtotime('-1 days', strtotime($date)));
        return $first." - ".$second;
    }


    public function get_tax($annual_pay,$pay_type){
        if($pay_type == "weekly"){
            $gross_pay =  $annual_pay / 52;
            $federal_tax =  $annual_pay * 0.0022614;
            $medicare_tax =  $annual_pay * 0.0002788;
            $ss_tax =  $annual_pay * 0.0011924;
            $state_tax =  $annual_pay * 0.0007658;

        }elseif($pay_type == "bi-weekly"){
            $gross_pay =  $annual_pay / 26;
            $federal_tax =  $annual_pay * 0.0045228;
            $medicare_tax =  $annual_pay * 0.0005576;
            $ss_tax =  $annual_pay * 0.0023848;
            $state_tax =  $annual_pay * 0.0015316;

        }else{
           
            $gross_pay =  $annual_pay / 12;
            $federal_tax =  $annual_pay * 0.0090456;
            $medicare_tax =  $annual_pay * 0.0011152;
            $ss_tax =  $annual_pay * 0.0047696;
            $state_tax =  $annual_pay * 0.0030632;

        }
        return $tax = [
                "gross_pay" => round($gross_pay,2),
                "federal_tax" => round($federal_tax ,2),
                "medicare_tax" => round($medicare_tax ,2),
                "ss_tax" =>  round($ss_tax,2),
                "state_tax" => round($state_tax,2),
                "deductions" => round($federal_tax + $medicare_tax + $ss_tax + $state_tax ,2)
        ];
    }



    public function ytd_total($pay_date,$tax,$pay_type){

        $weeks = $this->get_weeks_from_Jan($pay_date);

        if($pay_type == "weekly"){

            $federal_total   =  $tax['federal_tax'] * $weeks;
            $medicare_total  =  $tax['medicare_tax'] * $weeks;
            $ss_total        =  $tax['ss_tax'] * $weeks;
            $state_total     =  $tax['state_tax'] * $weeks;

        }elseif($pay_type == "bi-weekly"){

            $federal_total   =  $tax['federal_tax'] * $weeks * 0.5;
            $medicare_total  =  $tax['medicare_tax'] * $weeks* 0.5;
            $ss_total        =  $tax['ss_tax'] * $weeks* 0.5;
            $state_total     =  $tax['state_tax'] * $weeks* 0.5; 

        }else{
           
            $federal_total   =  $tax['federal_tax'] * $weeks  * 0.25;
            $medicare_total  =  $tax['medicare_tax'] * $weeks * 0.25;
            $ss_total        =  $tax['ss_tax'] * $weeks * 0.25;
            $state_total     =  $tax['state_tax'] * $weeks* 0.25; 

        }
        return $total = [
                "federal_total" => round($federal_total ,2),
                "medicare_total" => round($medicare_total ,2),
                "ss_total" =>  round($ss_total,2),
                "state_total" => round($state_total,2),
        ];
    }



    public function final_cal($pay_date,$tax,$pay_type){

        $deductions = $tax['deductions'];
        $net_pay = $tax['gross_pay'] - $tax['deductions'];
        $total = $tax['gross_pay'];
        $weeks = $this->get_weeks_from_Jan($pay_date);


        if($pay_type == "weekly"){

            $ytd_net_pay      =  $net_pay * $weeks;
            $ytd_deductions   =  $deductions * $weeks;
            $ytd_gross        =  $total * $weeks;

        }elseif($pay_type == "bi-weekly"){

            $ytd_net_pay     =  $net_pay * $weeks * 0.5;
            $ytd_deductions  =  $deductions * $weeks * 0.5;
            $ytd_gross       =  $total * $weeks * 0.5;

        }else{
           
            $ytd_net_pay     =  $net_pay * $weeks  * 0.25;
            $ytd_deductions  =  $deductions * $weeks  * 0.25;
            $ytd_gross       =  $total * $weeks  * 0.25;

        }
        return $ytd_final = [
                "deductions" => round($deductions,2),
                "net_pay" => round($net_pay ,2),
                "total" => round($total ,2),
                "ytd_net_pay" => round($ytd_net_pay ,2),
                "ytd_deductions" => round($ytd_deductions ,2),
                "ytd_gross" =>  round($ytd_gross,2),
        ];
    }



    public function figures($data){
    
        if($data->pay_type == "weekly"){
            $reporting_data = $this->reporting_period($data->pay_date,'-7 days');
            $tax            = $this->get_tax($data->annual_pay,$data->pay_type);
            $ytd_total      = $this->ytd_total($data->pay_date,$tax,$data->pay_type);
            $ytd_final      = $this->final_cal($data->pay_date,$tax,$data->pay_type);
            
        }elseif($data->pay_type == "bi-weekly"){
            $reporting_data = $this->reporting_period($data->pay_date,'-14 days');
            $tax            = $this->get_tax($data->annual_pay,$data->pay_type);
            $ytd_total      = $this->ytd_total($data->pay_date,$tax,$data->pay_type);
            $ytd_final      = $this->final_cal($data->pay_date,$tax,$data->pay_type);
        }else{
            $reporting_data = $this->reporting_period($data->pay_date,'-30days');
            $tax            = $this->get_tax($data->annual_pay,$data->pay_type);
            $ytd_total      = $this->ytd_total($data->pay_date,$tax,$data->pay_type);
            $ytd_final      = $this->final_cal($data->pay_date,$tax,$data->pay_type);
        }
        return [
            "reporting_data" =>  $reporting_data,
            "tax" =>  $tax,
            "ytd_total" =>  $ytd_total,
            "ytd_final" =>  $ytd_final,
            "data" => $data
        ];
    }



    public function typeOne($figures,$info){
            $no = rand(10000,99999);  
            $boldFont = $info['boldFont'];
            $normalFont = $info['normalFont'];
            $ArialLightFont = $info['ArialLightFont'];
            $OCRAStdFont = $info['OCRAStdFont'];
            $time = $info['time'];
            $theme = "my-paystubs/type1.png"; 
            $img = Image::make($theme);
    
    
            $img->text(strtoupper($figures['data']->company_name), 30, 230, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(40);
            });
            $img->text(strtoupper($figures['data']->company_street), 30, 260, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $add = $figures['data']->company_city. ", ". $figures['data']->company_state." ".$figures['data']->company_zip;
            $img->text(strtoupper($add), 30, 290, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $img->text(strtoupper($figures['data']->name), 1010, 230, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(40);
            });
            $img->text(strtoupper($figures['data']->street), 1010, 260, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $add = $figures['data']->city. ", ". $figures['data']->state." ".$figures['data']->zip;
            $img->text(strtoupper($add), 1010, 290, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $img->text(strtoupper($no), 1700, 230, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(40);
            });

            $ssn = "XXX-XX-".substr($figures['data']->ssn,-4);
            $img->text($ssn, 150, 500, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $changeDate = date("m/d/Y", strtotime($figures['data']->pay_date));
            $img->text($changeDate, 640, 500, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $img->text($figures['reporting_data'], 1040, 500, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $img->text(strtoupper($figures['data']->pay_type), 1600, 500, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(30);
            });
            $img->text("GROSS EARNINGS", 40, 700, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("SALARY", 330, 700, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("40", 570, 700, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text( "$".number_format($figures['tax']['gross_pay'],2), 790, 700, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });


            /// deduction 
            $img->text("STATUTORY DEDUCTIONS",  1030, 700, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("FEDERAL TAX",  1030, 780, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("FICA-MEDICARE",  1030, 830, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("FICA-SOCIAL SECURITY",  1030, 880, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("STATE TAX",  1030, 930, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });




            $img->text("$".number_format($figures['tax']['federal_tax'],2),  1510, 780, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['tax']['medicare_tax'],2),  1510, 830, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['tax']['ss_tax'],2),  1510, 880, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['tax']['state_tax'],2),  1510, 930, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });

            




            $img->text("$".number_format($figures['ytd_total']['federal_total'],2),  1730,780, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_total']['medicare_total'],2),  1730, 830, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_total']['ss_total'],2),  1730, 880, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_total']['state_total'],2),  1730, 930, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });








            /// final 

            $img->text("$".number_format($figures['ytd_final']['ytd_gross'],2), 80, 1200, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_final']['ytd_deductions'],2), 370, 1200, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_final']['ytd_net_pay'],2), 730, 1200, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_final']['total'],2), 1055, 1200, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_final']['deductions'],2), 1346, 1200, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
            $img->text("$".number_format($figures['ytd_final']['net_pay'],2), 1750, 1200, function($font) use ( $boldFont){
                $font->file( $boldFont);
                $font->size(27);
            });
    
            $img->save('my-paystubs/final/'.$time.'.png'); 
            $file = public_path(). '/my-paystubs/final/'.$time.'.png';
            return $file;
        
    }

















    public function typeTwo($figures,$info){
        $no = rand(10000,99999);  
        $boldFont = $info['boldFont'];
        $normalFont = $info['normalFont'];
        $ArialLightFont = $info['ArialLightFont'];
        $OCRAStdFont = $info['OCRAStdFont'];
        $time = $info['time'];
        $theme = "my-paystubs/type2.png"; 
        $img = Image::make($theme);


        $img->text(strtoupper($figures['data']->company_name), 30, 60, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(40);
        });
        $img->text(strtoupper($figures['data']->company_street), 30, 90, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        $add = $figures['data']->company_city. ", ". $figures['data']->company_state." ".$figures['data']->company_zip;
        $img->text(strtoupper($add), 30, 120, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        $img->text(strtoupper($figures['data']->name), 50, 230, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(40);
        });
        $img->text(strtoupper($figures['data']->street), 50, 260, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        $add = $figures['data']->city. ", ". $figures['data']->state." ".$figures['data']->zip;
        $img->text(strtoupper($add), 50, 290, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        $img->text(strtoupper($no), 1740, 260, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });

        $ssn = "XXX-XX-".substr($figures['data']->ssn,-4);
        $img->text($ssn, 780, 260, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        $changeDate = date("m/d/Y", strtotime($figures['data']->pay_date));
        $img->text($changeDate,1510, 260 , function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        $img->text($figures['reporting_data'], 1050, 260, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(30);
        });
        // $img->text(strtoupper($figures['data']->name), 1600, 500, function($font) use ( $boldFont){
        //     $font->file( $boldFont);
        //     $font->size(30);
        // });
        $img->text("GROSS EARNINGS", 40, 450, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("SALARY", 340, 450, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("40", 580, 450, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text( "$".number_format($figures['tax']['gross_pay'],2),770, 450, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });


        /// deduction 
        $img->text("STATUTORY DEDUCTIONS",  1030, 450, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("FEDERAL TAX",  1030, 530, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("FICA-MEDICARE",  1030, 580, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("FICA-SOCIAL SECURITY",  1030, 630, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("STATE TAX",  1030, 680, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });




        $img->text("$".number_format($figures['tax']['federal_tax'],2),  1510, 530, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['tax']['medicare_tax'],2),  1510, 580, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['tax']['ss_tax'],2),  1510, 630, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['tax']['state_tax'],2),  1510, 680, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });

        




        $img->text("$".number_format($figures['ytd_total']['federal_total'],2),  1750, 530, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_total']['medicare_total'],2),  1750, 580, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_total']['ss_total'],2),  1750, 630, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_total']['state_total'],2),  1750, 680, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });








        /// final 

        $img->text("$".number_format($figures['ytd_final']['ytd_gross'],2), 110, 1130, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_final']['ytd_deductions'],2), 390, 1130, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_final']['ytd_net_pay'],2), 750, 1130, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_final']['total'],2), 1070, 1130, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_final']['deductions'],2), 1380, 1130, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });
        $img->text("$".number_format($figures['ytd_final']['net_pay'],2), 1760, 1130, function($font) use ( $boldFont){
            $font->file( $boldFont);
            $font->size(27);
        });


        $img->save('my-paystubs/final/'.$time.'.png'); 
        $file = public_path(). '/my-paystubs/final/'.$time.'.png';
        return $file;
    
}







public function typeThree($figures,$info){
    $no = rand(10000,99999);  
    $boldFont = $info['boldFont'];
    $normalFont = $info['normalFont'];
    $ArialLightFont = $info['ArialLightFont'];
    $OCRAStdFont = $info['OCRAStdFont'];
    $time = $info['time'];
    $theme = "my-paystubs/type3.png"; 
    $img = Image::make($theme);


    $img->text(strtoupper($figures['data']->company_name), 30, 60, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(30);
    });
    $img->text(strtoupper($figures['data']->company_street), 30, 90, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $add = $figures['data']->company_city. ", ". $figures['data']->company_state." ".$figures['data']->company_zip;
    $img->text(strtoupper($add), 30, 120, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text(strtoupper($figures['data']->name), 50, 250, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(30);
    });
    $img->text(strtoupper($figures['data']->street), 50, 280, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $add = $figures['data']->city. ", ". $figures['data']->state." ".$figures['data']->zip;
    $img->text(strtoupper($add), 50, 310, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text(strtoupper("Paystub: #".$no), 1260, 120, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(22);
    });

    $ssn = "XXX-XX-".substr($figures['data']->ssn,-4);
    $img->text($ssn, 560, 260, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text(strtoupper($figures['data']->pay_type), 760, 260, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });

    $img->text($figures['reporting_data'], 1000, 260, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $changeDate = date("m/d/Y", strtotime($figures['data']->pay_date));
    $img->text($changeDate,1350, 260 , function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    // $img->text(strtoupper($figures['data']->name), 1600, 500, function($font) use ( $boldFont){
    //     $font->file( $boldFont);
    //     $font->size(30);
    // });
    $img->text("GROSS EARNINGS", 40, 430, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("SALARY", 340, 430, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });

    $img->text( "$".number_format($figures['tax']['gross_pay'],2),580, 430, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });


    /// deduction 
    $img->text("STATUTORY DEDUCTIONS",  760, 430, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("FEDERAL TAX",  760, 480, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("FICA-MEDICARE",  760, 530, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("FICA-SOCIAL SECURITY",  760, 580, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("STATE TAX",  760, 630, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });




    $img->text("$".number_format($figures['tax']['federal_tax'],2),  1200, 480, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("$".number_format($figures['tax']['medicare_tax'],2),  1200, 530, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("$".number_format($figures['tax']['ss_tax'],2),  1200, 580, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("$".number_format($figures['tax']['state_tax'],2),  1200, 630, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });

    




    $img->text("$".number_format($figures['ytd_total']['federal_total'],2),  1350, 480, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("$".number_format($figures['ytd_total']['medicare_total'],2),  1350, 530, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("$".number_format($figures['ytd_total']['ss_total'],2),  1350, 580, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });
    $img->text("$".number_format($figures['ytd_total']['state_total'],2),  1350, 630, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
    });








    /// final 

    $img->text("$".number_format($figures['ytd_final']['ytd_gross'],2), 100, 780, function($font) use ( $boldFont){
        $font->file( $boldFont);
        $font->size(20);
        $font->color('#ffffff');
    });
    $img->text("$".number_format($figures['ytd_final']['ytd_deductions'],2), 320, 780, function($font) use ( $boldFont){
        $font->file( $boldFont);
                $font->size(20);
        $font->color('#ffffff');
    });
    $img->text("$".number_format($figures['ytd_final']['ytd_net_pay'],2), 645, 780, function($font) use ( $boldFont){
        $font->file( $boldFont);
                $font->size(20);
        $font->color('#ffffff');
    });
    $img->text("$".number_format($figures['ytd_final']['total'],2), 870, 780, function($font) use ( $boldFont){
        $font->file( $boldFont);
                $font->size(20);
        $font->color('#ffffff');
    });
    $img->text("$".number_format($figures['ytd_final']['deductions'],2), 1060, 780, function($font) use ( $boldFont){
        $font->file( $boldFont);
                $font->size(20);
        $font->color('#ffffff');
    });
    $img->text("$".number_format($figures['ytd_final']['net_pay'],2), 1330, 780, function($font) use ( $boldFont){
        $font->file( $boldFont);
                $font->size(20);
        $font->color('#ffffff');
    });



    $img->save('my-paystubs/final/'.$time.'.png'); 
    $file = public_path(). '/my-paystubs/final/'.$time.'.png';
    return $file;

}



















}



?>