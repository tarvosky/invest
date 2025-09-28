<?php
#use App\Models\Transaction;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lease Agreement</title>
    <link rel="stylesheet" href="{{ public_path('css/test.css') }}" type="text/css" media="all">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');



         @font-face {
         font-family: Journal;
         src: url("{{ asset('fonts/Autograf_PersonalUseOnly.ttf') }}");
         }

         .typed {
          font-family: Journal;
          font-size: 26px;
          font-weight: bold;
         }

        .table {
            border-collapse: collapse;
        }

        body {
            font-family: 'Open Sans', sans-serif;

        }

        .sssize {
            font-size: 10px;
        }

        .smsize {
            font-size: 12px;
        }

        .mdsize {
            font-size: 16px;
        }

        .page-break {
            page-break-after: always;
        }

        .bigheading {
            font-size: 18;
            font-weight: 400;
        }
        .mb{
            margin-bottom:20px;
        }

        .lease{
            font-weight: bold;
            font-size: 14px;
        }

    </style>
</head>

<body>



    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right"> 
           <img style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/barcodes/'.$data['code'].".png"))) }}">
             </td>
        </tr>
    </table>
    <div class="mdsize" style="padding-top: 10px;padding-bottom: 20px; text-align:center;font-weight:bold;font-size:18px">
        <div>{{ $data['full_state']}}</div>
    </div>
        <div style="padding-top: 10px; text-align:center">
        <span>
         <img width="100" height="100" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/seals/'.$lease->state.".png"   ))) }}">
        </span>
    </div>
    <div style="padding-bottom: 10px; text-align:center;font-weight:bold;font-size:18px;text-transform:uppercase">
        <div style="margin-bottom:15px;">LEASE AGREEMENT</div>
        <div class="lease">{{  str_replace( ',', '',$lease->street) }}, {{ str_replace( ',', '',$lease->city)  }}, {{ $lease->state }} {{ $lease->zip }}</div>
    </div>

    <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
        <tr>
            <td style="padding:0px;" align="left">
                <p>THIS LEASE AGREEMENT (hereinafter referred to as the "Agreement") made and entered into this <span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($data['position']) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>day of</p>
                <p><span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ strtoupper($data['month_name']) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>, 20 <span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;{{$data['formated_year'] }}&nbsp;&nbsp;&nbsp; </span>   ,by and between</p>
                <p><span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ strtoupper($lease->landlord_first_name)}}  {{ strtoupper($lease->landlord_last_name) }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>(hereinafter referred to as "Landlord") and</p>
                <p><span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ strtoupper($lease->first_name) }}  {{ strtoupper($lease->last_name) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>(hereinafter referred to as "Tenant").</p>
            </td>
        </tr>
    </table>

    

        <div style="padding-top: 20px;padding-bottom: 20px; text-align:left" class="smsize">
        <span><strong>W I T N E S S E T H :</strong></span>
       </div>

    <table width="100%" cellspacing="" cellpadding="0" border="0"  class="smsize">
        <tr>
            <td style="padding:0px;" align="left">
            <p style="padding-left:20px"><strong>WHEREAS</strong>, Landlord is the fee owner of certain real property being, lying and situated<span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($lease->county) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>county</p>
            <referred>in such real property having a street address of <span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($lease->street ) }}, {{ strtoupper($lease->city ) }}, {{ strtoupper($lease->state ) }} {{ strtoupper($lease->zip ) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>(hereinafter referred to as the "Premises").</p>
            <p>&nbsp;</p>
             <p style="padding-left:20px"><strong>WHEREAS</strong>, Landlord is desirous of leasing the Premises to Tenant upon the terms and conditions as contained herein; and</p>
             <p>&nbsp;</p>
             <p style="padding-left:20px"><strong>WHEREAS</strong>,Tenant is desirous of leasing the Premises from Landlord on the terms and conditions as contained herein;</p>
             <p>&nbsp;</p>
             <p style="padding-left:20px"><strong>NOW, THEREFORE,</strong> for and in consideration of the covenants and obligations contained herein and other good and valuable</p>   
             <p>consideration, the receipt and sufficiency of which is hereby acknowledged, the parties hereto hereby agree as follows:  </p>
            </tr>
    </table>       
    <table width="100%" cellspacing="" cellpadding="0" border="0"  class="smsize">
        <tr>
           <td width="5%"style="padding:0px;" align="left">
              <span> 1.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>TERM.</strong>  Landlord leases to Tenant and Tenant leases from Landlord the above-described Premises together with any and all<p>
               <>appurtenances thereto, for a term of <span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($lease->month) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>[MONTHS], such term beginning on <span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ strtoupper($data['start_date']) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>, and ending on
               <span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($data['end_date']) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
           </td>
         </tr>

          <tr>
              <td width="5%" style="padding:0px;" align="left">
                 <span> 2.</span>
              </td>
             <td style="padding:0px;" align="left">
                 <span> <strong>RENT.</strong>  The total rent for the term hereof is the sum of<span>
                 <p><span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ strtoupper($data['lease_words'] ) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>DOLLARS ($<span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper(number_format($lease->amount,2) ) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>   &nbsp;    ) payable</p>
                 on the <span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($data['position'] ) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> day of each month of the term. All such payments shall be made to Landlord at Landlord's address as set forth in 
                 the preamble to this Agreement on or before the due date and without demand.</p>
             </td>
        </tr>
    </table>







    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>
        

    {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}

   



    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>


    <table width="100%" cellspacing="" cellpadding="0" border="0"  class="smsize">
        <tr>
           <td width="5%"style="padding:0px;" align="left">
              <span> 3.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>SECURITY DEPOSIT.</strong> Upon the due execution of this Agreement, Tenant shall deposit with Landlord the sum of</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
              <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
                <p><span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ strtoupper($data['montly_words']) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>DOLLARS ($  <span style="text-decoration:underline" class="lease">{{ strtoupper(number_format($data['montly_fee'],2) ) }}</span>   ) receipt of</p>
                <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;which is hereby acknowledged by Landlord, as security for any damage caused to the Premises during the term hereof.</p>
                <p> <i>Interest on Security Deposits.</i> In accordance with rental law, Landlord will pay Tenant interest on Tenant's security deposit,</p>
                <p> less any service fee charged by the bank or investment company. Interest will be paid annually on the anniversary of  </p>
                <p> Tenant's Lease in cash or as a credit towards rent due. Further, Landlord will annually notify Tenant of certain information </p>
                <p> concerning the security deposit: the name of the bank where the security deposit is held, the type of account in which the</p>
                <p> funds are deposited, and  the account's interest rate. Landlord is prohibited from increasing the amount of the security</p>
                <p> deposit by more than ten (10) percent per year.</p>
                <p>&nbsp;</p>
                <p><i>Timing of Return of Security Deposit.<i>I Within thirty (30) days after the end of Tenant's Lease term, Landlord will return</p>
                <p> Tenant's security deposit to Tenant, plus any accrued interest and less any allowed deductions. Interest and any deductions </p>
                <p>will be itemized. Tenant's security deposit or the balance thereof after deductions will be returned to Tenant by personal </p>
                <p>delivery or registered or certified mail.</p>
            </td> 
         </tr>
    </table>




    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 4.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>USE OF PREMISES.</strong>  The Premises shall be used and occupied by Tenant and Tenant's immediate family, as a private </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
              <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
                <p> single family dwelling, and no part of the Premises shall be used at any time during the term of this Agreement by Tenant  </p>
                <p> for the purpose of carrying on any business, profession, or trade of any kind, or for any purpose other than as a  </p>
                <p> private single  family dwelling.  </p>
                <p> Tenant shall not allow any other person, other than Tenant's immediate family or transient relatives and friends who are </p>
                <p> guests of Tenant, to use or occupy the Premises without first obtaining Landlord's written consent to such use. Tenant shall </p>
                <p>comply with any and all laws, ordinances, rules and orders of any and all governmental or quasigovernmental authorities </p>
                <p>affecting the cleanliness,use, occupancy and preservation of the Premises.</p>
            </td> 
         </tr>
    </table>
 

    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 5.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>CONDITION OF PREMISES. </strong>   Tenant stipulates, represents and warrants that Tenant has examined the Premises, </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
              <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
                <p>  and that they are at the time of this Lease in good order, repair, and in a safe, clean and tenantable condition. </p>
                 </td> 
         </tr>
    </table>




    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 6.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>ASSIGNMENT AND SUB-LETTING. </strong> Tenant shall not assign this Agreement, or sub-let or grant any license </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>  to use the Premises or any part thereof without the prior written consent of Landlord. A consent by Landlord to one  </p>
            <p>such assignment, sub-letting or license shall not be deemed to be a consent to any subsequent assignment, sub-letting </p>   
            <p>or license. An assignment, sub-letting or license without the prior written consent of Landlord or an assignment or </p>
            <p>sub- letting by operation of law shall be absolutely null and void and shall, at Landlord's option, terminate this Agreement.</p>
            <p>&nbsp;</p>
         </td> 
         </tr>
    </table>


 



    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>
        


    {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>





    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 7.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>ALTERATIONS AND IMPROVEMENTS. </strong> Tenant shall make no alterations to the buildings or improvements on the  </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>  Premises or  construct any building or make any other improvements on the Premises without the prior written consent of</p>
            <p> Landlord. Any and all alterations, changes, and/or improvements built, constructed or placed on the Premises by Tenant </p>   
            <p>shall, unless otherwise provided by written agreement between Landlord and Tenant, be and become the property of  </p>
            <p>Landlord  and remain on the Premises at the expiration or earlier termination of thisAgreement.</p>
           
         </td> 
         </tr>
    </table>


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 8.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>NON-DELIVERY OF POSSESSION. </strong> In the event Landlord cannot deliver possession of the Premises to Tenant  </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>upon the commencement of the Lease term, through no fault of Landlord or its agents, then Landlord or its agents shall </p>
            <p>have no liability, but the rental herein provided shall abate until possession is given. Landlord or its agents shall </p>   
            <p>havethirty (30) days in which to give possession, and if possession is tendered within such time, Tenant agrees to accept </p>
            <p>the demised Premises and pay the rental herein provided from that date. In the event possession cannot be delivered</p>
           <p> within such time, through no fault of Landlord or its agents, then this Agreement and all rights hereunder shall terminate</p>
         </td> 
         </tr>
    </table>






   <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 9.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>HAZARDOUS MATERIALS. </strong> Tenant shall not keep on the Premises any item of a dangerous, flammable or explosive</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>character that might unreasonably increase the danger of fire or explosion on the Premises or that might be considered </p>
            <p>hazardous  or extra hazardous by any responsible insurance company</p>   
         </td> 
         </tr>
    </table>


   <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 10.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>UTILITIES. </strong> Tenant shall be responsible for arranging for and paying for all utility services required on the Premises.</span>
             </td> 
       </tr>
    </table>



   <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 11.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>MAINTENANCE AND REPAIR; RULES. </strong>  Tenant will, at its sole expense, keep and maintain the Premises </span>
             </td> 
       </tr>
           <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>and appurtenances in good and sanitary condition and repair during the term of this Agreement and any renewal thereof. </p>
            <p> Without limiting the generality of the foregoing, Tenant shall:</p>   
         </td> 
         </tr>
    </table>



   <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:20px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span> (a)</span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Not obstruct the driveways, sidewalks, courts, entry ways, stairs and/or halls, which shall be used for the purposes of</span>
            </td> 
       </tr>
       <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>&nbsp;</span>
           </td>
           <td style="padding:0px;" align="left">
              <p>ingress and egress only; </p>
            </td> 
       </tr>
    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span> (b)</span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Keep all windows, glass, window coverings, doors, locks and hardware in good, clean order and repair;</span>
            </td> 
       </tr>
    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(c) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Not obstruct or cover the windows or doors;</span>
            </td> 
       </tr>
    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(d) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Not leave windows or doors in an open position during any inclement weather;</span>
            </td> 
       </tr>
    </table>






    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(e) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Not hang any laundry, clothing, sheets, etc. from any window, rail, porch or balcony nor air or dry any of </span>
            </td> 
       </tr>
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <p>&nbsp;</p>
           </td>
           <td style="padding:0px;" align="left">
              <p>same within any yard area or space;</p>
            </td> 
       </tr>
    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:8px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(f) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Not cause or permit any locks or hooks to be placed upon any door or window without the prior written consent of </span>
            </td> 
       </tr>
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <p>&nbsp;</p>
           </td>
           <td style="padding:0px;" align="left">
              <p>Landlord;</p>
            </td> 
       </tr>
    </table>


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(g)</span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Keep all air conditioning filters clean and free from dirt;</span>
            </td> 
       </tr>
    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(h) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Keep all lavatories, sinks, toilets, and all other water and plumbing apparatus in good order and repair and</span>
            </td> 
       </tr>
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>&nbsp;</span>
           </td>
           <td style="padding:0px;" align="left">
              <p>shall use same only for the purposes for which they were constructed. Tenant shall not allow any sweepings,</p>
              <p> rubbish, sand, rags, ashes or other substances to be thrown or deposited therein. Any damage to any such</p>
              <p> apparatus and the cost of clearing stopped plumbing resulting from misuse shall be borne by Tenant;</p>
              <p></p>
            </td> 
       </tr>
    </table>








    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>



        {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>















    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(i) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>And Tenant's family and guests shall at all times maintain order in the Premises and at all places on the Premises,</span>
            </td> 
       </tr>
            <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span></span>
           </td>
           <td style="padding:0px;" align="left">
              <p>and shall not make or permit any loud or improper noises, or otherwise disturb otherresidents;</p>
            </td> 
       </tr>
    </table>


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(j) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Keep all radios, television sets, stereos, phonographs, etc., turned down to a level of </span>
            </td> 
       </tr>
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>&nbsp;</span>
           </td>
           <td style="padding:0px;" align="left">
              <p>sound that does not annoy or interfere with other residents;</p>
            </td> 
       </tr>
    </table>



    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(k) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Deposit all trash, garbage, rubbish or refuse in the locations provided therefor and shall not allow any trash,</span>
            </td> 
       </tr>
        <tr>
           <td width="5%" align="left">
             <p>&nbsp;</p>
           </td>
           <td width="5%" align="left">
              <p>&nbsp;</p>
           </td>
           <td style="padding:0px;" align="left">
              <p>garbage, rubbish or refuse to be deposited or permitted to stand on the exterior of any building or within the</p>
              <p>common elements;</p>
            </td> 
       </tr>
    </table>



    <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
             <span>&nbsp;</span>
           </td>
           <td width="5%" align="left">
              <span>(j) </span>
           </td>
           <td style="padding:0px;" align="left">
              <span>Abide by and be bound by any and all rules and regulations affecting the Premises or the common area</span>
            </td> 
       </tr>
        <tr>
           <td width="5%" align="left">
             <p>&nbsp;</p>
           </td>
           <td width="5%" align="left">
              <p>&nbsp;</p>
           </td>
           <td style="padding:0px;" align="left">
              <p> appurtenant thereto which may be adopted or promulgated by the Condominium or Homeowners' Association </p>
              <p>having control over them.</p>
            </td> 
       </tr>
    </table>

   <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 12.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>DAMAGE TO PREMISES. </strong> In the event the Premises are destroyed or rendered wholly untenantable by </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>fire, storm, earthquake,or other casualty not caused by the negligence of Tenant, this Agreement shall terminate </p>
            <p>from such time except for the purpose of enforcing rights that may have then accrued hereunder. The rental provided</p>
            <p> for herein shall then be accounted for by and between Landlord and Tenant up to the time of such injury or destruction</p> 
            <p> of the Premises, Tenant paying rentals up to such date and Landlord refunding rentals collected beyond such date. </p>    
            <p>Should a portion of the Premises thereby be rendered untenantable, the Landlord shall have the option of either repairing</p> 
            <p> such injured or damaged portion or terminating this Lease. In the event that Landlord exercises its right to repair such </p> 
            <p>untenantable portion, the rental shall abate in the proportion that the injured parts bears to the whole Premises, and </p> 
            <p>such part so injured shall be restored by Landlord as speedily as practicable, after which the full rent shall recommence,</p> 
            <p> and the Agreement continue according to its terms.</p> 
         </td> 
         </tr>
</table>


   <table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 13.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>INSPECTION OF PREMISES. </strong> Landlord and Landlord's agents shall have the right at all reasonable</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>times during the term of this. Agreement and any renewal thereof to enter the Premises for the purpose of inspecting</p>
            <p>the Premises and all buildings and improvements thereon. And for the purposes of making any repairs, additions or </p>
            <p>alterations as may be deemed appropriate by Landlord for the preservation of the Premises or the building. Landlord</p> 
            <p> and its agents shall further have the right to exhibit the Premises and to display the usual "for sale", "for rent"</p>    
            <p> or "vacancy" signs on the Premises at any time within forty-five (45) days before the expiration of this Lease. The</p> 
            <p> right of entry shall likewise exist for the purpose of removing placards, signs, fixtures, alterations or additions,</p> 
            <p> but do not conform to this Agreement or to any restrictions, rules or regulations affecting the Premises. </p> 
         </td> 
         </tr>
</table>





    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>


        {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>














<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 14.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>SUBORDINATION OF LEASE. </strong>This Agreement and Tenant's interest hereunder are and shall be subordinate,</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>junior and inferior to any and all mortgages, liens or encumbrances now or hereafter placed on the Premises by Landlord,</p>
            <p> all advances made under any such mortgages, liens or encumbrances (including, but not limited to, future advances), </p>
            <p>the interest payable on such mortgages, liens or encumbrances and any and all renewals, extensions or modifications </p> 
            <p>of such mortgages, liens or encumbrances.</p>
         </tr>
</table>



<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 15.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>TENANT'S HOLD OVER. </strong>If Tenant remains in possession of the Premises with the consent of Landlord </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>after the natural expiration of this Agreement, a new tenancy from month-to-month shall be created between Landlord</p>
            <p> and Tenant which shall be subject to all of the terms and conditions hereof except that rent shall then be due and owing at</p>
            <p><span style="text-decoration:underline" class="lease"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($data['montly_words'] ) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>DOLLARS ($<span style="text-decoration:underline" class="lease">{{ number_format($data['montly_fee'],2 ) }}</span>   ) per month</p>
            <p>and except that such tenancy shall be terminable upon fifteen (15) days written notice served by either party. </p>
         </tr>
</table>




<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 16.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>SURRENDER OF PREMISES. </strong>Upon the expiration of the term hereof, Tenant shall surrender the  Premises in as good</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p> a state and condition as they were at the commencement of this Agreement, reasonable use  and wear and tear thereof</p>
            <p>  and damages by the elements excepted.</p>
         </tr>
</table>


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 17.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>QUIET ENJOYMENT. </strong> Tenant, upon payment of all of the sums referred to herein as being payable by Tenant </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
            <p>and Tenant's performance of all Tenant's agreements contained herein and Tenant's observance of all rules and regulations,</p>
            <p> shall and may peacefully and quietly have, hold and enjoy said Premises for the termhereof.</p>
         </tr>
</table>




<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 18.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>INDEMNIFICATION. </strong> Landlord shall not be liable for any damage or injury of or to the Tenant,Tenant's family, </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
             <p>guests, invitees, agents or employees or to any person entering the Premises or the building of which the Premises are a</p>
             <p> part or to goods or equipment, or in the structure or equipment of the structure of which the Premises are a part, and </p>
             <p> Tenant hereby agrees to indemnify, defend and hold Landlord harmless from any and all claims or assertions of every kind</p>
             <p> and nature</p>
         </tr>
</table>
<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 19.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>DEFAULT. </strong> If Tenant fails to comply with any of the material provisions of this Agreement, other than the  </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
             <p>covenant to pay rent, or of any present rules and regulations or any that may be hereafter prescribed by Landlord, or </p>
             <p>materially fails to comply with any duties imposed on Tenant by statute, within seven (7) days after delivery of written</p>
             <p> notice by Landlord specifying the noncompliance and indicating the intention of Landlord to terminate the Lease by reason</p>
             <p> thereof, Landlord may terminatethis Agreement. If Tenant fails to pay rent when due and the default continues for seven (7)</p>
             <p> days thereafter, Landlord may, at Landlord's option, declare the entire balance of rent payable hereunder to be immediately</p>
             <p> due and payable and may exercise any and all rights and remedies available to Landlord at law or in equity or may</p>
             <p> immediately terminate this Agreement. </p>
       </tr>
</table>





    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>


        {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>











   



 

<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:30px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 20.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>LATE CHARGE. </strong> In the event that any payment required to be paid by Tenant hereunder is not made within five (5) </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
             <p>business days of when due, Tenant shall pay to Landlord, in addition to such payment or other charges due hereunder, </p>
             <p> a "late fee" in the amount of ($_ 50.00 ). <span style="text-decoration:underline"> For purposes of this section, a "business day" means any day </span></p>
             <p> other than a Saturday, Sunday or State or federal holiday.</p>
       </tr>
</table>



<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 21.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>ABANDONMENT. </strong> If at any time during the term of this Agreement Tenant abandons the Premises or </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p>any part thereof, Landlord may, at Landlord's option, obtain possession of the Premises in the manner provided by law, </p>
              <p> and without becoming liable to Tenant for damages or for any payment of any kind whatever. Landlord may, at  Landlord's</p>
              <p>as agent for Tenant, relet the Premises, or any part thereof, for the whole or any part  discretion,  thereof, for </p>
              <p>the whole or any part of the then unexpired term, and may receive and collect all rent payable by virtue  of such reletting, </p>
              <p> and, at Landlord's option, hold Tenant liable for any difference between the rent that would have been  payable under</p>
              <p> this Agreement during the balance of the unexpired term, if this Agreement had continued in force, and the  net rent </p>
              <p>for such period realized by Landlord by means of such reletting. If Landlord's right of reentry is exercised following</p>
              <p> abandonment of the Premises by Tenant, then Landlord shall consider any personal property belonging to Tenant  and  </p>
              <p>left on the Premises to also have been abandoned, in which case Landlord may dispose of all  such personal property in</p>
              <p> any manner Landlord shall deem proper and Landlord is hereby relieved of all liability for doing so. </p>
              <p>&nbsp;</p>
       </tr>
</table>







 



<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 22.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>ATTORNEYS' FEES. </strong>Should it become necessary for Landlord to employ an attorney to enforce any of the  </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p>conditions or covenants hereof, including the collection of rentals or gaining possession of the Premises, Tenant agrees to</p>
              <p> pay all expenses so incurred, including a reasonable attorneys' fee.</p>
       </tr>
</table>







<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 23.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>RECORDING OF AGREEMENT. </strong> Tenant shall not record this Agreement on the Public Records of any public office. </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p>In the event that Tenant shall record this Agreement, this Agreement shall, at Landlord's option, terminate immediately and</p>
              <p> Landlord shall be entitled to all rights and remedies that it has at law or inequity.</p>
       </tr>
</table>





<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 24.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>GOVERNING LAW. </strong> This Agreement shall be governed, construed and interpreted by, through and under the Laws of </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p>the State of {{ $data['full_state'] }}.</p>
       </tr>
</table>
<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 25.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>SEVERABILITY.  </strong>If any provision of this Agreement or the application thereof shall, for any reason and to any extent, be </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p> invalid or unenforceable, neither the remainder of this Agreement nor the application of the provision to other persons,</p>
              <p> entities or circumstances shall be affected thereby, but instead shall be enforced to the maximum extent permitted by law.</p>

       </tr>
</table>






<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 26.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>BINDING EFFECT. </strong>The covenants, obligations and conditions herein contained shall be binding on and inure</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p> to the benefit of the heirs, legal representatives, and assigns of the parties hereto.</p>
       </tr>
</table>













    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>


    {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>













<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 27.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>DESCRIPTIVE HEADINGS. </strong> The descriptive headings used herein are for convenience of reference only and they </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p>are not intended to have any effect whatsoever in determining the rights or obligations of the Landlord or Tenant.</p>
       </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 28.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>CONSTRUCTION. </strong> The pronouns used herein shall include, where appropriate, either gender or both, singular and plural.</span>
             </td> 
       </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 29.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong> MODIFICATION. </strong>The parties hereby agree that this document contains the entire agreement between the parties and </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p> this Agreement shall not be modified, changed, altered or amended in any way except through a written amendment </p>
              <p> signed by all of the parties here to.</p>
       </tr>
</table> 



<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">

   <tr>
      <td width="5%" align="left">
         <span> 30.</span>
      </td>
      <td style="padding:0px;" align="left">
         <span><strong>CRIME INSURANCE. </strong>As required by law under Title VI of the Housing and Urban Development Act of 1970,</span>
        </td> 
  </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p>the Federal Government is subsidizing crime insurance in order to make the same available to  Residents in the</p>
              <p>State of {{ $data['full_state'] }}. Tenant, as a Resident, may be eligible to purchase this  insurance from the</p>
              <p>SAFETY MANAGEMENT INSTITUTE, located in Washington, D.C. Tenant may contact this company directly to  obtain </p>
              <p> an application and further information. Tenant may call the following toll free number:  (800) 638-8780. Crime </p>
              <p>insurance is available for tenants in all habitable property through the {{ $data['full_state'] }}  Underwriters  </p>
              <p>Association, Crime  Insurance Indemnity Plan.</p>
       </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span>31.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>CHILD PROTECTION WINDOW GUARD OPTION. </strong>Pursuant to {{ $data['full_state'] }} law ({{ $lease->state }}SA Section 55:13A-7.14), </span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p> Tenant can have window guards installed on the Premises and the public halls (1) by making a written request to Landlord</p>
              <p> and (2) if a child 10 years of age or younger resides on the Premises and (3) if Tenant lives in a dwelling above the first</p>
              <p> floor. Residents living on  the first floor may  only request window guards on windows in public halls above the first</p>
              <p> floor to which persons in the resident's dwelling have access without having to go out of the building. Landlord may, </p>
              <p> at Landlord's option,  recoup the costs associated with the installation of  the window guards through increased rent.</p>
             <
       </tr>
</table> 

<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 32.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>RETURN OF KEYS. </strong>Tenant must return the keys to the Premises to Landlord when Tenant vacates the Premises</span>
             </td> 
       </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding-top:10px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <span> 33.</span>
           </td>
           <td style="padding:0px;" align="left">
              <span><strong>TRUTH IN RENTING. </strong>Resident acknowledges receipt today of the Truth in Renting information, required to be</span>
             </td> 
       </tr>
        <tr>
            <td width="5%"style="padding:0px;" align="left">
            <p>&nbsp;</p>
           </td>
           <td  style="padding:0px;" align="left">
              <p> provided by {{ $data['full_state'] }} law ({{ $lease->state }}SA Section 46: 8-45).</p>
              <p>&nbsp;</p>
       </tr>
</table> 








    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>


    {{-- page break --}}
    <div class="page-break"></div>
    {{-- page break --}}


    <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-bottom:30px" class="smsize">
        <tr>

            <td style="padding:0px;" align="left"> DocuSign Envelope ID: {{ $data['dd']}}</td>
             <td style="padding:0px;" align="right">  </td>
        </tr>
    </table>
















 



<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding:20px 0px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <p> LANDLORD: </p>
           </td>
        </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding:20px 0px;" class="smsize">
        <tr>
           <td width="30%" align="left">
              <p> Sign: ___________________</p>
           </td>
          <td width="50%" align="left">
              <p> Print: <span style="text-decoration:underline" class="lease">&nbsp;&nbsp;{{ strtoupper($lease->landlord_first_name) }}  {{ strtoupper($lease->landlord_last_name) }}&nbsp;&nbsp;&nbsp;</span></span></p>
           </td>
           <td width="20%" align="left">
              <p> Date: <span style="text-decoration:underline" class="lease">&nbsp;&nbsp;{{ strtolower($data['remove_date'] ) }}&nbsp;&nbsp;&nbsp;</span></p>
           </td>
        </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding:20px 0px;" class="smsize">
        <tr>
           <td width="5%" align="left">
              <p> TENANT ("Tenant"):  </p>
           </td>
        </tr>
</table> 


<table width="100%" cellspacing="" cellpadding="0" border="0" style="padding:20px 0px;" class="smsize">
        <tr>
           <td width="30%" align="left">
              <p> Sign: ___________________</p>
           </td>
           <td width="50%" align="left">
            <p> Print: <span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;{{ strtoupper($lease->first_name) }}  {{ strtoupper($lease->last_name) }}&nbsp;&nbsp;&nbsp;</span></p>
           </td>
           </td>
           <td width="20%" align="left">
              <p> Date:<span style="text-decoration:underline" class="lease">&nbsp;&nbsp;&nbsp;{{ strtolower($data['remove_date'] ) }}&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
           </td>
        </tr>
</table> 

@if($lease->landlord_signature == "YES")
    <div style=" position: absolute;left:30px;top:130px;z-index:-1">
          <img width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/landlord_sign/'. $data['code'].'.png'))) }}"><br>
    </div>
@endif

@if($lease->tenant_signature == "YES")
        <div style=" position: absolute;left:30px;top:300px;z-index:-1">
          <img width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/sign/'. $data['code'].'.png'))) }}"><br>
    </div>
@endif
    <div style="margin-top:50px">
          <img  width="200px" height="100px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/docusign.png'))) }}"><br>
    </div>


    @if($lease->tenant_signature == "YES")
    <div style=" position: absolute;left:50px;top:430px;z-index:-1">
          <img width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/sign/'. $data['code'].'.png'))) }}"><br>
    </div>
     @endif

 
    <div style=" position: absolute;left:50px;top:485px;z-index:-1" > {{$data['docucode']}}...</div>



    <div style=" position: absolute;left:0px;top:970px;z-index:-1">
          <img width="70px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('rental/ehlogo.png'))) }}"><br>
    </div>



 
    <script type="text/php">
        if (isset($pdf)) {
            $x = 520;
            $y = 20;
            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
            $font = null;
            $size = 7;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>

</body>

</html>
