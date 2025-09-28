@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">

                        <header class="widget-header">
                            <h4 class="widget-title">Custom Bank Statements</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">


                        <div class="alert alert-info" style="margin:15px" >
                           
                            
                            <p>View <a href="{{ asset('home/how-it-works')}}">Video</a></p>
                           <p>Price : $10/ month</p>
                           
                          
                        </div>





                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Business Name</th>
                                            <th scope="col">Full name</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('custom-statements/create-custom-statement') }}"> Place Order <i class="fas fa-plus"></i></a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('y-m-d') }}</td>
                                            <td>{{ $value->business_name }}</td>
                                            <td>{{ $value->full_name }}</td>
                                            <td>{{ $value->bank->slug }}</td>
                                            <td>
                                           
                                                @if($value->bank->slug == "customize-any-bank")
                                              
                                                <a href="{{ asset('statements/logo/upload-logo/'.$value->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Logo"><i class="fas fa-images text-primary"></i></a>
                                                        @if($value->logo != null)
                                                        <i class="fas fa-check text-success"></i>
                                                        @else 
                                                        <i class="fas fa-ban text-danger"></i>
                                                        @endif
                                                @else 
                                                Not Needed
                                                @endif
    
    
                                            </td>
                                            <td><a href="{{ asset('custom-statements/' . $value->id . '/edit-custom-statement') }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
    
    
                                                <a href="{{ asset('custom-statements/' . $value->id . '/delete') }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
    
    
                                                @if($value->logo != null)
                                                <a href="{{ asset('statements/transactions/' . $value->id) }}"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="add transactions / preview / download"> <i
                                                        class="fas fa-download text-success"></i></a>
                                                @else 
                                                pending...
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