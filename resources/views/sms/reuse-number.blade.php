@extends('layouts.app_home')
@section('css')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                      
                          
                            
                        <div class="alert alert-info" style="margin:15px" >
                              <div class="alert alert-info">
                                <ul>
                                 <li class="text-danger">Please only request a code once every 30 seconds after you have confirmed that a code has been sent, multiple requests may result in issues with your output.</li>
                                 <li>Click on Request code to get the code sent to the number.</li>
                                </ul>
                                </div>
                        </div>


                        <div class="widget-body">






                         <table class="table  table-bordered table-responsive" width="100%">
                            <tbody>
                            <tr>
                                <th width="30%" >Use this number for <span class="text-danger" style="font-size: 20px">{{ $data['name']}}</span> </th>
                                <th> 
                                        <span style="font-size:18px;padding-right:10px"  id="vernumber"> {{ $number}} </span> 
                                        <span id="hidecopy"> <i onclick="copyToClipboard('#vernumber')" class="fas fa-copy fa-1x"></i></span>
                                        <p id="loading" style="display:none;margin-top:5px" class="m-2"> <i class="fas fa-spinner fa-pulse fa-2x"></i></p>
                                 </th>
                            </tr>
                            <tr>
                                <td>Verification cost</td>
                                <td>${{ $data['amount']}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span  id="status">pending</span> </td>
                            </tr>
                             <tr>
                                <td>country</td>
                                <td>
                                @if($data['country'] == "UK" )
                                 <img  width="40px" height="40px"src="{{ asset('uk.png')}}"  class="pb-1" alt="...">
                                @else
                                 <img  width="40px" height="40px"src="{{ asset('us.png')}}"  class="pb-1" alt="...">
                                @endif
                                </td>
                            </tr>
                              
                            <tr class="info text-color">
                                <td>Remaining Time</td>
                                <td><div id="total-time-left"> </div></td>
                            </tr>
                            
                        </tbody></table>



               


                    </div><!-- .widget-body -->
                </div><!-- .widget -->
                </div><!-- END column -->
                </div>





                <div class="row">
                    <div class="col-md-12">
                        <div class="widget row no-gutter p-lg">	


       


                                    <div class="col-md-3 col-sm-3">
                                        <a class="btn btn-success" onclick="requestCode()" > Request Code </a>
                                    </div>
                                    <div class="col-md-6 col-sm-6"> 
                                    <span style="font-size:18px;padding-right:10px;color:'brown'"  id="requestcode"></span> 
                                     <p id="loading_request_code" style="display:none;margin-top:5px" class="m-2"> <i class="fas fa-spinner fa-pulse fa-2x"></i></p>
                                     </div>
                                   <div class="col-md-3 col-sm-3">
                                         <a href="{{ asset('sms')}}" class="btn btn-inverse"> Back to SmS <i class="fas fa-backward"></i> </a>
                                    </div>


                                    
            
                              
                                

                            </div><!-- .widget-body -->
                        </div>
                        </div><!-- Row -->




       



                
                <div class="row">
                    @include('partials/news')
                </div><!-- .row -->
                
                
                <div class="row">
                @include('partials/banner')
                </div><!-- .row -->
                
                @endsection


                @push('scripts')

                <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
                </script>
                <script type="text/javascript">




                // COUNTDOWN TIMER
                if(localStorage.getItem("countdown")){
                var countdown = localStorage.getItem("countdown");
                        if(countdown < 0){
                            countdown = -2;
                            document.getElementById("total-time-left").innerHTML = " ----- ";  // change timer to nothing
                        }
                } else {
                //var countdown = 90;    
                var countdown = 60*10;
                }

                var minutes = parseInt(countdown/60);
                var seconds = parseInt(countdown%60);

                function countDownTimer(){
                    if(seconds < 10){
                        seconds= "0"+ seconds ;
                    }if(minutes < 10){
                        minutes= "0"+ minutes ;
                    }
                    document.getElementById("total-time-left").innerHTML =  minutes+" Minutes "+seconds+" Seconds      (if time elapses you will be redirected back)";
                    if(countdown === 0){
                        // redirect back to main page if time elapse
                        localStorage.clear("countdown");
                        let url = "<?php echo env('APP_URL'); ?>"
                        window.location.replace(url+'/verification/get-sms' );
                    
                    }else if(countdown < 0){
                        countdown = -2;
                        document.getElementById("total-time-left").innerHTML = " ---- ";  // change timer to nothing
                    } else {
                        countdown = countdown -1 ;
                        minutes = parseInt(countdown/60);
                        seconds = parseInt(countdown%60);
                        localStorage.setItem("countdown",countdown);
                        setTimeout("countDownTimer()",1000);
                    }
                }

                function myFunction(val){
                    localStorage.setItem("countdown",val);
                return countdown = val;
                }

                //myFunction(-22);
        
            setTimeout("countDownTimer()",1000);












                // REQUEST CODE
                function requestCode() {
         
                        document.getElementById("loading_request_code").style.display = "inline-block";
                        //document.getElementById("hidecopy_request").style.display = "none";
                        //request-code/{service}/{country}/{number}
                         //url:"{{ asset('sms-ajax/get-number/'. $service->id .'/'. $data['country'])}}",
                        const  url = "<?php echo env('APP_URL'); ?>";
                        const  service = "<?php echo $service->id; ?>";
                        const  country = "<?php echo $data['country']; ?>";
                        let  changenumber  = "<?php echo $number; ?>";
                        let  formated = changenumber.substring(1);
                        let  url_link = url + '/sms-ajax/request-code/'  +service+ '/' + country +'/' + formated;
                        console.log(url_link,changenumber);
                        $.ajax({  
                           type: "GET",
                           url:url_link,
                           success: function (data) {
                               document.getElementById("loading_request_code").style.display = "none";
                               console.log('request code');
                               // send to db                    
                               const num = data.data;
                               let num_container="";
                               updateDatabase(changenumber,service,country,num,"reuse"); 

                            if(num == "Balance_error"){
                                num_container = "insufficient credit";
                            }else if(num == "Number_error"){
                                num_container = "Phone Number is no longer available";
                            }else if(num == "Not_received"){
                                num_container = "Code hasn't been received kindly wait for 30 seconds then click on the request code button again";
                            }else if(num == "Number_zero"){
                                num_container = "There are currently no numbers available";
                            }else if(num == "Website_error"){
                                num_container = "Website id is not supported";
                            }else if(num == "Request_limited"){
                                num_container = "Requesting the received SMS too quickly. Please only request the SMS once every 30 seconds"
                            }else{
                               myFunction(-22);
                               document.getElementById("status").innerHTML = "completed";
                               num_container = num;
                            }


                             $("#requestcode").html(num_container);
                           },
                             error: function (data) {
                                 document.getElementById("loading_request_code").style.display = "none";
                                 console.log(data);
                             var errors = $.parseJSON(data.responseText);
                             console.log(errors);
                             console.log('error');
                             }
                         });

                }









                // GET BALANCE
                function getBalance() {
         
                        document.getElementById("loading_request_code").style.display = "inline-block";
                        //document.getElementById("hidecopy_request").style.display = "none";
                        let  url = "<?php echo env('APP_URL'); ?>"
                        let  url_link = url + '/sms-ajax/get-balance';
                         $.ajax({  
                           type: "GET",
                           url:url_link,
                           success: function (data) {
                               document.getElementById("loading_request_code").style.display = "none";
                               console.log(data);
                               console.log('balance');
                               // send to db 
                              
                               let num = data.data;
                                myFunction(-22);
                                document.getElementById("status").innerHTML = "completed";
                                updateDatabase('44785849393',"1","Uk",num,"reuse"); 
                             $("#requestcode").html(num);
                           },
                             error: function (data) {
                                 document.getElementById("loading_request_code").style.display = "none";
                                 console.log(data);
                             var errors = $.parseJSON(data.responseText);
                             console.log(errors);
                             console.log('error');
                             }
                         });
                       

                }




        // COPY TO UPDATE DATABASE
        function updateDatabase(number,service,country,num,state) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                //document.getElementById("loading").style.display = "block";
                // country,code,price
                const user_id = "<?php echo auth()->user()->id; ?>";
                $.ajax({
                        url:"{{ asset('sms-ajax/post-sms-service')}}",
                        type: 'post',data: {_token: CSRF_TOKEN,number:number,sms_services_id:service,country:country,web_code:num,state:state,user_id:user_id},
                        dataType:'json',
                    success: function (data) {
                    console.log(data);
                        },
                        error: function (data) {
                        var errors = $.parseJSON(data.responseText);
                        console.log(errors);
                        }
                    })
        }






                // COPY TO CLIPBOARD
                function copyToClipboard(element) {
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val($(element).text()).select();
                    document.execCommand("copy");
                    $('#vernumber').toggleClass('text-primary');
                    $temp.remove();
                }



               





                      
                        

                </script>
                @endpush
                
               
                
                