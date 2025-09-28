
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>
  <link rel="stylesheet" href="{{ public_path('css/test.css') }}" type="text/css" media="all">
  <head>
<link href='https://fonts.googleapis.com/css?family=Sigmar+One' rel='stylesheet' type='text/css'>
</head>

  <style>
      @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');

      .table {
          border-collapse: collapse;
      }

      body {
          font-family: 'Open Sans', sans-serif;
          padding:0px 30px;

      }

      

      .strong{
          font-weight:900;
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

    .lawsign1
    {
    position:absolute;
      top: 0px;
      left: 15px;
      z-index: 1;
    }
    .lawsign2
    {
      position:absolute;
      top: 15px;
      left: 20px;
      z-index: 2;
    }
    .witness1
    {
    position:absolute;
      top: 0px;
      left: 15px;
      z-index: 1;
    }
    .witness2
    {
      position:absolute;
      top: 15px;
      left: 20px;
      z-index: 2;
    }
    .probate1
    {
    position:absolute;
      top: 0px;
      left: 15px;
      z-index: 1;
    }
    .probate2
    {
      position:absolute;
      top: 15px;
      left: 20px;
      z-index: 2;
    }
    .lawbg
    {
    position:absolute;
      top: -60px;
      left: 15px;
      z-index: 1;
    }
    .lawbg1
    {
      position:absolute;
      top: -98px;
      left: 180px;
      z-index: 3;
    }
    .lawbg2
    {
      position:absolute;
      top: -61px;
      left: 245px;
      font-size: 12px;
      z-index: 3;
    }
    .law_country
    {
      font-weight:bold;
      position:absolute;
      top: -45px;
      left: 290px;
      font-size: 12px;
      z-index: 3;
    }
    .law_expiry
    {
      position:absolute;
      top: -30px;
      left: 270px;
      font-size: 12px;
      z-index: 3;
    }
    .cour{
      font-family: 'Courier New'
    }

@font-face {
font-family: 'Courier New';
    src: url("{{ storage_path('fonts/cour.ttf')  }}") format("truetype");
    font-weight: bold;
    font-style: bold;
}


  </style>
</head>

<body>

<table width="100%" cellspacing="" cellpadding="0" border="0">

  <tr>
      <td width="20%" style="padding:0px;" align="right">
          <p style="padding-top:20px">
           </p>
      </td>
      <td width="50%" style="padding:0px;" align="center">
 <img style="margin:20;padding:0" width="200px" height="180px"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/law.png'))) }}">
      </td>
      <td width="30%" style="padding:0px;" align="right">
      </td>
  </tr>

  <tr class="strong" style="margin:30px;">
      <td width="20%" style="padding:0px;" align="right">
      </td>
      <td width="50%" style="padding:0px; font-weight:900px" align="center">
      <div><strong>  {{ strtoupper($data->law_firm_name)}} </strong></div>
      <div style="color:#1f3864"> <strong>{{ strtoupper( $data->law_firm_address ) }}</strong> </div>
      <br/>
          {{-- <div style="padding-bottom:20px">United Kingdom</div> --}}
      </td>
      <td width="30%" style="padding:0px;" align="right">
      </td>
  </tr>
</table>

<div width="100%" style="border:1px #000 solid "></div>
<table width="100%" cellspacing="" style="padding:100px 0px" cellpadding="0" border="0">
  <tr class="strong">
      <td width="20%" style="padding:0px;" align="right">
      </td>
      <td width="50%" style="padding:0px;" align="center">
      <p>LAST WILL AND TESTAMENT</p>
<p>OF</p>
<p> {{ strtoupper($data->client_name )}} </p>
      </td>
      <td width="30%" style="padding:0px;" align="right">
      </td>
  </tr>
</table>

<div width="100%" style="border:1px #000 solid "></div>

<table width="100%" cellspacing="" style="padding:100px 0px" cellpadding="0" border="0">
  <tr >
      <td width="20%" style="padding:0px;" align="right">
      </td>
      <td width="50%" style="padding:0px;" align="center">
      <p>Date:  {{ date("m/d/Y", strtotime($data->issued_date)) }} </p>
      </td>
      <td width="30%" style="padding:0px;" align="right">
      </td>
  </tr>
</table>

{{-- page break --}}

<div class="page-break"></div>


<table width="100%" cellspacing="" style="padding:0px 0px" cellpadding="0" border="0">
  <tr class="strong">
      <td width="20%" style="padding:0px;" align="right">
      </td>
      <td width="50%" style="padding:0px;" align="center">
          <p>LAST WILL AND TESTAMENT</p>
          <p>OF</p>
          <p>{{ strtoupper($data->client_name)}}</p>
      </td>
      <td width="30%" style="padding:0px;" align="right">
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin:30px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%" >
      <div>This is the Last Will and Testament of <strong>{{ ucwords(strtolower($data->testator))}}</strong> of <strong>{{ ucwords(strtolower($data->testator_address))}}</strong>.</div>
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >1.</td>
      <td width="95%" >
      <div>I, being of sound and disposing mind and memory and having attained the age of majority,
hereby revoke all former Wills, codicils and other testamentary dispositions at any time
heretofore made by me and declare this to be my last Will..</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >2.</td>
      <td width="95%" >
      <div>I am divorcee at the time of this Last Will and Testament</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >3.</td>
      <td width="95%" >
      <div>I appoint <strong>Attorney {{ ucwords(strtolower($data->lawyer ))}}</strong> of <strong>{{ ucwords(strtolower($data->law_firm_name ))}}</strong> (hereinafter called
"my Executor") to be executor of this my Will. The expression "Executor" wherever used in this my
Will shall, unless otherwise stated, mean the person or persons from time to time acting
in the office of executor and personal representative of this my Will, and wherever the
singular or masculine are used throughout this Will, the same shall be construed as meaning the
plural or feminine or body corporate (and vice versa) where the context so requires</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >4.</td>
      <td width="95%" >
      <div>I direct that my Executor to give Beneficiaries:</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >5.</td>
      <td width="95%" >
      <div>Name: <strong>{{ ucwords(strtolower($data->dating_name ))}}  ( {{ ucwords(strtolower($data->dating_connection ))}}  )</strong></div>
      </td>
  </tr>
</table>
<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >6.</td>
      <td width="95%" >
      <div>Name: <strong>{{ ucwords(strtolower($data->client_name ))}} ( {{ ucwords(strtolower($data->client_connection ))}})</strong> </div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >7.</td>
      <td width="95%">
      <div>I give and bequeath the following:</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >8.</td>
      <td width="95%">
      <div><strong>Sum of   {{ $info['currency']}}{{ number_format($data->amount,2 ) }} ( {{ ucwords(strtolower($info['amount_in_words'] ))}} {{ $data->currency}}) </strong></div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" >9.</td>
      <td width="95%">
      <div><strong>{{ $data->property }}</strong>
In addition to all powers allowable to Executors under the laws of this state, my Executor shall have
the following powers:</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(i)</td>
      <td width="90%">
      <div>to ensure the money in the offshore bank account be fixed all through the years till it will
be claimed</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(ii)</td>
      <td width="90%">
      <div>to manage and maintain the property till Beneficiaries of my Will are ready to claim</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(iii)</td>
      <td width="90%">
      <div>The Beneficiaries of my Will handle all the legal fees attached to the claim. I request the
show a sense of responsibility as they to take up what is bequeathed to them.</div>
      </td>
  </tr>
</table>


{{-- page break --}}

<div class="page-break"></div>



<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>On the death of the trust beneficiary, in which case the property being held for that trust
beneficiary shall be paid over and distributed (i) under the terms of the trust beneficiary's Will,
(ii) to the trust beneficiary's issue (if any), per stirpes, or in default of such, (iii) to the trust
beneficiary's brothers and sisters and descendants of deceased brothers and sisters, per
stirpes, or, in default of such, (iv) to my heirs, determined as if I had died at the time of the
trust beneficiary's death, pursuant to the General Statutes as written on the
date of this Will</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>In addition to all statutory powers and common law powers of gratuitous trustees, and special
powers herein conferred, a trustee of an individual child trust shall have the fullest powers of
investment, realization, administration, management and division of the trust estate or any part
thereof as if that trustee was the beneficial owner thereof; and without prejudice to the
generality of the foregoing, that trustee shall have the powers set out hereinafter:</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin-top:30px;margin-bottom:20px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(i)</td>
      <td width="90%">
      <div>to receive from any person, to retain and to invest and reinvest in any kind of property or
investment;</div>
      </td>
  </tr>
</table>
<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(ii)</td>
      <td width="90%">
      <div>to exercise or sell all rights, options, powers and privileges, and to vote in person or by
proxy, in relation to any stocks, bonds or other securities, all as fully as might be done by
persons owning similar property in their own right;</div>
      </td>
  </tr>
</table>
<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(iii)</td>
      <td width="90%">
      <div>to assent to, oppose and participate in any reorganization, recapitalization, merger,
consolidation or similar proceeding, to deposit securities, delegate discretionary powers,
pay assessments or other expenses and exchange property, all as fully as might be done
by persons owning similar property in their own right;</div>
      </td>
  </tr>
</table>
<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(iv)</td>
      <td width="90%">
      <div>to employ or retain such agents and advisors, including any firm with which any fiduciary
may be affiliated, as may seem advisable and to delegate authority thereto, and to
compensate them from the funds of my estate provided such compensation is reasonable
in the circumstances; and</div>
      </td>
  </tr>
</table>
<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
  <td width="5%" ></td>
  <td width="5%" >(v)</td>
      <td width="90%">
      <div>to pay all necessary or proper expenses and charges from income or principal, or
partly fromeach, in such manner as may seem equitable</div>
      </td>
  </tr>
</table>





{{-- page break --}}

<div class="page-break"></div>







<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>To the extent that provision has not been made under the Will for the management of any
property, asset or item to be given outright to a person who is a minor, my Executor may,
without court approval, pay or transfer all or part of such property to a parent or guardian of
that minor or that minor's estate, to a custodian under the Uniform Transfers to Minors Act, or
may defer payment or transfer of such property until the minor reaches the age of majority, as
defined by his or her state of residence. No bondshall be required for such payments.</div>
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>I declare that no executor of this Will shall be liable for any loss not attributable to the executor's own
dishonesty or to the willful commission by the executor of any act known to be a breach of
executor's duties and obligations as executor</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>I direct my Executor to pay all estate, inheritance and succession taxes (including any interest and
penalties thereon) payable by reason of my death in accordance with the laws of the state.</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin:20px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>If any portion of my Will shall be held illegal, invalid or otherwise inoperative, it is my intention that all
of the other provisions hereof shall continue to be fully effective and operative insofar as is
possible and reasonable</div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin-top:10px;margin-bottom:70px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>IN WITNESS HEREOF, I sign the foregoing as my Last Will and Testament, do it willingly and as

my free andvoluntary act for the purpose herein expressed, this day  <span style="text-decoration: underline">{{ $info['day_month']  }}  </span> </div>of 20<span style="text-decoration: underline">{{ $info['year_last_num']  }}  </span> 

</div>
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin-top:100px;margin:bottom:10px" cellpadding="0" border="0">
  <tr>
  <td width="60%">
      <div>Full Name of Testator  <span style="text-decoration: underline">{{ ucwords(strtolower($data->testator )) }}</span></div>
      </td>
      <td width="40%">
      <div>Date <span style="text-decoration: underline">{{ date("m/d/Y", strtotime($data->issued_date))  }}  </span> </div>
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin:100px 0px" cellpadding="0" border="0">
  <tr>
  <td width="30%">
      <div></div>
      </td>
      <td width="40%">
      <div>   <img width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/sign/testator_'.$info['time'].'.png'))) }}">   </div>
      <div><span style="text-decoration: overline">Signature of Testator</span></div>
      </td>
      <td width="30%">
      <div></div>
      </td>
  </tr>
</table>



<table width="100%" cellspacing="" style="margin:10px 0px" cellpadding="0" border="0">
  <tr>
      <td width="100%">
      <div>Signed by the said Testator as and for his last will and testament in our presence both of us being
present at the same time who at his request and in his presence and in the presence of each other
have hereunto subscribed our names as witnesses</div>
      </td>
  </tr>
</table>



{{-- page break --}}

<div class="page-break"></div>




<table width="100%" cellspacing="" style="margin-top:30px;margin-bottom:15px" cellpadding="0" border="0">
  <tr>
     <td width="10%">
      <div></div>
      </td>
      <td width="30%">
     
    <div style="position: relative; left: 0; top: 0;">
      <img class="witness1" width="80px" height="80px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/red_label.png'))) }}"> 
      <img class="witness2"  width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/sign/witness_'.$info['time'].'.png'))) }}"> 
    </div>   




      </td>
      <td width="15%">
      <div></div>
      </td>
      <td width="35%">
    <div style="position: relative; left: 0; top: 0;">
      <img class="probate1" width="80px" height="80px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/red_label.png'))) }}"> 
      <img class="probate2"  width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/sign/probate_'.$info['time'].'.png'))) }}"> </div>
    
      </td>
      <td width="10%">
      <div></div>
      </td>
  </tr>
</table>

<table width="100%" cellspacing="" style="margin-top:80px 0px" cellpadding="0" border="0">
  <tr>
     <td width="10%">
      <div></div>
      </td>
      <td width="30%"> <div>  <span style="text-decoration: overline">Signature of Witness </span></div>
      </td>
      <td width="15%">
      <div></div>
      </td>
      <td width="35%"> <div><span style="text-decoration: overline"> Signature of Probate Officer </span></div>
      </td>
      <td width="10%">
      <div></div>
      </td>
  </tr>
</table>














<table width="100%" cellspacing="" style="margin:50px 0px" cellpadding="0" border="0">
  <tr>
     <td width="10%">
      <div></div>
      </td>
      <td width="30%">
     <div>{{ strtoupper($info['witness_first_name']) }} {{ strtoupper($info['witness_last_name']) }}</div>
      <div><span style="text-decoration: overline">Name of Witness </span></div>
      </td>
      <td width="15%">
      <div></div>
      </td>
      <td width="35%">
      <div>{{ strtoupper($info['probate_first_name']) }} {{ strtoupper($info['probate_last_name']) }}</div>
      <div><span style="text-decoration: overline">Name of Probate Officer </span></div>
      </td>
      <td width="10%">
      <div></div>
      </td>
  </tr>
</table>














<table width="100%" cellspacing="" style="margin:50px 0px" cellpadding="0" border="0">
  <tr>
     <td width="10%">
      <div></div>
      </td>
      <td width="30%">
      

             
    <div style="position: relative; left: 0; top: 0;">
      <img class="lawsign1" width="80px" height="80px"  style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/red_label.png'))) }}"> 
      <img class="lawsign2"width="100px" height="60px" style="margin:0;padding:0"
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/sign/lawyer_'.$info['time'].'.png'))) }}"> 
    </div>       
      </td>
      <td width="15%">
      <div></div>
      </td>
      <td width="35%">
      <div></div>
      </td>
      <td width="10%">
      <div></div>
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin-top:80px 0px" cellpadding="0" border="0">
  <tr>
     <td width="10%">
      <div></div>
      </td>
      <td width="30%">   
       <div><span style="text-decoration: overline">Signature of Attorney </span></div>
      </td>
      <td width="15%">
      <div></div>
      </td>
      <td width="35%">
      <div></div>
      </td>
      <td width="10%">
      <div></div>
      </td>
  </tr>
</table>


<table width="100%" cellspacing="" style="margin:50px 0px" cellpadding="0" border="0">
  <tr>
     <td width="10%">
      <div></div>
      </td>
      <td width="30%">
      <div><div >{{ strtoupper($data->lawyer) }}</div></div>
      <div><span style="text-decoration: overline; ">Name of Attorney</span></div>
      </td>
      <td width="5%">
      <div></div>
      </td>
      <td width="45%">
     
    <div style="position: relative; left: 0; top: 0;">
    <div class="lawbg"><img  class="lawbg" width="360px" height="130px" style="margin:0;padding:0" 
             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('will/lawyer_stamp.png'))) }}"> </div>
    <div class="lawbg1" style="font-size:15px;"><strong>{{ strtoupper($data->law_firm_name) }}</strong></div>  
    <div class="lawbg2">{{ strtoupper($info['comm']) }}</div>  
     <div class="law_country">{{ strtoupper($data->law_firm_country) }}</div>  
    <div class="law_expiry">{{ strtoupper($info['law_expiry']) }}</div>  
    </div>  
      </td>
      <td width="10%">
      <div></div>
      </td>
  </tr>
</table>


</body>
</html>