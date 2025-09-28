@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Paystub</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">


                        <div class="alert alert-info" style="margin:15px" >
                            <p>Click 
                      

                                <a href="{{ asset('watermark/type1.png') }}" data-lightbox="gallery-1" data-title="Paystub">
                                    Type 1
                                </a> /

                                <a href="{{ asset('watermark/type2.png') }}" data-lightbox="gallery-1" data-title="Paystub">
                                    Type 2
                                </a> /

                                <a href="{{ asset('watermark/type3.png') }}" data-lightbox="gallery-1" data-title="Paystub">
                                    Type 3
                                </a>
                                to view demo
                            </p>
                             <p>Price : ${{ $charge->charge}}</p>
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
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Pay Date</th>
                                            <th scope="col">Pay Type</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Annual pay</th>
                                             <th scope="col">Edit/del</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('paystubs/create') }}"> Place Order <i class="fas fa-plus"></i>   </a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('y-m-d') }}</td>
                                            <td>{{ $value->company_name }}</td>
                                            <td>{{ $value->pay_date }}</td>
                                            <td>{{ $value->pay_type }}</td>
                                            <td>{{ $value->type }}</td>
                                            <td>${{ number_format($value->annual_pay,2) }}</td>
                           
                                            <td><a href="{{ asset('paystubs/' . $value->id . '/edit') }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
    
    
                                                <a href="{{ asset('paystubs/' . $value->id . '/delete') }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>

                                            <td>          <form method="POST" action="{{ route('paystubs.create.document') }}">
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