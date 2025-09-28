@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"> Energy</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">




    <div class="alert alert-info" style="margin:15px" >
        <p>Available Energy Bill click to view demo</p> <p>
        <a href="{{ asset('watermark/energy1.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            First Page
        </a> /
        <a href="{{ asset('watermark/energy2.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            Second Page
        </a> /
        <a href="{{ asset('watermark/energy3.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            Third Page
        </a> /
        <a href="{{ asset('watermark/energy4.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            Fourth Page
        </a> 
       
           <p>Price : ${{ $charge->charge}}</p>
        </p>
      
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Billing Date</th>
                                            <th scope="col">State</th>
                                             <th scope="col">Edit/del</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('utility/energy-create') }}"> Place Order <i class="fas fa-plus"></i>   </a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->billing_date }}</td>
                                            <td>{{ $value->state }}</td>
                           
                                            <td><a href="{{ asset('utility/' . $value->id . '/energy-edit') }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
                                                <a href="{{ asset('utility/' . $value->id . '/energy-delete') }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>

                                            <td>        
                                                            <form method="POST" action="{{ route('utility.energy.create.document') }}">
                                                                @csrf
                                                                <input type="hidden" value="{{$value->id}}" name="id" />
                                                                <input type="hidden" value="{{$charge->charge}}" name="cost" />
                                                                <button onclick=" return confirm('Are you sure you want to download? you will be charged $' + {{ $charge->charge}})  " style="border: none;outline: none;" type="submit" ><i class="fas fa-download text-success"></i></button>
                                                                </form> 





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