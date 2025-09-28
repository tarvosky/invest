<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Traits\Payment;
use App\Traits\TaxTrait;
use App\Traits\FontTrait;
use App\Traits\License;
use App\Models\Charge;
use Image;
use PDF;
use App\Traits\FormatTrait;

class EmployeeController extends Controller
{
    use Payment,TaxTrait,License,FontTrait,FormatTrait;

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
        $charge = Charge::where('slug','w2')->first();
        $data = Employee::where('user_id',auth()->user()->id)->get();
        return view('employee.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
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
            'employers_name' => 'required' , 
            'employers_street' => 'required' ,
            'employers_city' => 'required' , 
            'employers_state' => 'required', 
            'employers_zip' => 'required' , 
            'employers_ein' => 'required|digits:9|numeric',   
            'applicant_fullname' => 'required', 
            'applicant_street' => 'required' ,  
            'applicant_city' => 'required' , 
            'applicant_gender' => 'required',
            'applicant_state' => 'required' , 
            'applicant_zip' => 'required', 
            'applicant_ssn' => 'required|digits:9|numeric',  
            'total_income' => 'required',
            'income_tax' => 'required',
            'social_security_wages' => 'required',
            'social_security_tax' => 'required',
            'medicare_wages' => 'required',
            'madicare_security_tax' => 'required',
        ]);

        $user = auth()->user();
        $data =  $user->employees()->create([
            'year' => $request->year, 
            'employers_name' => $request->employers_name , 
            'employers_street' => $request->employers_street ,
            'employers_city' => $request->employers_city , 
            'employers_state' => $request->employers_state, 
            'employers_zip' => $request->employers_zip , 
            'employers_ein' =>  $this->numberToEIN($request->employers_ein) , 
            'applicant_fullname' => $request->applicant_fullname, 
            'applicant_street' => $request->applicant_street ,  
            'applicant_city' => $request->applicant_city, 
            'applicant_gender' => $request->applicant_gender,
            'applicant_state' => $request->applicant_state, 
            'applicant_zip' => $request->applicant_zip, 
            'applicant_ssn' => $this->numberToSSN($request->applicant_ssn),
            'total_income' => $request->total_income,
            'income_tax' => $request->income_tax,
            'social_security_wages' => $request->social_security_wages,
            'social_security_tax' => $request->social_security_tax,
            'medicare_wages' => $request->medicare_wages,
            'madicare_security_tax' => $request->madicare_security_tax,
        ]);
        return  redirect()->route('employee.index');
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
    public function edit(Employee $employee)
    {
        $xssn =  $this->ConvertToNumber($employee->applicant_ssn);
        $xein =  $this->ConvertToNumber($employee->employers_ein);
        return view('employee.edit')->with('data', $employee)->with('xssn', $xssn)->with('xein', $xein);
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
            'employers_name' => 'required' , 
            'employers_street' => 'required' ,
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
            'applicant_gender' => 'required',
            'total_income' => 'required',
            'income_tax' => 'required',
            'social_security_wages' => 'required',
            'social_security_tax' => 'required',
            'medicare_wages' => 'required',
            'madicare_security_tax' => 'required',
        ]);
        $user = auth()->user();
        $data =  $user->employees()->update([
            'year' => $request->year, 
            'employers_name' => $request->employers_name , 
            'employers_street' => $request->employers_street ,
            'employers_city' => $request->employers_city , 
            'employers_state' => $request->employers_state, 
            'employers_zip' => $request->employers_zip , 
            'employers_ein' =>  $this->numberToEIN($request->employers_ein) , 
            'applicant_fullname' => $request->applicant_fullname, 
            'applicant_street' => $request->applicant_street ,  
            'applicant_city' => $request->applicant_city, 
            'applicant_gender' => $request->applicant_gender,
            'applicant_state' => $request->applicant_state, 
            'applicant_zip' => $request->applicant_zip, 
            'applicant_ssn' => $this->numberToSSN($request->applicant_ssn),
            'total_income' => $request->total_income,
            'income_tax' => $request->income_tax,
            'social_security_wages' => $request->social_security_wages,
            'social_security_tax' => $request->social_security_tax,
            'medicare_wages' => $request->medicare_wages,
            'madicare_security_tax' => $request->madicare_security_tax,
        ]);
        return  redirect()->route('employee.index');
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

    public function Delete(Employee $employee)
    {
        $employee->delete();
        return back();
    }

    public function createDocument(Request $request)
    {
        
        $tax = Employee::find($request->id);
        $normalFont = $this->font['normalFont'];
        $courierFont= $this->font['courierFont'];
        $courbdFont = $this->font['courbdFont'];
        $boldFont= $this->font['boldFont'];
        $ocrFont = $this->font['ocrFont'];
        $ocrb_only = $this->font['ocrb_only'];
        $time = time().$this->codeName();    
        $tax_theme = "tax/w2.png";       
        $img = Image::make($tax_theme);


        $year = substr($tax->year,2,2);




        $img->text(strtoupper($tax->year), 1125, 82, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(60);
        });
        $img->text(strtoupper($year), 700, 240, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(100);
        });
        $img->text(strtoupper($year), 700, 3220, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(100);
        });
        $img->text(strtoupper($year), 1540, 3220, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(100);
        });
        $img->text(strtoupper($year), 2375, 3220, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(100);
        });

        $cn = "0".$this->getRndInteger(10000,99999)." ".$this->getRndLetter().$this->getRndLetter().$this->getRndLetter().$this->getRndLetter()."/".$this->getRndLetter().$this->getRndLetter().$this->getRndLetter();
        $img->text(strtoupper($cn), 40, 343, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(28);
        });

        $dp = $this->getRndInteger(100000,999999);
        $img->text(strtoupper($dp), 322, 343, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(28);
        });


        $img->text(strtoupper($tax->employers_name), 80, 440, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $img->text(strtoupper($tax->employers_street), 80, 480, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $city_and_zip = strtoupper($tax->employers_city).", ".strtoupper($tax->employers_state)." ".strtoupper($tax->employers_zip);
        $img->text($city_and_zip, 80, 520, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });


        $b = "#".$this->getRndInteger(10000,99999);
        $img->text(strtoupper($b), 660, 605, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(32);
        });


        $img->text(strtoupper($tax->applicant_fullname), 80, 710, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $img->text(strtoupper($tax->applicant_street), 80, 750, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $city_and_zip = strtoupper($tax->applicant_city).", ".strtoupper($tax->applicant_state)." ".strtoupper($tax->applicant_zip);
        $img->text($city_and_zip, 80, 790, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });


                                    
        $img->text(strtoupper($tax->employers_ein), 120, 895, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(strtoupper($tax->applicant_ssn), 500, 895, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        // xxxxxxxxxxxxxx
        $img->text(number_format($tax->total_income,2), 120, 960, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 500, 960, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->social_security_wages,2), 120, 1025, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->social_security_tax,2), 500, 1025, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(number_format($tax->medicare_wages,2), 120, 1090, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->madicare_security_tax,2), 500, 1090, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        // xxxxxxxxxxxxxx

        $img->text(strtoupper($tax->applicant_state), 80, 1485, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });


        $id = $this->getRndInteger(100000000,999999999)."/000";
        $img->text($id, 160, 1485, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->total_income,2), 500, 1485, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 160, 1550, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });


        // xxxxxxxxxxxxxx
        $img->text(number_format($tax->total_income,2), 120, 1750, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 500, 1750, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->social_security_wages,2), 120, 1815, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->social_security_tax,2), 500, 1815, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(number_format($tax->medicare_wages,2), 120, 1880, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->madicare_security_tax,2), 500, 1880, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(strtoupper($cn), 40, 1968, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(28);
        });
        $img->text(strtoupper($dp), 322, 1968, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(28);
        });

        // xxxxxxxxxxxxxx

        $img->text(strtoupper($tax->employers_name), 80, 2088, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $img->text(strtoupper($tax->employers_street), 80, 2128, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $city_and_zip = strtoupper($tax->employers_city).", ".strtoupper($tax->employers_state)." ".strtoupper($tax->employers_zip);
        $img->text($city_and_zip, 80, 2168, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        // xxxxxxxxxxxxxx

        $img->text(strtoupper($tax->employers_ein), 120, 2310, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(strtoupper($tax->applicant_ssn), 500, 2310, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        // xxxxxxxxxx

        $img->text(strtoupper($tax->applicant_fullname), 80, 2770, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $img->text(strtoupper($tax->applicant_street), 80, 2810, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $city_and_zip = strtoupper($tax->applicant_city).", ".strtoupper($tax->applicant_state)." ".strtoupper($tax->applicant_zip);
        $img->text($city_and_zip, 80, 2850, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });

        // xxxxxxxxxx

        // $img->text(strtoupper($tax->applicant_state), 80, 2970, function($font) use ($courbdFont){
        //     $font->file($courbdFont); 
        //     $font->size(27);
        // });

        // $img->text($id, 160, 2970, function($font) use ($courbdFont){
        //     $font->file($courbdFont); 
        //     $font->size(27);
        // });
        // $img->text(number_format($tax->total_income,2), 500, 2970, function($font) use ($courbdFont){
        //     $font->file($courbdFont); 
        //     $font->size(27);
        // });
        // $img->text(number_format($tax->income_tax,2), 160, 3035, function($font) use ($courbdFont){
        //     $font->file($courbdFont); 
        //     $font->size(27);
        // });


        // PAGE 2
        // xxxxxxxxxx

        $img->text(number_format($tax->total_income,2), 1500, 750, function($font) use ($ocrb_only){
            $font->file($ocrb_only); 
            $font->size(33);
        });
        $img->text(number_format($tax->total_income,2), 1500, 790, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(33);
        });

        $img->text(number_format($tax->social_security_wages,2), 1750, 750, function($font) use ($ocrb_only){
            $font->file($ocrb_only); 
            $font->size(33);
        });
        $img->text(number_format($tax->social_security_wages,2), 1750, 790, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(33);
        });

        $img->text(number_format($tax->medicare_wages,2), 2000, 750, function($font) use ($ocrb_only){
            $font->file($ocrb_only); 
            $font->size(33);
        });
        $img->text(number_format($tax->medicare_wages,2), 2000, 790, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(33);
        });
        $img->text(number_format($tax->total_income,2), 2250, 750, function($font) use ($ocrb_only){
            $font->file($ocrb_only); 
            $font->size(33);
        });
        $img->text(number_format($tax->total_income,2), 2250, 790, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(33);
        });

        // xxxxxxxxxx

        $img->text(strtoupper($tax->applicant_fullname), 1000, 1340, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(50);
        });
        $img->text(strtoupper($tax->applicant_street), 1000, 1390, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(50);
        });
        $city_and_zip = strtoupper($tax->applicant_city).", ".strtoupper($tax->employers_state)." ".strtoupper($tax->employers_zip);
        $img->text($city_and_zip, 1000, 1430, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(50);
        });


        $img->text(strtoupper($tax->applicant_ssn), 2230, 1280, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(27);
        });


        $img->text(strtoupper($tax->applicant_gender), 2230, 1320, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(27);
        });

        $img->text(strtoupper($tax->applicant_gender), 2280, 1440, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(27);
        });

                        // xxxxxxxxxxxxxx
                        $img->text(number_format($tax->total_income,2), 1000, 1750, function($font) use ($courbdFont){
                            $font->file($courbdFont); 
                            $font->size(27);
                        });
                        $img->text(number_format($tax->income_tax,2), 1380, 1750, function($font) use ($courbdFont){
                            $font->file($courbdFont); 
                            $font->size(27);
                        });
                        $img->text(number_format($tax->social_security_wages,2), 1000, 1815, function($font) use ($courbdFont){
                            $font->file($courbdFont); 
                            $font->size(27);
                        });
                        $img->text(number_format($tax->social_security_tax,2), 1380, 1815, function($font) use ($courbdFont){
                            $font->file($courbdFont); 
                            $font->size(27);
                        });
                
                        $img->text(number_format($tax->medicare_wages,2), 1000, 1880, function($font) use ($courbdFont){
                            $font->file($courbdFont); 
                            $font->size(27);
                        });
                        $img->text(number_format($tax->madicare_security_tax,2), 1380, 1880, function($font) use ($courbdFont){
                            $font->file($courbdFont); 
                            $font->size(27);
                        });
                        $img->text(strtoupper($cn), 890, 1968, function($font) use ($courierFont){
                            $font->file($courierFont); 
                            $font->size(28);
                        });
                        $img->text(strtoupper($dp), 1160, 1968, function($font) use ($courierFont){
                            $font->file($courierFont); 
                            $font->size(28);
                        });


                 // xxxxxxxxxxxxxx
        $img->text(number_format($tax->total_income,2), 1820, 1750, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 2200, 1750, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->social_security_wages,2), 1820, 1815, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->social_security_tax,2), 2200, 1815, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(number_format($tax->medicare_wages,2), 1820, 1880, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->madicare_security_tax,2), 2200, 1880, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(strtoupper($cn), 1730, 1968, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(28);
        });
        $img->text(strtoupper($dp), 2012, 1968, function($font) use ($courierFont){
            $font->file($courierFont); 
            $font->size(28);
        });

        // xxxxxxxxxxxxxx



                $img->text(strtoupper($tax->employers_name), 910, 2088, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                $img->text(strtoupper($tax->employers_street), 910, 2128, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                $city_and_zip = strtoupper($tax->employers_city).", ".strtoupper($tax->employers_state)." ".strtoupper($tax->employers_zip);
                $img->text($city_and_zip, 910, 2168, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                // xxxxxxxxxxxxxx



        $img->text(strtoupper($tax->employers_name), 1750, 2088, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $img->text(strtoupper($tax->employers_street), 1750, 2128, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        $city_and_zip = strtoupper($tax->employers_city).", ".strtoupper($tax->employers_state)." ".strtoupper($tax->employers_zip);
        $img->text($city_and_zip, 1750, 2168, function($font) use ($boldFont){
            $font->file($boldFont); 
            $font->size(35);
        });
        // xxxxxxxxxxxxxx

        $img->text(strtoupper($tax->employers_ein), 910, 2310, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(strtoupper($tax->applicant_ssn), 1380, 2310, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(strtoupper($tax->employers_ein), 1750, 2310, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text(strtoupper($tax->applicant_ssn), 2200, 2310, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

                // xxxxxxxxxx

                $img->text(strtoupper($tax->applicant_fullname), 910, 2770, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                $img->text(strtoupper($tax->applicant_street), 910, 2810, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                $city_and_zip = strtoupper($tax->applicant_city).", ".strtoupper($tax->applicant_state)." ".strtoupper($tax->applicant_zip);
                $img->text($city_and_zip, 910, 2850, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });


                        // xxxxxxxxxx

                $img->text(strtoupper($tax->applicant_fullname), 1750, 2770, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                $img->text(strtoupper($tax->applicant_street), 1750, 2810, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });
                $city_and_zip = strtoupper($tax->applicant_city).", ".strtoupper($tax->applicant_state)." ".strtoupper($tax->applicant_zip);
                $img->text($city_and_zip, 1750, 2850, function($font) use ($boldFont){
                    $font->file($boldFont); 
                    $font->size(35);
                });


        // xxxxxxxxxx

        $img->text(strtoupper($tax->applicant_state), 80, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text($id, 160, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->total_income,2), 500, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 160, 3035, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        // xxxxxxxxxx

        $img->text(strtoupper($tax->applicant_state), 920, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text($id, 1000, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->total_income,2), 1380, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 1000, 3035, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        


        $img->text(strtoupper($tax->applicant_state), 1760, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

        $img->text($id, 1840, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->total_income,2), 2200, 2970, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });
        $img->text(number_format($tax->income_tax,2), 1840, 3035, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(27);
        });

         //***** */

         $img->text(strtoupper($tax->applicant_state).".", 1052, 3141, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(35);
        });


        $img->text(strtoupper($tax->applicant_state).".",1853, 3141, function($font) use ($courbdFont){
            $font->file($courbdFont); 
            $font->size(35);
        });



        $img->save('tax/completed/'.$time.'.png'); 

        $user = auth()->user();
        $charge = Charge::where('slug','w2')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  W2 at $".$charge->charge." #".$time,$user,"w2"); //update history

        $data = ['filename'=>$time.'.png']; // used this for image name In the page
        $pdf = PDF::loadView('tax-template/w2',compact('data'));
        return $pdf->download($time.'.pdf');








    }


}
