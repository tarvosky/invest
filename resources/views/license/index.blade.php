<?php use App\Models\Charge;
$front = Charge::where('slug','dl_front')->first();
$both = Charge::where('slug','dl_front_and_back')->first();
?>
@extends('layouts.app_home')
@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Scannable Drivers License</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">






                
                <div class="alert alert-info" style="margin:15px" >
                    <strong>Available States: (Front & Back) click to view</strong> <p>
                        <a href="{{ asset('watermark/AL.png') }}" data-lightbox="gallery-1" data-title="DL">
                            AL
                        </a> / 
                        <a href="{{ asset('watermark/AK.png') }}" data-lightbox="gallery-1" data-title="DL">
                            AK
                        </a> / 
                        <a href="{{ asset('watermark/AR.png') }}" data-lightbox="gallery-1" data-title="DL">
                            AR
                        </a> / 
                        <a href="{{ asset('watermark/AZ.png') }}" data-lightbox="gallery-1" data-title="DL">
                            AZ
                        </a> / 
                        <a href="{{ asset('watermark/CT.png') }}" data-lightbox="gallery-1" data-title="DL">
                            CT
                        </a> /                                                
                        <a href="{{ asset('watermark/CA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            CA
                        </a> / 
                        <a href="{{ asset('watermark/DE.png') }}" data-lightbox="gallery-1" data-title="DL">
                            DE
                        </a> /                         
                        <a href="{{ asset('watermark/FL.png') }}" data-lightbox="gallery-1" data-title="DL">
                            FL
                        </a> / 
                        <a href="{{ asset('watermark/GA_OLD.png') }}" data-lightbox="gallery-1" data-title="DL">
                            GA OLD
                        </a> / 
                        <a href="{{ asset('watermark/GA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            GA NEW
                        </a> / 
                        <a href="{{ asset('watermark/HI.png') }}" data-lightbox="gallery-1" data-title="DL">
                            HI
                        </a> / 
                        <a href="{{ asset('watermark/IA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            IA
                        </a> / 
                         <a href="{{ asset('watermark/ID.png') }}" data-lightbox="gallery-1" data-title="DL">
                            ID
                        </a> /
                        <a href="{{ asset('watermark/IL.png') }}" data-lightbox="gallery-1" data-title="DL">
                            IL
                        </a> /
                        <a href="{{ asset('watermark/IN.png') }}" data-lightbox="gallery-1" data-title="DL">
                            IN
                        </a> /  
                        <a href="{{ asset('watermark/KS.png') }}" data-lightbox="gallery-1" data-title="DL">
                            KS
                        </a> /                         
                        <a href="{{ asset('watermark/KY.png') }}" data-lightbox="gallery-1" data-title="DL">
                            KY
                        </a> /                       
                        <a href="{{ asset('watermark/LA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            LA
                        </a> / 
                        <a href="{{ asset('watermark/MA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MA
                        </a> /  
                        <a href="{{ asset('watermark/MD.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MD
                        </a> /  
                        <a href="{{ asset('watermark/ME.png') }}" data-lightbox="gallery-1" data-title="DL">
                            ME
                        </a> / 
                       <a href="{{ asset('watermark/MI.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MI
                        </a> / 
                       <a href="{{ asset('watermark/MN.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MN
                        </a> /                         
                        <a href="{{ asset('watermark/MO.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MO
                        </a> / 
                        <a href="{{ asset('watermark/MS.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MS
                        </a> / 
                        <a href="{{ asset('watermark/MT.png') }}" data-lightbox="gallery-1" data-title="DL">
                            MT
                        </a> /                         
                        <a href="{{ asset('watermark/NC.png') }}" data-lightbox="gallery-1" data-title="DL">
                            NC
                        </a> /   
                        <a href="{{ asset('watermark/NE.png') }}" data-lightbox="gallery-1" data-title="DL">
                            NE
                        </a> /                           
                         <a href="{{ asset('watermark/NH.png') }}" data-lightbox="gallery-1" data-title="DL">
                            NH
                        </a> /                                             
                        <a href="{{ asset('watermark/NJ.png') }}" data-lightbox="gallery-1" data-title="DL">
                            NJ
                        </a> / 
                        <a href="{{ asset('watermark/NM.png') }}" data-lightbox="gallery-1" data-title="DL">
                            NM
                        </a> /  
                        <a href="{{ asset('watermark/NV.png') }}" data-lightbox="gallery-1" data-title="DL">
                            NV
                        </a> /                                                        
                        <a href="{{ asset('watermark/OH.png') }}" data-lightbox="gallery-1" data-title="DL">
                            OH
                        </a> / 
                        <a href="{{ asset('watermark/OK.png') }}" data-lightbox="gallery-1" data-title="DL">
                            OK
                        </a> /                         
                        <a href="{{ asset('watermark/OR.png') }}" data-lightbox="gallery-1" data-title="DL">
                            OR
                        </a> /                         
                        <a href="{{ asset('watermark/PA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            PA
                        </a> / 
                        <a href="{{ asset('watermark/RI.png') }}" data-lightbox="gallery-1" data-title="DL">
                            RI
                        </a> /
                        <a href="{{ asset('watermark/SC.png') }}" data-lightbox="gallery-1" data-title="DL">
                            SC
                        </a> /  
                        <a href="{{ asset('watermark/SD.png') }}" data-lightbox="gallery-1" data-title="DL">
                            SD
                        </a> /  
                         <a href="{{ asset('watermark/TN.png') }}" data-lightbox="gallery-1" data-title="DL">
                            TN
                        </a> /        
                         <a href="{{ asset('watermark/TX.png') }}" data-lightbox="gallery-1" data-title="DL">
                            TX
                        </a> /   
                        <a href="{{ asset('watermark/UT.png') }}" data-lightbox="gallery-1" data-title="DL">
                            UT
                        </a> /                                                                 
                        <a href="{{ asset('watermark/VT.png') }}" data-lightbox="gallery-1" data-title="DL">
                            VT
                        </a> /
                      <a href="{{ asset('watermark/WA.png') }}" data-lightbox="gallery-1" data-title="DL">
                            WA
                        </a> /
                        <a href="{{ asset('watermark/WV.png') }}" data-lightbox="gallery-1" data-title="DL">
                            WV
                        </a> /
                     <a href="{{ asset('watermark/WY.png') }}" data-lightbox="gallery-1" data-title="DL">
                            WY
                        </a>        
                      </p>
                    <strong>Coming Soon: October 2021</strong> 
                    <p> 
                    CO / NY / ND / VA / WI  
                    </p>
                    {{-- <p> 
                    AL / AZ / CO / CT / DE / GA / ID / IN / KS / KY / LA / MA / MN
                    MS / MO / MT / NE / NV / NH / NJ / NM / NY / NC / ND / OK / OR / SC / SD / TN / TX / UT / VT / VA / WA / WV / WI
                    / WY  
                    </p> --}}
                    <p>View <a href="{{ asset('home/how-it-works')}}">Video</a></p>
                     <p>Price : Front or Back ${{ $front->charge}} / Front and Back ${{ $both->charge}}  </p>
                                <p>Customize Picture (24hrs) $5 :  <a href="{{ asset('payment/customize/edit-picture') }}" >click here</a> </p>
                </div>




                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <div class="widget-body">


                            <div class="mb-3">
                                @if ($errors->has('cost'))
                                <div class="alert alert-danger ">{{ $errors->first('cost') }}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                @if ($errors->has('error'))
                                <div class="alert alert-danger ">{{ $errors->first('error') }}</div>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Name</th>
                                            <th scope="col">State</th>
                                            <th scope="col">Edit Photo</th>
                                            <th scope="col">Edit Bg</th>
                                            <th scope="col">Download</th>
                                            <th scope="col">edit/del</th>
                                            <th scope="col"><a class="btn btn-primary" data-toggle="tooltip"
                                                data-placement="bottom" title="new license"
                                                href="{{ asset('license/create-license') }}">Place Order <i class="fas fa-plus"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $d)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{ $d->created_at->format('y-m-d')}}</td>
                                            <td>{{ $d->first_name}} &nbsp;{{ $d->last_name}}</td>
                                            <td>{{ $d->state}}</td>
                                            <td><a href="{{ asset('license/get-photo/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Photo">
                                                <i class="fas  fa-user text-primary"></i></a> 
                                            @if($d->picture != "sample.jpg")
                                            <i class="fas fa-check text-success"></i>
                                            @else 
                                            <i class="fas fa-ban text-danger"></i>
                                            @endif
                                            </td>
                                            <td><a href="{{ asset('license/get-background/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Background"><i
                                                    class="fas fa-images text-primary"></i></a>
                                                    @if($d->background != "sample.png")
                                                    <i class="fas fa-check text-success"></i>
                                                    @else 
                                                    <i class="fas fa-ban text-danger"></i>
                                                    @endif
                                                
                                                </td>
                                            <td>{{ $d->view}}</td>      
                                            <td>
                                                <a href="{{ asset('license/edit-license/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
                                                <a href="{{ asset('license/'.$d->id.'/delete')}}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>
                                            <td>
                                                    @if($d->background !=  "sample.png"  && $d->picture != "sample.jpg"  )


                                                    <?php


                                                        $view = "dl_front_and_back";
                                                        if($d->view == "front-view"){
                                                            $view ="dl_front";
                                                        }
                                                        if($d->view == "back-view"){
                                                            $view ="dl_back";
                                                        }
                                                        $charge = Charge::where('slug',$view)->first();

                                                    ?>
                                                    
                                                        <form method="POST" action="{{ route('create.document') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{$d->id}}" name="id" />
                                                            <button  style="border: none;outline: none;"  onclick=" return confirm('Are you sure you want to download? you will be charged $' + {{ $charge->charge}})  " type="submit" ><i class="fas fa-download text-success"></i></button>
                                                            </form> 
                                                    @else 
                                                    <i>pending download...</i>
                                                    @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                   </tbody>
                                </table>


                    </div>

                </div><!-- .widget-body -->
                </div><!-- .widget -->
                </div><!-- END column -->
                </div>
                

                <div class="row">
                    @include('partials/news')
            </div><!-- .row -->
         
         
            <div class="row">
             @include('partials/banner')
            </div><!-- .row -->


     
         
         @endsection