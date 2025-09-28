@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"> Utility Bill</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">




    <div class="alert alert-info" style="margin:15px" >
        <p>Available Utility Bill click to view demo</p> <p>
        <a href="{{ asset('watermark/att.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            AT&T USA
        </a> /
        <a href="{{ asset('watermark/directv.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            DIRECTV USA
        </a> /
        <a href="{{ asset('watermark/spectrum.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            SPECTRUM USA
        </a> /
        <a href="{{ asset('watermark/xfinity.png') }}" data-lightbox="gallery-1" data-title="UTILITY">
            XFINITY USA
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
                                            <th scope="col">Type</th>
                                             <th scope="col">Edit/del</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('utility/create') }}"> Place Order <i class="fas fa-plus"></i>   </a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->billing_date }}</td>
                                             <td>{{ strtoupper($value->type) }}</td>
                           
                                            <td><a href="{{ asset('utility/' . $value->id . '/edit') }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
    
    
                                                <a href="{{ asset('utility/' . $value->id . '/delete') }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>

                                            <td>          <form method="POST" action="{{ route('utility.create.document') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{$value->id}}" name="id" />
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