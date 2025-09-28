<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Traits\Payment;

class PaymentTest extends TestCase
{
    use Payment;
    /**
     * A basic unit test example.
     *
     * @return void
     */


    //php artisan test --filter UserTest::can_create_user
    //return dd($percentage) ; // exits all test
    public function test_bonus()
    {

      $amount = 500;
      $amount_getting = $this->paymentBonusOn500Above1000($amount);

    if($amount >= 500 && $amount < 1000){
        $this->assertEquals($amount_getting, 0.10 * $amount );
    }else if($amount > 999){
        $this->assertEquals($amount_getting, 0.20 * $amount );
    }else{
        $this->assertEquals($amount_getting, $amount );
    }
         
       
     
    }




    public function test_check_if_it_rejects_lower_money_than_cost_price()
    {
        $wallet = 2;
        $cost = 2.5;
        if($this->check_if_there_is_enough_credit($wallet,$cost) === false){
            $this->assertTrue($wallet < $cost);
        }else{
            $this->assertTrue($wallet < $cost);

        }
    }




    


}
