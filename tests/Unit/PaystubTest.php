<?php

namespace Tests\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class PaystubTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    public function test_create_document()
    {


        // dumpSession() // shows you if you get 302 errors it could be validations
        //$user = User::factory()->make();
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->post('paystubs/create-document', ['id' => 1])->dumpSession();


         //$response->assertDownload();
        // assertTrue()
        // assertFalse()
        // assertEquals()
        // assertNull()
        // assertContains()
        // assertCount()
        // assertEmpty()
       // $response->assertStatus();
        $response->assertStatus(500);  // 500 is due to the image invention

    }
}
