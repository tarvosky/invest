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
use PDF;

trait TaxTrait {


    public function test(){
        return "hello";
    }



   public function convertJpgToPdf($image){
        $file = storage_path($image);
        $image = new Imagick($file);
        $image->setImageFormat('pdf');
        $image->writeImage(storage_path('tax/test.pdf'));
        return true;
    }










}



?>