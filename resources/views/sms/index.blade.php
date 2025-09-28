@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Short-Term Numbers / SMS Verification</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">


                        <div class="alert alert-info" style="margin:15px">
                            <p class="text-danger">Click on <b> Get new number </b> button below to start.</p>
                            <p>View <a href="{{ asset('home/how-it-works')}}">Video</a></p>
                            <p>You cannot reuse a number.</p>
                             
                        </div>
                        
                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <div class="widget-body">


                       @if ($errors->has('cost'))
                        <div class="alert alert-danger ">{{ $errors->first('cost') }}</div>
                        @endif

                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Country</th>
                                             <th scope="col">Website</th>
                                            <th scope="col">Number</th>
                                             <th scope="col">Code</th>
                                              <th scope="col">price</th>
                                            <th scope="col">
                                            
                                            <a class="btn btn-danger" href="{{ asset('verification/get-sms')}}">Get new number <i class="fas fa-play"></i></a>
                                            
                                            </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                        <tr>
                                            <td>{{$key+1}} </td>
                                            <td>{{$value->created_at->format('Y-m-d')}}</td>
                                            <td>{{$value->country}}</td>
                                            <td>{{$value->website}}</td>
                                            <td>{{$value->number}}</td>
                                            <td>{{$value->code}}</td>
                                            <td>${{$value->price}}</td>
                                            <td>
                                            <?php
                                            $country = "US1";
                                            if($value->country == "United Kingdom"){
                                             $country = "UK";   
                                            }
                                            ?>
                                            {{-- <a class="btn btn-primary" href="{{ asset('verification/reuse-number/'.urlencode($value->created_at).'/'.$value->number.'/'.$value->sms_services_id.'/'.$country)}}"> Re use </a> --}}
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


                <script>
                    localStorage.clear("countdown");
                 </script>


                 