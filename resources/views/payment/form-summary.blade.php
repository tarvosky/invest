@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Recharge</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">



                        <table class="table">
                            <tr>
                                <th>PAYMENT:</th>
                                <td>{{ $item_name }}</td>
                            </tr>
                            <tr>
                                <th>CURRENCY:</th>
                                <td>{{ $currency }}</td>
                            </tr>
                            <tr>
                                <th>AMOUNT:</th>
                                <td>${{ number_format($amount,2) }}</td>
                            </tr>
                        </table>



                        <a class="btn btn-primary" href="{{ asset('/payment/address/' . $code) }}">Pay</a>







                  

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
                





                <script>
                    localStorage.clear("count_timer");
                 </script>


                @endsection
                
               
                
                