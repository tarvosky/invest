@extends('layouts.app_home')
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Passports</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">


    <div class="alert alert-info" style="margin:15px" >
        <p>Available Passport: click to view demo</p> <p>

            <a href="{{ asset('watermark/UKPP.png') }}" data-lightbox="gallery-1" data-title="PASSPORT">
                UK
            </a> /
            <a href="{{ asset('watermark/USPP.png') }}" data-lightbox="gallery-1" data-title="PASSPORT">
                US
            </a>
           <p>Price : ${{ $charge->charge}}</p>
           <p>Customize Picture (24hrs) $5 :  <a href="{{ asset('payment/customize/edit-picture') }}" >click here</a> </p>
        </p>
      
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Edit Picture</th>
                                            <th scope="col">Edit Bg</th>
                                            <th scope="col">Download</th>
                                            <th scope="col">edit/del</th>
                                            <th scope="col"><a class="btn btn-primary" data-toggle="tooltip"
                                                data-placement="bottom" title="new passports"
                                                href="{{ asset('passports/create') }}">Place Order <i class="fas fa-plus"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key => $d)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{ $d->created_at->format('y-m-d')}}</td>
                                            <td>{{ $d->first_name}} &nbsp;{{ $d->last_name}}</td>
                                            <td><a href="{{ asset('passports/get-photo/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Picture"><i
                                                class="fas fa-images text-primary"></i></a>
                                                @if($d->picture != "sample.jpg")
                                                <i class="fas fa-check text-success"></i>
                                                @else 
                                                <i class="fas fa-ban text-danger"></i>
                                                @endif
                                            </td>
    
                                            <td><a href="{{ asset('passports/get-background/'.$d->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Background"><i
                                                    class="fas fa-images text-primary"></i></a>
                                                    @if($d->background != "sample.png")
                                                    <i class="fas fa-check text-success"></i>
                                                    @else 
                                                    <i class="fas fa-ban text-danger"></i>
                                                    @endif
                                                </td>
                                            <td>{{ $d->view}}</td>      
                                            <td>
                                                <a href="{{ asset('passports/'.$d->id.'/edit')}}" data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
                                                <a href="{{ asset('passports/'.$d->id.'/delete')}}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>
                                            <td>
                                                    @if($d->background !=  "sample.png"  && $d->picture != "sample.jpg"  )
                                                    
                                                        <form method="POST" action="{{ route('create.document.passport') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{$d->id}}" name="id" />
                                                            <button  style="border: none;outline: none;" type="submit"   onclick=" return confirm('Are you sure you want to download? you will be charged $' + {{ $charge->charge}})  "><i class="fas fa-download text-success"></i></button>
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