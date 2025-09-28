<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LicenseImage;
use App\Models\LicenseBackground;
use App\Models\User;
use App\Models\Voidcheck; 
use Illuminate\Support\Facades\Auth;
use App\Models\Charge;
use Image;
use App\Traits\Payment;
use App\Traits\FontTrait;
use App\Traits\FormatTrait;
use App\Traits\VoidcheckTrait;
use App\Traits\License;

class VoidcheckController extends Controller
{

    use License,Payment,FontTrait,FormatTrait,VoidcheckTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
      $this->middleware(['auth', 'verified']);
    }



    public function index()
    {
        $data = Voidcheck::where('user_id',auth()->user()->id)->get();
        return view('voidchecks.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voidchecks.create');
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
            'company_name' => 'required', 
            'company_street' => 'required', 
            'company_city' => 'required', 
            'company_state' => 'required', 
            'company_zip' => 'required', 
            'bank_name' => 'required', 
            'bank_street' => 'required', 
            'bank_city' => 'required', 
            'bank_state' => 'required', 
            'bank_zip' => 'required', 
            'account_no'=> 'required',
            'routing_no'=> 'required',
            'type'=> 'required',
          ]);

          $user = auth()->user();
          $user->voidchecks()->create($request->all());
          return  redirect()->route('voidcheck.index');

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
    public function edit(Voidcheck $voidcheck)
    {
        
        return view('voidchecks.edit')
        ->with('data', $voidcheck)->with('state_arr',$this->state_arr)->with("array_type",$this->array_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voidcheck $voidcheck)
    {
        $this->validate($request, [ 
            'company_name' => 'required', 
            'company_street' => 'required', 
            'company_city' => 'required', 
            'company_state' => 'required', 
            'company_zip' => 'required', 
            'bank_name' => 'required', 
            'bank_street' => 'required', 
            'bank_city' => 'required', 
            'bank_state' => 'required', 
            'bank_zip' => 'required', 
            'account_no'=> 'required',
            'routing_no'=> 'required',
            'type'=> 'required',
          ]);
    //    $user = auth()->user();
    //    $user->voidchecks()->update($request->except(['_token', '_method' ]));
        $voidcheck->update($request->except(['_token', '_method' ]));
        return  redirect()->route('voidcheck.index');
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

    public function delete(Voidcheck $voidcheck)
    {
        $voidcheck->delete();
        return back();
    }



    public function uploadLogo(Voidcheck $voidcheck)
    {
        $user = Auth::user();
        $data = Voidcheck::where('id',$voidcheck->id)->orderBy('id','DESC')->first();
        return view('voidchecks.logo')->with('data', $data);
    }


    public function postUploadLogo(Request $request)
    {
       
        $s = Voidcheck::find($request->voidcheck_id);




        if($s->logo != null && $s->logo != "logo.png"){
         // return  "theres an image there";
          $Image  = public_path('voidchecks/logos/'.$s->logo);
          if( file_exists($Image)){
            unlink($Image);
          }
        }




        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           ]);
           $file = $request->file('image');
                
           // for save original image
           $ogImage = Image::make($file);
           $originalPath  = public_path('voidchecks/logos/');
           $ogImage->resize(100,100, function($constraint){
             $constraint->aspectRatio();
             $constraint->upsize();
           });
           $name_remove = preg_replace('/[^A-Za-z0-9\.]/','_',$file->getClientOriginalName());
           $newName = time().$name_remove;
           $ogImage =  $ogImage->save($originalPath.$newName);
           
           
           $s->logo =   $newName;
           $s->save();

            return back()->with('success','Logo has successfully uploaded.');

    }



    public function background(Voidcheck $voidcheck)
    {
        $user =  User::where('role','admin')->first();
        $images = LicenseBackground::where('user_id',$user->id)->orderBy('id','Desc')->paginate(50);
        return view('voidchecks.background',compact('images','voidcheck'));
    }



    public function getSelectedBg(Voidcheck $voidcheck)
    {
        return response()->json([
            'success'=>$voidcheck->background
        ]);
    }

    public function updateSelectedBg(Request $request,Voidcheck $voidcheck)
    {
        $voidcheck->background = $request->image;
        $voidcheck->save();
        return response()->json([
            'success'=>'get your data'
        ]);
    }







    public function createDocument(Request $request)
    {

        $data = Voidcheck::find($request->id);
        $time = time().$this->codeName().rand(1000,9999);    

        $info = [
            "time" => $time,
            "ocrb_only" => $this->font['ocrb_only'],
            "OCRAStdFont" => $this->font['OCRAStdFont'],
            "micFont" => $this->font['micFont'],
            "micRegularFont" => $this->font['micRegularFont'],
            "boldFont" => $this->font['boldFont'],
            "normalFont" => $this->font['normalFont'],
        ];

        $user = auth()->user();
        $charge = Charge::where('slug','pp')->first();
        if($this->check_if_there_is_enough_credit($user->wallet,$charge->charge) === false){
        return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$charge->charge);  //update cost
        $this->recordHistory("Downloaded  ".$data->type." at $".$charge->charge." #".$time,$user,$data->type); //update history
        
        switch ($data->type) {
            case 'void1':
                $file = $this->void1($data,$info);
                return response()->download($file);
                break;
            case 'void2':
                $file = $this->void2($data,$info);
                return response()->download($file);
                break;  
            case 'void3':
                $file = $this->void3($data,$info);
                return response()->download($file);
                break;          
            default:
                $file = $this->void4($data,$info);
                return response()->download($file);
                break; 
        }



        
    }











}
