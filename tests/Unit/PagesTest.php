<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
class PagesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_paystub_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('/paystubs');
        $response->assertStatus(200);
    }

    public function test_bank_statement_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('/statements');
        $response->assertStatus(200);
    }
    public function test_bank_custom_statement_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('/custom-statements');
        $response->assertStatus(200);
    }
    public function test_ein_letter_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('einletter');
        $response->assertStatus(200);
    }
    public function test_divorce_certificate_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('divorce-certificate');
        $response->assertStatus(200);
    }
    public function test_customize_edit_picture_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('payment/customize/edit-picture');
        $response->assertStatus(200);
    }
    public function test_lawyers_license_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('lawyers-license');
        $response->assertStatus(200);
    }
    public function test_passports_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('passports');
        $response->assertStatus(200);
    } 
    public function test_notice_to_vacate_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('rental/notice-to-vacate');
        $response->assertStatus(200);
    }    
    public function test_late_rent_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('rental/late-rent');
        $response->assertStatus(200);
    }  
    public function test_lease_agreement_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('rental/lease-agreement');
        $response->assertStatus(200);
    }    
    public function test_socials_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('socials');
        $response->assertStatus(200);
    }   
    public function test_sms_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('sms');
        $response->assertStatus(200);
    } 
    public function test_tax_documents_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('tax-documents/index');
        $response->assertStatus(200);
    } 
    public function test_1099_contractor_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('1099/contractor');
        $response->assertStatus(200);
    }    

    public function test_w2_employee_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('w2/employee');
        $response->assertStatus(200);
    }  
    public function test_energy_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('utility/energy');
        $response->assertStatus(200);
    } 
    public function test_utility_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('utility');
        $response->assertStatus(200);
    }    
    public function test_voidcheck_landing_page()
    {
        $user = User::where('id',2)->first();
        $response = $this->actingAs($user)->get('voidcheck');
        $response->assertStatus(200);
    } 




}
