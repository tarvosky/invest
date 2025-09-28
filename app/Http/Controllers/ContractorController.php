<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\Contractor;
use App\Traits\Payment;
use App\Traits\TaxTrait;
use App\Traits\FontTrait;
use App\Traits\License;
use Image;
use PDF;
use App\Traits\FormatTrait;

class ContractorController extends Controller
{

    use Payment,FontTrait,TaxTrait,License,FormatTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        set_time_limit(8000000);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charge = Charge::where('slug','ssn_front')->first();
        $data = Contractor::where('user_id',auth()->user()->id)->get();
        return view('contractor.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contractor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

 
        $this->validate($request, [ 
            'year' => 'required', 
            'employers_business_name' => 'required' , 
            'employers_street' => 'required' ,
            'employers_phone' => 'required' , 
            'employers_city' => 'required' , 
            'employers_state' => 'required', 
            'employers_zip' => 'required' , 
            'employers_ein' => 'required|digits:9|numeric',   
            'applicant_fullname' => 'required', 
            'applicant_street' => 'required' ,  
            'applicant_city' => 'required' , 
            'applicant_state' => 'required' , 
            'applicant_zip' => 'required', 
            'applicant_ssn' => 'required|digits:9|numeric',  
            'applicant_total_income' => 'required',
        ]);

        $user = auth()->user();
        $data =  $user->contractors()->create([
            'year' => $request->year, 
            'employers_business_name' => $request->employers_business_name , 
            'employers_street' => $request->employers_street ,
            'employers_phone' => $request->employers_phone , 
            'employers_city' => $request->employers_city , 
            'employers_state' => $request->employers_state, 
            'employers_zip' => $request->employers_zip, 
            'employers_ein' => $this->numberToEIN($request->employers_ein),   
            'applicant_fullname' => $request->applicant_fullname, 
            'applicant_street' => $request->applicant_street ,  
            'applicant_city' => $request->applicant_city , 
            'applicant_state' => $request->applicant_state , 
            'applicant_zip' => $request->applicant_zip, 
            'applicant_ssn' => $this->numberToSSN($request->applicant_ssn),  
            'applicant_total_income' => $request->applicant_total_income,
        ]);
        return  redirect()->route('contractor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contractor $contractor)
    {
    $xssn =  $this->ConvertToNumber($contractor->applicant_ssn);
    $xein =  $this->ConvertToNumber($contractor->employers_ein);
        return view('contractor.edit')->with('data', $contractor)->with('xssn', $xssn)->with('xein', $xein);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [ 
            'year' => 'required', 
            'employers_business_name' => 'required' , 
            'employers_street' => 'required' , 
            'employers_phone' => 'required' ,
            'employers_city' => 'required' , 
            'employers_state' => 'required', 
            'employers_zip' => 'required' , 
            'employers_ein' => 'required|digits:9|numeric',
            'applicant_fullname' => 'required', 
            'applicant_street' => 'required' ,  
            'applicant_city' => 'required' , 
            'applicant_state' => 'required' , 
            'applicant_zip' => 'required', 
            'applicant_ssn' => 'required|digits:9|numeric',
            'applicant_total_income' => 'required',
        ]);
        $user = auth()->user();
        $data =  $user->contractors()->update([
            'year' => $request->year, 
            'employers_business_name' => $request->employers_business_name , 
            'employers_street' => $request->employers_street ,
            'employers_phone' => $request->employers_phone , 
            'employers_city' => $request->employers_city , 
            'employers_state' => $request->employers_state, 
            'employers_zip' => $request->employers_zip, 
            'employers_ein' => $this->numberToEIN($request->employers_ein),   
            'applicant_fullname' => $request->applicant_fullname, 
            'applicant_street' => $request->applicant_street ,  
            'applicant_city' => $request->applicant_city , 
            'applicant_state' => $request->applicant_state , 
            'applicant_zip' => $request->applicant_zip, 
            'applicant_ssn' => $this->numberToSSN($request->applicant_ssn),  
            'applicant_total_income' => $request->applicant_total_income,
        ]);
        return  redirect()->route('contractor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Delete(Contractor $contractor)
    {
        $contractor->delete();
        return back();
    }
    


    public function createDocument(Request $request)
    {
    
       


        $tax = Contractor::find($request->id);
        $normalFont = $this->font['normalFont'];
        $courierFont= $this->font['courierFont'];
        $boldFont= $this->font['boldFont'];
        $time = time().$this->codeName();    
        $tax_theme = "tax/1099.png";       
        $img = Image::make($tax_theme);


        $year = substr($tax->year,2,2);
        $img->text(strtoupper($year), 1640, 370, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(75);
        });



        $img->text(strtoupper($tax->employers_business_name), 60, 340, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->employers_street), 60, 410, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $addr = strtoupper($tax->employers_city).", ".strtoupper($tax->employers_state)."  ".strtoupper($tax->employers_zip);
        $img->text(strtoupper($addr), 60, 480, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->employers_phone), 60, 550, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->employers_ein), 60, 780, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->applicant_ssn), 610, 780, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->applicant_fullname), 60, 880, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->applicant_street), 60, 1050, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $addr = strtoupper($tax->applicant_city).", ".strtoupper($tax->employers_state)."  ".strtoupper($tax->employers_zip);
        $img->text(strtoupper($addr), 60, 1200, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(number_format($tax->applicant_total_income,2),  1150, 980, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });








        $year = substr($tax->year,2,2);
        $img->text(strtoupper($year), 1640, 2010, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(75);
        });
        
        $img->text(strtoupper($tax->employers_business_name), 60, 1960, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->employers_street), 60, 2030, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $addr = strtoupper($tax->employers_city).", ".strtoupper($tax->employers_state)."  ".strtoupper($tax->employers_zip);
        $img->text(strtoupper($addr), 60, 2100, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->employers_phone), 60, 2200, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->employers_ein), 60, 2430, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->applicant_ssn), 610, 2430, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->applicant_fullname), 60, 2530, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(strtoupper($tax->applicant_street), 60, 2700, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $addr = strtoupper($tax->applicant_city).", ".strtoupper($tax->employers_state)."  ".strtoupper($tax->employers_zip);
        $img->text(strtoupper($addr), 60, 2850, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });
        $img->text(number_format($tax->applicant_total_income,2),  1150, 2600, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(45);
        });





        $img->save('tax/completed/'.$time.'.png'); 



    


        $user = auth()->user();
        $charge = Charge::where('slug','1099')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  1099 at $".$charge->charge." #".$time,$user,"1099"); //update history

        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('tax-template/1099',compact('data'));
        return $pdf->download($time.'.pdf');
        

         



    }

}
