@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"> LATE RENT</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">




    <div class="alert alert-info" style="margin:15px" >
        <p>Click to view demo</p> <p>
        <a href="{{ asset('watermark/rent.png') }}" data-lightbox="gallery-1" data-title="Rent">
            LATE RENT
        </a> 
           <p>Price : ${{ $charge->charge}}</p>
        </p>
      
    </div>





                        <div class="widget-body">
                 <div class="mb-3">
                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
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
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Form Date</th>
                                            <th scope="col">State</th>
                                             <th scope="col">Edit/del</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('rental/create-late-rent') }}"> Place Order <i class="fas fa-plus"></i>   </a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $value->first_name }} {{ $value->last_name }} </td>
                                            <td>{{ $value->form_date }}</td>
                                            <td>{{ $value->state }}</td>
                           
                                            <td><a href="{{ asset('rental/edit-late-rent/' . $value->id ) }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>
    
    
                                                <a href="{{ asset('rental/delete-late-rent/' . $value->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="" data-toggle="tooltip" data-placement="bottom" title="delete"><i
                                                        class="fas fa-trash text-danger"></i> </a>
                                            </td>

                                            <td>          <form method="POST" action="{{ route('rental.create.lr') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{$value->id}}" name="id" />
                                                            <button onclick=" return confirm('Are you sure you want to download? you will be charged $' + {{ $charge->charge}})  " style="border: none;outline: none;" type="submit" ><i class="fas fa-download text-success"></i></button>
                                                            <i>After clicking, be patient while it downloads</i>
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