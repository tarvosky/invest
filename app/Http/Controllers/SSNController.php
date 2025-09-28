<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Image;
use DNS1D;
use DNS2D;
use App\Traits\License;
use App\Traits\Payment;
use App\Traits\FormatTrait;
use ZipArchive;
use File;
use App\Models\LicenseImage;
use App\Models\LicenseBackground;
use App\Models\User;
use App\Models\SSN; 
use Illuminate\Support\Facades\Auth;
use App\Models\Charge;

class SSNController extends Controller
{
    use License, Payment,FormatTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        set_time_limit(8000000);
    }

    public function index()
    {
        $data = SSN::where('user_id',auth()->user()->id)->get();
        return view('socials.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        return view('socials.create');
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
            'first_name' => 'required', 
            'last_name' => 'required' , 
            'ssn' => 'required|digits:9|numeric' ,  
          ]);
       // dd($request->all());
       $user = Auth::user();
       $user->ssn()->create([
        'first_name'=> $request->first_name,
        'last_name'=> $request->last_name,
        'ssn'=> $this->numberToSSN($request->ssn),
        'view'=> $request->view,
        'background'=> 'sample.png',
       ]);
        return  redirect()->route('socials.index');
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
    public function edit(SSN $social)
    {
        $data = $social;
        $ssn_number = $this->ConvertToNumber($social->ssn);
        return view('socials.edit')
        ->with('data', $data)
        ->with('ssn_number', $ssn_number);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SSN $social)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required' , 
            'ssn' => 'required|digits:9|numeric' ,  
          ]);
          $social->first_name= $request->first_name; 
          $social->last_name= $request->last_name; 
          $social->ssn=  $this->numberToSSN($request->ssn); 
          $social->view= $request->view; 
          $social->save();
          return  redirect()->route('socials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SSN $social)
    {
        $social->delete();
        return back();
    }
    public function socialDelete(SSN $social)
    {
        $social->delete();
        return back();
    }




    public function background(SSN $social)
    {
        $user =  User::where('role','admin')->first();
        $images = LicenseBackground::where('user_id',$user->id)->orderBy('id','Desc')->paginate(50);
        return view('socials.background',compact('images','social'));
    }



    public function getSelectedBg(SSN $social)
    {
        return response()->json([
            'success'=>$social->background
        ]);
    }

    public function updateSelectedBg(Request $request,SSN $social)
    {
        $social->background = $request->image;
        $social->save();
        return response()->json([
            'success'=>'get your data'
        ]);
    }


    public function ssnDate(){

        $m = $this->getRndInteger(1,12);
        if ($m <= 9) {
            $m = "0".$m;
        }
        $d = $this->getRndInteger(1,30);
        if ($d <= 9) {
            $d = "0".$d;
        }
        $y = $this->getRndInteger(2001,2005);

        return $m."/".$d."/".$y;
    }




    public function getFrontFile($social,$info){


        $time = $info['codename']."xxx".$this->codeName();
        $mf= $info['myFont'];
        $signFont= $info['signFont'];
        $bgImage = "ssn/templates/SSN_FRONT.png";
        $img = Image::make($bgImage); 
        $sign_name = substr(strtolower($social->first_name),0,5);
        $img->text($sign_name, 320, 390, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(70);
        });
        $sign_name = substr(strtoupper($social->last_name),0,1) ;
        $img->text($sign_name, 322, 390, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(72);
        });
        $img->text($social->ssn, 250, 220, function($font) use ($mf){
            $font->file($mf); 
            $font->size(45);
        });
        $name = strtoupper($social->first_name)." ".strtoupper($social->last_name);
        $img->text($name, 400, 305, function($font) use ($mf){
            $font->file($mf); 
            $font->align('center');
            $font->size(40);
        });

        $img->text($this->ssnDate(), 445, 435, function($font) use ($mf){
            $font->file($mf); 
            $font->size(33);
        });

        $img->save('ssn/destination/'.$time.'.png');  
        $background = $info['background'];
        $background->insert('ssn/destination/'.$time.'.png','center');
        $background->save('ssn/final/'.$time.'.png');  
        $file= public_path(). '/ssn/final/'.$time.'.png';

        return $file;
    }
 

    public function getBackFile($social,$info){
        $time = $info['codename']."xxx".$this->codeName();
        $val = strtoupper($this->getRndLetter()).$this->getRndInteger(10000000, 99999999);
        $mf= $info['myFont'];
        $signFont= $info['signFont'];
        $bgImage = "ssn/templates/SSN_BACK.png";
        $img = Image::make($bgImage); 
        $img->text($val, 490, 435, function($font) use ($mf){
            $font->file($mf); 
            $font->size(43);
            $font->color("#e02b2b");
        });
        $img->save('ssn/destination/'.$time.'.png');  
        $background = $info['background'];
        $background->insert('ssn/destination/'.$time.'.png','center');
        $background->save('ssn/final/'.$time.'.png');  
        $file= public_path(). '/ssn/final/'.$time.'.png';
        return $file;
        
    }




    public function createDocument(Request $request){
        $codename = $this->codeName();
        $social = SSN::find($request->id);
        $myFont = 'fonts/OCR-B10BT.ttf';
        $signFont = 'fonts/Autograf_PersonalUseOnly.ttf';
        $time = $this->codeName();
        $bg = "license/background/".$social->background;
        $background = Image::make($bg);
        $background->resize(920, 620);


        $info =[
            "myFont" => $myFont,
            "signFont" => $signFont,
            "time" =>$time,
            "background" => $background,
            "codename" => $codename
        ];

        $user =auth()->user();
        // charge user


    
        if($social->view == "front-view"){
            $file = $this->getFrontFile($social,$info);
            $charge = Charge::where('slug','ssn_front')->first();
            if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
            }
            $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
            $this->recordHistory("Downloaded ".$social->view." SSN at $".$charge->charge." #".$codename,$user,"ssn"); //update history

            return response()->download($file);
        }elseif($social->view == "back-view"){
            $file = $this->getBackFile($social,$info);
            $charge = Charge::where('slug','ssn_back')->first();
            if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
            }
            $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
            $this->recordHistory("Downloaded ".$social->view." SSN at $".$charge->charge." #".$codename,$user,"ssn"); //update history

            return response()->download($file);
        }else{
            $front = $this->getFrontFile($social,$info);
            $back =  $this->getBackFile($social,$info);
            $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
            $charge = Charge::where('slug','ssn_front_and_back')->first();
            if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
            }
            $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
            $this->recordHistory("Downloaded ".$social->view." SSN at $".$charge->charge." #".$codename,$user,"ssn"); //update history

            return response()->download(public_path("zip/".$fileName));
        }


    }
} 