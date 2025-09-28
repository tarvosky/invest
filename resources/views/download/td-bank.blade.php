<?php
use App\Models\Transaction;

$rand = rand(1234567, 123456789);
$rand1 = number_format(rand(100, 300), 2);
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

$first_row_count = 22;
$normal_row_count = 40;

$both = $deposit_count + $debit_count;

if ($both <= $first_row_count) { // enter deposit normally // enter debit normally
    $deposits=Transaction::where('statement_id', $statement->id)
    //->orderBy('id', 'DESC')
    ->where('paidout', 0)
    ->get();
    $debits = Transaction::where('statement_id', $statement->id)
    //->orderBy('id', 'DESC')
    ->where('paidin', 0)
    ->get();
    } elseif ($deposit_count < $first_row_count && $both> $first_row_count) {
        // enter deposit normally
        $deposits = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidout', 0)
        ->get();

        $remain_debit_count = $first_row_count - $deposit_count;

        $debits1 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
        ->skip(0)
        ->take($remain_debit_count)
        ->get();

        $debits2 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
        ->skip($remain_debit_count)
        ->take(1000)
        ->get();
        } elseif ($deposit_count == $first_row_count) {

        $deposits = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidout', 0)
        ->get();

        $debits = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
        ->get();

        } elseif ($deposit_count > $first_row_count && $both > $first_row_count) {
        // enter deposit normally
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

        $debits = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
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
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="smsize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        <img width="260" height="90" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                        <h5>E</h5>
                    </td>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="40%" style="padding:0px;" align="left">
                        <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                    </td>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                       {{ strtoupper($statement->full_name) }} DBA
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                        <h5></h5>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                        Page:
                    </td>
                    <td width="27%" style="padding:0px;" align="right">

                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;text-transform:uppercase" align="left">
                        {{ strtoupper($statement->business_name) }} 
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                        <h5></h5>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                        Statement Period:
                    </td>
                    <td width="27%" style="padding:0px;" align="right">
                        {{ date(' M, d, Y', strtotime($statement->fromDate)) }} -
                        {{ date(' M, d, Y', strtotime($statement->toDate)) }}
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;text-transform:uppercase" align="left">
                        {{ $statement->address }}
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                        <h5></h5>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                        Cust Ref #:
                    </td>
                    <td width="27%" style="padding:0px;" align="right">
                        {{ $rand }}-433-F-***
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;text-transform:uppercase" align="left">
                        {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                        <h5></h5>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                        Primary Account #:
                    </td>
                    <td width="27%" style="padding:0px;" align="right">
                        {{ $statement->account_card_number }}
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;text-transform:uppercase" align="left">
                       
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                        <h5></h5>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">

                    </td>
                    <td width="27%" style="padding:0px;" align="right">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">
                    </td>
                </tr>
            </table>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px" class="sssize">
                <tr>
                    <td width="50%" style="padding:0px;" align="left">
                        <h3>TD Business Simple Checking</h3>
                    </td>
                    <td width="50%" style="padding:0px;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                        {{ strtoupper($statement->full_name) }} DBA <br> {{ strtoupper($statement->business_name) }} 
                    </td>
                    <td width="50%" style="padding:0px;" align="right">
                        Account # {{ $statement->account_card_number }}
                    </td>
                </tr>
            </table>

            <div
                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:20px;font-weight:800px;padding-bottom:1px;font-size:12px">
                <strong>ACCOUNT SUMMARY</strong>
            </div>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                        Beginning Balance
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        {{ $currency . '' . number_format($statement->opening_balance, 2) }}
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        Average Collected Balance
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        {{ $currency . '' . number_format($calculation['total'], 2) }}
                    </td>
                </tr>
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                        Electronic Deposits
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        {{ $currency . '' . number_format($calculation['credit'], 2) }}
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        Interest Earned This Period
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        0.00
                    </td>
                </tr>
                <tr>
                    <td width="25%" style="padding:0px;" align="left">

                    </td>
                    <td width="10%" style="padding:0px;" align="right">

                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        Interest Paid Year-to-Date
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        0.00
                    </td>
                </tr>
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                        Electronic Payments
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        {{ $currency . '' . number_format($calculation['debit'], 2) }}
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        Annual Percentage Yield Earned
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        0.00%
                    </td>
                </tr>
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                        Service Charges
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        $10.00
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        Days in Period
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                        {{ $day }}
                    </td>
                </tr>
                <tr>
                    <td width="25%" style="padding:0px;" align="left">
                        Ending Balance
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                    <?php $res = $calculation['total_bal'] -10; ?>
                        {{ $currency . '' . number_format($res, 2)  }}
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                    </td>
                    <td width="10%" style="padding:0px;" align="right">
                    </td>
                </tr>
            </table>

            <div
                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                <strong>DAILY ACCOUNT ACTIVITY</strong>
            </div>
            <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                <strong>Electronic Deposits</strong>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr style="color: #02FF01;font-weight:900px;">
                    <th width="20%" style="padding:0px;" align="left">
                        POSTING DATE
                    </th>
                    <th width="50%" style="padding:0px;" align="left">
                        DESCRIPTION
                    </th>
                    <th width="30%" style="padding:0px;" align="left">
                    </th>
                    <th width="20%" style="padding:0px;" align="right">
                        AMOUNT
                    </th>
                </tr>
            </table>






            @if ($both <= $first_row_count)
                @foreach ($deposits as $key => $value) <table width="100%"
                cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                <td width="20%" style="padding-top:1px;padding-bottom:1px;"
                align="left">
                {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="50%"
                style="padding-top:1px;padding-bottom:1px;text-transform:uppercase" align="left">
                {{ $value->description }}
                </td>
                <td width="30%" style="padding-top:1px;padding-bottom:1px;"
                align="left">
                </td>
                <td width="20%" style="padding-top:1px;padding-bottom:1px;"
                align="right">
                {{ $currency . '' . number_format($value->paidin, 2) }}
                </td>
                </tr>
                </table> @endforeach

            @elseif($deposit_count < $first_row_count && $both> $first_row_count)

                    @foreach ($deposits as $key => $value)

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr>
                                <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                    align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                </td>
                                <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                    {{ $currency . '' . number_format($value->paidin, 2) }}
                                </td>
                            </tr>
                        </table>
                    @endforeach

    @elseif ($deposit_count == $first_row_count) 

                @foreach ($deposits as $key => $value)

                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                    <tr>
                        <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                            {{ date_format(date_create($value->theDate), 'm/d') }}
                        </td>
                        <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                            align="left">
                            {{ $value->description }}
                        </td>
                        <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                        </td>
                        <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                            {{ $currency . '' . number_format($value->paidin, 2) }}
                        </td>
                    </tr>
                </table>
                
               @endforeach
             {{-- page break --}}
             <div class="page-break"></div>
             <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                 class="smsize">
                 <tr>
                     <td width="5%" style="padding:0px;" align="left">
                     </td>
                     <td width="35%" style="padding:0px;" align="left">
                         <img width="260" height="90" style="margin:0;padding:0"
                             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                     </td>
                     <td width="7%" style="padding:0px;" align="left">
                     </td>
                     <td width="3%" style="padding:0px;" align="left">
                         <h5>E</h5>
                     </td>
                     <td width="5%" style="padding:0px;" align="left">
                     </td>
                     <td width="40%" style="padding:0px;" align="left">
                         <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                     </td>
                     <td width="5%" style="padding:0px;" align="left">
                     </td>
                 </tr>
             </table>
             <div
                 style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                 <strong>DAILY ACCOUNT ACTIVITY</strong>
             </div>

        @elseif($deposit_count > $first_row_count && $both > $first_row_count)


                 @foreach ($deposits1 as $key => $value)
                 <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                    <tr>
                        <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                            {{ date_format(date_create($value->theDate), 'm/d') }}
                        </td>
                        <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                            align="left">
                            {{ $value->description }}
                        </td>
                        <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                        </td>
                        <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                            {{ $currency . '' . number_format($value->paidin, 2) }}
                        </td>
                    </tr>
                </table>
                 @endforeach

                        {{-- page break --}}
                        <div class="page-break"></div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                            class="smsize">
                            <tr>
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="35%" style="padding:0px;" align="left">
                                    <img width="260" height="90" style="margin:0;padding:0"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                                </td>
                                <td width="7%" style="padding:0px;" align="left">
                                </td>
                                <td width="3%" style="padding:0px;" align="left">
                                    <h5>E</h5>
                                </td>
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="40%" style="padding:0px;" align="left">
                                    <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                                </td>
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                            </tr>
                        </table>
                        <div
                            style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                            <strong>DAILY ACCOUNT ACTIVITY</strong>
                        </div>
                        <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                            <strong>Electronic Deposits (continued)</strong>
                        </div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                            class="sssize">
                            <tr style="color: #02FF01;font-weight:900px;">
                                <th width="20%" style="padding:0px;" align="left">
                                    POSTING DATE
                                </th>
                                <th width="50%" style="padding:0px;" align="left">
                                    DESCRIPTION
                                </th>
                                <th width="30%" style="padding:0px;" align="left">
                                </th>
                                <th width="20%" style="padding:0px;" align="right">
                                    AMOUNT
                                </th>
                            </tr>
                        </table>



                    @foreach ($deposits2 as $key => $value)

                        @if ($key % $normal_row_count == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                                class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="35%" style="padding:0px;" align="left">
                                        <img width="260" height="90" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                                    </td>
                                    <td width="7%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="3%" style="padding:0px;" align="left">
                                        <h5>E</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="40%" style="padding:0px;" align="left">
                                        <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                </tr>
                            </table>
                            <div
                                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                                <strong>DAILY ACCOUNT ACTIVITY</strong>
                            </div>
                            <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                                <strong>Electronic Deposits (continued)</strong>
                            </div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                                class="sssize">
                                <tr style="color: #02FF01;font-weight:900px;">
                                    <th width="20%" style="padding:0px;" align="left">
                                        POSTING DATE
                                    </th>
                                    <th width="50%" style="padding:0px;" align="left">
                                        DESCRIPTION
                                    </th>
                                    <th width="30%" style="padding:0px;" align="left">
                                    </th>
                                    <th width="20%" style="padding:0px;" align="right">
                                        AMOUNT
                                    </th>
                                </tr>
                            </table>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidin, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidin, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach


                    


            @endif








            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr>
                    <td width="20%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="left">

                    </td>
                    <td width="50%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="left">

                    </td>
                    <td width="30%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="left">
                        Subtotal:
                    </td>
                    <td width="20%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="right">
                        {{ $currency . '' . number_format($calculation['credit'], 2) }}
                    </td>
                </tr>
            </table>


            @if($deposit_count > $first_row_count && $both > $first_row_count)
             {{-- page break --}}
             <div class="page-break"></div>
             <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                 class="smsize">
                 <tr>
                     <td width="5%" style="padding:0px;" align="left">
                     </td>
                     <td width="35%" style="padding:0px;" align="left">
                         <img width="260" height="90" style="margin:0;padding:0"
                             src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                     </td>
                     <td width="7%" style="padding:0px;" align="left">
                     </td>
                     <td width="3%" style="padding:0px;" align="left">
                         <h5>E</h5>
                     </td>
                     <td width="5%" style="padding:0px;" align="left">
                     </td>
                     <td width="40%" style="padding:0px;" align="left">
                         <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                     </td>
                     <td width="5%" style="padding:0px;" align="left">
                     </td>
                 </tr>
             </table>
             <div
                 style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                 <strong>DAILY ACCOUNT ACTIVITY</strong>
             </div>
            @endif


            {{-- ========== --}}




            <div style="font-weight:900px;padding-bottom:1px;font-size:12px;margin-top:20px">
                <strong>Electronic Payments</strong>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr style="color: #02FF01;font-weight:900px;">
                    <th width="20%" style="padding:0px;" align="left">
                        POSTING DATE
                    </th>
                    <th width="50%" style="padding:0px;" align="left">
                        DESCRIPTION
                    </th>
                    <th width="30%" style="padding:0px;" align="left">
                    </th>
                    <th width="20%" style="padding:0px;" align="right">
                        AMOUNT
                    </th>
                </tr>
            </table>

            @if ($both < $first_row_count)
                @foreach ($debits as $key => $value) <table width="100%"
                cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                <td width="20%" style="padding-top:1px;padding-bottom:1px;"
                align="left">
                {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="50%"
                style="padding-top:1px;padding-bottom:1px;text-transform:uppercase" align="left">
                {{ $value->description }}
                </td>
                <td width="30%" style="padding-top:1px;padding-bottom:1px;"
                align="left">
                </td>
                <td width="20%" style="padding-top:1px;padding-bottom:1px;"
                align="right">
                {{ $currency . '' . number_format($value->paidout, 2) }}
                </td>
                </tr>
                </table> @endforeach



            @elseif($deposit_count < $first_row_count && $both> $first_row_count)

                    @foreach ($debits1 as $key => $value)
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr>
                                <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                    align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                </td>
                                <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                    {{ $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                            </tr>
                        </table>
                    @endforeach

                    {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                        class="smsize">
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                            </td>
                            <td width="35%" style="padding:0px;" align="left">
                                <img width="260" height="90" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                            </td>
                            <td width="7%" style="padding:0px;" align="left">
                            </td>
                            <td width="3%" style="padding:0px;" align="left">
                                <h5>E</h5>
                            </td>
                            <td width="5%" style="padding:0px;" align="left">
                            </td>
                            <td width="40%" style="padding:0px;" align="left">
                                <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                            </td>
                            <td width="5%" style="padding:0px;" align="left">
                            </td>
                        </tr>
                    </table>

                    <div
                        style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                        <strong>DAILY ACCOUNT ACTIVITY</strong>
                    </div>
                    <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                        <strong>Electronic Payments (continued)</strong>
                    </div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                        class="sssize">
                        <tr style="color: #02FF01;font-weight:900px;">
                            <th width="20%" style="padding:0px;" align="left">
                                POSTING DATE
                            </th>
                            <th width="50%" style="padding:0px;" align="left">
                                DESCRIPTION
                            </th>
                            <th width="30%" style="padding:0px;" align="left">
                            </th>
                            <th width="20%" style="padding:0px;" align="right">
                                AMOUNT
                            </th>
                        </tr>
                    </table>

                    @foreach ($debits2 as $key => $value)
                        @if ($key % 33 == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                                class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="35%" style="padding:0px;" align="left">
                                        <img width="260" height="90" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                                    </td>
                                    <td width="7%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="3%" style="padding:0px;" align="left">
                                        <h5>E</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="40%" style="padding:0px;" align="left">
                                        <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                                <strong>DAILY ACCOUNT ACTIVITY</strong>
                            </div>
                            <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                                <strong>Electronic Payments (continued)</strong>
                            </div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                                class="sssize">
                                <tr style="color: #02FF01;font-weight:900px;">
                                    <th width="20%" style="padding:0px;" align="left">
                                        POSTING DATE
                                    </th>
                                    <th width="50%" style="padding:0px;" align="left">
                                        DESCRIPTION
                                    </th>
                                    <th width="30%" style="padding:0px;" align="left">
                                    </th>
                                    <th width="20%" style="padding:0px;" align="right">
                                        AMOUNT
                                    </th>
                                </tr>
                            </table>



                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>


                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach




                @elseif ($deposit_count == $first_row_count)     
                        @foreach ($debits as $key => $value)
                        @if ($key % $normal_row_count == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                                class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="35%" style="padding:0px;" align="left">
                                        <img width="260" height="90" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                                    </td>
                                    <td width="7%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="3%" style="padding:0px;" align="left">
                                        <h5>E</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="40%" style="padding:0px;" align="left">
                                        <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                                <strong>DAILY ACCOUNT ACTIVITY</strong>
                            </div>
                            <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                                <strong>Electronic Payments (continued)</strong>
                            </div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                                class="sssize">
                                <tr style="color: #02FF01;font-weight:900px;">
                                    <th width="20%" style="padding:0px;" align="left">
                                        POSTING DATE
                                    </th>
                                    <th width="50%" style="padding:0px;" align="left">
                                        DESCRIPTION
                                    </th>
                                    <th width="30%" style="padding:0px;" align="left">
                                    </th>
                                    <th width="20%" style="padding:0px;" align="right">
                                        AMOUNT
                                    </th>
                                </tr>
                            </table>



                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>


                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach

                @elseif($deposit_count > $first_row_count && $both > $first_row_count)
                    @foreach ($debits as $key => $value)
                        @if ($key % $normal_row_count == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                                class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="35%" style="padding:0px;" align="left">
                                        <img width="260" height="90" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                                    </td>
                                    <td width="7%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="3%" style="padding:0px;" align="left">
                                        <h5>E</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                    <td width="40%" style="padding:0px;" align="left">
                                        <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                                    </td>
                                    <td width="5%" style="padding:0px;" align="left">
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                                <strong>DAILY ACCOUNT ACTIVITY</strong>
                            </div>
                            <div style="font-weight:900px;padding-bottom:1px;font-size:12px">
                                <strong>Electronic Payments (continued)</strong>
                            </div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                                class="sssize">
                                <tr style="color: #02FF01;font-weight:900px;">
                                    <th width="20%" style="padding:0px;" align="left">
                                        POSTING DATE
                                    </th>
                                    <th width="50%" style="padding:0px;" align="left">
                                        DESCRIPTION
                                    </th>
                                    <th width="30%" style="padding:0px;" align="left">
                                    </th>
                                    <th width="20%" style="padding:0px;" align="right">
                                        AMOUNT
                                    </th>
                                </tr>
                            </table>



                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>


                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                                <tr>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding-top:1px;padding-bottom:1px;text-transform:uppercase"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td width="30%" style="padding-top:1px;padding-bottom:1px;" align="left">
                                    </td>
                                    <td width="20%" style="padding-top:1px;padding-bottom:1px;" align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach

            @endif




            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr>
                    <td width="20%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="left">

                    </td>
                    <td width="50%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="left">

                    </td>
                    <td width="30%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="left">
                        Subtotal:
                    </td>
                    <td width="20%" style="padding:0px;border-bottom: 1px solid #000;padding-top:5px" align="right">
                        {{ $currency . '' . number_format($calculation['debit'], 2) }}
                    </td>
                </tr>
            </table>





            {{-- page break --}}

            <div class="page-break"></div>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px">
                <tr>
                    <td width="60%" style="padding:0px;color: #02FF01;" align="left">
                        <h2>How to Balance your Account</h2>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                <tr>
                    <td width="70%" style="padding:0px;" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                            <tr>
                                <td width="50%" style="padding:0px;" align="left">
                                    <strong>Begin by adjusting your account register as follows:</strong>
                                </td>
                                <td width="50%" style="padding:0px;" align="left">
                                    <span style="color: #02FF01;">1.</span> Your ending balance shown on this statement
                                    is:
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="left">
                                    <li>Subtract any services charges shown on this statement.</li>
                                </td>
                                <td width="50%" style="padding:0px;" align="left">
                                    <span style="color: #02FF01;">2.</span>
                                    List below the amount of deposits or credit transfers which do not appear on this
                                    statement.
                                    Total the deposits and enter on Line 2.
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="left">
                                    <li>Add any interest earned if you have an interest-bearing account.</li>
                                </td>
                                <td width="50%" style="padding:0px;" align="left">
                                    <span style="color: #02FF01;">3.</span>
                                    Subtotal by adding lines 1 and 2
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="left">
                                    <li>Add any automatic deposit or overdraft line of credit.</li>
                                    <li>Review all withdrawals shown on this statement and check them off in your
                                        account
                                        register.</li>
                                </td>
                                <td width="50%" style="padding:12px 0px;" align="left">
                                    <span style="color: #02FF01;">4.</span>
                                    List below the total amount of withdrawals that do not appear on this statement.
                                    Total the
                                    withdrawals and enter on Line 4.
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="left">
                                    <li>Follow instructions 2-5 to verify your ending account balance.</li>
                                </td>
                                <td width="50%" style="padding:0px;" align="left">
                                    <span style="color: #02FF01;">5.</span>
                                    Subtract Line 4 from 3. This adjusted balance should equal your account balance.
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td width="30%" style="padding:0px;" align="left">

                        <table width="100%" cellspacing="0" cellpadding="0" border="0"
                            style="margin-top:10px;background: #eaf3ea;padding:20px">
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="center">
                                    <strong> Ending <br> Balance</strong>
                                </td>
                                <td width="50%" style="padding:12px 0px;border-bottom: 2px solid  #02FF01;"
                                    align="left">
                                    <strong>
                                        {{ $currency . '' . number_format($calculation['total_bal'], 2) }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="center">
                                    <strong> Total <br> Deposits</strong>
                                </td>
                                <td width="50%" style="padding:12px 0px;border-bottom: 2px solid  #02FF01;"
                                    align="left">
                                    +
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="center">
                                    <strong> Sub Total </strong>
                                </td>
                                <td width="50%" style="padding:12px 0px;border-bottom: 2px solid  #02FF01;"
                                    align="left">
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="center">
                                    <strong> Total <br> Withdrawals</strong>
                                </td>
                                <td width="50%" style="padding:12px 0px;border-bottom: 2px solid  #02FF01;"
                                    align="left">
                                    -
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" style="padding:12px 0px;" align="center">
                                    <strong> Adjusted<br> Balance</strong>
                                </td>
                                <td width="50%" style="padding:12px 0px;border-bottom: 3px solid  #000;" align="left">
                                    -
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px;color:#02FF01;"
                class="sssize">
                <tr>
                    <td width="30%" style="padding:0px;" align="left">

                        <table width="100%" cellspacing="0" cellpadding="0" border="0"
                            style="margin-top:10px;text-transform:uppercase">
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    deposit not <br>on statement
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    dollars
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                    cents
                                </td>
                            </tr>

                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <span>&nbsp;</span>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <strong style="color:#000">Total <br> Deposits</strong>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                        </table>




                    </td>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="30%" style="padding:0px;" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0"
                            style="margin-top:10px;text-transform:uppercase">
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    withdrawals not <br>on statement
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    dollars
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                    cents
                                </td>
                            </tr>


                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>

                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <span>&nbsp;</span>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <span>&nbsp;</span>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="30%" style="padding:0px;" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0"
                            style="margin-top:10px;text-transform:uppercase">
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    withdrawals not <br>on statement
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    dollars
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                    cents
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <p>&nbsp;</p>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>

                            <tr>
                                <td width="40%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                    <strong style="color:#000">Total <br> Withdrawals</strong>
                                </td>
                                <td width="30%"
                                    style="padding:0px;border-bottom:1px solid  #02FF01;border-right:1px solid  #02FF01;"
                                    align="center">
                                </td>
                                <td width="30%" style="padding:0px;border-bottom:1px solid  #02FF01;" align="center">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>



            {{-- page break --}}

            <div class="page-break"></div>



            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                <tr>
                    <td width="48%" style="padding:0px;" align="left">

                        <div style="padding:0px;color: #02FF01;font-size:10px">
                            <strong>FOR CONSUMER ACCOUNTS ONLY — IN CASE OF ERRORS OR QUESTIONS ABOUT YOUR ELECTRONIC
                                FUNDS
                                TRANSFERS:</strong>
                        </div>
                        <p class="sssize">
                            If you need information about an electronic fund transfer or if you believe there is an
                            error on
                            your bank statement or receipt relating to an electronic fund transfer, telephone the bank
                            immediately at the phone number listed on the front of your statement or write to:
                        </p>
                        <div class="sssize"><strong>TD Bank, N.A., Deposit Operations Dept, P.O. Box 1377, Lewiston,
                                Maine
                                04243-1377</strong>
                        </div>
                        <p class="sssize">We must hear from you no later than sixty (60) calendar days after we sent you
                            the
                            first statement
                            upon which the error or problem first appeared. When contacting the Bank, please explain as
                            clearly
                            as you can why you believe there is an error or why more information is needed. Please
                            include:</p>
                        <ul class="sssize">
                            <li> Your name and account number.</li>
                            <li>A description of the error or transaction you are unsure about</li>
                            <li>The dollar amount and date of the suspected error</li>
                        </ul>
                        <p class="sssize">
                            When making a verbal inquiry, the Bank may ask that you send us your complaint in writing
                            within ten
                            (10) business days after the first telephone call. <br> <br>
                            We will investigate your complaint and will correct any error promptly. If we take more than
                            ten
                            (10) business days to do this, we will credit your account for the
                            amount you think is in error, so that you have the use of the money during the time it takes
                            to
                            complete our investigation.
                        </p>
                        <div style="padding:0px;color: #02FF01;font-size:10px" class="sssize">
                            <strong>INTEREST NOTICE</strong>
                        </div>
                        <p class="sssize"> Total interest credited by the Bank to you this year will be reported by the
                            Bank to
                            the Internal Revenue Service and State tax authorities. The amount to be reported will be
                            reported
                            separately to you by the Bank.</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </td>


                    <td width="4%" style="padding:0px;" align="left">
                    </td>
                    <td width="48%" style="padding:0px;" align="left" class="sssize">
                        <div style="padding:0px;color: #02FF01;font-size:10px">
                            <strong>FOR CONSUMER LOAN ACCOUNTS ONLY — BILLING RIGHTS SUMMARY</strong>
                        </div>
                        <p>
                            In case of Errors or Questions About Your Bill: <br> <br>
                            If you think your bill is wrong, or if you need more information about a transaction on your
                            bill,
                            write us at P.O. Box 1377, Lewiston, Maine 04243-1377 as soon as possible. We must hear from
                            you no
                            later than sixty (60) days after we sent you the FIRST bill on which the error or problem
                            appeared.
                            You can telephone us, but doing so will not preserve your rights. In your letter, give us
                            the
                            following information:

                        </p>
                        <ul>
                            <li>Your name and account number.</li>
                            <li>The dollar amount of the suspected error.</li>
                            <li>Describe the error and explain, if you can, why you believe there is an error.
                                If you need more information, describe the item you are unsure about.</li>
                        </ul>
                        <p>
                            You do not have to pay any amount in question while we are investigating, but you
                            are still obligated to pay the parts of your bill that are not in question. While we
                            investigate
                            your question, we cannot report you as delinquent or take any action to collect the amount
                            you
                            question.
                            <br><br>
                            FINANCE CHARGES: Although the Bank uses the Daily Balance method to calculate the finance
                            charge on
                            your Moneyline/Overdraft Protection account (the term "ODP" or "OD" refers to Overdraft
                            Protection),
                            the Bank discloses the Average Daily Balance on the periodic statement as an easier method
                            for you
                            to calculate the finance
                            charge. The finance charge begins to accrue on the date advances and other debits are posted
                            to your
                            account and will continue until the balance has been paid in full.
                            To compute the finance charge, multiply the Average Daily Balance times the Days in Period
                            times the
                            Daily Periodic Rate (as listed in the Account Summary section on
                            the front of the statement). The Average Daily Balance is calculated by adding the balance
                            for each
                            day of the billing cycle, then dividing the total balance by the number of Days in the
                            Billing
                            Cycle. The daily balance is the balance for the day after advances have been added and
                            payments or
                            credits have been subtracted plus or minus any other adjustments that might have occurred
                            that day.
                            There is no grace period during which no finance charge accrues. Finance charge adjustments
                            are
                            included in your total finance charge.


                        </p>

                    </td>
                </tr>
            </table>




            {{-- page break --}}

            <div class="page-break"></div>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="smsize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="35%" style="padding:0px;" align="left">
                        <img width="260" height="90" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                    </td>
                    <td width="7%" style="padding:0px;" align="left">
                    </td>
                    <td width="3%" style="padding:0px;" align="left">

                    </td>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="40%" style="padding:0px;" align="left">
                        <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                    </td>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                </tr>
            </table>

            <div style="font-weight:900px;padding-bottom:1px;font-size:12px;margin-top:50px">
                <strong>Service Charges</strong>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr style="color: #02FF01;font-weight:900px;">
                    <th width="20%" style="padding:0px;" align="left">
                        POSTING DATE
                    </th>
                    <th width="50%" style="padding:0px;" align="left">
                        DESCRIPTION
                    </th>
                    <th width="30%" style="padding:0px;" align="left">
                    </th>
                    <th width="20%" style="padding:0px;" align="right">
                        AMOUNT
                    </th>
                </tr>
                <tr>
                    <td width="20%" style="padding:0px;" align="left">
                        04/30
                    </td>
                    <td width="50%" style="padding:0px;" align="left">
                        MAINTENANCE FEE
                    </td>
                    <td width="30%" style="padding:0px;" align="left">

                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        10
                    </td>
                </tr>
                <tr>
                    <td width="20%" style="padding:0px;" align="left">

                    </td>
                    <td width="50%" style="padding:0px;" align="left">

                    </td>
                    <td width="30%" style="padding:0px;" align="left">
                        Subtotal:
                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        10
                    </td>
                </tr>
            </table>

            <div
                style="border-top:2px solid #000;color: #02FF01;border-bottom:1px solid #000;margin-top:40px;font-weight:800px;padding-bottom:1px;font-size:12px">
                <strong>DAILY BALANCE SUMMARY</strong>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px" class="sssize">
                <tr style="color: #02FF01;font-weight:900px;">
                    <th width="20%" style="padding:0px;" align="left">
                        DATE
                    </th>
                    <th width="50%" style="padding:0px;" align="left">

                    </th>
                    <th width="30%" style="padding:0px;" align="left">
                    </th>
                    <th width="20%" style="padding:0px;" align="right">
                        BALANCE
                    </th>
                </tr>
            </table>
            @foreach ($transactions as $key => $value)
                @if ($key % 42 == 0 && $key !== 0)
                    {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px"
                        class="smsize">
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                            </td>
                            <td width="35%" style="padding:0px;" align="left">
                                <img width="260" height="90" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/td-bank.png'))) }}">
                            </td>
                            <td width="7%" style="padding:0px;" align="left">
                            </td>
                            <td width="3%" style="padding:0px;" align="left">
                                <h5>E</h5>
                            </td>
                            <td width="5%" style="padding:0px;" align="left">
                            </td>
                            <td width="40%" style="padding:0px;" align="left">
                                <h5 style="color:#02FF01">STATEMENT OF ACCOUNT</h5>
                            </td>
                            <td width="5%" style="padding:0px;" align="left">
                            </td>
                        </tr>
                    </table>
                @else
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px"
                        class="sssize">
                        <tr>
                            <td width="20%" style="padding:0px;" align="left">
                                {{ date_format(date_create($value->theDate), 'm/d') }}
                            </td>
                            <td width="50%" style="padding:0px;" align="left">

                            </td>
                            <td width="30%" style="padding:0px;" align="left">
                            </td>
                            <td width="20%" style="padding:0px;" align="right">
                                <?php echo cal_bal_by_key($statement->opening_balance, $key + 1,
                                $transactions_ordinary); ?>
                                </th>
                        </tr>
                    </table>
                @endif
            @endforeach






            <script type="text/php">
                if (isset($pdf)) {
        $x = 525;
        $y = 111;
        $text = "{PAGE_NUM} of {PAGE_COUNT}";
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
