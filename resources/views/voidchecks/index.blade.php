<?php use App\Models\Charge;
$front = Charge::where('slug','ssn_front')->first();
?>
@extends('layouts.app_home')
@section('content')


            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">VOID CHECKS</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">

                        <div class="alert alert-info" style="margin:15px" >
                            <p>Available VOID CHECKS: click below to view demo</p> <p>
                    
                                <a href="{{ asset('watermark/void1.png') }}" data-lightbox="gallery-1" data-title="VOID 1">
                                    VOID 1
                                </a> / 
                                <a href="{{ asset('watermark/void2.png') }}" data-lightbox="gallery-1" data-title="VOID 2">
                                    VOID 2
                                </a> /                    
                                <a href="{{ asset('watermark/void3.png') }}" data-lightbox="gallery-1" data-title="VOID 3">
                                    VOID 3
                                </a> /
                                <a href="{{ asset('watermark/void4.png') }}" data-lightbox="gallery-1" data-title="VOID 4">
                                    VOID 4
                                </a>                                                   
                            </p>
                            <p>Price :  ${{ $front->charge}} </p>
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
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Edit Logo</th>
                                            <th scope="col">Edit Bg</th>
                                            <th scope="col">Download</th>
                                            <th scope="col">edit/del</th>
                                            <th scope="col"><a class="btn btn-primary" data-toggle="tooltip"
                                                data-placement="bottom" title="new voidcheck"
                                                href="{{ asset('voidcheck/create') }}">Place Order <i class="fas fa-plus"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $d)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{ $d->created_at->format('y-m-d')}}</td>
                                            <td>{{ $d->company_name}} </td>
                                             <td>{{ $d->bank_name}} </td>

                                           <td><a href="{{ asset('voidcheck/upload-logo/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Logo"><i
                                                    class="fas fa-images text-primary"></i></a>
                                                    @if($d->logo != "logo.png")
                                                    <i class="fas fa-check text-success"></i>
                                                    @else 
                                                    <i class="fas fa-ban text-danger"></i>
                                                    @endif
                                                </td>
    
                                            <td><a href="{{ asset('voidcheck/get-background/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Background"><i
                                                    class="fas fa-images text-primary"></i></a>
                                                    @if($d->background != "sample.png")
                                                    <i class="fas fa-check text-success"></i>
                                                    @else 
                                                    <i class="fas fa-ban text-danger"></i>
                                                    @endif
                                                </td>
                                            <td>{{ $d->type}}</td>      
                                            <td>
                                                <a href="{{ asset('voidcheck/'.$d->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
                                                <a href="{{ asset('voidcheck/'.$d->id.'/delete')}}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>
                                            <td>
    
    
                                                    @if($d->background !=  "sample.png"  && $d->picture != "sample.jpg"  )

                                                    <?php
                                                        $view = "ssn_front_and_back";
                                                        if($d->view == "front-view"){
                                                            $view ="ssn_front";
                                                        }
                                                        if($d->view == "back-view"){
                                                            $view ="ssn_back";
                                                        }
                                                       $charge = Charge::where('slug',$view)->first();
                                                    
                                                    ?>
                                                    
                                                    
                                                        <form method="POST" action="{{ route('voidcheck.create.document') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{$d->id}}" name="id" />
                                                            <button  style="border: none;outline: none;"  onclick=" return confirm('Are you sure you want to download? you will be charged $' + {{ $front->charge}})  " type="submit" ><i class="fas fa-download text-success"></i></button>
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