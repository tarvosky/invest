<?php

namespace App\Http\Controllers;

use App\Models\Divorce;
use Illuminate\Http\Request;
use App\Traits\FontTrait;
use App\Traits\Payment;
use App\Models\Charge;
use App\Traits\FormatTrait;
use App\Traits\UtilityTrait;
use App\Traits\License;
use Image;
use PDF;

class DivorceController extends Controller
{
    use License,Payment,FontTrait,FormatTrait,UtilityTrait;
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
        $charge = Charge::where('slug','divorce')->first();
        $data = Divorce::where('user_id',auth()->user()->id)->orderBy('id','Desc')->get();
        return view('divorce.index',compact('data','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divorce.create');
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
            'court_house_name' => 'required', 
            'county' => 'required',
            'husband_name' => 'required', 
            'wife_name' => 'required', 
            'issued_date' => 'required',
            'divorce_date' => 'required',
            'judge_first_name' => 'required',
            'judge_last_name' => 'required',
          ]);
       // dd($request->all());
       $user = auth()->user();
       $user->divorces()->create($request->all());
       return  redirect()->route('divorce-certificate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function show(Divorce $divorce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function edit(Divorce $divorce_certificate)
    {
        return view('divorce.edit')->with('data',$divorce_certificate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Divorce $divorce_certificate)
    {
        $this->validate($request, [ 
            'court_house_name' => 'required', 
            'husband_name' => 'required', 
            'wife_name' => 'required', 
            'issued_date' => 'required',
            'divorce_date' => 'required',
            'judge_first_name' => 'required',
            'judge_last_name' => 'required',
          ]);
       // dd($request->all());
    //    $user = auth()->user();
       $divorce_certificate->update($request->except(['_token', '_method' ]));
       return  redirect()->route('divorce-certificate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divorce $divorce_certificate)
    {
        $divorce_certificate->delete();
        return back();
    }






    public function createDocument(Request $request)
    {

        $data = Divorce::find($request->id);
        $time = time().$this->codeName().rand(1000,9999);    
        $codename = $this->codeName().time();
        $user = auth()->user();
        if($this->check_if_there_is_enough_credit($user->wallet,$request->cost) === false){
            return  redirect()->back()->withErrors(array('cost' => "insufficient funds!"));
        }
        $this->remove_from_wallet_and_update($user,$request->cost);  //update cost 
        $this->recordHistory("Downloaded Divorce Certificate at $".$request->cost." #".$codename,$user,"divorce");// recording history
      


        $normalFont = $this->myfont['normalFont'];
        $l_font = $this->myfont['boldFont'];
        $BigFont = $this->myfont['BigFont'];
        $arialnFont = $this->font['arialnFont'];
        $ocrb_only = $this->font['ocrb_only'];
        $signFont = $this->font['signFont3'];
       // $bg = "divorce/template/".$divorce->type;
        $bg = "divorce/templates/divorce1.png";
        $img = Image::make($bg); 
        $img->text(strtoupper($data->court_house_name), 370, 137, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(30);
        });
        $img->text("( ".ucwords(strtolower($data->county))." )", 450, 170, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(25);
        });
        $img->text(ucwords(strtolower($data->husband_name)), 430, 390, function($font) use ($BigFont){
            $font->file($BigFont); 
            $font->color("#c7ce64"); 
            $font->size(30);
        });
        $img->text(ucwords(strtolower($data->wife_name)), 570, 468, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(18);
        });
        $img->text($this->monthShort_day_year($data->divorce_date), 390, 497, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(18);
        });

        $img->text(ucwords(strtolower($data->court_house_name))." ( ".ucwords(strtolower($data->county))." )", 560, 497, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(18);
        });
        $img->text($this->monthShort_day_year($data->issued_date), 510, 542, function($font) use ($normalFont){
            $font->file($normalFont); 
            $font->size(18);
        });

        $sign_name = substr(strtolower($data->judge_first_name),0,5);
        $img->text($sign_name, 470, 640, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(50);
        });
        $sign_name = strtoupper(substr($data->judge_last_name,0,1)) ;
        $img->text($sign_name, 470, 645, function($font) use ($signFont){
            $font->file($signFont); 
            $font->size(50);
        });


        $img->text(ucwords(strtolower($data->judge_first_name))." ".ucwords(strtolower($data->judge_last_name)) , 470, 670, function($font) use ($l_font){
            $font->file($l_font); 
            $font->size(18);
        });

    
    
        $img->save('divorce/destination/'.$time.'.png');   
        $file= public_path(). '/divorce/destination/'.$time.'.png';
        return response()->download($file);

        
    }    






}
