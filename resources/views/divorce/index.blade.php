@extends('layouts.app_home')
@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
@endsection
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Divorce Certificate</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">



                        <div class="alert alert-info" style="margin:15px" >
                            <p>Click 

                                <a href="{{ asset('watermark/Divorce1.png') }}" data-lightbox="gallery-1" data-title="Divorce Certtificate">
                                    Divorce Certificate
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
                                            <th scope="col">Court House</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col">Divorce Date</th>
                                            <th scope="col">Edit/del</th>
                                            <th scope="col"> <a class="btn btn-primary float-right" data-toggle="tooltip"
                                                    data-placement="bottom" title="new order"
                                                    href="{{ asset('divorce-certificate/create') }}"> Place Order<i class="fas fa-plus"></i></a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value->created_at->format('y-m-d') }}</td>
                                            <td>{{ $value->court_house_name }}</td>
                                            <td>{{ $value->issued_date }}</td>
                                            <td>{{ $value->divorce_date }}</td>
                           
                                            <td><a href="{{ asset('divorce-certificate/' . $value->id . '/edit') }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="fas fa-edit text-secondary"></i></a>



                        <form style="display:inline" method="post" action="{{route('divorce-certificate.destroy',$value->id)}}">
                            @method('DELETE')
                            @csrf
                            <button  style="border: none;outline: none;background: none;" onclick="return confirm('Are you sure you want to delete this item?');" type="submit"><i class="fas fa-trash text-danger"></i></button>
                        </form>


                                               
                                            </td>

                                            <td>          <form method="POST" action="{{ route('divorce-certificate.create.document') }}">
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