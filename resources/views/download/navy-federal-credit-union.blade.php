<?php
use App\Models\Transaction;
$fees = number_format(rand(10, 90), 2);
$access = rand(12345, 2334324242);
$year = date('Y', strtotime($statement->toDate));

function cal_bal_by_key($opening_balance, $key, $transactions,$statement_id)
{
$trans = Transaction::where('statement_id', $statement_id)
->take(0)
->limit($key)
->get();


$inSum = $opening_balance;
$outSum = 0;
foreach ($trans as $value) {
$inSum += $value->paidin;
$outSum += $value->paidout;
}
$result = $inSum - $outSum;
return number_format($result, 2);
}


$tranx1 = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->get();
$tranx2 = Transaction::where('statement_id', $statement->id)
->where('paidin', 0)
->get();

$transactions_ordinary = $transactions;
$transactions = $transactions->get();

$from = strtotime($statement->fromDate);
$to = strtotime($statement->toDate);
$datediff = $to - $from;

$day = round($datediff / (60 * 60 * 24));

$month = floor($day / 30);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="{{ public_path('css/test.css') }}" type="text/css" media="all">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');

        .table {
            border-collapse: collapse;
        }

        body {
            font-family: 'Open Sans', sans-serif;

        }

        .sssize {
            font-size: 11px;
        }

        .mdsize {
            font-size: 12px;
        }

        .lgsize {
            font-size: 14px;
        }

        .llgsize {
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

    <div style=" 
    z-index:-1000;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)               
    ">
        <img width="450" height="450" style="margin:0;padding:0;opacity: 0.09;"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union/globe.png'))) }}"><br>

    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="50%" style="padding:0px;" align="left">
                <img width="120" height="70" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union.png'))) }}"><br>
                <div class="sssize" style="color:#666"><small>P.O.Box 3000 . Merrifield,VA. 22119-3000 <br>
                        navyfederal.org</small></div>
            </td>
            <td width="30%" style="padding:0px;padding-top:30px" align="center">
                Statement Period <br>
                {{ $statement->fromDate }} - {{ $statement->toDate }}
            </td>
            <td width="20%" style="padding:0px;" align="left"></td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left"></td>
            <th width="45%" style="padding:0px;" align="left">
            </th>
            <td width="30%" style="padding:0px;padding-top:30px" align="center">
                Access No. {{ $access }}
            </td>
            <td width="20%" style="padding:0px;" align="left"></td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="10%" style="padding:0px;" align="left"></td>
            <td width="40%"  style="padding:0px;text-transform:uppercase" align="left" class="mdsize">
                #BWNLLSV <br>
                #000{{ $fees }}Q3S7YYT6A8#000JMA90F <br>
                <span>{{ $statement->business_name }} <br /> {{ $statement->full_name }}</span><br />
                <span>{{ $statement->address }} </span><br />
                <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
            </td>
            <td width="30%" style="padding:0px;padding-top:30px" align="center" class="sssize">
                <p>Routing Number: {{ $statement->routing_number }}</p>
                Questions about this Statement? <br>
                Toll-free in the U.S. 1-888-842-6328<br>
                For toll-free numbers when overseas,<br>
                visit <strong>navyfederal.org/overseas/</strong> <br>
                Collect internationally 1-703-255-8837
                <p>
                    <strong>Say "Yes" to Paperless! View your digital statements via Mobile or Navy Federal Online
                        Banking.</strong>
                </p>
            </td>
            <td width="20%" style="padding:0px;" align="left"></td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="20%" style="padding:0px;" align="left"></td>
            <td width="60%" style="padding:0px;" align="left" class="sssize">
                <span style="font-weight:bolder">Say "Yes" to Paperless Statements</span> <br>
                If you haven't already, go paperless! You can access up to 36 months of statements anytime, anywhere.
                <br>
                To get started, select "Statements" in digital banking.* <br>
                It's an easy way to reduce the risk of identity theft and cut down on paper clutter. <br>
                Insured by NCUA. *Message and data rates may apply. Visit <strong>navyfederal.org</strong> for more
                information.
            </td>
            <td width="20%" style="padding:0px;" align="left"></td>
        </tr>
    </table>


    <h3>Summary of your deposit accounts</h3>



    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:100px;margin-top:10px"
        class="sssize">
        <tr>
            <th width="20%" style="padding:0px;border-bottom:1px solid #000" align="left">
            </th>
            <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="center">
                Previous <br>Balance
            </th>
            <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="center">
                Deposits/ <br> Credits
            </th>
            <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="center">
                Withdrawals/ <br>Debits
            </th>
            <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="center">
                Ending <br>Balance
            </th>
            <th width="20%" style="padding:0px;border-bottom:1px solid #000;border-left:1px solid #000" align="right">
                YTD <br>Dividends
            </th>
        </tr>
        <tr>
            <td width="20%" style="padding:0px;" align="left">
                <strong>Flagship Checking</strong> <br>{{ $statement->account_card_number }}
            </td>
            <td width="15%" style="padding:0px;" align="center">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </td>
            <td width="15%" style="padding:0px;" align="center">
                {{ $currency . '' . number_format($calculation['credit'], 2) }}
            </td>
            <td width="15%" style="padding:0px;" align="center">
                {{ $currency . '' . number_format($calculation['debit'], 2) }}
            </td>
            <td width="15%" style="padding:0px;" align="center">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </td>
            <td width="20%" style="padding:0px;border-left:1px solid #000;" align="right">
                $0.00
            </td>
        </tr>
        <tr>
            <th width="20%" style="padding:0px;border-top:1px solid #000;" align="left">
                <strong>Totals</strong>
            </th>
            <th width="15%" style="padding:0px;border-top:1px solid #000;" align="center">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </th>
            <th width="15%" style="padding:0px;border-top:1px solid #000;" align="center">
                {{ $currency . '' . number_format($calculation['credit'], 2) }}
            </th>
            <th width="15%" style="padding:0px;border-top:1px solid #000;" align="center">
                {{ $currency . '' . number_format($calculation['debit'], 2) }}
                </td>
            </th>
            <th width="15%" style="padding:0px;border-top:1px solid #000;" align="center">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </th>
            <th width="20%" style="padding:0px;border-top:1px solid #000;border-left:1px solid #000;" align="right">
                $0.00
            </th>
        </tr>
    </table>







    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                <div style="text-align:center">
                    {{ $statement->business_name }} <span>&nbsp;</span> {{ $statement->full_name }} <br>
                    {{ $access }}
                </div>

                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <td width="35%" style="padding:0px;" align="left">
                           
                        </td>
                        <td width="5%" style="padding:0px;" align="left">
                            
                        </td>
                        <td width="30%" style="padding:0px;" align="right">
                           
                        </td>
                        <td width="30%" style="padding:0px;" align="left">
                        </td>
                    </tr>
                </table>



                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="30%" style="padding:0px;" align="right">
                        </td>
                        <td width="70%" style="padding:0px;" align="left" class="sssize">
                            <strong> NFCU <br>
                                PO BOX 3100<br>
                                MERRIFIELD VA 22119-3100</strong>
                        </td>
                    </tr>
                </table>

                <p>&nbsp;</p>

            </td>



            <td width="50%" style="padding:0px;text-align:center" align="left">
                <h3>DEPOSIT VOUCHER</h3>
                <div style="font-size:10px">
                    (FOR MAIL USE ONLY. DO NOT SEND CASH THROUGH THE MAIL <br>
                    DEPOSITS MAY NOT BE AVAILABLE FOR IMMEDIATE WITHDRAWAL)
                </div>
                <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top:10px">
                    <tr style="background:#ccc">
                        <td width="40%" style="padding:0px;" align="center">
                            <span style="font-size:10px">ACCOUNT NUMBER</span>
                        </td>
                        <td width="25%" style="padding:0px;" align="center">
                            <span style="font-size:10px">ACCOUNT TYPE</span>
                        </td>
                        <td width="40%" style="padding:0px;" align="center">
                            <span style="font-size:10px"> AMOUNT ENCLOSED</span>
                        </td>
                    </tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="1" class="sssize">
                    <tr>
                        <td width="40%" style="padding:-left:5px;" align="left">
                            {{ $statement->account_card_number }}
                        </td>
                        <td width="25%" style="padding:-left:10px;" align="left">
                            Checking
                        </td>
                        <td width="25%" style="padding:0px;" align="left">
                        </td>
                        <td width="10%" style="padding:0px;" align="left">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:-left:5px;" align="left">
                            <span>&nbsp;</span>
                        </td>
                        <td width="25%" style="padding:-left:10px;" align="left">

                        </td>
                        <td width="25%" style="padding:0px;" align="left">
                        </td>
                        <td width="10%" style="padding:0px;" align="left">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:-left:5px;" align="left">
                            <span>&nbsp;</span>
                        </td>
                        <td width="25%" style="padding:-left:10px;" align="left">

                        </td>
                        <td width="25%" style="padding:0px;" align="left">
                        </td>
                        <td width="10%" style="padding:0px;" align="left">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:-left:5px;" align="left">
                            <span>&nbsp;</span>
                        </td>
                        <td width="25%" style="padding:-left:10px;" align="left">

                        </td>
                        <td width="25%" style="padding:0px;" align="left">
                        </td>
                        <td width="10%" style="padding:0px;" align="left">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:-left:5px;" align="left">
                            <p>&nbsp;</p>
                        </td>
                        <td width="25%" style="padding:-left:10px;" align="left">
                        </td>
                        <td width="25%" style="padding:0px;" align="left">
                        </td>
                        <td width="10%" style="padding:0px;" align="left">
                        </td>
                    </tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="" class="sssize">
                    <tr>
                        <td width="65%" style="padding:-left:5px;" align="right">
                            TOTAL
                        </td>
                        <td width="25%" style="padding:0px;border-left:1px solid #000;border-bottom:1px solid #000;"
                            align="left">
                        </td>
                        <td width="10%" style="padding:0px;border-left:1px solid #000;border-bottom:1px solid #000;"
                            align="left">
                        </td>
                    </tr>
                </table>


<p>&nbsp;</p>

            </td>
            <td width="10%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>







    {{-- page break --}}

    <div class="page-break"></div>

    <div style=" 
    z-index:-1000;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)               
    ">
        <img width="450" height="450" style="margin:0;padding:0;opacity: 0.09;"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union/globe.png'))) }}"><br>

    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize" style="margin-top:50px">
        <tr>
            <td width="70%" style="padding:0px;" align="left">
                <img width="120" height="70" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union.png'))) }}">
            </td>
            <td width="30%" style="padding:0px;padding-top:30px" align="left">
                Statement Period <br>
                {{ $statement->fromDate }} - {{ $statement->toDate }}
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left"></td>
            <th width="65%" style="padding:0px;" align="left">
                <span style="font-weight:bolder"><strong>Statement of Account</strong></span> <br>For
                {{ $statement->business_name }} <span>&nbsp;</span>{{ $statement->full_name }}
            </th>
            <td width="30%" style="padding:0px;padding-top:30px" align="left">
                Access No. {{ $access }}
            </td>
        </tr>
    </table>

    <div class="llgsize" style="font-weight: bold;margin-top:20px">Checking</div>
    <div class="lgsize" style="font-weight: bold;">Flagship Checking - {{ $statement->account_card_number }}</div>
    <div>Joint Owner(s): NONE</div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <th width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                Date
            </th>
            <th width="60%" style="padding:0px;border-bottom:1px solid #000" align="left">
                Transaction Detail
            </th>
            <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="right">
                Amount({{ $currency }})
            </th>
            <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="right">
                Balance({{ $currency }})
            </th>
        </tr>
        <tr>
            <td width="10%" style="padding:0px;" align="left">
                {{ date_format(date_create($statement->fromDate), 'm-d') }}
            </td>
            <td width="60%" style="padding:0px;" align="left">
                Beginning Balance
            </td>
            <td width="15%" style="padding:0px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </td>
        </tr>
    </table>
    @foreach ($tranx1 as $key => $value)
        @if ($key % 45 == 0 && $key !== 0)
            {{-- page break --}}

            <div class="page-break"></div>

            <div style=" 
                    z-index:-1000;
                    margin: 0;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    margin-right: -50%;
                    transform: translate(-50%, -50%)               
                    ">
                <img width="450" height="450" style="margin:0;padding:0;opacity: 0.09;"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union/globe.png'))) }}"><br>

            </div>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize" style="margin-top:50px">
                <tr>
                    <td width="70%" style="padding:0px;" align="left">
                        <img width="120" height="70" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union.png'))) }}">
                    </td>
                    <td width="30%" style="padding:0px;padding-top:30px" align="left">
                        Statement Period <br>
                        {{ $statement->fromDate }} - {{ $statement->toDate }}
                    </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left"></td>
                    <th width="65%" style="padding:0px;" align="left">
                        <span style="font-weight:bolder"><strong>Statement of Account</strong></span> <br>For
                        {{ $statement->business_name }} <span>&nbsp;</span>{{ $statement->full_name }}
                    </th>
                    <td width="30%" style="padding:0px;padding-top:30px" align="left">
                        Access No. {{ $access }}
                    </td>
                </tr>
            </table>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:20px 0px">
                <tr>
                    <td width="35%" style="padding:0px;" align="left">
                        <div class="lgsize" style="font-weight: bold;">Flagship Checking -
                            {{ $statement->account_card_number }}</div>
                    </td>
                    <td class="sssize" width="35%" style="padding:0px;" align="right">
                        (Continued from previous page)
                    </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                <tr>
                    <th width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        Date
                    </th>
                    <th width="60%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        Transaction Detail
                    </th>
                    <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="right">
                        Amount({{ $currency }})
                    </th>
                    <th width="15%" style="padding:0px;border-bottom:1px solid #000" align="right">
                        Balance({{ $currency }})
                    </th>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width="10%" style="padding:0px;" align="left">
                        {{ date_format(date_create($value->theDate), 'm-d') }}
                    </td>
                    <td width="60%" style="padding:0px;" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="15%" style="padding:0px;" align="right">
                        {{ $value->paidout == 0 ? '' : number_format($value->paidout, 2) . '-' }}
                        {{ $value->paidin == 0 ? '' : number_format($value->paidin, 2) }}
                    </td>
                    <td width="15%" style="padding:0px;" align="right">
                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1,
                        $transactions_ordinary,$statement->id); ?>
                    </td>
                </tr>
            </table>

        @else

            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width="10%" style="padding:0px;" align="left">
                        {{ date_format(date_create($value->theDate), 'm-d') }}
                    </td>
                    <td width="60%" style="padding:0px;" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="15%" style="padding:0px;" align="right">
                        {{ $value->paidout == 0 ? '' : number_format($value->paidout, 2) . '-' }}
                        {{ $value->paidin == 0 ? '' : number_format($value->paidin, 2) }}
                    </td>
                    <td width="15%" style="padding:0px;" align="right">
                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1,
                        $transactions_ordinary,$statement->id); ?>
                    </td>
                </tr>
            </table>
        @endif
    @endforeach
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <th width="10%" style="padding:0px;" align="left">
                {{ date('M-d', strtotime($statement->toDate)) }}
            </th>
            <th width="60%" style="padding:0px;" align="left">
                Ending Balance
            </th>
            <td width="15%" style="padding:0px;" align="right">
            </td>
            <th width="15%" style="padding:0px;" align="right">

                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </th>
        </tr>

    </table>
    <div class="sssize" style="margin:20px 0px"><em>Average Daily Balance - Current Cycle: {{ $currency . '' . number_format($calculation['total'], 2) }}
        Your account earned $0.37, with an annual percentage yield earned of 0.26%, for the dividend period from
        {{$statement->fromDate}} through {{$statement->toDate}}</em>
</div>













   {{-- page break --}}

   <div class="page-break"></div>

   <div style=" 
  z-index:-1000;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%)               
  ">
       <img width="450" height="450" style="margin:0;padding:0;opacity: 0.09;"
           src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union/globe.png'))) }}"><br>

   </div>


   <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize" style="margin-top:50px">
       <tr>
           <td width="70%" style="padding:0px;" align="left">
               <img width="120" height="70" style="margin:0;padding:0"
                   src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union.png'))) }}">
           </td>
           <td width="30%" style="padding:0px;padding-top:30px" align="left">
               Statement Period <br>
               {{ $statement->fromDate }} - {{ $statement->toDate }}
           </td>
       </tr>
   </table>

   <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
       <tr>
           <td width="5%" style="padding:0px;" align="left"></td>
           <th width="65%" style="padding:0px;" align="left">
               <span style="font-weight:bolder"><strong>Statement of Account</strong></span> <br>For
               {{ $statement->business_name }} <span>&nbsp;</span>{{ $statement->full_name }}
           </th>
           <td width="30%" style="padding:0px;padding-top:30px" align="left">
               Access No. {{ $access }}
           </td>
       </tr>
   </table>
    <h3>Items Paid</h3>
                 <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <th width="20%" style="padding:0px;border-bottom: 1px solid #000" align="left">Date
                        </th>
                        <th width="50%" style="padding:0px;border-bottom: 1px solid #000" align="left">Item
                        </th>
                        <th width="30%" style="padding:0px;border-bottom: 1px solid #000" align="left">Amount($)
                        </th>
                    </tr>
                </table>
   

        @foreach ($tranx2 as $key => $value)
                @if ($key % 32 == 0 && $key !== 0)
                       {{-- page break --}}
                        <div class="page-break"></div>
                        <div style=" 
                                z-index:-1000;
                                margin: 0;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                margin-right: -50%;
                                transform: translate(-50%, -50%)               
                                ">
                            <img width="450" height="450" style="margin:0;padding:0;opacity: 0.09;"
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union/globe.png'))) }}"><br>
                        </div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize" style="margin-top:50px">
                            <tr>
                                <td width="70%" style="padding:0px;" align="left">
                                    <img width="120" height="70" style="margin:0;padding:0"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union.png'))) }}">
                                </td>
                                <td width="30%" style="padding:0px;padding-top:30px" align="left">
                                    Statement Period <br>
                                    {{ $statement->fromDate }} - {{ $statement->toDate }}
                                </td>
                            </tr>
                        </table>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr>
                                <td width="5%" style="padding:0px;" align="left"></td>
                                <th width="65%" style="padding:0px;" align="left">
                                    <span style="font-weight:bolder"><strong>Statement of Account</strong></span> <br>For
                                    {{ $statement->business_name }} <span>&nbsp;</span>{{ $statement->full_name }}
                                </th>
                                <td width="30%" style="padding:0px;padding-top:30px" align="left">
                                    Access No. {{ $access }}
                                </td>
                            </tr>
                        </table>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:20px 0px">
                            <tr>
                                <td width="35%" style="padding:0px;" align="left">
                                    <div class="lgsize" style="font-weight: bold;">Flagship Checking -
                                        {{ $statement->account_card_number }}</div>
                                </td>
                                <td class="sssize" width="35%" style="padding:0px;" align="right">
                                    (Continued from previous page)
                                </td>
                            </tr>
                        </table>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <th width="20%" style="padding:0px;border-bottom: 1px solid #000" align="left">Date
                        </th>
                        <th width="50%" style="padding:0px;border-bottom: 1px solid #000" align="left">Item
                        </th>
                        <th width="30%" style="padding:0px;border-bottom: 1px solid #000" align="left">Amount($)
                        </th>
                    </tr>
                </table>
                @else 

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                        <tr >
                            <td width="20%" style="padding:0px;" align="left">
                                {{ date_format(date_create($value->theDate), 'm-d') }}
                            </td>
                            <td width="50%" style="padding:0px;" align="left">{{ $key % 5 == 0 ? 'ATM' : 'POS' }}
                            </td>
                            <td width="30%" style="padding:0px;" align="left">
                                {{ number_format($value->paidout, 2) }}
                            </td>
                        </tr>
                    </table>
                @endif
                @endforeach




























    {{-- page break --}}

    <div class="page-break"></div>

    <div style=" 
   z-index:-1000;
   margin: 0;
   position: absolute;
   top: 50%;
   left: 50%;
   margin-right: -50%;
   transform: translate(-50%, -50%)               
   ">
        <img width="450" height="450" style="margin:0;padding:0;opacity: 0.09;"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union/globe.png'))) }}"><br>

    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize" style="margin-top:50px">
        <tr>
            <td width="70%" style="padding:0px;" align="left">
                <img width="120" height="70" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/navy-federal-credit-union.png'))) }}">
            </td>
            <td width="30%" style="padding:0px;padding-top:30px" align="left">
                Statement Period <br>
                {{ $statement->fromDate }} - {{ $statement->toDate }}
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left"></td>
            <th width="65%" style="padding:0px;" align="left">
                <span style="font-weight:bolder"><strong>Statement of Account</strong></span> <br>For
                {{ $statement->business_name }} <span>&nbsp;</span>{{ $statement->full_name }}
            </th>
            <td width="30%" style="padding:0px;padding-top:30px" align="left">
                Access No. {{ $access }}
            </td>
        </tr>
    </table>

    <div class="sssize" style="margin-top: 20px">
        <strong>Disclosure Information</strong>
        <ul>
            <li>The interest charge on the Checking Line of Credit advances begins to accrue on the date an advance is
                posted to your account and continues to accrue daily on the unpaid principal balance.</li>
            <li>
                • We calculate the interest charge on your account by applying the daily periodic rate to the "daily
                balance" of your account for each day in the billing cycle. To get the "daily balance"
                we take the beginning balance of your account each day, add any new advances or fees, and subtract any
                payments, credits, or unpaid interest charges</li>
            <li>You may also determine the amount of interest charges by multiplying the "Balance Subject to Interest
                Rate"
                by the number of days in the billing cycle and the daily periodic rate. The "Balance
                Subject to Interest Rate" disclosed in the Interest Charge Calculation table is the "average daily
                balance."
                To calculate the "average daily balance" add up all the "daily balances" for the billing cycle and
                divide
                the total by the number of days in the billing cycle.</li>
            <li>f there are two or more daily periodic rates imposed during the billing cycle, you may determine the
                amount
                of interest charges by multiplying each of the "Balances Subject to Interest Rate" by the number of days
                the
                applicable rate was in effect and multiplying each of the results by the applicable daily periodic rate
                and
                adding the results together.</li>
        </ul>

        <strong>
            What to Do if You Think You Find a Mistake on Your Statement <br>
            Errors Related to a Checking Line of Credit Advance</strong>




        If you think there is an error on your statement, write to us at: <br>
        <strong>Navy Federal Credit Union, PO Box 3000, Merrifield, VA 22119-3000; or by fax, 1-703-206-4244.</strong>
        <br>
        You may also contact us on the Web: <strong>navyfederal.org.</strong> <br>
        In your letter, give us the following information:<br>
        <ul>
            <li><strong>Account information:</strong> Your name and account number.</li>
            <li><strong>Dollar amount:</strong> The dollar amount of the suspected error.</li>
            <li><strong>Description of problem:</strong> If you think there is an error on your bill, describe what you
                believe is wrong and why you believe it is a mistake.
                You must contact us within 60 days after the error appeared on your statement.
                You must notify us of any potential errors in writing (or electronically). You may call us, but if you
                do, we are not required to investigate any potential error, and you may have to pay the amount in
                question.</li>
        </ul>

        While we investigate whether or not there has been an error, the following are true: <br>
        <ul>
            <li>We cannot try to collect the amount in question or report you as delinquent on that amount.</li>
            <li>The charge in question may remain on your statement, and we may continue to charge you interest on that
                amount. But, if we determine that we made a mistake, you will not have to pay the amount in question or
                any interest or other fees related to that amount.</li>
            <li>While you do not have to pay the amount in question, you are responsible for the remainder of your
                balance.</li>
            <li>We can apply any unpaid amount against your credit limit.</li>
        </ul>
        If we take more than 10 days in resolving an electronic transfer inquiry, we will provisionally credit your
        account for the amount in question so that you will have access to the funds during the time of our
        investigation.

        <strong>Errors Within Your Checking Account, Money Market Savings Account, or Savings Account</strong>
        In case of errors or questions about your electronic transfers telephone us at 1-888-842-6328, write us at the
        address provided above, or through Navy Federal Online Banking as soon as you can, if you think your statement
        or receipt is wrong or if you need more information about a transfer listed on the statement or receipt. We must
        hear from you no later than 60 days after we sent the FIRST statement on which the problem or error appeared.
        <br>
        <ul>
            <li>Tell us your name and account number (if any)</li>
            <li>Describe the error or the transfer you are unsure about, and explain as clearly as you can why you
                believe it is an error or why you need more information.</li>
            <li>Tell us the dollar amount of the suspected error.</li>
        </ul>

        We will investigate your complaint and will correct any error promptly. If we take more than 10 business days to
        do this, we will provisionally credit your account for the amount you think is in error,
        so that you will have the use of the money during the time it takes us to complete our investigation.
        <br> <strong>Payments</strong> <br>
        Your check must be payable to Navy Federal Credit Union and include your Checking Line of Credit account number.
        Include the voucher found at the bottom of your statement and mail the enclosed envelope to: Navy Federal Credit
        Union, PO Box 3100, Merrifield, VA 22119-3100. Payments received by 5:00 pm Eastern Time at the mail address
        above will be credited the same day. Mailed payments for your Checking Line of Credit account may not be
        commingled with funds designated for credit to other Navy Federal Credit Union accounts.



    </div>









    <script type="text/php">
        if (isset($pdf)) {
        $x = 500;
        $y = 40;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 8;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>

</body>

</html>
