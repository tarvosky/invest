<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="{{ public_path('css/test.css') }}" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet"> 
    <style>
        .signature {
   font-family:'Caveat', cursive;
   font-size:31px;
}

      @font-face {
            font-family: cedarville-font-family;
            src: url("{{ asset('fonts/aAccountantSignature.ttf') }}");
            font-weight: normal;
        }


        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');


        .typed {
        font-family: 'Cash';
        }

        .table {
            border-collapse: collapse;
        }

        body {
            font-family: 'Open Sans', sans-serif;

        }

        .spsize {
            font-size: 8px;
        }

        .sssize {
            font-size: 10px;
        }

        .mdsize {
            font-size: 12px;
        }

        .bgsize {
            font-size: 16px;
        }

        .page-break {
            page-break-after: always;
        }

        .bigheading {
            font-size: 18;
            font-weight: 400;
        }

    </style>
</head>

<body>




<table width="100%" cellspacing="" cellpadding="0" border="0" class="mdsize">

    <tr>
        <td width="48%" style="padding:0px;" align="left">
            <span style="padding-top:0px">
            
               <img 
                width="240" height="70"
                style="margin:0;padding:0"
               src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/logo/'.$data['state'].'.png'))) }}">
               
            </span>
        </td>
        <td width="4%"></td>
        <td width="48%" style="background:#ff6e1f;color:white" align="right">
            <span style="">
                <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding:20px 10px;font-weight:bold">
                
                    <tr>
                        <td width="50%" style="padding:0px;" align="left">
                            <span style="padding-top:0px">
                                Total amount due
                            </span>
                        </td>
                        <td width="50%" style="padding:0px;" align="right">
                            <span style="padding-top:0px;">
                                ${{ number_format($info['amount'],2) }}
                             </span>
                        </td>
                    </tr>    
                    <tr>
                        <td width="50%" style="padding:0px;" align="left">
                            <span style="padding-top:0px">
                                Please pay by
                            </span>
                        </td>
                        <td width="50%" style="padding:0px;" align="right">
                            <span style="padding-top:0px;">
                               {{ $info['pay_date']}}
                             </span>
                        </td>
                    </tr>
                </table>
             </span>
        </td>
    </tr>
</table>



<table width="100%" cellspacing="" cellpadding="0" border="0" class="mdsize" style="margin-bottom:5px">
    <tr>
        <td width="50%" style="padding:0px;" align="left" >
            <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                Your energy bill
            </span>
        </td>
        <td width="50%"  align="right">
            <span style="">
                <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:20px;">
                    <tr>
                        <td width="50%" style="padding:0px;" align="left">
                            <span style="padding-top:0px">
                                <strong>Bill date:</strong>{{ $info['bill_date_format']}}
                            </span>
                        </td>
                    </tr>    
                    <tr>
                        <td width="50%" style="padding:0px;" align="left">
                            <span style="padding-top:0px">
                                <strong>For the period:</strong> {{ $info['period']}}
                            </span>
                        </td>
                    </tr>
                </table>
             </span>
        </td>
    </tr>
</table>

<div style=";border-top: #ff6e1f solid thin" class="mdsize">
</div>



<table width="100%" cellspacing="" cellpadding="0" border="0" class="mdsize" style="margin-bottom:5px">
    <tr>
        <td width="48%" style="padding:0px;" align="left" >
            <div style="padding:10px;font-size:20px;color:#268fff;">
            
               <table><tr>
                   <td><img  width="30" height="20"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/4.png'))) }}"> </td>
                   <td><strong>Message Center</strong></td>
                </tr></table>

            </div>
            <div style="text-align: justify;padding-bottom:10px"> <strong style="color:#268fff;">Gas bill credit!</strong> Effective for usage from Jan. 1, 2021 through Feb. 28, 2021, customers receiving BGSS-RSG supply service from PSE&G will receive a bill credit of $0.15/therm (incl. SUT). A typical residential heating customer receiving supply service from PSE&G, and using a total of 330 therms during this period will see a bill reduction of $49.50 (about 16.95%). Visit pseg.com/tariffs for more info.</div>
            <div style="text-align: justify;padding-bottom:10px"> <strong style="color:#268fff;">Extreme frigid weather in December and January may have resulted in increased gas usage and higher gas bills.</strong> 
                 While customers are benefiting from gas bill credits this winter, there are ways to further manage winter heating costs. To learn more, visit pseg.com/saveenergy.
            </div>

            <div style="text-align: justify;padding-bottom:10px"> <strong style="color:#268fff;">Need help paying your PSE&G bill? </strong>
            The Low Income Home Energy Assistance Program (LIHEAP) application deadline is April 30, 2021. Moderate-income households can apply for PAGE or NJ SHARES year-round.
            <strong> Call 1-800-510-3102, 7 days a week (9 am - 9 pm), visit pseg.com/help, or see the enclosed bill insert for more details.</strong> 
            <div style="padding:10px 0px">


           <table><tr>
            <td><img  width="30" height="30"
                style="margin:0;padding:0"
               src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/5.png'))) }}"></td>
            <td> <strong>NEXT METER READING</strong> {{ ucwords($info['next_meter_reading'])}}</div> </td>
         </tr></table>


            <div style="font-size:20px;background: black;color:#ffffff;padding:10px">
                How to contact us
            </div>

            <table width="100%" border="0" class="mdsize">
                <tr>
                    <td width="10%"><img  width="30" height="30"
                        style="margin:0;padding:0"
                       src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/6.png'))) }}"></td>
                    <td width="90%">
                        <strong>1-800-436-PSEG (7734)</strong> <br>
                        <strong>Customer service:</strong> 7am to 8pm Mon-Fri, 7am to 5pm Sat-Sun <br>
                        <strong>Emergencies / outages: </strong>  24 hours daily <br>
                        <strong>TTY for the hearing impaired </strong> 1 800 225-0072<br>
                    </td>
                </tr>   
                <tr>
                    <td width="10%"><img  width="30" height="20"
                        style="margin:0;padding:0"
                       src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/7.png'))) }}"></td>
                    <td width="90%"><strong>Visit pseg.com/myaccount </strong> to access your account anytime</td>
                </tr>      
                <tr>
                    <td width="10%"><img  width="30" height="20"
                        style="margin:0;padding:0"
                       src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/8.png'))) }}"></td>
                    <td width="90%"><strong>Text us</strong>. Register for MyAlerts by texting <strong>REG</strong> to 4PSEG(47734) > Text <strong>OUT</strong> to report an outage.</td>
                </tr> 
                <tr>
                    <td width="10%"></td>
                    <td width="90%"><strong></strong><img  width="15" height="15"
                        style="margin:0;padding:0"
                       src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/9.png'))) }}">facebook.com/pseg <strong></strong>
                       
                       <img  width="15" height="15"
                        style="margin:0;padding:0"
                       src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/10.png'))) }}">
                       twitter.com/psegdeliver.</td>
                </tr>                                   
            </table>




        </td>
        <td width="4%"></td>
        <td width="48%"  align="right">
            <span style="">
                <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:20px;">
                

                    <tr>
                        <td width="50%" style="padding:0px;" align="left">


                                <table width="100%" border="0"  class="sssize">
                                    <tr>
                                        <td width="5%">
                                            <img 
                                            width="30" height="30"
                                            style="margin:0;padding:0"
                                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/1.png'))) }}">
                                        </td>
                                        <th width="45%" align="left">{{ strtoupper($data['name'])}}</th>
                                        <td width="5%"></td>
                                        <td width="45%"></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"></td>
                                        <th width="45%" align="left"></th>
                                        <td width="5%">&nbsp;</td>
                                        <td width="45%"></td>
                                    </tr>
                                    <tr>
                                        <td> 
                                        <img 
                                            width="30" height="30"
                                            style="margin:0;padding:0"
                                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/2.png'))) }}"></td>
                                        <td>ACCOUNT NUMBER</td>
                                        <td><img 
                                            width="30" height="20"
                                            style="margin:0;padding:0"
                                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/3.png'))) }}"></td>
                                        <td>SERVICE ADDRESS</td>
                                    </tr>   
  
                                    <tr>
                                        <td></td>
                                        <td>{{ strtoupper($info['account_no'])}}</td>
                                        <td></td>
                                        <td>{{ ucwords(strtolower($data['street']))}} <br>
                                            {{ ucwords(strtolower($data['city']))}} , {{ $data['state']}} {{ $data['zip']}}</td>
                                    </tr>     
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>                             
                                </table>

                                <div style="border:  10px solid  #ffede7">

                                    <span style="padding:10px;font-size:20px;color:#ff6e1f;font-weight:bold">
                                        Snapshot of what you owe
                                    </span>
                                    <div style="padding:10px 0px;">See page 2 for details</div>
                                    <table class="sssize" width="100%" border="0">
                                        <tr>
                                            <td align="left" width="80%">Balance remaining from your last bill</td>
                                            <td width="20%">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td align="left"  width="80%">This month’s charges and credits</td>
                                            <td width="20%"> ${{ number_format($info['amount'],2) }}</td>   
                                        </tr>   
                                        <tr>
                                            <th align="left" width="80%">Total amount due by {{ $info['pay_date']}}</th>
                                            <th width="20%"> ${{ number_format($info['amount'],2) }}</th>   
                                        </tr>                                 
                                    </table>
                                </div>
                                
                                <div style="background: #ffede7; padding:10px;">
                                    <div style="font-size:18px;color:#ff6e1f;">How much energy you’re using</div>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td><img 
                                                width="15" height="15"
                                                style="margin:0;padding:0"
                                               src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/11.png'))) }}">
                                               <br> <span style="color:#ff6e1f">Electric</span>
                                            </td>
                                            <td>You <br> used</td>
                                            <td style="font-size:30px;"> {{ rand(5,8)}}.{{ rand(1,9)}} %</td>
                                            <td><img 
                                                width="20" height="20"
                                                style="margin:0;padding:0"
                                               src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/13.png'))) }}"><br> more</td>
                                            <th>electric compared to this month last year</th>
                                        </tr>    
                                        <tr>
                                            <td><img 
                                                width="15" height="15"
                                                style="margin:0;padding:0"
                                               src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/12.png'))) }}">
                                            <br> <span style="color:#ff6e1f">Gas</span>
                                            </td>
                                            <td>You <br> used</td>
                                            <td style="font-size:30px;">{{ rand(50,89)}}.{{ rand(1,9)}}%</td>
                                            <td><img 
                                                width="20" height="20"
                                                style="margin:0;padding:0"
                                               src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/14.png'))) }}"> <br> less</td>
                                            <th>gas compared to this month last year</th>
                                        </tr>                             
                                    </table>

                                    <div class="ssize">This month was 1°F warmer compared to this month last year.</div>

                                </div>    

                        </td>
                    </tr>
                </table>
             </span>
        </td>
    </tr>
</table>
<table border="0" width="100%" style="text:align:right" class="mdsize">
    <tr>
        <td  align="left">
          
        </td>
        <td  align="right">
            Page 1 of 4
        </td>
    </tr>
</table>
<div style="padding-top:20px;border:dashed 1px #000"></div>


<table width="100%" class="mdsize" border="0">
    <tr>
        <td width="40%">
            <img 
             height="30"
            style="margin:0;padding:0"
           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/logo/'.$data['state'].'.png'))) }}">
        </td>
        <td width="20%"></td>
        <td width="40%">
            <div><strong>Account number  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;{{ $info['formated_acc']}}</strong></div>
            <div><strong>Total amount  due &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;${{ number_format($info['amount'],2) }}</strong></div>
        </td>
    </tr> 
    <tr>
        <td width="40%">
        <strong>PAY YOUR WAY, 24/7</strong>
        We offer a variety of methods that make it easy to
        pay your bill. See reverse side for more information
        </td>
        <td width="20%"></td>
        <td width="40%" style="border:solid 1px #000">
            Amount enclosed &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; $
        </td>
    </tr>                            
</table>

<table width="100%" class="mdsize" border="0" style="margin-top:40px;">
    <tr>
        <td width="10%"></td>
        <td width="30%">
            <div>{{ strtoupper($data['name'])}}</div>
            <div>{{ strtoupper($data['street'])}}</div>
            <div>{{ strtoupper($data['city'])}}, {{ strtoupper($data['state'])}} {{ strtoupper($data['zip'])}}</div>
        </td>
        <td width="20%"></td>
        <td width="30%">
            <div>PSE&G CO</div>
            <div>PO BOX 14444</div>
            <div>NEW BRUNSWICK NJ 08906-4444</div>
        </td>
        <td width="10%"></td>
    </tr>                            
</table>

<div style="padding-top:30px;text-align:center;font-family: cedarville-font-family;">{{ strtoupper($info['account_no'])}} 0000{{ rand(100000,999999)}} 00000{{ rand(100000,999999)}}</div>




            {{-- This is the end of the first Section --}}
            {{-- This is the end of the first Section --}}
            {{-- This is the end of the first Section --}}
            {{-- This is the end of the first Section --}}
            {{-- This is the end of the first Section --}}


    {{-- page break --}}

    <div class="page-break"></div>






   {{-- ------------------------------------------------------------------------------------------------------------------ --}}


            {{-- This is the Beginning of the Second Section --}}
            {{-- This is the Beginning of the Second Section --}}
            {{-- This is the Beginning of the Second Section --}}
            {{-- This is the Beginning of the Second Section --}}
            {{-- This is the Beginning of the Second Section --}}



    <table width="100%" cellspacing="" cellpadding="0" border="0" class="mdsize" style="margin-bottom:5px">
        <tr>
            <td width="50%" style="padding:0px;" align="left" >
                <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                    
                </span>
            </td>
            <td width="50%"  align="right">
                <span style="">
                    <strong>{{ strtoupper($data['name'])}}</strong>
                 </span>
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding:0px;" align="left" >
                <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                    
                </span>
            </td>
            <td width="50%"  align="right">
                <span style="">
                    <strong>Your account number: {{ strtoupper($info['account_no'])}}</strong>
                 </span>
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding:0px;" align="left" >
                <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                    
                </span>
            </td>
            <td width="50%"  align="right">
                <span style="">
                    <strong>Invoice Number:{{ strtoupper($info['invoice_no'])}}</strong>
                 </span>
            </td>
        </tr>
    </table>
    <div style=";border-top: #ff6e1f solid thin" class="mdsize">
    </div>


     
    


    <table width="100%" class="mdsize" border="0" style="margin-top:60px;">
        <tr>
            <td width="50%">
                <div style="padding-top:0px;font-size:20px;color:#ff6e1f;">
                    Balance remaining from your last bill
                </div>
                <table width="100%" class="sssize" border="0" style="margin-top:10px;">
                    <tr>
                        <td width="10%"></td>
                        <td width="70%">PSE&G balance from last bill</td>
                        <td  width="20%" align="left" >${{ number_format($info['balance_remain_sec_page'],2)}}</td>
                    </tr>
                    <tr>
                        <td> <span style="color:#ff6e1f;font-weight:bold;font-style:italic;font-size:8px">Less</span></td>
                        <td> Payment received February 19, 2021 – thank you!</td>
                        <td  align="left" > -${{ number_format($info['balance_remain_sec_page'],2)}}</td>
                    </tr>  
                    <tr>
                        <td></td>
                        <td><strong>Balance remaining from your last bill</strong></td>
                        <td  align="left" ><strong>$0</strong></td>
                    </tr>                             
                </table>

                <div style="padding-top:0px;font-size:21px;color:#ff6e1f;margin-top:10px;">
                    This month’s charges and credits
                </div>
                <table width="100%" class="sssize" border="0" style="margin-top:10px;">
                    <tr>
                        <td width="10%"></td>
                        <td width="70%">Gas charges - PSE&G</td>
                        <td  width="20%" align="right" >${{ number_format($info['r1'],2)}}</td>
                    </tr>
                    <tr>
                        <td> <span style="color:#ff6e1f;font-weight:bold;font-style:italic;font-size:8px">Plus</span></td>
                        <td> Electric charges - PSE&G</td>
                        <td  align="right" > ${{ number_format($info['r2'],2)}}</td>
                    </tr>  
                    <tr>
                        <td> <span style="color:#ff6e1f;font-weight:bold;font-style:italic;font-size:8px">Plus</span></td>
                        <td> WorryFree Protection Plan charge </td>
                        <td  align="right" > ${{ number_format($info['r3'],2)}}</td>
                    </tr> 
                    <tr>
                        <td> <span style="color:#ff6e1f;font-weight:bold;font-style:italic;font-size:8px">Plus</span></td>
                        <td> Community Solar Credit    </td>
                        <td  align="right" > -${{ number_format($info['r4'],2)}}</td>
                    </tr> 
                    <tr>
                        <td> </td>
                        <td><strong>This month’s charges and credits</strong></td>
                        <td  align="right" ><strong>${{ number_format($info['rx5'],2)}}</strong></td>
                    </tr>                             
                </table>
                <div style="background:#ccc;margin-top:10px;" >
                    <table width="100%" class="mdsize" border="0" >
                        <tr>
                            <td> <span style="color:#ff6e1f;font-weight:bold;">Total amount due by {{ ucwords($info['pay_date_short'])}}</span></td>
                            <td  align="right" > <strong> -${{ number_format($info['t'],2)}}</strong></td>
                        </tr>                              
                    </table>
                </div>


                <div style="color:#268fff;font-weight:bold;margin-top:20px"><img 
                    width="15" height="12"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/4.png'))) }}"> Message Center (Continued from page 1)</div>


                <div>
                    Si desea recibir en español una notificación de desconexión del servicio, llame al <strong>1-800-357-2262.</strong> <br> <br>
                    <span style="color:#268fff;font-weight:bold;">Stay connected during winter storms!</span> PSE&G’s enhanced online "Outage Center" keeps you better informed during power 
                    outages with more detailed, real-time information. To learn more, <strong>visit pseg.com/outagecenter.</strong> <br> <br>
                    <span style="color:#268fff;font-weight:bold;">Please help to keep our employees safe.</span> Make sure the path leading to your meters and other 
                    outside electrical equipment is free of clutter, ice and snow.
    
                </div>


            </td>





            <td width="10%"></td>
            <td width="40%">
               <div style="padding: 10px;border:1px solid #000;text-align:justify">
                <div><strong style="color:#5c8726">Don't miss your meter reading</strong></div>
                 If you'll be away on your meter reading day,
                 log in to MyAccount at pseg.com or call 1-800-622-0197 
                before your scheduled date, to submit your reading.

                <div style="color:#5c8726;padding:10px 0px"><strong >Electric & Gas Rate Information</strong></div>
                For news about PSE&G's rate filing and upcoming 
                public hearings visit www.pseg.com/pseandgfilings. 
                Under applicable tax law, the State Sales and Use 
                Tax and corporate business tax are imposed 
                upon the energy you have used.
               </div>
               <div style="padding:150px 0px">
               &nbsp;
              </div>
            </td>
        </tr>                            
    </table>

    <table border="0" width="100%" style="margin-top:140px;text:align:right" class="mdsize">
        <tr>
            <td  align="left">
              
            </td>
            <td  align="right">
                Page 2 of 4
            </td>
        </tr>
    </table>
    <div style="border:dashed 1px #000"></div>



   <table width="100%"   border="0" >
    <tr>
        <td><div style="color:#ff6e1f; padding-top:20px"> IT’S <strong>YOUR BILL</strong>. HOW YOU PAY IS <strong>YOUR CHOICE.</strong></div></td>
   </tr>                            
</table>

<table width="100%"  class="spsize" border="0" >

    <tr>
        <th width="20%" style="text-align:justify"> <img 
                    width="15" height="12"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/8a.png'))) }}"> &nbsp;Online or phone</th>
        <th width="20%" style="text-align:justify"> <img 
                    width="15" height="12"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/1a.png'))) }}"> &nbsp; Automatic bill pay</th>
        <th width="15%" style="text-align:justify"> <img 
                    width="15" height="12"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/2a.png'))) }}">&nbsp; Credit card</th>
        <th width="15%" style="text-align:justify"> <img 
                    width="15" height="12"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/3a.png'))) }}"> &nbsp; In person</th>
        <th width="30%" style="text-align:justify"> <img 
                    width="15" height="12"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/4a.png'))) }}">&nbsp; By mail</th>
    <tr>
        <td  style="text-align:justify">
            Make a payment anytime from a checking or savings account with MyAccount or our automated telephone services <br> <br>
            <strong>Online:</strong>
            pseg.com/myaccount <br> <br>
            <strong>Phone:</strong> 1-800-553-7734 Mon-Fri 7am-8pm, Sat-Sun 7am-5pm
            <strong>Pay by text:</strong>
            Text PAY to 4PSEG (47734)
        </td>
    </td>
    <td   style="text-align:justify">
       <div>
       Automatic payments from your bank. Skip checks and stamps. Never worry about due dates. <br><br>
       <strong>Enroll at:</strong>
       pseg.com/myaccount
   </div>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   </td>
   <td  style="text-align:justify">
    <div>
        Pay your bill with a credit card online or by phone (fee applies).<br><br>
        <strong>Online:</strong> 
        pseg.com/myaccount<br><br>
       <strong> Phone:</strong> 
        1-888-575-6273
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</td>
<td  style="text-align:justify">
    <div>Payments are accepted at any customer service center or authorized location.</div> <br> <br>
    <strong>Locations can be found at pseg.com/csc</strong>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

</td>
<td style="text-align:justify">
    <div>
        Make your check payable to PSE&G and write your account
        number on your check. Do not fold your check and do not 
        attach it to the payment slip with a staple, paper clip or tape.
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
</td>
   </tr>                            
</table>

   



            {{-- This is the end of the Second Section --}}
            {{-- This is the end of the Second Section --}}
            {{-- This is the end of the Second Section --}}
            {{-- This is the end of the Second Section --}}
            {{-- This is the end of the Second Section --}}


    {{-- page break --}}

    <div class="page-break"></div>






   {{-- ------------------------------------------------------------------------------------------------------------------ --}}


            {{-- This is the Beginning of the Third Section --}}
            {{-- This is the Beginning of the Third Section --}}
            {{-- This is the Beginning of the Third Section --}}
            {{-- This is the Beginning of the Third Section --}}
            {{-- This is the Beginning of the Third Section --}}




    <table width="100%" cellspacing="" cellpadding="0" border="0" class="mdsize" style="margin-bottom:5px">
        <tr>
            <td width="50%" style="padding:0px;" align="left" >
                <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                    
                </span>
            </td>
            <td width="50%"  align="right">
                <span style="">
                    <strong>{{ strtoupper($data['name'])}}</strong>
                 </span>
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding:0px;" align="left" >
                <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                    
                </span>
            </td>
            <td width="50%"  align="right">
                <span style="">
                    <strong>Your account number: {{ strtoupper($info['account_no'])}}</strong>
                 </span>
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding:0px;" align="left" >
                <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                    
                </span>
            </td>
            <td width="50%"  align="right">
                <span style="">
                    <strong>Invoice Number:{{ strtoupper($info['invoice_no'])}}</strong>
                 </span>
            </td>
        </tr>
    </table>
    <div style=";border-top: #ff6e1f solid thin" class="mdsize">
    </div>


     
    


    <table width="100%" class="mdsize" border="0" style="margin-top:60px;">
        <tr>
            <td width="50%">
                

                <table width="100%" class="mdsize" border="0" style="margin-top:10px;">
                 
                    <tr>
                        <td width="10%"><img 
                    width="60" height="70"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/9a.png'))) }}"></td>
                        <td><div style="padding-top:0px;font-size:18px;color:#ff6e1f;font-weight:bold">
                            Details of your gas charges
                        </div><span class="sssize"> Your rate: Residential Service Gas-Heating - RSG (HTG)</span></td>
                    </tr>                             
                </table>



                <table width="100%" class="sssize" border="0" style="margin-top:10px;">
                    <tr style=" font-style: italic">
                        <td width="10%">Meter </td>
                        <td width="50%"># 157543243577</td>
                        <td  width="20%" align="left" >usage</td>
                        <td  width="20%" align="left" ></td>
                    </tr> 
                    <tr>
                        <td width="10%"></td>
                        <td width="50%" style="border-bottom: 1px dashed #000000">Actual reading <strong>{{ ucwords($info['short_period1'])}}</strong></td>
                        <td  width="20%" style="border-bottom: 1px dashed #000000" align="left" >1753</td>
                        <td  width="20%" align="left" ></td>
                    </tr>   
                    <tr>
                        <td width="10%"><span style="color:#ff6e1f;font-weight:bold;font-style:italic;font-size:8px">Less</span></td>
                        <td width="50%" style="border-bottom: 1px solid #000000" >Actual reading <strong>{{ ucwords($info['short_period2'])}}</strong></td>
                        <td  width="20%" style="border-bottom: 1px solid #000000" align="left" >1744</td>
                        <td  width="20%" align="left" ></td>
                    </tr>   
                    <tr>
                        <td width="10%"></td>
                        <td width="50%"><strong>Difference</strong></td>
                        <td  width="20%" align="left" ><strong>9</strong></td>
                        <td  width="20%" align="left" ></td>
                    </tr>                          
                </table>

                <table width="100%" class="sssize" border="0" >
                    <tr>
                        
                        <td width="60%" style="border-bottom: 1px dashed #000000">Converted to CCF x 1.012</td>
                        <td  width="20%" align="left" style="border-bottom: 1px dashed #000000" >9.108</td>
                        <td width="20%"></td>
                    </tr>   
                    <tr>
                        <td width="60%" style="border-bottom: 1px dashed #000000">Converted to therms x 1.033</td>
                        <td  width="20%" align="left" style="border-bottom: 1px dashed #000000">9.409</td>
                        <td width="20%"></td>
                    </tr>    
                    <tr>
                        <th width="60%" style="border-bottom: 1px dashed #000000">Total gas you used in 31 days</th>
                        <th  width="20%" align="left" style="border-bottom: 1px dashed #000000">9.409
                            </th>
                        <th width="20%">therms</th>
                    </tr>                      
                </table>

                <div style="padding-top:0px;font-size:14px;color:#ff6e1f;margin-top:10px;font-weight:bold">
                    Delivery charges
                </div>
                <table width="100%" class="sssize" border="0" >
                    <tr>

   
                        
                        <td width="40%" style="border-bottom: 1px dashed #000000">Monthly service charge</td>
                        <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" ></td>
                        <td align="right"  width="20%" style="border-bottom: 1px dashed #000000" >${{ number_format($info['gc_month_sc'],2)}}</td>
                    </tr>   
                    <tr>
                        <td width="40%" >Charges for delivering gas to you:</td>
                        <td  width="40%" align="left"  ></td>
                        <td width="20%"  ></td>
                    </tr> 
                    <tr>
                        <td width="40%" style="border-bottom: 1px dashed #000000">For the First</td>
                        <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['gc_first_terms'],2)}} therms x ${{ number_format($info['g_value_f'],2)}}</td>
                        <td align="right"  width="20%" style="border-bottom: 1px dashed #000000" >${{ number_format($info['gc_first'],2)}}</td>
                    </tr>   
                    <tr>
                        <td width="40%" style="border-bottom: 1px dashed #000000">For the Next</td>
                        <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['gc_next_terms'],2)}} therms x ${{ number_format($info['g_value_n'],2)}}</td>
                        <td align="right"  width="20%" style="border-bottom: 1px dashed #000000" >${{ number_format($info['gc_next'],2)}}</td>
                    </tr>  
                    <tr>
                        <th width="40%" style="border-bottom: 1px dashed #000000">Total gas delivery charges</th>
                        <th  width="40%" align="left" style="border-bottom: 1px dashed #000000">
                            </th>
                        <th align="right"  width="20%">${{ number_format($info['gas_dc'],2)}}</th>
                    </tr>                      
                </table>


                <div style="padding-top:0px;font-size:14px;color:#ff6e1f;margin-top:10px;font-weight:bold">
                    Supply charges
                </div>
                <table width="100%" class="sssize" border="0" >
                         <tr>
                        <td width="40%" style="border-bottom: 1px dashed #000000">Cost of gas supplied by PSE&G:</td>
                        <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['gas_terms'],2)}} therms x ${{ number_format($info['gas_value'],2)}}</td>
                        <td align="right"  width="20%" style="border-bottom: 1px dashed #000000" >${{ number_format($info['gas_sc'],2)}}</td>
                    </tr>  
                    <tr style="background:  #ffece6">
                        <th width="40%" >
                         <img 
                    width="15px" height="19px"
                    style="margin:0;padding-top:5px"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/12.png'))) }}">
                        Total gas supply charges</th>
                        <th  width="20%" align="left" >
                            </th>
                        <th align="right" width="20%">${{ number_format($info['gas_total'],2)}}</th>
                    </tr>                      
                </table>
                <table width="100%" class="sssize" border="0" >
                        <tr>
                         <td> <p>&nbsp;</p></td>
                         </tr>      

                         <tr>
                          <td style="color:#ff6e1f;font-weight:bold">How much gas are you using?</td>
                         </tr>
                    <tr>
                   
                        <td>
                        <img 
                    width="350px" height="130px"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/13a.png'))) }}">
                        </td>
                        
                    </tr>                      
                </table>






            </td>
            <td width="10%"></td>
            <td width="40%">
               <div style="padding: 10px;border:1px solid #000;text-align:justify">
                <div><strong style="color:#5c8726">Explaining gas charges</strong></div>
                We measure the volume of gas you use in cubic feet (CCF) and then convert it to therms.
               <table>
                   <tr>
                       <td>
                           <img 
                    width="30" height="30"
                    style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/6a.png'))) }}"></td>
                        <td><div style="padding-top:0px;font-size:18px;color:#ff6e1f;font-weight:bold">
                       </td>
                       <td> If you used a gas oven, it would take 9 hours of use to equal 1 therm of energy.</td>
                   </tr>
               </table>
               </div>



               <div style="margin-top:20px;padding: 10px;border:1px solid #ff6e1f;text-align:justify">
                <div><strong style="">Price to compare</strong></div>
                If you want to consider getting your gas supply from another supplier,
                 you can compare their price with ours. This month, your cost for 
                 gas supply is $3.19 (or an average of 0.33903709 per therm). 
                 This price to compare varies from month to month, depending on your usage.

                <div style="padding:10px 0px"><strong >Your PoD ID is: PG53462790065423445</strong></div>
                 – Your PoD ID is your Point of Delivery identification 
                within PSE&G’s system. You will need this number if you are considering enrolling with 
                another supplier.
               </div>


                   <table width="100%" class="sssize" border="0" >
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>   
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>   
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>   
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>   
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>   
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>   
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>  
                        <tr>
                        <td> <p>&nbsp;</p></td>
                        </tr>                          
                </table>
            </td>
        </tr>                            
    </table>

    <table border="0" width="100%" style="margin-top:210px;text:align:right" class="mdsize">
        <tr>
            <td  align="left">
              
            </td>
            <td  align="right">
                Page 3 of 4
            </td>
        </tr>
    </table>



            {{-- This is the end of the Third Section --}}
            {{-- This is the end of the Third Section --}}
            {{-- This is the end of the Third Section --}}
            {{-- This is the end of the Third Section --}}
            {{-- This is the end of the Third Section --}}


    {{-- page break --}}

    <div class="page-break"></div>






   {{-- ------------------------------------------------------------------------------------------------------------------ --}}


            {{-- This is the Beginning of the FORTH Section --}}
            {{-- This is the Beginning of the FORTH Section --}}
            {{-- This is the Beginning of the FORTH Section --}}
            {{-- This is the Beginning of the FORTH Section --}}
            {{-- This is the Beginning of the FORTH Section --}}



            <table width="100%" cellspacing="" cellpadding="0" border="0" class="mdsize" style="margin-bottom:5px">
                <tr>
                    <td width="50%" style="padding:0px;" align="left" >
                        <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                            
                        </span>
                    </td>
                    <td width="50%"  align="right">
                        <span style="">
                            <strong>{{ strtoupper($data['name'])}}</strong>
                         </span>
                    </td>
                </tr>
                <tr>
                    <td width="50%" style="padding:0px;" align="left" >
                        <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                            
                        </span>
                    </td>
                    <td width="50%"  align="right">
                        <span style="">
                            <strong>Your account number: {{ strtoupper($info['account_no'])}}</strong>
                         </span>
                    </td>
                </tr>
                <tr>
                    <td width="50%" style="padding:0px;" align="left" >
                        <span style="padding-top:0px;font-size:32px;color:#ff6e1f;">
                            
                        </span>
                    </td>
                    <td width="50%"  align="right">
                        <span style="">
                            <strong>Invoice Number:{{ strtoupper($info['invoice_no'])}}</strong>
                         </span>
                    </td>
                </tr>
            </table>
            <div style=";border-top: #ff6e1f solid thin" class="mdsize">
            </div>
        
        
             
            
        
        
            <table width="100%" class="mdsize" border="0" style="margin-top:60px;">
                <tr>
                    <td width="50%">
                        
        
                        <table width="100%" class="mdsize" border="0" style="margin-top:10px;">
                         
                            <tr>
                                <td width="10%"><img 
                            width="40" height="40"
                            style="margin:0;padding:0"
                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/11a.png'))) }}"></td>
                                <td><div style="padding-top:0px;font-size:18px;color:#ff6e1f;font-weight:bold">
                                    Details of your electric charges
                                </div><span class="sssize"> Your rate: Residential Service (RS)</span></td>
                            </tr>                             
                        </table>
        
        
        
                        <table width="100%" class="sssize" border="0" style="margin-top:10px;">
                            <tr style=" font-style: italic">
                                <td width="10%">Meter </td>
                                <td width="50%"># 157543243577</td>
                                <td  width="20%" align="left" >usage</td>
                                <td  width="20%" align="left" ></td>
                            </tr> 
                            <tr>
                                <td width="10%"></td>
                                <td width="50%" style="border-bottom: 1px dashed #000000">Actual reading <strong>{{ ucwords($info['short_period1'])}}</strong> </td>
                                <td  width="20%" style="border-bottom: 1px dashed #000000" align="left" >1753</td>
                                <td  width="20%" align="left" ></td>
                            </tr>   
                            <tr>
                                <td width="10%"><span style="color:#ff6e1f;font-weight:bold;font-style:italic;font-size:8px">Less</span></td>
                                <td width="50%" style="border-bottom: 1px solid #000000" >Actual reading <strong>{{ ucwords($info['short_period1'])}}</strong> </td>
                                <td  width="20%" style="border-bottom: 1px solid #000000" align="left" >65434</td>
                                <td  width="20%" align="left" ></td>
                            </tr>   
                            <tr>
                                <td width="10%"></td>
                                <th width="50%"><strong>Total electric you used in 31 days</strong></th>
                                <td  width="20%" align="left" ><strong>1,071</strong></td>
                                <td  width="20%" align="left" >kWh</td>
                            </tr>                          
                        </table>
        


                    
        
                        <div style="padding-top:0px;font-size:14px;color:#ff6e1f;margin-top:10px;font-weight:bold">
                            Delivery charges
                        </div>
                        <table width="100%" class="sssize" border="0" >
                            <tr>
                                
                                <td width="40%" style="border-bottom: 1px dashed #000000">Monthly service charge</td>
                                <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" ></td>
                                <td width="20%" align="right" style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_month_sc'],2)}} </td>
                            </tr>   
                            <tr>
                                <td width="40%" >&nbsp;kWh charges:</td>
                                <td  width="40%" align="left"  ></td>
                                <td width="20%"  ></td>
                            </tr> 
                            <tr>
                                <td width="40%" style="border-bottom: 1px dashed #000000">&nbsp;&nbsp;For the First</td>
                                <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_first_terms'],2)}}  kWh x ${{ number_format($info['e_value_dc_f'],2)}}</td>
                                <td width="20%" align="right" style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_first'],2)}}</td>
                            </tr>   
                            <tr>
                                <td width="40%" style="border-bottom: 1px dashed #000000">&nbsp;&nbsp; For the Next</td>
                                <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_next1_terms'],2)}} kWh x ${{ number_format($info['e_value_dc_n1'],2)}}</td>
                                <td width="20%" align="right" style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_next1'],2)}}</td>
                            </tr>  
                            <tr>
                                <td width="40%" style="border-bottom: 1px dashed #000000">&nbsp;&nbsp; For the Next</td>
                                <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_next2_terms'],2)}} kWh x ${{ number_format($info['e_value_dc_n2'],2)}}</td>
                                <td width="20%" align="right" style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_next2'],2)}}</td>
                            </tr>  
                            <tr>
                                <td width="40%" style="border-bottom: 1px dashed #000000">&nbsp;&nbsp;For the Next</td>
                                <td  width="40%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_next3_terms'],2)}} kWh x ${{ number_format($info['e_value_dc_n3'],2)}}</td>
                                <td width="20%" align="right" style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_next3'],2)}}</td>
                            </tr>  
                            <tr>
                                <th width="60%" >Total electric delivery charges</th>
                                <th  width="20%" align="left" >
                                    </th>
                                <th width="20%" align="right" >${{ number_format($info['ele_dc'],2)}}</th>
                            </tr>                      
                        </table>
        
        
                        <div style="padding-top:0px;font-size:14px;color:#ff6e1f;margin-top:10px;font-weight:bold">
                            Supply charges
                        </div>
                        <table width="100%" class="sssize" border="0" >
                            <tr>
                                <td width="50%" style="">Cost of gas supplied by PSE&G:</td>
                                <td  width="30%" align="left"  ></td>
                                <td width="20%"  ></td>
                            </tr>  
                            <tr>
                                <td width="50%" style=""> &nbsp; Charges</td>
                                <td  width="30%" align="left"  ></td>
                                <td width="20%"  ></td>
                            </tr>  

                            <tr>
                                <td width="50%" style="border-bottom: 1px dashed #000000"> &nbsp;&nbsp; For the first</td>
                                <td  width="30%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_first_terms_sc'],2)}} kWh x ${{ number_format($info['e_value_sc_f'],2)}}</td>
                                <td width="20%" align="right"  style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_first_sc'],2)}}</td>
                            </tr> 
                            <tr>
                                <td width="50%" style="border-bottom: 1px dashed #000000"> &nbsp;&nbsp; For the Next</td>
                                <td  width="30%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_next1_terms_sc'],2)}} kWh x ${{ number_format($info['e_value_sc_n1'],2)}}</td>
                                <td width="20%" align="right"  style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_next1_sc'],2)}}</td>
                            </tr> 
                            <tr>
                                <td width="50%" style="border-bottom: 1px dashed #000000"> &nbsp;&nbsp; For the Next</td>
                                <td  width="30%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_next2_terms_sc'],2)}} kWh x ${{ number_format($info['e_value_sc_n2'],2)}}</td>
                                <td width="20%" align="right"  style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_next2_sc'],2)}}</td>
                            </tr> 
                            <tr>
                                <td width="50%" style="border-bottom: 1px dashed #000000"> &nbsp;&nbsp; For the Next</td>
                                <td  width="30%" align="left" style="border-bottom: 1px dashed #000000" >{{ number_format($info['ele_next3_terms_sc'],2)}} kWh x ${{ number_format($info['e_value_sc_n3'],2)}}</td>
                                <td width="20%" align="right"  style="border-bottom: 1px dashed #000000" >${{ number_format($info['ele_next3_sc'],2)}}</td>
                            </tr> 
                            <tr>
                                <th width="50%" align="left" style="border-bottom: 1px dashed #000000">Total electric supply charges</th>
                                <th  width="30%" align="left" style="border-bottom: 1px dashed #000000">
                                    </th>
                                <th width="20%" align="right"  >${{ number_format($info['ele_sc'],2)}}</th>
                            </tr> 
                            <tr>
                                <th width="50%" ><p>&nbsp;</p></th>
                                <th  width="30%" align="left" >
                                    </th>
                                <th width="20%"></th>
                            </tr> 

                            <tr style="background:  #e6e6e5">
                                <th width="50%" >
                                 <img 
                            width="15px" height="19px"
                            style="margin:0;padding-top:5px"
                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/12a.png'))) }}">
                           Total electric charges</th>
                                <th  width="30%" align="left" >
                                    </th>
                                <th  align="right"  style="color:#ff6e1f;font-weight:bold;" width="20%">${{ number_format($info['electric_total'],2)}}</th>
                            </tr>                      
                        </table>
                        
                        <table width="100%" class="sssize" border="0" >
                                <tr>
                                 <td> <p>&nbsp;</p></td>
                                 </tr>      
        
                                 <tr>
                                  <td style="color:#ff6e1f;font-weight:bold">How much gas are you using?</td>
                                 </tr>
                            <tr>
                           
                                <td>
                                <img 
                            width="350px" height="130px"
                            style="margin:0;padding:0"
                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/13a.png'))) }}">
                                </td>
                                <tr>
                                    <td> <p>&nbsp;</p></td>
                                    </tr> 
                                    <tr>
                                        <td> Visit MyAccount for more details regarding your energy usage.</td>
                                        </tr> 
                                
                            </tr>                      
                        </table>
        
        
        
        
        
        
                    </td>
                    <td width="10%"></td>
                    <td width="40%">
                       <div style="padding: 10px;border:1px solid #000;text-align:justify">
                        <div><strong style="color:#5c8726">Explaining gas charges</strong></div>
                        We charge for the electric you use in kilowatt hours (kWh). 1 kilowatt is equal to 1,000 watts..
                       <table>
                           <tr>
                               <td>
                                   <img 
                            width="30" height="30"
                            style="margin:0;padding:0"
                           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('utilities/energy/10a.png'))) }}"></td>
                                <td><div style="padding-top:0px;font-size:18px;color:#ff6e1f;font-weight:bold">
                               </td>
                               <td> If you used a 100 watt light bulb, it would take 10 hours of use to equal to 1 kWh of energy.</td>
                           </tr>
                       </table>
                       </div>
        
        
        
                       <div style="margin-top:20px;padding: 10px;border:1px solid #ff6e1f;text-align:justify">
                        <div><strong style="">Price to compare</strong></div>
                        If you want to consider getting your electric supply from another supplier, you can compare their price with ours. This month, your cost for energy supply is $134.75 (or an average of 0.125817 per kWh). This price to compare varies from month to month, depending on your usage.
        
                        <div style="padding:10px 0px"><strong >Your PoD ID is: PG53462790065423445</strong></div>
                         – Your PoD ID is your Point of Delivery identification 
                         Your PoD ID is your Point of Delivery identification within PSE&G’s system. You will need this number if you are considering enrolling with another supplier..
                       </div>
        
        
                           <table width="100%" class="sssize" border="0" >
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>   
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>   
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>   
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>   
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>   
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>   
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>  
                                <tr>
                                <td> <p>&nbsp;</p></td>
                                </tr>                          
                        </table>
        
        
        
        
        
                    </td>
                </tr>                            
            </table>
            <table border="0" width="100%" style="margin-top:170px;text:align:right" class="mdsize">
                <tr>
                    <td  align="left">
                      
                    </td>
                    <td  align="right">
                        Page 4 of 4
                    </td>
                </tr>
            </table>




<script type="text/php">
    {{-- if (isset($pdf)) {
    $x = 500;
    $y = 570;
    $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
    $font = null;
    $size = 8;
    $color = array(0,0,0);
    $word_space = 0.0;  //  default
    $char_space = 0.0;  //  default
    $angle = 0.0;   //  default
    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
} --}}
</script>

</body>

</html>