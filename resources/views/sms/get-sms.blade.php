@extends('layouts.app_home')
@section('content')




            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Short-Term Numbers / SMS Verification</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">


                        <div class="alert alert-info" style="margin:15px" >
                            <h4>Instructions</h4>
                            <ol>
                                <li>1. Type your preference website name in the search bar</li>
                                <li>2. Click on   <img  width="20px" height="20px"src="{{ asset('us.png')}}"  class="pb-1" alt="..."> or <img  width="20px" height="20px"src="{{ asset('uk.png')}}"  class="pb-1" alt="...">
                             below to get the number of specific services below.</li>
                            </ol>
                             
                        </div>
                        



                        <div class="widget-body">


                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif

                        @if ($errors->has('cost'))
                        <div class="alert alert-danger ">{{ $errors->first('cost') }}</div>
                        @endif




                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%" scope="col">#</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">US</th>
                                            <th scope="col">UK</th>
                                    </thead>
                                    <tbody>






                                    
                                        @foreach ($service as $key => $value)
                                        <tr>
                                            <td>{{ $key+1}}</td>
                                            <td>  <img  width="20px" height="20px" src="{{ asset('logos/sms/'.$value->image)}}"  class="pb-1" alt="...">    &nbsp;  {{ $value->name}}</td>
                                            <td>
                                              @if( $value->us_code != "")
                                                <a href="{{ asset('verification/get-number/'.$value->id.'/US1')}}" data-toggle="tooltip" data-placement="bottom" title="{{ 'Get '.$value->name.' @  $'.$value->us_amount.' US Number now'}}">
                                                    <img  width="20px" height="20px"src="{{ asset('us.png')}}"  class="pb-1" alt="...">
                                                </a>   
                                               @else
                                                N/A
                                               @endif
                                            </td>
                                            <td>
                                               @if( $value->uk_code != "")
                                                <a href="{{ asset('verification/get-number/'.$value->id.'/UK')}}" data-toggle="tooltip" data-placement="bottom" title="{{ 'Get '.$value->name.' @  $'.$value->uk_amount.' UK Number now'}}">
                                                     <img  width="20px" height="20px"src="{{ asset('uk.png')}}"  class="pb-1" alt="...">
                                               @else
                                                N/A
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


                <script>
                    localStorage.clear("countdown");
                 </script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#default-datatable').dataTable({
        'iDisplayLength': 100
      })})
  </script>