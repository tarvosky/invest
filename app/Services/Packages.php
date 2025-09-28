<?php

namespace App\Services;

class Packages
{

    public static function getPackages(){
        return [
            [
                'name' => 'Bronze Package',
                'price' => 10000,
                'roi' => '20%',
                'support' => 'Support Response within 2 days',
                'commission' => '4% withdrawal commission',
                'btnClass' => 'btn-danger'
            ],
            [
                'name' => 'Silver Package',
                'price' => 25000,
                'roi' => '30%',
                'support' => 'Support Response within 2 days',
                'commission' => '3% withdrawal commission',
                'btnClass' => 'btn-info'
            ],
            [
                'name' => 'Gold Package',
                'price' => 50000,
                'roi' => '50%',
                'support' => 'Support Response within 2 days',
                'commission' => '2% withdrawal commission',
                'btnClass' => 'btn-warning'
            ],
            [
                'name' => 'Platinum Package',
                'price' => 100000,
                'roi' => '100%',
                'support' => 'Support Response within 2 days',
                'commission' => '0% withdrawal commission',
                'btnClass' => 'btn-success'
            ],
        ];
    }
}

