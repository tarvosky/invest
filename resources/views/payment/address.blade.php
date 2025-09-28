@extends('layouts.app_home')




@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
  <link rel="stylesheet" href=" {{ asset('css/jquery.countdown.css') }}">

<style>
#defaultCountdown { width: 100%; height: 90px; }
</style>
@endsection

@section('content')

           <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Subscription Payment</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                         <?php
                        $statusval = $data->status;
                        $status = $data->status;
                        $info = '';
                        if ($status == 0) {
                        $status = "<span style='color: orangered' id='status'>PENDING</span>";
                        $info = '<p>Your payment has been received. Invoice will be marked as paid on two blockchain confirmation. Kindly check back in 15mins, you can also confirm your status by clicking the recharge button on your dashboard page.</p>';
                        } elseif ($status == 1) {
                        $status = "<span style='color: orangered' id='status'>PENDING</span>";
                        $info = '<p>Your payment has been received. Invoice will be marked as paid on two blockchain confirmation. Kindly check back in 15mins, you can also confirm your status by clicking the recharge button on your dashboard page.</p>';
                        } elseif ($status == 2) {
                        $status = "<span style='color: green' id='status'>PAID</span>";
                        } elseif ($status == -1) {
                        $status = "<span style='color: red' id='status'>UNPAID</span>";
                        } elseif ($status == -2) {
                        $status = "<span style='color: red' id='status'>Too little paid, please pay the rest.</span>";
                        } else {
                        $status = "<span style='color: red' id='status'>Error, expired.</span>";
                        }
                        ?>

                          <p>Please send the exact amount of BTC to the given address below</p>

                            <div class="alert alert-warning text-center" role="alert">
                                <h3>  {{$btc }}  BTC </h3>
                            </div>
                              <div class="alert  text-center" role="alert">
                                <h3> &asymp;    ${{ $data->amount }}</h3>
                             </div>

                        <div class="alert alert-warning text-center" role="alert">
                            <strong id="address">{{ $data->address }}</strong>
                        </div>

                        <div class="alert alert-info text-center" role="alert">
                            <h4 class="text-center">  <div id="total-time-left" align="center"> </div></h4>
                            <p class="text-center">  If you don't get update after 3mins, refresh manually for status update </p>
                        </div>
                        <p>Status: <?php echo $status; ?></p>

                        <?php echo $info; ?>
                        <div id="info"></div>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div><!-- END column -->




 <div class="col-md-6">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">QRcode</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                        <?php
                        // QR code generation using google apis
                        $cht = 'qr';
                        $chs = '300x300';
                        $chl = $data->address;
                        $choe = 'UTF-8';

                        $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl .
                        '&choe=' . $choe;
                        ?>
                        <div class="qr-hold">
                            <img src="<?php echo $qrcode; ?>" alt="My QR code"
                                style="width:300px;">
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



        <script>

              

                // countdown timer
                if(localStorage.getItem("count_timer")){
                var count_timer = localStorage.getItem("count_timer");
                        if(count_timer < 0){
                            count_timer = -2;
                            document.getElementById("total-time-left").innerHTML = "Time Left To Pay: ----- ";  // change timer to nothing
                        }
                } else {
                var count_timer = 60*10;
                }


               

                var minutes = parseInt(count_timer/60);
                var seconds = parseInt(count_timer%60);

                function countDownTimer(){
                    if(seconds < 10){
                        seconds= "0"+ seconds ;
                    }if(minutes < 10){
                        minutes= "0"+ minutes ;
                    }
                    document.getElementById("total-time-left").innerHTML = "Time Left To Pay: "+minutes+" Minutes "+seconds+" Seconds";
                    if(count_timer === 0){
                        localStorage.clear("count_timer");
                        let url = "<?php echo env('APP_URL'); ?>"
                        let amount = "<?php echo $data->amount; ?>"
                        let code = "<?php echo $data->code; ?>"
                        window.location.replace(url+'/payment/form-summary/Subcription/USD/'+ amount + "/" + code );
                    
                    }else if(count_timer < 0){
                        count_timer = -2;
                        document.getElementById("total-time-left").innerHTML = "Time Left To Pay: ----- ";  // change timer to nothing
                    } else {
                        count_timer = count_timer -1 ;
                        minutes = parseInt(count_timer/60);
                        seconds = parseInt(count_timer%60);
                        localStorage.setItem("count_timer",count_timer);
                        setTimeout("countDownTimer()",1000);
                    }
                }

                function myFunction(val){
                    localStorage.setItem("count_timer",val);
                return count_timer = val;
                }
        
            setTimeout("countDownTimer()",1000);

        // refresh
            let status = "<?php echo $statusval; ?>"
            console.log('ssssssss');
            var addr = document.getElementById("address").innerHTML;
            console.log(addr);
            // Create socket variables
            if (status < 2 && status != -2) {
                var addr = document.getElementById("address").innerHTML;
                var timestamp = Math.floor(Date.now() / 1000) - 5;
                var wsuri = "wss://www.blockonomics.co/payment/" + addr + "?timestamp=" + timestamp;
                var socket = new WebSocket(wsuri);
    
                socket.onmessage = function(event) {
                    response = JSON.parse(event.data);
                    console.log(response.status);
                    //Refresh page if payment moved up one status
                    if (response.status > status){
                        
                        setTimeout(function() {
                            window.location = window.location
                            myFunction(-22);
                        }, 1000);
                    }
                };
            }










        </script>


                
@endsection







