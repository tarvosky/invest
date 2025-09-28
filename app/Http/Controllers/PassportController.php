<?php

namespace App\Http\Controllers;

use Image;
use DNS1D;
use DNS2D;
use ZipArchive;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passport; 
use Illuminate\Support\Facades\Auth;
use File;
use App\Models\LicenseImage;
use App\Models\LicenseBackground;
use App\Traits\License;
use App\Traits\Payment;
use App\Models\Charge;

class PassportController extends Controller
{
    use License, Payment;
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
        $charge = Charge::where('slug','pp')->first();
        $data = Passport::where('user_id',auth()->user()->id)->get();
        return view('passports.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('passports.create');
    }


    public function conv_num($num) {
        if ($num <= 9) {
            $num = "0".$num;
        }
        return $num;
    }

    public function sortDate($issued_date) {
 
        $birthYear = $this->birthday($issued_date)['birthYear'];
        $birthMonth = $this->birthday($issued_date)['birthMonth'];
        $birthDate = $this->birthday($issued_date)['birthDate'];
        $year = $birthYear + 10;

        $ty = ['04','06','09','11',];
        
        if($birthDate == "01"){
                if(in_array($birthMonth,$ty)){
                    $birthDate = "29";
                    $birthMonth = $birthMonth -1;
                    $birthMonth = $this->conv_num($birthMonth);
                }elseif($birthMonth == "03"){
                    $birthDate = "28";
                    $birthMonth = $birthMonth -1;
                    $birthMonth = $this->conv_num($birthMonth);
                }else{
                    $birthDate = "31";
                    $birthMonth = $birthMonth -1;
                    $birthMonth = $this->conv_num($birthMonth);
                }
        }else{
            $birthDate = $birthDate -1;
            $birthDate = $this->conv_num($birthDate);
        }
        $date = $year ."-". $birthMonth ."-". $birthDate;
        return $date;
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
            'issued_date' => 'required', 
            'birth_date' => 'required',  
            'birth_place' => 'required', 
          ]);
       // dd($request->all());


       $passport_number = $this->getRndInteger(100000000, 999999999);
       if($request->passport_number != null || $request->passport_number != ""){
        $passport_number = $request->passport_number;
        }

       $user = Auth::user();
       $user->passports()->create([
        'first_name' =>  $request->first_name , 
        'last_name' =>   $request->last_name  , 
        'expiry_date' => $this->sortDate($request->issued_date), 
        'issued_date' => $request->issued_date, 
        'birth_date' =>  $request->birth_date,  
        'birth_place' => $request->birth_place , 
        'gender'       => $request->gender,
        'passport_number' => $passport_number ,
        'view'            => $request->view, 
        'background'      => $request->background, 
        'picture'         => $request->picture, 
       ]);
        return  redirect()->route('passports.index');
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
    public function edit(Passport $passport)
    {
        return view('passports.edit')
        ->with('data', $passport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passport $passport)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required' , 
            'issued_date' => 'required', 
            'birth_date' => 'required',  
            'birth_place' => 'required', 
          ]);
          $rand =$this->getRndInteger(100000000, 999999999);
          $passport_number = $request->passport_number;
          if($request->passport_number == null || $request->passport_number == "" ){
            $passport_number = $rand;
          }

          $passport->first_name= $request->first_name; 
          $passport->last_name= $request->last_name; 
          $passport->expiry_date= $this->sortDate($request->issued_date); 
          $passport->birth_date= $request->birth_date; 
          $passport->issued_date= $request->issued_date; 
          $passport->view= $request->view; 
          $passport->birth_place= $request->birth_place; 
          $passport->gender= $request->gender; 
          $passport->passport_number = $passport_number ;
          $passport->save();
          return  redirect()->route('passports.index');
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

    public function passportDelete(Passport $passport)
    {
        $passport->delete();
        return back();
    }

    public function photo(Passport $passport)
    {
        $user =  User::where('role','admin')->first();
        $young = LicenseImage::where('user_id',$user->id)->where('category','young')->orderBy('id','Desc')->simplePaginate(50);
        $midAge = LicenseImage::where('user_id',$user->id)->where('category','middle')->orderBy('id','Desc')->simplePaginate(50);
        $old = LicenseImage::where('user_id',$user->id)->where('category','old')->orderBy('id','Desc')->simplePaginate(50);
        $myimages = LicenseImage::where('user_id',$passport->user_id)->orderBy('id','Desc')->get();
        return view('passports.photo',compact('young','midAge','old','myimages','passport'));
    }

    public function background(Passport $passport)
    {
        $user =  User::where('role','admin')->first();
        $images = LicenseBackground::where('user_id',$user->id)->orderBy('id','Desc')->simplePaginate(50);
        return view('passports.background',compact('images','passport'));
    }

    public function getSelectedBg(Passport $passport)
    {
        return response()->json([
            'success'=>$passport->background
        ]);
    }

    public function updateSelectedBg(Request $request,Passport $passport)
    {
        $passport->background = $request->image;
        $passport->save();
        return response()->json([
            'success'=>'get your data'
        ]);
    }

    public function getSelectedPic(Passport $passport)
    {
        return response()->json([
            'success'=>$passport->picture
        ]);
    }

    public function updateSelectedPic(Request $request,Passport $passport)
    {
        $passport->picture = $request->image;
        $passport->save();
        return response()->json([
            'success'=>'get your data'
        ]);
    }


   

    public  function month($monthNumber) {
        switch ($monthNumber) {
            case '01':
                return "Jan";
                break;
            case '02':
                return "Feb";
                break;  
            case '03':
                return "Mar";
                break;  
            case '04':
                return "Apr";
                break;
            case '05':
                return "May";
                break;  
            case '06':
                return "Jun";
                break;   
            case '07':
                return "Jul";
                break;
            case '08':
                return "Aug";
                break;  
            case '09':
                return "Sep";
                break;   
            case '10':
                return "Oct";
                break;
            case '11':
                return "Nov";
                break;  
            default:
                return "Dec";
                break;    
        }
    }

   
    public  function frenchMonth($monthNumber) {
        switch ($monthNumber) {
            case '01':
                return "Jan";
                break;
            case '02':
                return "FÉV";
                break;  
            case '03':
                return "MAR";
                break;  
            case '04':
                return "AVR";
                break;
            case '05':
                return "MAI";
                break;  
            case '06':
                return "JUN";
                break;   
            case '07':
                return "JUL";
                break;
            case '08':
                return "AOÛ";
                break;  
            case '09':
                return "SEP";
                break;   
            case '10':
                return "OCT";
                break;
            case '11':
                return "NOV";
                break;  
            default:
                return "DÉC";
                break;    
        }
    }
    


    public  function dateFormatPee($birthday) {
        $birthYear  = substr($birthday,0,4);
        $birthMonth = substr($birthday,5,2);
        $birthDate  = substr($birthday,8,2);
        $month= $this->month($birthMonth);
        $formattedBirthday = $birthDate." ".$month ." ". $birthYear;
        //1999-07-15
        $arr =[
            "birthYear"=>$birthYear,
            "birthMonth"=>$birthMonth,
            "birthDate"=>$birthDate,
            "formattedBirthday"=>$formattedBirthday 
        ];
        return $arr;
    }


    public  function dateFormatUK($birthday) {
        $birthYear  = substr($birthday,0,4);
        $birthMonth = substr($birthday,5,2);
        $birthDate  = substr($birthday,8,2);
        $birthYear_format  = substr($birthYear,2,2);
        $month= strtoupper($this->month($birthMonth));
        $frenchMonth= strtoupper($this->frenchMonth($birthMonth));
        $formattedBirthday = $birthDate."  ".$month ."  "."/ ". $frenchMonth. "  ".$birthYear_format;
        //1999-07-15
        $arr =[
            "birthYear"=>strtoupper($birthYear),
            "birthMonth"=>strtoupper($birthMonth),
            "birthDate"=>strtoupper($birthDate),
            "formattedBirthday"=>strtoupper($formattedBirthday) 
        ];
        return $arr;
    }


    public function arrows($nameCount,$arrowCount){
        $realArrowNo;
        if($nameCount > 6){
          $r =  $nameCount - 6; 
         $realArrowNo = $arrowCount - $r;
        }else{
            $realArrowNo = $arrowCount;  
        }
        return $realArrowNo;
    }





    public function getDoc_US($passport,$info){
        // this will create the arrows


       // dd($this->dateFormatPee($passport->birth_date)['birthMonth']);




        $arrow_string="";
        $nameCount = strlen($passport->last_name) + strlen($passport->first_name); 
        $arrow = $this->arrows($nameCount,35);
        for($i=0;$i< $arrow ; $i++){
            $arrow_string .="<";
        }

        $time = $info['codename']."PPUS".time();
        $mf= $info['myFont'];
        $cash = $info['cash'];
        $signFont= $info['signFont'];
        $sign_medium = $info['sign_medium'];
        $bgImage = "passport/templates/US.png";
        $img = Image::make($bgImage); 
        // signature



        $sign_name = substr(strtolower($passport->first_name),0,5);
        $img->text($sign_name, 320, 495, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(60);
        });
        $sign_name = strtoupper(substr($passport->last_name,0,1)) ;
        $img->text($sign_name, 320, 500, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(60);
        });
        $photoImage = Image::make('license/photo/'.$passport->picture);
        $photoImage->resize(233, 217); 
        $photoImage->opacity(70); 
        $photoImage->crop(194, 217, 25,0 );
        $img->insert($photoImage,'bottom-left',98, 261); //picture y + up


        // values
        $img->text( strtoupper($passport->last_name), 318, 677, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( strtoupper($passport->first_name), 318, 716, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });

        $img->text( strtoupper($info['passport_number']), 600, 639, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });



        $n = ($passport->view == "US") ? "UNITED STATES OF AMERICA":"UNITED KINGDOM";
        $img->text( $n, 318, 750, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( $this->dateFormatPee($passport->birth_date)['formattedBirthday'], 318, 788, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $c = ($passport->view == "US") ? "USA":"UK";
        $where = strtoupper($passport->birth_place);
        $img->text( $where, 318, 825, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( strtoupper($passport->gender), 690, 825, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( $this->dateFormatPee($passport->issued_date)['formattedBirthday'], 318, 862, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( $this->dateFormatPee($passport->expiry_date)['formattedBirthday'], 318, 899, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $firstLine = "P<USA".strtoupper($passport->last_name)."<".strtoupper($passport->first_name).$arrow_string;
        $img->text( $firstLine, 99, 1000, function($font) use ($mf){
            $font->file($mf); 
            $font->size(19);
        }); //$this->getRndInteger(0, 9)
        $secondline = strtoupper($info['passport_number']).$this->getRndInteger(0, 9)."USA". substr($this->dateFormatPee($passport->birth_date)['birthYear'],2,2).$this->dateFormatPee($passport->birth_date)['birthMonth'].$this->dateFormatPee($passport->birth_date)['birthDate'].$this->getRndInteger(0, 9).$passport->gender.
        $this->getRndInteger(1000000000, 99999999999).$this->getRndInteger(100000, 999999)."<<".$this->getRndInteger(1000000, 9999999);
        $img->text( $secondline, 99, 1030, function($font) use ($mf){
            $font->file($mf); 
            $font->size(19);
        });

        

        $img->save('passport/destination/'.$time.'.png');  
        $background = $info['background'];
        $background->insert('passport/destination/'.$time.'.png','center');
        $background->save('passport/final/'.$time.'.png');  
        $file= public_path(). '/passport/final/'.$time.'.png';

        return $file;
    }


    public function getDoc_UK($passport,$info){
        // this will create the arrows
        $arrow_string="";
        $nameCount = strlen($passport->last_name) + strlen($passport->first_name); 
        $arrow = $this->arrows($nameCount,31);
        for($i=0;$i< $arrow ; $i++){
            $arrow_string .="<";
        }

        $time = $info['codename']."PPUK".time();
        $mf= $info['myFont'];
        $cash = $info['cash'];
        $signFont= $info['signFont'];
        $perforated = $info['perforated'];
        $perforated_bold = $info['perforated_bold'];
        $bgImage = "passport/templates/UK.png";
        $img = Image::make($bgImage); 

        // signature
        $sign_name = substr(strtolower($passport->first_name),0,5);
        $img->text($sign_name, 530, 875, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(40);
        });
        $sign_name = strtoupper(substr($passport->last_name,0,1)) ;
        $img->text($sign_name, 530, 880, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(45);
        });



        // parforated
        $pp = strtoupper($info['passport_number']);
        $img->text( $pp, 715, 490, function($font) use ($perforated){
            $font->file($perforated); 
            $font->angle(90);
            $font->size(45);
        });
   
        $img->text($pp , 683, 575, function($font) use ($perforated){
            $font->file($perforated); 
            $font->angle(-90);
            $font->size(45);
            $font->color('#666666');
        });
        

        $photoImage = Image::make('license/photo/'.$passport->picture);
        $photoImage->resize(233, 217); 
        $photoImage->opacity(50); 
        $photoImage->crop(175, 217, 25,0 );
        $photoImage->greyscale(); 
        $img->insert($photoImage,'top-right',135, 181); //picture y + up


        $photoImage = Image::make('license/photo/'.$passport->picture);
        $photoImage->resize(233, 217); 
        $photoImage->opacity(40); 
        $photoImage->crop(186, 217, 25,0 );
        $img->insert($photoImage,'bottom-left',98, 211); //picture y + up

        $img->text( "P", 300, 620, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( "GBR", 410, 620, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( strtoupper($info['passport_number']), 490, 620, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });

        //values
        $img->text( strtoupper($passport->last_name), 300, 653, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( strtoupper($passport->first_name), 300, 688, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });

        $img->text( "BRITISH CITIZEN", 300, 718, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( $this->dateFormatUK($passport->birth_date)['formattedBirthday'], 300, 750, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });

        $img->text( strtoupper($passport->gender), 300, 782, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        
        $where = strtoupper($passport->birth_place);
        $img->text( $where, 400, 782, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });

        $img->text( $this->dateFormatUK($passport->issued_date)['formattedBirthday'], 300, 814, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $where = strtoupper($passport->birth_place);
        $img->text( $where, 505, 814, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $img->text( $this->dateFormatUK($passport->expiry_date)['formattedBirthday'], 300, 846, function($font) use ($cash){
            $font->file($cash); 
            $font->size(18);
        });
        $firstLine = "P<GBR".strtoupper($passport->last_name)."<<".strtoupper($passport->first_name).$arrow_string;
        $img->text( $firstLine, 95, 930, function($font) use ($mf){
            $font->file($mf); 
            $font->size(20);
        }); //$this->getRndInteger(0, 9)
        $secondline = strtoupper($info['passport_number']).$this->getRndInteger(0, 9)."GBR". substr($this->dateFormatPee($passport->birth_date)['birthYear'],2,2).$this->dateFormatPee($passport->birth_date)['birthMonth'].$this->dateFormatPee($passport->birth_date)['birthDate'].$this->getRndInteger(0, 9).$passport->gender.
        $this->getRndInteger(1000000, 9999999)."<<<<<<<<<<<<<<".$this->getRndInteger(10, 99);
        $img->text( $secondline, 95, 963, function($font) use ($mf){
            $font->file($mf); 
            $font->size(20);
        });

        

        $img->save('passport/destination/'.$time.'.png');  
        $background = $info['background'];
        $background->insert('passport/destination/'.$time.'.png','center');
        $background->save('passport/final/'.$time.'.png');  
        $file= public_path(). '/passport/final/'.$time.'.png';

        return $file;
    }


    public function createDocument(Request $request){

        $passport = Passport::find($request->id);
        $perforated = 'fonts/perforated.ttf';
        $perforated_bold = 'fonts/perforated_bold.ttf';
        $sign_medium = 'fonts/sign_medium.ttf';
        $signFont = 'fonts/Autograf_PersonalUseOnly.ttf';
        $myFont = 'fonts/ocrb10.ttf';
        $cash = "fonts/wcash.org.ttf";
        $time = $this->codeName();
        $bg = "license/background/".$passport->background;
        $pic = "license/photo/".$passport->picture;
        $background = Image::make($bg);
        $background->resize(900, 1200);
        $rand =$this->getRndInteger(100000000, 999999999);
        $passport_number = $passport->passport_number;




        $info =[
            "myFont" => $myFont,
            "cash" => $cash,
            "perforated" => $perforated,
            "perforated_bold" => $perforated_bold,
            "signFont" => $signFont,
            "sign_medium" =>$sign_medium,
            "codename" =>$time,
            "background" => $background,
            "passport_number" =>$passport_number,
        ];

        $user =auth()->user();
        // charge user
        $charge = Charge::where('slug','pp')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded ".$passport->view." passport at $".$charge->charge." #".$time,$user,"passport"); //update history
        if($passport->view == "US"){
            $file = $this->getDoc_US($passport,$info);
            return response()->download($file);
        }else{
            $file = $this->getDoc_UK($passport,$info);
            return response()->download($file);
        }
    }





    public function postUploadLogo(Request $request)
    {
       
        $s = Passport::find($request->passport_id);

        if($s->picture != null){
         // return  "theres an image there";
          $Image  = public_path('license/photo/'.$s->picture);
          if( file_exists($Image)){
            unlink($Image);
          }
        }

        $user =auth()->user();



        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           ]);
           $file = $request->file('image');
                
           // for save original image
           $ogImage = Image::make($file);
           $originalPath  = public_path('license/photo/');
           $ogImage->resize(250,125);
           $newName = time().$file->getClientOriginalName();
           $ogImage =  $ogImage->save($originalPath.$newName);
           $ogImage->resize(120,120);
           $thumbPath  = public_path('license/photo/thumb/');
           $ogImage =  $ogImage->save($thumbPath.$newName);
           
           
           $user->licenseImages()->create([
            "image"=>  $newName,
            "category" => "young",
           ]);

            return back()->with('success','picture has successfully uploaded.');

    }








}
