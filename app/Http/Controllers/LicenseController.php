<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DNS1D;
use DNS2D;
use App\Traits\License;
use App\Traits\Payment;
use App\Traits\FontTrait;
use ZipArchive;
use File;
use App\Models\LicenseImage;
use App\Models\LicenseBackground;
use App\Models\User;
use App\Models\Charge;
use App\Models\License as MyLicense;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    use License, Payment,FontTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        set_time_limit(8000000);
    }


    public function index()
    {
        $data = MyLicense::where('user_id',auth()->user()->id)->get();
        return view('license.index',compact('data'));

    }






    public function createLicense()
    {
        return view('license.create-license');
    }

    public function storeLicense(Request $request)
    {
        $this->validate($request, [ 
            'first_name' => 'required', 
            'last_name' => 'required' , 
            'issued_date' => 'required' , 
            'birth_date' => 'required' , 
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'eye_color' => 'required', 
            'hair_color' => 'required',
            'foot' => 'required' ,  
            'inches' => 'required' , 
            'weight' => 'required' , 
          ]);
       // dd($request->all());


       $birthYear = str_replace("-", "",$this->birthday($request->issued_date)['birthYear']);
       $birthMonth = str_replace("-", "",$this->birthday($request->issued_date)['birthMonth']);
       $birthDate = str_replace("-", "",$this->birthday($request->issued_date)['birthDate']);

       if(strlen($birthYear)<4){
         return  redirect()->back()->withErrors("Incorrect format for Issued Date! format should be Year-month-day: eg 2021-11-09")->withInput();
       }

       $birthYearX = str_replace("-", "",$this->birthday($request->birth_date)['birthYear']);
       $birthMonthX = str_replace("-", "",$this->birthday($request->birth_date)['birthMonth']);
       $birthDateX = str_replace("-", "",$this->birthday($request->birth_date)['birthDate']);

       if(strlen($birthYearX)<4){
         return  redirect()->back()->withErrors("Incorrect format for Date of Birth! format should be Year-month-day: eg 2021-11-09")->withInput();
       }

       $user = Auth::user();
       $user->licenses()->create($request->all());
       return  redirect()->route('license.index');
    }

  
    

    public function editLicense(MyLicense $license )
    {
        $data = $license;
        return view('license.edit-license')
        ->with('data', $data);
    }

    public function updateLicense(Request $request,MyLicense $license)
    {
        $this->validate($request, [
            'first_name' => 'required', 
            'last_name' => 'required' , 
            'issued_date' => 'required' , 
            'birth_date' => 'required' , 
            'last_name' => 'required' , 
            'street' => 'required', 
            'city' => 'required' , 
            'state' => 'required' , 
            'zip' => 'required', 
            'eye_color' => 'required', 
            'hair_color' => 'required',
            'foot' => 'required' ,  
            'inches' => 'required' , 
            'weight' => 'required' , 
          ]);


          

          $birthYear = str_replace("-", "",$this->birthday($request->issued_date)['birthYear']);
          $birthMonth = str_replace("-", "",$this->birthday($request->issued_date)['birthMonth']);
          $birthDate = str_replace("-", "",$this->birthday($request->issued_date)['birthDate']);
  
          if(strlen($birthYear)<4){
            return  redirect()->back()->withErrors("Incorrect format for Issued Date! format should be Year-month-day: eg 2021-11-09")->withInput();
          }

          $birthYearX = str_replace("-", "",$this->birthday($request->birth_date)['birthYear']);
          $birthMonthX = str_replace("-", "",$this->birthday($request->birth_date)['birthMonth']);
          $birthDateX = str_replace("-", "",$this->birthday($request->birth_date)['birthDate']);

          if(strlen($birthYearX)<4){
            return  redirect()->back()->withErrors("Incorrect format for Date of Birth! format should be Year-month-day: eg 2021-11-09")->withInput();
          }

      // dd($request->all());
        $license->dl_number= $request->dl_number ; 
        $license->first_name= $request->first_name; 
        $license->middle_name= $request->middle_name; 
        $license->last_name= $request->last_name; 
        $license->issued_date= $request->issued_date ; 
        $license->birth_date= $request->birth_date; 
        $license->street= $request->street; 
        $license->city= $request->city; 
        $license->state= $request->state; 
        $license->zip= $request->zip; 
        $license->eye_color= $request->eye_color; 
        $license->hair_color= $request->hair_color;
        $license->foot= $request->foot;  
        $license->gender= $request->gender;  
        $license->inches= $request->inches; 
        $license->weight= $request->weight;
        $license->view= $request->view;
        $license->save();
        return  redirect()->route('license.index');
    }

    public function licenseDelete(Mylicense $license)
    {
        $license->delete();
        return back();

    }




    public function photo(MyLicense $license)
    {
        $user =  User::where('role','admin')->first();
        $young = LicenseImage::where('user_id',$user->id)->where('category','young')->orderBy('id','Desc')->simplePaginate(50);
        $midAge = LicenseImage::where('user_id',$user->id)->where('category','middle')->orderBy('id','Desc')->simplePaginate(50);
        $old = LicenseImage::where('user_id',$user->id)->where('category','old')->orderBy('id','Desc')->simplePaginate(50);
        $myimages = LicenseImage::where('user_id',$license->user_id)->orderBy('id','Desc')->get();
        return view('license.photo',compact('young','midAge','old','myimages','license'));
    }

    public function background(MyLicense $license)
    {
        $user =  User::where('role','admin')->first();
        $images = LicenseBackground::where('user_id',$user->id)->orderBy('id','Desc')->simplePaginate(50);
        $myimages = LicenseBackground::where('user_id',$license->user_id)->orderBy('id','Desc')->get();
        return view('license.background',compact('images','myimages','license'));
    }

    public function getSelectedPhoto(MyLicense $license)
    {
        return response()->json([
            'success'=>$license->picture
        ]);
    }

    public function updateSelectedPhoto(Request $request,Mylicense $license)
    {
        $license->picture = $request->image;
        $license->save();
        return response()->json([
            'success'=>'get your data'
        ]);
    }


    public function getSelectedBg(MyLicense $license)
    {
        return response()->json([
            'success'=>$license->background
        ]);
    }

    public function updateSelectedBg(Request $request,Mylicense $license)
    {
        $license->background = $request->image;
        $license->save();
        return response()->json([
            'success'=>'success'
        ]);
    }







    public function uploadPhoto(Request $request)
    {
            $user =auth()->user();
            $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $file = $request->file('image');
            // for save original image
            $ogImage = Image::make($file);
            $originalPath  = public_path('license/photo/');
            $ogImage->resize(250,125, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
              });
            $newName = time().$file->getClientOriginalName();
            $ogImage =  $ogImage->save($originalPath.$newName);
            $ogImage->resize(120,120, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
              });
            $thumbPath  = public_path('license/photo/thumb/');
            $ogImage =  $ogImage->save($thumbPath.$newName);
           
           
           
           $user->licenseImages()->create([
               "image"=>  $newName,
               "category" =>"young"
           ]);

            return back()->with('success','Image has successfully uploaded.');

    }

    public function uploadBg(Request $request)
    {
        $user =auth()->user();
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           ]);
           $file = $request->file('image');
                
           // for save original image
           $ogImage = Image::make($file);
           $originalPath  = public_path('license/background/');
           $ogImage->resize(250,125);
           $newName = time().$file->getClientOriginalName();
           $ogImage =  $ogImage->save($originalPath.$newName);
           
           $user->licenseBackground()->create([
               "image"=>  $newName
           ]);

            return back()->with('success','Image has successfully uploaded.');
    }









    public function createDocument(Request $request){

        $license = MyLicense::find($request->id);

        //dd($license->picture);
        $codename =$this->codeName();
        $signatureFont = 'fonts/aAccountantSignature.ttf';
        $date = date('d F, Y'); 
        $header = "@\x0A\x1E\x0D";
        $filetype = "ANSI ";
        $iin = "XXXXXX";
        $version = "09";
        $jurVer = "00";
        $entries = "01";
        $subType = "DL";
        $offset = "XXXX";
        $lengthField = "XXXX";
        $lin = $license->dl_number;
        $inventoryNum = $this->inventoryNum();
        $docid = $this->docid();
        $audit = $this->audit();

        $compliance = "F";
        $revDate = "11272016";
        $formattedState = $license->state;
        $issue_date = $license->issued_date;
        $issueDate = $this->format_date($issue_date);
        $birthArray = $this->birthday($license->birth_date);  
        $lastName   =  strtoupper($license->last_name); 
        $middleName =  strtoupper($license->middle_name); 
        $firstName  =  strtoupper($license->first_name);
        $inches = $license->inches;
        $feet = $license->foot;
        $height = ($feet * 12) + $inches;
        //$formattedHeight = $feet . $height ." in";
        $formattedHeight = "0" . $height ." in";

//dd($feet, $inches,$formattedHeight);
        // $expiryDateFormatted = $this->format_date($license->expiry_date);
        $expiryDateFormatted = $this->getStateCredentials($formattedState,$license,$issue_date)['expiryDate'];
        $weight = $this->weight($license->weight); 
        $gender = $this->gender($license->gender); 
        $hairColor = $license->hair_colour; 
        $eyeColor = $license->eye_color; 
        $formattedStreet = strtoupper($license->street);  
        $formattedCity = strtoupper($license->city);
        $zip =  $license->zip;
        $formattedZip = $zip . $this->getRndInteger(1000, 9999) . "  ";

        $iin = $this->getStateCredentials($formattedState,$license,$issue_date)['iin']; 
        if($lin == ""){
            $lin =   $this->getStateCredentials($formattedState,$license,$issue_date)['lin'];
            $license->dl_number = $lin;
            $license->save(); // update new dl number if it was left untouched
        }



        $expiryDate= $this->getStateCredentials($formattedState,$license,$issue_date)['expiryDate'];
        $classification = $this->getStateCredentials($formattedState,$license,$issue_date)['classification'];

        $offset = strlen($header) + strlen($filetype) + strlen($iin) + strlen($version) + strlen($jurVer) + strlen($entries) + strlen($subType) + strlen($offset) + strlen($lengthField);
        $formattedOffset = "00" . $offset;
        $lengthField = strlen($subType) + strlen("DAQ") + strlen($lin) + strlen("\x0ADCS") + strlen($lastName) + strlen("\x0ADDEN\x0ADAC") 
        + strlen($firstName) + strlen("\x0ADDFN\x0ADAD") + strlen($middleName) + strlen("\x0ADDGN\x0ADCA") 
        + strlen($classification) + strlen("\x0ADCBNONE\x0ADCDNONE\x0ADBA") + strlen($expiryDate) + strlen("\x0ADBD") + strlen($issueDate) 
        + strlen("\x0ADBB") + strlen($birthArray['formattedBirthday']) + strlen("\x0ADBC") + strlen($gender) + strlen("\x0ADAY") + strlen($eyeColor) 
        + strlen("\x0ADAZ") + strlen($hairColor) + strlen("\x0ADAU") + strlen($formattedHeight) + strlen("\x0ADAG") + strlen($formattedStreet) 
        + strlen("\x0ADAI") + strlen($formattedCity) + strlen("\x0ADAJ") + strlen($formattedState) + strlen("\x0ADAK") + strlen($formattedZip) 
        + strlen("\x0ADCF") + strlen($docid) + strlen("\x0ADCGUSA\x0ADCJ") + strlen($audit) + strlen("\x0ADCK") + strlen($inventoryNum) 
        + strlen("\x0ADDA") + strlen($compliance) + strlen("\x0ADDB") + strlen($revDate) + strlen("\x0D");

        $formattedLength = "0" . $lengthField;

        $code = $header . $filetype . $iin . $version . $jurVer . $entries . $subType . $formattedOffset . $formattedLength 
        . $subType . "DAQ" . $lin . "\x0ADCS" . $lastName . "\x0ADDEN\x0ADAC" . $firstName 
        . "\x0ADDFN\x0ADAD" . $middleName . "\x0ADDGN\x0ADCA" . $classification . "\x0ADCBNONE\x0ADCDNONE\x0ADBA" 
        . $expiryDate . "\x0ADBD" . $issueDate . "\x0ADBB" . $birthArray['formattedBirthday'] . "\x0ADBC" . $gender . "\x0ADAY" 
        . $eyeColor . "\x0ADAZ" . $hairColor . "\x0ADAU" . $formattedHeight . "\x0ADAG" . $formattedStreet . "\x0ADAI" 
        . $formattedCity . "\x0ADAJ" . $formattedState . "\x0ADAK" . $formattedZip  . "\x0ADCGUSA\x0ADCF" . $docid . "\x0ADCJ" 
        . $audit . "\x0ADCK" . $inventoryNum . "\x0ADDA" . $compliance . "\x0ADDB" . $revDate . "\x0D";
    
        $mydata =$code;


        $info =[
            "last_name"   =>  $lastName,
            "middle_name" =>  $middleName,
            "first_name"  =>  $firstName,
            "street"      =>  $formattedStreet,
            "city"        =>  $formattedCity,
            "expiry_date" =>  $expiryDate,
            "revDate"    =>   $revDate,
            "dl_number"  =>  strtoupper($lin),
            "classification"  =>  strtoupper($classification),
            "codename" => $codename,
            "myfonts" => $this->font,
        ];
        
        
        $user =auth()->user();




        // checking TEXAS 
        if($license->state == "TX" && (strtotime($license->issued_date) < strtotime("02/23/2020"))  ){
            return  redirect()->back()->withErrors(array('cost' => "Incorrect Issued Date for TEXAS! TEXAS (TX) issued date should not be before 02/23/2020"));
        }



        
        /**
         *   THIS IS FRONT VIEWSSSS
         */

       // dd('eeee');


        if($license->view == "front-view"){


    
            

          // charge user
          $charge = Charge::where('slug','dl_front')->first();
          if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
          }
          $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
          $this->recordHistory("Downloaded ".$license->view." ".$license->state." DL at $".$charge->charge." #".$codename,$user,"license"); //update history


      

          


          


            switch ($license->state) {
                case 'AL':
                    $file = $this->get_AL_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'AK':
                    $file = $this->get_AK_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;       
                case 'AZ':
                    $file = $this->get_AZ_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;    
                case 'AR':
                    $file = $this->get_AR_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;    
                case 'CA':
                    $file = $this->get_CA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'CO':
                    $file = $this->get_CO_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;      
                case 'CT':
                    $file = $this->get_CT_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'DE':
                    $file = $this->get_DE_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'FL':
                    $file = $this->get_FL_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'GA':
                    $file = $this->get_GA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;  
                case 'GA_OLD':
                    $file = $this->get_GA_FRONT_OLD_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'HI':
                    $file = $this->get_HI_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'ID':
                    $file = $this->get_ID_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'IL':
                    $file = $this->get_IL_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'IN':
                    $file = $this->get_IN_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;     
                case 'IA':
                    $file = $this->get_IA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'KS':
                    $file = $this->get_KS_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'KY':
                    $file = $this->get_KY_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'LA':
                    $file = $this->get_LA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'ME':
                    $file = $this->get_ME_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;                           
                case 'MD':
                    $file = $this->get_MD_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'MA':
                    $file = $this->get_MA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;       
                case 'MI':
                    $file = $this->get_MI_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;       
                case 'MN':
                    $file = $this->get_MN_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;        
                case 'MS':
                    $file = $this->get_MS_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;       
                case 'MO':
                    $file = $this->get_MO_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'MT':
                    $file = $this->get_MT_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'NC':
                    $file = $this->get_NC_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'ND':
                    dd("ND");
                    break;                                                
                case 'NE':
                    $file = $this->get_NE_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;       
                case 'NV':
                    $file = $this->get_NV_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;     
                case 'NH':
                    $file = $this->get_NH_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;       
                case 'NJ':
                    $file = $this->get_NJ_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'NM':
                    $file = $this->get_NM_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'NY':
                    dd("NY");
                    break;                        
                case 'OH':
                    $dd = strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter()). $this->getRndInteger(1000000,9999999); 
                    $file = $this->get_OH_FRONT_File($license,$info,$classification,$dd);
                    return response()->download($file);
                    break;         
                case 'OK':
                    $file = $this->get_OK_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;      
                case 'OR':
                    $file = $this->get_OR_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;  
                case 'PA':
                    $file = $this->get_PA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;  
                case 'RI':
                    $file = $this->get_RI_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'SC':
                    $file = $this->get_SC_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'SD':
                    $file = $this->get_SD_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'TN':
                    $file = $this->get_TN_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;                   
                case 'TX':
                    $file = $this->get_TX_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break; 
                case 'UT':
                    $file = $this->get_UT_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'VT':
                    $file = $this->get_VT_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'VA':
                    dd("VA");
                    break;
                case 'WA':
                    $file = $this->get_WA_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'WV':
                    $file = $this->get_WV_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;
                case 'WI':
                    dd("WI");
                    break;
                case 'WY':
                    $file = $this->get_WY_FRONT_File($license,$info,$classification);
                    return response()->download($file);
                    break;                   
                default:
                    # code...
                    break;
            }
            

        }else if($license->view == "back-view"){
        /**
         *   THIS IS BACK  VIEWS
         */


          // charge user
          $charge = Charge::where('slug','dl_back')->first();
          if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
          }
          $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
          $this->recordHistory("Downloaded ".$license->view." ".$license->state." DL at $".$charge->charge." #".$codename,$user,"license"); //update history

            switch ($license->state) {
                case 'AL':
                    $file = $this->get_AL_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'AK':
                    $file = $this->get_AK_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'AZ':      
                    $file = $this->get_AZ_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'AR':
                    $file = $this->get_AR_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;    
                case 'CA':
                    $file = $this->get_CA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'CO':
                    $file = $this->get_CO_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;    
                case 'CT':
                    $file = $this->get_CT_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'DE':
                    $file = $this->get_DE_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'FL':
                    $file = $this->get_FL_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'GA':
                    $file = $this->get_GA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;                      
                case 'GA_OLD':
                    $file = $this->get_GA_BACK_OLD_File($license,$info,$mydata);
                    return response()->download($file);
                    break;  
                case 'HI':
                    $file = $this->get_HI_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'ID':
                    $file = $this->get_ID_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'IL':
                    $file = $this->get_IL_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'IN':
                    $file = $this->get_IN_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;    
                case 'IA':
                    $file = $this->get_IA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'KS':
                    $file = $this->get_KS_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'KY':
                    $file = $this->get_KY_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'LA':
                    $file = $this->get_LA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'ME':
                    $file = $this->get_ME_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;                   
                case 'MD':
                    $file = $this->get_MD_BACK_File($license->state,$license->background,$license->picture,$mydata,$info);
                    return response()->download($file);
                    break;
                case 'MA':
                    $file = $this->get_MA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;         
                case 'MI':
                    $file = $this->get_MI_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;       
                case 'MN':
                    $file = $this->get_MN_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;        
                case 'MS':
                    $file = $this->get_MS_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;       
                case 'MO':
                    $file = $this->get_MO_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'MT':
                    $file = $this->get_MT_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;    
                case 'NC':
                    $file = $this->get_NC_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;         
                case 'ND':
                    dd("ND");
                    break;                             
                case 'NE':
                    $file = $this->get_NE_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;         
                case 'NV':
                    $file = $this->get_NV_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;      
                case 'NH':
                    $file = $this->get_NH_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;       
                case 'NJ':
                    $file = $this->get_NJ_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;    
                case 'NM':
                    $file = $this->get_NM_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;  
                case 'NY':
                    dd("NY");
                    break;               
                case 'OH':
                    $dd = strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter()). $this->getRndInteger(1000000,9999999); 
                    $file = $this->get_OH_BACK_File($license,$info,$mydata,$dd);
                    return response()->download($file);
                    break;         
                case 'OK':
                    $file = $this->get_OK_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;     
                case 'OR':
                    $file = $this->get_OR_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'PA':
                    $file = $this->get_PA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;  
                case 'RI':
                    $file = $this->get_RI_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'SC':
                    $file = $this->get_SC_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'SD':
                    $file = $this->get_SD_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'TN':
                    $file = $this->get_TN_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;                    
                case 'TX':
                    $file = $this->get_TX_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break; 
                case 'UT':
                    $file = $this->get_UT_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'VT':
                    $file = $this->get_VT_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'VA':
                    dd("VA");
                    break;
                case 'WA':
                    $file = $this->get_WA_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'WV':
                    $file = $this->get_WV_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;
                case 'WI':
                    dd("WI");
                    break;
                case 'WY':
                    $file = $this->get_WY_BACK_File($license,$info,$mydata);
                    return response()->download($file);
                    break;                   
                default:
                    break;
            }


        }else{
        /**
         *   THIS IS BOTH VIEWSSSS
         */

        


          // charge user
          $charge = Charge::where('slug','dl_front_and_back')->first();
          if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
          }
          $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
          $this->recordHistory("Downloaded ".$license->view." ".$license->state." DL at $".$charge->charge." #".$codename,$user,"license"); //update history

            switch ($license->state) {
                case 'AL':
                    $front = $this->get_AL_FRONT_File($license,$info,$classification);
                    $back =  $this->get_AL_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'AK':
                    $front = $this->get_AK_FRONT_File($license,$info,$classification);
                    $back =  $this->get_AK_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;       
                case 'AZ':
                    $front = $this->get_AZ_FRONT_File($license,$info,$classification);
                    $back =  $this->get_AZ_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;  
                case 'AR':
                    $front = $this->get_AR_FRONT_File($license,$info,$classification);
                    $back =  $this->get_AR_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;    
                case 'CA':
                    $front = $this->get_CA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_CA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'CO':
                    $front = $this->get_CO_FRONT_File($license,$info,$classification);
                    $back =  $this->get_CO_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;   
                case 'CT':
                    $front = $this->get_CT_FRONT_File($license,$info,$classification);
                    $back =  $this->get_CT_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'DE':
                    $front = $this->get_DE_FRONT_File($license,$info,$classification);
                    $back =  $this->get_DE_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'FL':
                    $front = $this->get_FL_FRONT_File($license,$info,$classification);
                    $back =  $this->get_FL_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'GA':
                    $front = $this->get_GA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_GA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'GA_OLD':
                    $front = $this->get_GA_FRONT_OLD_File($license,$info,$classification);
                    $back =  $this->get_GA_BACK_OLD_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;      
                case 'HI':
                    $front = $this->get_HI_FRONT_File($license,$info,$classification);
                    $back =  $this->get_HI_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'ID':
                    $front = $this->get_ID_FRONT_File($license,$info,$classification);
                    $back =  $this->get_ID_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;  
                case 'IL':
                    $front = $this->get_IL_FRONT_File($license,$info,$classification);
                    $back =  $this->get_IL_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'IN':
                    $front = $this->get_IN_FRONT_File($license,$info,$classification);
                    $back =  $this->get_IN_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;      
                case 'IA':
                    $front = $this->get_IA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_IA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'KS':
                    $front = $this->get_KS_FRONT_File($license,$info,$classification);
                    $back =  $this->get_KS_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'KY':
                    $front = $this->get_KY_FRONT_File($license,$info,$classification);
                    $back =  $this->get_KY_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break; 
                case 'LA':
                    $front = $this->get_LA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_LA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;   
                case 'ME':
                    $front = $this->get_ME_FRONT_File($license,$info,$classification);
                    $back =  $this->get_ME_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;               
                case 'MD':
                    $front = $this->get_MD_FRONT_File($license,$info,$classification);
                    $back = $this->get_MD_BACK_File($license->state,$license->background,$license->picture,$mydata,$info);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'MA':
                    $front = $this->get_MA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_MA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;      
                case 'MI':
                    $front = $this->get_MI_FRONT_File($license,$info,$classification);
                    $back =  $this->get_MI_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;       
                case 'MN':
                    $front = $this->get_MN_FRONT_File($license,$info,$classification);
                    $back =  $this->get_MN_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;       
                case 'MS':
                    $front = $this->get_MS_FRONT_File($license,$info,$classification);
                    $back =  $this->get_MS_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;       
                case 'MO':
                    $front = $this->get_MO_FRONT_File($license,$info,$classification);
                    $back =  $this->get_MO_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break; 
                case 'MT':
                    $front = $this->get_MT_FRONT_File($license,$info,$classification);
                    $back =  $this->get_MT_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break; 
                case 'NC':
                    $front = $this->get_NC_FRONT_File($license,$info,$classification);
                    $back =  $this->get_NC_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;         
                case 'ND':
                    dd("ND");
                    break;                           
                case 'NE':
                    $front = $this->get_NE_FRONT_File($license,$info,$classification);
                    $back =  $this->get_NE_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;        
                case 'NV':
                    $front = $this->get_NV_FRONT_File($license,$info,$classification);
                    $back =  $this->get_NV_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;      
                case 'NH':
                    $front = $this->get_NH_FRONT_File($license,$info,$classification);
                    $back =  $this->get_NH_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;          
                case 'NJ':
                    $front = $this->get_NJ_FRONT_File($license,$info,$classification);
                    $back =  $this->get_NJ_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;     
                case 'NM':
                    $front = $this->get_NM_FRONT_File($license,$info,$classification);
                    $back =  $this->get_NM_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break; 
                case 'NY':
                    dd("NY");
                    break;                
                case 'OH':
                    $dd = strtoupper($this->getRndLetter()) . strtoupper($this->getRndLetter()). $this->getRndInteger(1000000,9999999); 
                    $front = $this->get_OH_FRONT_File($license,$info,$classification,$dd);
                    $back =  $this->get_OH_BACK_File($license,$info,$mydata,$dd);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;         
                case 'OK':
                    $front = $this->get_OK_FRONT_File($license,$info,$classification);
                    $back =  $this->get_OK_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName)); 
                case 'OR':
                    $front = $this->get_OR_FRONT_File($license,$info,$classification);
                    $back =  $this->get_OR_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break; 
                case 'PA':
                    $front = $this->get_PA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_PA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;  
                case 'RI':
                    $front = $this->get_RI_FRONT_File($license,$info,$classification);
                    $back =  $this->get_RI_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'SC':
                    $front = $this->get_SC_FRONT_File($license,$info,$classification);
                    $back =  $this->get_SC_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'SD':
                    $front = $this->get_SD_FRONT_File($license,$info,$classification);
                    $back =  $this->get_SD_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break; 
                case 'TN':
                    $front = $this->get_TN_FRONT_File($license,$info,$classification);
                    $back =  $this->get_TN_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;            
                case 'TX':
                    $front = $this->get_TX_FRONT_File($license,$info,$classification);
                    $back =  $this->get_TX_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'UT':
                    $front = $this->get_UT_FRONT_File($license,$info,$classification);
                    $back =  $this->get_UT_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'VT':
                    $front = $this->get_VT_FRONT_File($license,$info,$classification);
                    $back =  $this->get_VT_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'VA':
                    dd("VA");
                    break;
                case 'WA':
                    $front = $this->get_WA_FRONT_File($license,$info,$classification);
                    $back =  $this->get_WA_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'WV':
                    $front = $this->get_WV_FRONT_File($license,$info,$classification);
                    $back =  $this->get_WV_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;
                case 'WI':
                    dd("WI");
                    break;
                case 'WY':
                    $front = $this->get_WY_FRONT_File($license,$info,$classification);
                    $back =  $this->get_WY_BACK_File($license,$info,$mydata);
                    $fileName = $this->getZippedFile($front,$back,$codename);  // zip both files
                    return response()->download(public_path("zip/".$fileName));
                    break;                  
            default:
                # code...
                break;
        }




        }
















    }




}








    //https://hdtuto.com/article/laravel-8-resize-image-laravel-8-image-intervention-example
    //https://www.codermen.com/blog/67/how-to-write-text-on-image-in-laravel-and-save
    //https://stackoverflow.com/questions/25776534/mac-os-x-10-10-php-5-5-14-free-type-support
    //https://docs.scandit.com/parser/dlid.html
    //https://github.com/milon/barcode