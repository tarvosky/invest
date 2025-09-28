<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Statement;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
      $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $b= Bank::where('slug','customize-any-bank')->first();
        $user = Auth::user();
        $data = Statement::where('user_id',$user->id)->where('bank_id',"!=",$b->id)->orderBy('id','DESC')->get();
        return view('statements.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    $banks = Bank::where('slug','!=','customize-any-bank')->get();
        return view('statements.create-statement')->with('banks',$banks);
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
        'full_name' => ['required', 'string'], 
        'address' => ['required' ], 
        'city' => ['required', 'string'],
        'state' => ['required', 'string'],
        'zip' => ['required' ],
        'bank_id' => ['required' ],
        'account_card_number' => ['required', 'numeric', ],
        'routing_number' => ['required'],
        'fromDate' => ['required'],
        'opening_balance' => ['required', 'numeric', ],
        'toDate' => ['required']
      ],[
        'fromDate.required' => "Select Start Transaction date", 
        'toDate.required' => "Select End Transaction  date", 
        'bank_id.required' => "Select a bank", 
        'account_card_number.required' => "Account or Card number is required", 
      ]);

      $user = Auth::user();
      $user->statements()->create( [
            'business_name' => $request->business_name, 
            'full_name' => $request->full_name, 
            'address' => $request->address, 
            'city' => $request->city, 
            'currency' => $request->currency, 
            'state' => $request->state, 
            'opening_balance' => $request->opening_balance,
            'zip' => $request->zip, 
            'bank_id' => $request->bank_id, 
            'account_card_number' => $request->account_card_number, 
            'routing_number' => $request->routing_number, 
            'fromDate' => $request->fromDate, 
            'toDate' => $request->toDate, 
            'bank_name' => $request->bank_name, 
            'bank_address' => $request->bank_address, 
            'bank_website' => $request->bank_website, 
            'bank_phone' => $request->bank_phone, 
            'bank_city' => $request->bank_city, 
            'bank_state' => $request->bank_state,
            'bank_zip' => $request->bank_zip,  
      ]);
      return  redirect()->route('statements.index');
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
    public function edit(Statement $statement)
    {
       $data = Statement::find($statement->id);

       //dd($data);

       
    $banks = Bank::where('slug','!=','customize-any-bank')->get();
        return view('statements.edit')
            ->with('data', $statement)
            ->with('banks',$banks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statement $statement)
    {

        $this->validate($request, [
           // 'business_name' => ['required', 'string'], 
            'full_name' => ['required', 'string'], 
            'address' => ['required' ], 
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'zip' => ['required'],
            'opening_balance' => ['required','numeric', ],
            'bank_id' => ['required', 'string', ],
            'account_card_number' => ['required', 'numeric', ],
            'routing_number' => ['required'],
            'fromDate' => ['required'],
            'toDate' => ['required']
          ],[
            'fromDate.required' => "Select an order From date", 
            'toDate.required' => "Select an order To date", 
            'bank_id.required' => "Select a bank", 
            'account_card_number.required' => "Account or Card number is required", 
          ]);


          

          
    
        $statement->business_name = $request->business_name; 
        $statement->full_name = $request->full_name; 
        $statement->bank_name = $request->bank_name; 
        $statement->address = $request->address; 
        $statement->city = $request->city; 
        $statement->currency = $request->currency;
        $statement->state = $request->state; 
        $statement->opening_balance = $request->opening_balance;
        $statement->zip = $request->zip;
        $statement->bank_id = $request->bank_id; 
        $statement->account_card_number = $request->account_card_number; 
        $statement->routing_number = $request->routing_number; 
        $statement->fromDate = $request->fromDate; 
        $statement->toDate = $request->toDate; 
        $statement->bank_website = $request->bank_website;
        $statement->bank_phone = $request->bank_phone;
        $statement->bank_city = $request->bank_city;
        $statement->bank_address = $request->bank_address;
        $statement->bank_state = $request->bank_state;
        $statement->bank_zip = $request->bank_zip;
        $statement->save();

        Session::flash('message', 'Successfully updated!');
        return  redirect()->route('statements.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statement $statement)
    {
    }

    public function deleteStatement(Statement $statement)
    {
        $statement->delete();
        return  back();
    }


    public function uploadLogo(Statement $statement)
    {
        $user = Auth::user();
        $data = Statement::where('id',$statement->id)->orderBy('id','DESC')->first();
        return view('statements.logo')->with('data', $data);
    }


    public function postUploadLogo(Request $request)
    {
       
        $s = Statement::find($request->statement_id);




        if($s->logo != null){
         // return  "theres an image there";
          $Image  = public_path('logos/customize/'.$s->logo);
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
           $originalPath  = public_path('logos/customize/');
           $ogImage->resize(null,120, function($constraint){
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







   // customStore

    /**
     *   CUSTOM
     */

    public function customIndex()
    {

        $b= Bank::where('slug','customize-any-bank')->first();
        $user = Auth::user();
        $data = Statement::where('user_id',$user->id)->where('bank_id',$b->id)->orderBy('id','DESC')->get();
        return view('statements.custom-index')->with('data', $data);
    }


    public function customCreate()
    {    
      return view('statements.create-custom-statement');
    }

    public function customStore(Request $request)
    {    
      $this->validate($request, [
        'full_name' => ['required', 'string'], 
        'address' => ['required' ], 
        'city' => ['required', 'string'],
        'state' => ['required', 'string'],
        'zip' => ['required' ],
        'account_card_number' => ['required', 'numeric', ],
        'routing_number' => ['required'],
        'fromDate' => ['required'],
        'opening_balance' => ['required', 'numeric', ],
        'toDate' => ['required'],
        'bank_name' => ['required' ], 
        'bank_phone' => ['required' ], 
        'bank_address' => ['required' ], 
        'bank_city' => ['required' ], 
        'bank_zip' => ['required' ], 
        'bank_state' => ['required' ], 
      ],[
        'fromDate.required' => "Select Start Transaction date", 
        'toDate.required' => "Select End Transaction  date", 
        'account_card_number.required' => "Account or Card number is required", 
      ]);
      $b= Bank::where('slug','customize-any-bank')->first();
      $user = Auth::user();
      $user->statements()->create( [
            'business_name' => $request->business_name, 
            'full_name' => $request->full_name, 
            'address' => $request->address, 
            'city' => $request->city, 
            'currency' => $request->currency, 
            'state' => $request->state, 
            'opening_balance' => $request->opening_balance,
            'zip' => $request->zip, 
            'bank_id' => $b->id, 
            'account_card_number' => $request->account_card_number, 
            'routing_number' => $request->routing_number, 
            'fromDate' => $request->fromDate, 
            'toDate' => $request->toDate, 
            'bank_name' => $request->bank_name, 
            'bank_website' => $request->bank_website, 
            'bank_phone' => $request->bank_phone, 
            'bank_address' => $request->bank_address, 
            'bank_city' => $request->bank_city, 
            'bank_state' => $request->bank_state,
            'bank_zip' => $request->bank_zip,  
      ]);
      return  redirect()->route('statement.custom.index');
    }

    public function customEdit(Statement $statement)
    {    
      $data = Statement::find($statement->id);
      $banks = Bank::all();
       return view('statements.edit-custom-statement')
           ->with('data', $statement)
           ->with('banks',$banks);
    }

    public function customUpdate(Request $request, Statement $statement)
    {    

      $this->validate($request, [
         'full_name' => ['required', 'string'], 
         'address' => ['required' ], 
         'city' => ['required', 'string'],
         'state' => ['required', 'string'],
         'zip' => ['required'],
         'opening_balance' => ['required','numeric', ],
         'account_card_number' => ['required', 'numeric', ],
         'routing_number' => ['required'],
         'fromDate' => ['required'],
         'toDate' => ['required'],
         'bank_name' => ['required' ], 
         'bank_phone' => ['required' ], 
         'bank_address' => ['required' ], 
         'bank_city' => ['required' ], 
         'bank_zip' => ['required' ], 
         'bank_state' => ['required' ], 
       ],[
         'fromDate.required' => "Select an order From date", 
         'toDate.required' => "Select an order To date", 
         'account_card_number.required' => "Account or Card number is required", 
       ]);



     $b= Bank::where('slug','customize-any-bank')->first();
     $statement->business_name = $request->business_name; 
     $statement->full_name = $request->full_name; 
     $statement->bank_name = $request->bank_name; 
     $statement->address = $request->address; 
     $statement->city = $request->city; 
     $statement->currency = $request->currency;
     $statement->state = $request->state; 
     $statement->opening_balance = $request->opening_balance;
     $statement->zip = $request->zip;
     $statement->bank_id = $b->id; 
     $statement->account_card_number = $request->account_card_number; 
     $statement->routing_number = $request->routing_number; 
     $statement->fromDate = $request->fromDate; 
     $statement->toDate = $request->toDate; 
     $statement->bank_website = $request->bank_website;
     $statement->bank_phone = $request->bank_phone;
     $statement->bank_address = $request->bank_address;
     $statement->bank_city = $request->bank_city;
     $statement->bank_state = $request->bank_state;
     $statement->bank_zip = $request->bank_zip;
     $statement->save();

     Session::flash('message', 'Successfully updated!');
     return  redirect()->route('statement.custom.index');

    }

    public function customDelete()
    {    
        return ;
    }


}
