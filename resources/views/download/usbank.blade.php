<?php
use App\Models\Transaction;

$rand = number_format(rand(100, 900));
$rand1 = rand(10000, 300000);
$random1 = rand(1234567, 12345678910);
$year = date('Y', strtotime($statement->toDate));

function cal_bal_by_key($opening_balance, $key, $transactions)
{
$trans = $transactions
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

$first_row_count = 19;
$normal_row_count = 28;
$deposits = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->where('paidout', 0)
->get();
$debits = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->where('paidin', 0)
->get();

$deposit_count = count($deposits);
$debit_count = count($debits);

if ($deposit_count <= $first_row_count) { // enter deposit normally $deposits=Transaction::where('statement_id', $statement->id)
    $deposits = Transaction::where('statement_id', $statement->id)    
    //->orderBy('id', 'DESC')
    ->where('paidout', 0)
    ->get();
    } else {
    $deposits1 = Transaction::where('statement_id', $statement->id)
    //->orderBy('id', 'DESC')
    ->where('paidout', 0)
    ->skip(0)
    ->take($first_row_count)
    ->get();

    $deposits2 = Transaction::where('statement_id', $statement->id)
    //->orderBy('id', 'DESC')
    ->where('paidout', 0)
    ->skip($first_row_count)
    ->take(1000)
    ->get();
    }

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

            .mt-1 {
                margin-top: 10px
            }

            .mt-5 {
                margin-top: 50px
            }

            .mb-1 {
                margin-top: 10px
            }

            .mb-5 {
                margin-top: 50px
            }

            .b-1 {
                font-weight: bold
            }

            .b-5 {
                font-weight: bolder
            }

        </style>
    </head>

    <body>




        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="5%" style="padding:0px;" align="left">

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                        <tr>
                            <td width="10%" style="padding:10px; border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="5%" style="padding:0px;">
                </td>
                <td width="70%" style="padding:0px;" align="left">
                    <img width="200" height="60" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank.png'))) }}">
                    <div class="sssize" style="padding-left:50px">
                        <small>P.O. Box 1800 <br>
                            Paul, Minnesota 55101-0800 <br><br>
                            {{ $rand }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TRN
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            X &nbsp;&nbsp;&nbsp;&nbsp;ST01
                        </small>
                    </div>
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    <h3> Uni-Statement</h3>
                    <div class="sssize">
                        Account Number: <br>
                        {{ $statement->account_card_number }} <br>
                        Statement Period: <br>
                        {{ date('F d Y', strtotime($statement->fromDate)) }} <br>
                        through <br>
                        {{ date('F d Y', strtotime($statement->toDate)) }}
                    </div>
                </td>
            </tr>
        </table>







        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="30%" style="padding:0px;" align="left">

                </td>
                <td width="40%" style="padding:0px;" align="left">
                    <img width="20" height="20" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
        </table>



        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
            <tr>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="45%" style="padding:0px;" align="left">
                    <img width="200" height="50" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank/barcode.png'))) }}">
                    <div style="padding-left:10px">
                        <div style="font-size:9px"><strong>0000{{ $rand }} 1 SP 10648196{{$rand1}} S</strong></div>
                        <strong>
                            <span  style="text-transform: uppercase">{{ $statement->full_name }}</span><br>
                            <span  style="text-transform: capitalize">{{ $statement->business_name }}</span><br>
                            <span style="text-transform: uppercase">
                                {{ $statement->address }} <br> {{ $statement->city }},
                                {{ $statement->state }} {{ $statement->zip }}
                            </span>
                        
                        </strong>
                    </div>
                </td>
                <td width="40%" style="padding:0px;" align="left">


                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-style:italic"
                        class="sssize">
                        <tr>
                            <td width="50%" style="padding:0px;" align="left">
                                <img width="20" height="20" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank/phone.png'))) }}">
                            </td>
                            <th width="50%" style="padding:0px;" align="right">
                                To Contact U.S. Bank
                            </th>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:0px;" align="left"> By Phone:</th>
                            <td width="50%" style="padding:0px;" align="right">
                                1-800-US BANKS <br>(1-800-872-2657)
                            </td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:0px;" align="left"> Nevada<br>Metro Area: </th>
                            <td width="50%" style="padding:0px;" align="right">
                                (303-585-8585)
                            </td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:0px;" align="left">
                                Telecommunications Device <br> for the Deaf:</th>
                            <td width="50%" style="padding:0px;" align="right">
                                1-800-685-5065
                            </td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:0px;" align="left">
                                Internet:</th>
                            <td width="50%" style="padding:0px;" align="right">
                                usbank.com
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr style="background:#eee;padding:4px 0px;font-weight:bolder">
                <td width="50%" style="padding:0px;border-top: 3px solid #000" align="left">
                    FREE CHECKING
                </td>
                <td width="50%" style="padding:0px;border-top: 3px solid #000" align="right">
                    Member FDIC
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td width="50%" style="padding:0px;" align="left" class="sssize">
                    U.S. Bank National Association
                </td>
                <th width="50%" style="padding:0px;" align="right">
                    Account Number {{ $statement->account_card_number }}
                </th>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <th width="50%" style="padding:0px;" align="left">
                    Account Summary
                </th>
                <td width="50%" style="padding:0px;" align="left" class="sssize">
                </td>

            </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
            <tr>
                <td width="35%" style="padding:0px;" align="left">
                    Beginning Balance on {{ $statement->fromDate }}
                </td>
                <td width="15%" style="padding:0px;" align="right">
                    {{ $currency }}{{ number_format($statement->opening_balance, 2) }}
                </td>
                <td width="30%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
            </tr>
            <tr>
                <td width="35%" style="padding:0px;" align="left">
                    Deposits / Credits
                </td>
                <td width="15%" style="padding:0px;" align="right">
                    {{ $currency }}{{ number_format($calculation['credit'], 2) }}
                </td>
                <td width="30%" style="padding:0px;" align="right">
                    Number of Days in Statement Period
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $day }}
                </td>
            </tr>
            <tr>
                <td width="35%" style="padding:0px;" align="left">
                    Card Withdrawals
                </td>
                <td width="15%" style="padding:0px;" align="right">
                    {{ $currency }}{{ number_format($calculation['debit'], 2) }}-
                </td>
                <td width="30%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
            </tr>
            <tr>
                <td width="35%" style="padding:0px;" align="left">
                    Other Withdrawals
                </td>
                <td width="15%" style="padding:0px;" align="right">
                    {{ $currency }}0.00
                </td>
                <td width="30%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
            </tr>
            <tr>
                <th width="35%" style="padding-right:30px;" align="right">
                    Ending Balance on {{ date('F d Y', strtotime($statement->toDate)) }}
                </th>
                <th width="15%" style="padding:0px;border-top:3px solid #000" align="right">
                    {{ $currency }}{{ number_format($calculation['total_bal'], 2) }}
                </th>
                <td width="30%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
            </tr>
        </table>

        <div class="mt-1 b-1">Deposits / Credits</div>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
            <tr>
                <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    Date
                </td>
                <td width="50%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    Description of Transaction
                </td>
                <td width="15%" style="padding:0px;border-bottom:1px solid #000" align="center">
                    Ref Number
                </td>
                <td width="25%" style="padding:0px;border-bottom:1px solid #000" align="right">
                    Amount
                </td>
            </tr>
        </table>

        @if ($deposit_count <= $first_row_count)
            @foreach ($deposits as $key => $value) <table width="100%"
            cellspacing="0" cellpadding="0" border="0" style="margin-top:10px"
            class="sssize">
            <tr>
            <td width="10%" style="padding:0px;" align="left">
            {{ date_format(date_create($value->theDate), 'M d') }}
            </td>
            <td width="50%" style="padding:0px;" align="left">
            {{ $value->description }}
            </td>
            <td width="15%" style="padding:0px;" align="center">
                {{ rand(1234567, 12345678910) }}
            </td>
            <td width="25%" style="padding:0px;" align="right">
            {{ $currency . '' . number_format($value->paidin, 2) }}
            </td>
            </tr>
            </table> @endforeach
        @else
            @foreach ($deposits1 as $key => $value)
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <td width="10%" style="padding:0px;" align="left">
                            {{ date_format(date_create($value->theDate), 'M d') }}
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            {{ $value->description }}
                        </td>
                        <td width="15%" style="padding:0px;" align="center">
                            {{ rand(1234567, 12345678910) }}
                        </td>
                        <td width="25%" style="padding:0px;" align="right">
                            {{ $currency . '' . number_format($value->paidin, 2) }}
                        </td>
                    </tr>
                </table>
            @endforeach

            {{-- page break --}}
            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                            <tr>
                                <td width="10%" style="padding:10px; border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="5%" style="padding:0px;">
                    </td>
                    <td width="70%" style="padding:0px;" align="left">
                        <img width="200" height="60" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank.png'))) }}">
                        <div class="sssize" style="padding-left:50px">
                            <small>P.O. Box 1800 <br>
                                Paul, Minnesota 55101-0800 <br><br>
                                {{ $rand }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TRN
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                X &nbsp;&nbsp;&nbsp;&nbsp;ST01
                            </small>
                        </div>
                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        <h3> Uni-Statement</h3>
                        <div class="sssize">
                            Account Number: <br>
                            {{ $statement->account_card_number }} <br>
                            Statement Period: <br>
                            {{ date('F d Y', strtotime($statement->fromDate)) }} <br>
                            through <br>
                            {{ date('F d Y', strtotime($statement->toDate)) }}
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                    </td>
                    <td width="30%" style="padding:0px;" align="left">
                    </td>
                    <td width="40%" style="padding:0px;" align="left">
                        <img width="20" height="20" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">
                    </td>
                    <td width="5%" style="padding:0px;" align="right">
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr style="background:#eee;padding:4px 0px;font-weight:bolder">
                    <td width="50%" style="padding:0px;border-top: 3px solid #000" align="left">
                        FREE CHECKING
                    </td>
                    <td width="50%" style="padding:0px;border-top: 3px solid #000" align="right">
                        (CONTINUED)
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="50%" style="padding:0px;" align="left" class="sssize">
                        U.S. Bank National Association
                    </td>
                    <th width="50%" style="padding:0px;" align="right">
                        Account Number {{ $statement->account_card_number }}
                    </th>
                </tr>
            </table>

            @foreach ($deposits2 as $key => $value)
            @if ($key % $normal_row_count == 0 && $key !== 0)
            {{-- page break --}}
            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                            <tr>
                                <td width="10%" style="padding:10px; border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="5%" style="padding:0px;">
                    </td>
                    <td width="70%" style="padding:0px;" align="left">
                        <img width="200" height="60" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank.png'))) }}">
                        <div class="sssize" style="padding-left:50px">
                            <small>P.O. Box 1800 <br>
                                Paul, Minnesota 55101-0800 <br><br>
                                {{ $rand }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TRN
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                X &nbsp;&nbsp;&nbsp;&nbsp;ST01
                            </small>
                        </div>
                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        <h3> Uni-Statement</h3>
                        <div class="sssize">
                            Account Number: <br>
                            {{ $statement->account_card_number }} <br>
                            Statement Period: <br>
                            {{ date('F d Y', strtotime($statement->fromDate)) }} <br>
                            through <br>
                            {{ date('F d Y', strtotime($statement->toDate)) }}
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                    </td>
                    <td width="30%" style="padding:0px;" align="left">
                    </td>
                    <td width="40%" style="padding:0px;" align="left">
                        <img width="20" height="20" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">
                    </td>
                    <td width="5%" style="padding:0px;" align="right">
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr style="background:#eee;padding:4px 0px;font-weight:bolder">
                    <td width="50%" style="padding:0px;border-top: 3px solid #000" align="left">
                        FREE CHECKING
                    </td>
                    <td width="50%" style="padding:0px;border-top: 3px solid #000" align="right">
                        (CONTINUED)
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="50%" style="padding:0px;" align="left" class="sssize">
                        U.S. Bank National Association
                    </td>
                    <th width="50%" style="padding:0px;" align="right">
                        Account Number {{ $statement->account_card_number }}
                    </th>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                <tr>
                    <td width="10%" style="padding:0px;" align="left">
                        {{ date_format(date_create($value->theDate), 'M d') }}
                    </td>
                    <td width="50%" style="padding:0px;" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="15%" style="padding:0px;" align="center">
                        {{ rand(1234567, 12345678910) }}
                    </td>
                    <td width="25%" style="padding:0px;" align="right">
                        {{ $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                </tr>
            </table>
            @else
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <td width="10%" style="padding:0px;" align="left">
                            {{ date_format(date_create($value->theDate), 'M d') }}
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            {{ $value->description }}
                        </td>
                        <td width="15%" style="padding:0px;" align="center">
                            {{ rand(1234567, 12345678910) }}
                        </td>
                        <td width="25%" style="padding:0px;" align="right">
                            {{ $currency . '' . number_format($value->paidin, 2) }}
                        </td>
                    </tr>
                </table>
                @endif
            @endforeach


        @endif
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
            <tr>
                <td width="10%" style="padding:0px;" align="left">

                </td>
                <td width="50%" style="padding:0px;" align="left">

                </td>
                <th width="15%" style="padding:0px;" align="left">
                    Total Deposits / Credits
                </th>
                <td width="25%" style="border-bottom:2px #000 solid;padding:0px;border-top:2px #000 solid"
                    align="right">
                    {{ $currency . number_format($calculation['credit'], 2) }}
                </td>
            </tr>
        </table>

   











        {{-- page break --}}
        <div class="page-break"></div>



        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="30%" style="padding:0px;" align="left">
                    <div>
                        <img width="200" height="60" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank.png'))) }}">
                    </div>

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:0px"
                        class="sssize">
                        <tr>
                            <td>Outstanding Deposits</td>
                        </tr>
                    </table>

                    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top:0px"
                        class="sssize">
                        <tr>
                            <td width="50%">DATE </td>
                            <td width="50%">AMOUNT</td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%">TOTAL</td>
                            <td width="50%">$</td>
                        </tr>
                    </table>


                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px"
                        class="sssize">
                        <tr>
                            <td>Outstanding Withdrawals</td>
                        </tr>
                    </table>

                    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top:0px"
                        class="sssize">
                        <tr>
                            <td width="50%">DATE </td>
                            <td width="50%">AMOUNT</td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%"><span>&nbsp;</span></td>
                            <td width="50%"></td>
                        </tr>
                        <tr>
                            <td width="50%">TOTAL</td>
                            <td width="50%">$</td>
                        </tr>
                    </table>



                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="65%" style="padding:0px;" align="left" class="sssize">
                    <div class="b-1"> BALANCE YOUR ACCOUNT</div>
                    <span>To keep track of all your transactions, you should balance your account every month. Please
                        examine this statement immediately. We will assume that the balance and transactions shown are
                        correct unless you notify us of an error.
                    </span> <br> <br>
                    <ol>
                        <li>List any deposits that do not appear on your statement in the Outstanding Deposits section
                            at
                            the left. Record the total.</li>
                        <li>Check off in your checkbook register all checks, withdrawals (including Check Card and ATM)
                            and
                            automatic payments that appear on your statement. Withdrawals that are NOT checked off
                            should be
                            recorded in the Outstanding Withdrawals section at the left. Record the total.</li>
                        <li>Enter the ending balance shown on this statement. $_____________ </li>
                        <li>Enter the total deposits recorded in the Outstanding Deposits section. $_____________ </li>
                        <li>Total lines 3 and 4. $_____________</li>
                        <li> Enter the total withdrawals recorded in the Outstanding Withdrawals section. </li>
                        <li> Subtract line 6 from line 5. This is your balance. </li>
                        <li>Enter in your register and subtract from your register balance any checks, withdrawals or
                            other
                            debits (including fees, if any) that appear on your statement but have not been recorded in
                            your
                            register.
                        </li>
                        <li>Enter in your register and add to your register balance any deposits or other credits
                            (including
                            interest, if any) that appear in your statement but have not been recorded in your register.
                        </li>
                        <li>The balance in your register should be the same as the balance shown in #7. If it does not
                            match, review and check all figures used, and check the addition and subtraction in your
                            register. If necessary, review and balance your statement from the previous month.</li>
                    </ol>
                </td>
            </tr>
        </table>

        <div class="sssize mt-1 b-1">IMPORTANT DISCLOSURES TO OUR CONSUMER CUSTOMERS</div>
        <div class="sssize  b-1">In Case of Errors or Questions About Your Checking, Savings, ATM, Check Card,
            ACH, Bill Pay and Other Electronic Transfers</div>
        <div class="sssize">If you think your statement or receipt is wrong or if you need more information
            about a transfer on the statement or receipt, we must hear from you no later than 60 days* after we
            sent you the FIRST statement on which the error or problem appeared. Telephone us at the number
            listed on the front of this statement or write to us at U.S. Bank P.O. Box 64991 St. Paul, MN
            55164-9505.</div>
        <ul class="sssize">
            <li>Tell us your name and account number.</li>
            <li>Describe the error or the transfer you are unsure about, and explain as clearly as you can why
                you believe there is an error or why you need more information.</li>
            <li>Tell us the dollar amount of the suspected error.
            </li>
        </ul>
        <div class="sssize">
            We will tell you all the results of our investigation within 10 business days and will correct any
            error promptly. If we need more time, we may take up to 45 days to investigate your complaint. In
            that case, we will provisionally credit your account for the amount you think is in error, so that
            you will have the use of the money during the time it takes us to complete our investigation. For
            transfers initiated outside the United States or transfers resulting from point of sale debit card
            transactions, the time period for provisional credit is 10 business days and the time to resolve the
            investigation is 90 days.
            <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Please note: Paper draft and paper check claims must be
            disputed within 30 days per Your Deposit Account Agreement.
        </div>
        <div class="sssize mt-1 b-1">
            CONSUMER BILLING RIGHTS SUMMARY</div>
        <div class="sssize  b-1">In Case of Errors or Questions About Your Credit Card or Line of Credit
            Statement</div>

        <div class="sssize">
            If you think your statement is wrong, or if you need more information about a transaction on your statement,
            write to us on a separate sheet at the address shown on your credit card or line of credit statement as soon
            as
            possible. We must hear from you no later than 60 days after we sent you the FIRST statement on which the
            error
            or problem appeared. You can telephone us, but doing so will not preserve your rights. In your letter,
            provide
            us the following information:
            <ul>
                <li>Your name and account number.</li>
                <li>The dollar amount of the suspected error.</li>
                <li>Date the transaction occurred.</li>
                <li>Describe the error and explain, if you can, why you believe there is an error. If you need more
                    information, describe the item you are unsure about.</li>
            </ul>
            You do not have to pay any amount in question while we are investigating, but you are still obligated to pay
            the
            parts of your statement that are not in question. While we investigate your question, we cannot report you
            as
            delinquent or take any action to collect the amount you question.
        </div>

        <div class="sssize mt-1 b-1">SPECIAL RULE FOR CREDIT CARD PURCHASES</div>
        <div class="sssize ">If you have a problem with the quality of the goods or services that you purchased with a
            credit card, and you have tried in good faith to correct the problem with the merchant, you may not have to
            pay
            the remaining amount due on the goods or services. You have this protection only when the purchase price was
            more than $50 and the purchase was made in your home state or within 100 miles of your mailing address. If
            we
            own or operate the merchant, or if we mailed you the advertisement for the property or services, all
            purchases
            are covered regardless of amount or location of purchase.</div>

        <div class="sssize mt-1 b-1">RESERVE LINE</div>
        <div class="sssize ">
            Reserve Line Balance Computation Method: To calculate the Balance Subject to Interest Rate (sometimes
            referred to as the "average daily balance"), we take the beginning balance of your account each day, add any
            new advances, and subtract any payments, credits and unpaid interest charges. This gives us a daily balance.
            Then, we add up all the daily balances for the billing cycle and divide the total by the number of days in
            the billing cycle. This is your Balance Subject to Interest Rate. The ***INTEREST CHARGE*** begins from the
            date of each advance.</div>


        {{-- page break   withdrawal --}}
        <div class="page-break"></div>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="5%" style="padding:0px;" align="left">

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                        <tr>
                            <td width="10%" style="padding:10px; border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="5%" style="padding:0px;">
                </td>
                <td width="70%" style="padding:0px;" align="left">
                    <img width="200" height="60" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank.png'))) }}">
                    <div class="sssize" style="padding-left:50px">
                        <small>P.O. Box 1800 <br>
                            Paul, Minnesota 55101-0800 <br><br>
                            {{ $rand }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TRN
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            X &nbsp;&nbsp;&nbsp;&nbsp;ST01
                        </small>
                    </div>
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    <h3> Uni-Statement</h3>
                    <div class="sssize">
                        Account Number: <br>
                        {{ $statement->account_card_number }} <br>
                        Statement Period: <br>
                        {{ date('F d Y', strtotime($statement->fromDate)) }} <br>
                        through <br>
                        {{ date('F d Y', strtotime($statement->toDate)) }}
                    </div>
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="30%" style="padding:0px;" align="left">
                </td>
                <td width="40%" style="padding:0px;" align="left">
                    <img width="20" height="20" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr style="background:#eee;padding:4px 0px;font-weight:bolder">
                <td width="50%" style="padding:0px;border-top: 3px solid #000" align="left">
                    FREE CHECKING
                </td>
                <td width="50%" style="padding:0px;border-top: 3px solid #000" align="right">
                    (CONTINUED)
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td width="50%" style="padding:0px;" align="left" class="sssize">
                    U.S. Bank National Association
                </td>
                <th width="50%" style="padding:0px;" align="right">
                    Account Number {{ $statement->account_card_number }}
                </th>
            </tr>
        </table>




        <div class="mt-1 b-1">Card Withdrawals</div>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
            <tr>
                <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    Date
                </td>
                <td width="50%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    Description of Transaction
                </td>
                <td width="15%" style="padding:0px;border-bottom:1px solid #000" align="center">
                    Ref Number
                </td>
                <td width="25%" style="padding:0px;border-bottom:1px solid #000" align="right">
                    Amount
                </td>
            </tr>
        </table>

        @foreach ($debits as $key => $value)
            @if ($key % $normal_row_count == 0 && $key !== 0)
                {{-- page break --}}
                <div class="page-break"></div>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="5%" style="padding:0px;" align="left">

                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                                <tr>
                                    <td width="10%" style="padding:10px; border-bottom:3px solid #000;" align="left">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%" style="padding:10px;border-bottom:3px solid #000;" align="left">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="5%" style="padding:0px;">
                        </td>
                        <td width="70%" style="padding:0px;" align="left">
                            <img width="200" height="60" style="margin:0;padding:0"
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/usbank.png'))) }}">
                            <div class="sssize" style="padding-left:50px">
                                <small>P.O. Box 1800 <br>
                                    Paul, Minnesota 55101-0800 <br><br>
                                    {{ $rand }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TRN
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    X &nbsp;&nbsp;&nbsp;&nbsp;ST01
                                </small>
                            </div>
                        </td>
                        <td width="20%" style="padding:0px;" align="right">
                            <h3> Uni-Statement</h3>
                            <div class="sssize">
                                Account Number: <br>
                                {{ $statement->account_card_number }} <br>
                                Statement Period: <br>
                                {{ date('F d Y', strtotime($statement->fromDate)) }} <br>
                                through <br>
                                {{ date('F d Y', strtotime($statement->toDate)) }}
                            </div>
                        </td>
                    </tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="25%" style="padding:0px;" align="left">
                        </td>
                        <td width="30%" style="padding:0px;" align="left">
                        </td>
                        <td width="40%" style="padding:0px;" align="left">
                            <img width="20" height="20" style="margin:0;padding:0"
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">
                        </td>
                        <td width="5%" style="padding:0px;" align="right">
                        </td>
                    </tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr style="background:#eee;padding:4px 0px;font-weight:bolder">
                        <td width="50%" style="padding:0px;border-top: 3px solid #000" align="left">
                            FREE CHECKING
                        </td>
                        <td width="50%" style="padding:0px;border-top: 3px solid #000" align="right">
                            (CONTINUED)
                        </td>
                    </tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td width="50%" style="padding:0px;" align="left" class="sssize">
                            U.S. Bank National Association
                        </td>
                        <th width="50%" style="padding:0px;" align="right">
                            Account Number {{ $statement->account_card_number }}
                        </th>
                    </tr>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <td width="10%" style="padding:0px;" align="left">
                            {{ date_format(date_create($value->theDate), 'M d') }}
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            {{ $value->description }}
                        </td>
                        <td width="15%" style="padding:0px;" align="center">
                            {{ rand(1234567, 12345678910) }}
                        </td>
                        <td width="25%" style="padding:0px;" align="right">
                            {{ $currency . '' . number_format($value->paidout, 2) }}-
                        </td>
                    </tr>
                </table>

            @else
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                    <tr>
                        <td width="10%" style="padding:0px;" align="left">
                            {{ date_format(date_create($value->theDate), 'M d') }}
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            {{ $value->description }}
                        </td>
                        <td width="15%" style="padding:0px;" align="center">
                            {{ rand(1234567, 12345678910) }}
                        </td>
                        <td width="25%" style="padding:0px;" align="right">
                            {{ $currency . '' . number_format($value->paidout, 2) }}-
                        </td>
                    </tr>
                </table>

            @endif
        @endforeach

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
            <tr>
                <td width="10%" style="padding:0px;" align="left">

                </td>
                <td width="50%" style="padding:0px;" align="left">

                </td>
                <th width="15%" style="padding:0px;" align="left">
                    Total Withdrawals
                </th>
                <th width="25%" style="padding:0px;border-bottom:2px #000 solid;border-top:2px #000 solid"
                    align="right">
                    {{ $currency . ' ' . number_format($calculation['debit'], 2) }}-
                </th>
            </tr>
        </table>














        <script type="text/php">
            if (isset($pdf)) {
        $x = 492;
        $y = 163;
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
