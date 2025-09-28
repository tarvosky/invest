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

$first_row_count = 6;
$normal_row_count = 45;

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
    } elseif ($debit_count <= $first_row_count && $both> $first_row_count) {
        // enter deposit normally
        $debits = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
        ->get();

        $remain_deposit_count = $first_row_count - $debit_count;

        $deposits1 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidout', 0)
        ->skip(0)
        ->take($remain_deposit_count)
        ->get();

        $deposits2 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidout', 0)
        ->skip($remain_deposit_count)
        ->take(1000)
        ->get();
        } elseif ($debit_count > $first_row_count && $both > $first_row_count) {
        // enter deposit normally
        $debits3 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
        ->skip(0)
        ->take($first_row_count)
        ->get();

        $debits4 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidin', 0)
        ->skip($first_row_count)
        ->take(1000)
        ->get();

        $deposits = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->where('paidout', 0)
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

            </style>
        </head>

        <body>





            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                        <img width="40" height="40" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                    </td>
                    <td width="15%" align="left"></td>
                    <td width="60%" align="left">
                        {{ $statement->toDate }}

                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        <img width="120" height="100" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                    </td>
                </tr>

            </table>



            <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-top: 50px">

                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="50%" style="padding:0px;text-transform: uppercase;padding:20px" align="left">
                        <span class="sssize">999-99-99-99 16771 0 C 001 30 S 66 002</span> <br>
                        <span>{{ $statement->full_name }}</span><br />
                        <span>{{ $statement->business_name }}</span><br />
                        <span>{{ $statement->address }} </span><br />
                        <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
                    </td>
                    <td width="45%" style="padding:0px;" align="right">
                    </td>
                </tr>
            </table>



            <table width="100%" cellspacing="" cellpadding="0" border="0" style="margin-top:50px;">

                <tr>
                    <td width="50%" style="padding:0px;">
                        <h3>Your account statement</h3>
                        <h3> <small class="smsize">For {{ $statement->toDate }}</small> </h3>


                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                        <h3>Contact us</h3>
                        <table width="100%" border="0">
                            <tr>
                                <td><img width="40" height="40" style="margin:0;padding:0"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/mouse.png'))) }}">
                                </td>
                                <td class="smsize">BBT.com</td>
                            </tr>
                        </table>
                    </td>
                    <td width="30%" style="padding:0px;" align="left">
                        <h3>&nbsp;</h3>
                        <table width="100%" border="0">
                            <tr>
                                <td><img width="40" height="40" style="margin:0;padding:0"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/phone.png'))) }}">
                                </td>
                                <td class="smsize">(800) BANK-BBT or <br>(800) 226-5228</td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>

            <div style="border-top:solid 7px #930031;border-bottom:solid 7px #930031" class="smsize">
                <p>
                    <strong>BB&T and SunTrust have merged to become Truist.</strong> Until our separate operating
                    systems are
                    fully
                    integrated, we'll continue to use the BB&T name. For now, keep banking as you always have.
                    Find details about BB&T now Truist, your account(s), and the Truist Disclosure at any BB&T
                    financial center, BBT.com/Truist or 800-226-5228.
                </p>
            </div>

            <div style="padding-top:25px;">
                <li><strong>BUSINESS MONEY RATE CHECKING {{ $statement->account_card_number }}</strong></li>
            </div>

            <table width="100%" cellspacing="" cellpadding="0" border="0">
                <tr>
                    <td width="40%" style="padding:0px;">
                        <h3>Account summary</h3>


                        <table width="100%" cellspacing="" cellpadding="1" border="0" class="smsize">

                            <tr>
                                <td style="border-bottom:1px #666 solid" width="75%" style="padding:0px;" align="left">
                                    Previous balance as of {{ $statement->fromDate }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="25%" style="padding:0px;" align="right">
                                    {{ $currency }} {{ number_format($statement->opening_balance, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom:1px #666 solid" width="75%" style="padding:0px;" align="left">
                                    Checks
                                </td>
                                <td style="border-bottom:1px #666 solid" width="25%" style="padding:0px;" align="right">
                                    {{ $currency }}0.00
                                </td>
                            </tr>

                            <tr>
                                <td style="border-bottom:1px #666 solid" width="75%" style="padding:0px;" align="left">
                                    Other withdrawals, debits and service charges
                                </td>
                                <td style="border-bottom:1px #666 solid" width="25%" style="padding:0px;" align="right">
                                    {{ $currency }}{{ number_format($calculation['debit'], 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td style="border-bottom:1px #666 solid" width="75%" style="padding:0px;" align="left">
                                    Deposits, credits and interest
                                </td>
                                <td style="border-bottom:1px #666 solid" width="25%" style="padding:0px;" align="right">
                                    {{ $currency }} {{ number_format($calculation['credit'], 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td style="border-bottom:1px #666 solid" width="75%" style="padding:0px;" align="left">
                                    Your new balance as of {{ $statement->toDate }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="25%" style="padding:0px;" align="right">
                                    ={{ $currency }}{{ number_format($calculation['total_bal'], 2) }}
                                </td>
                            </tr>

                        </table>

                    <td width="10%"></td>


                    </td>
                    <td width="40%" style="padding:0px;">
                        <h3>Interest summary</h3>
                        <table width="100%" cellspacing="0" cellpadding="1" border="0" class="smsize">

                            <tr>
                                <td style="border-bottom:1px #666 solid" width="70%" style="padding:0px;" align="left">
                                    Interest paid this statement period
                                </td>
                                <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="right">
                                    {{ $currency }}0.00
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom:1px #666 solid" width="70%" style="padding:0px;" align="left">
                                    2020 interest paid year-to-date
                                </td>
                                <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="right">
                                    {{ $currency }}0.00
                                </td>
                            </tr>

                            <tr>
                                <td style="border-bottom:1px #666 solid" width="70%" style="padding:0px;" align="left">
                                    Interest rate
                                </td>
                                <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="right">
                                    0.01%
                                </td>
                            </tr>
                            <tr>
                                <td width="70%" style="padding:0px;" align="left">
                                    &nbsp;
                                </td>
                                <td width="30%" style="padding:0px;" align="right">

                                </td>
                            </tr>
                            <tr>
                                <td width="70%" style="padding:0px;" align="left">
                                    &nbsp;
                                </td>
                                <td width="30%" style="padding:0px;" align="right">

                                </td>
                            </tr>
                            <tr>
                                <td width="70%" style="padding:0px;" align="left">
                                    &nbsp;
                                </td>
                                <td width="30%" style="padding:0px;" align="right">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>









            <div style="padding:10px 0px;">
                <div style="font-weight: bolder">Total Other withdrawals, debits and service charges</div>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">

                <tr>
                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                        DATE
                    </td>
                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                        DESCRIPTION
                    </td>
                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">
                        &nbsp;
                    </td>
                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                        AMOUNT|({{ $currency }})
                    </td>
                </tr>
            </table>

            {{-- //////START DEBIT --}}


            @if ($both <= $first_row_count)
                @foreach ($debits as $key => $value) <table width="100%"
                cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr >
                <td style="border-bottom:1px #666 solid" width="10%"
                style="padding:0px;" align="left">
                {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td style="border-bottom:1px #666 solid" width="50%"
                style="padding:0px;" align="left">
                {{ $value->description }}
                </td>
                <td style="border-bottom:1px #666 solid" width="30%"
                style="padding:0px;" align="left">

                </td>
                <td style="border-bottom:1px #666 solid" width="10%"
                style="padding:0px;" align="right">
                {{ $currency . '' . number_format($value->paidout, 2) }}
                </td>
                </tr>
                </table> @endforeach
            @elseif($debit_count <= $first_row_count && $both> $first_row_count)
                    @foreach ($debits as $key => $value)
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                            <tr>
                                <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">
                                </td>
                                <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                                    {{ $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                            </tr>
                        </table>
                    @endforeach
                @elseif ($debit_count > $first_row_count && $both > $first_row_count)

                    @foreach ($debits3 as $key => $value)
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                            <tr>
                                <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">
                                </td>
                                <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                                    {{ $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                            </tr>
                        </table>
                    @endforeach
                    {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                                <img width="40" height="40" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                            </td>
                            <td width="15%" align="left"></td>
                            <td width="60%" align="left">
                                {{ $statement->toDate }}

                            </td>
                            <td width="20%" style="padding:0px;" align="right">
                                <img width="120" height="100" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                            </td>
                        </tr>
                    </table>
                    <p>&nbsp;</p>

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                        <tr>
                            <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                                DATE
                            </td>
                            <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                                DESCRIPTION
                            </td>
                            <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">
                                &nbsp;
                            </td>
                            <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                                AMOUNT|({{ $currency }})
                            </td>
                        </tr>
                    </table>




                    @foreach ($debits4 as $key => $value)
                        @if ($key % $normal_row_count == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                        <img width="40" height="40" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                                    </td>
                                    <td width="15%" align="left"></td>
                                    <td width="60%" align="left">
                                        {{ $statement->toDate }}

                                    </td>
                                    <td width="20%" style="padding:0px;" align="right">
                                        <img width="120" height="100" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                                    </td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;"
                                        align="left">
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;"
                                        align="left">
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="right">
                                        {{ $currency . '' . number_format($value->paidout, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach

                    {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                                <img width="40" height="40" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                            </td>
                            <td width="15%" align="left"></td>
                            <td width="60%" align="left">
                                {{ $statement->toDate }}

                            </td>
                            <td width="20%" style="padding:0px;" align="right">
                                <img width="120" height="100" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                            </td>
                        </tr>
                    </table>
                    <p>&nbsp;</p>





            @endif


            <table width="100%" cellspacing="0" class="smsize">
                <tr>
                    <td width="80%" style="padding:0px;" align="left">
                        Total Other withdrawals, debits and service charges
                    <td width="20%" style="padding:0px;" align="right">
                        = {{ $currency . '' . number_format($calculation['debit'], 2) }}
                    </td>
                </tr>
            </table>









            {{-- //////END DEBIT --}}




            {{-- \\\\\\\\\\\\\\\ DEPOSITS --}}


            <div style="padding:10px 0px;">
                <div style="font-weight: bolder">Deposits, credits and interest</div>
            </div>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                        DATE
                    </td>
                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                        DESCRIPTION
                    </td>
                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">
                        &nbsp;
                    </td>
                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                        AMOUNT|({{ $currency }})
                    </td>
                </tr>
            </table>



            @if ($both <= $first_row_count)
                @foreach ($deposits as $key => $value) <table width="100%"
                cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr >
                <td style="border-bottom:1px #666 solid" width="10%"
                style="padding:0px;" align="left">
                {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td style="border-bottom:1px #666 solid" width="50%"
                style="padding:0px;" align="left">
                {{ $value->description }}
                </td>
                <td style="border-bottom:1px #666 solid" width="30%"
                style="padding:0px;" align="left">

                </td>
                <td style="border-bottom:1px #666 solid" width="10%"
                style="padding:0px;" align="right">
                {{ $currency . '' . number_format($value->paidin, 2) }}
                </td>
                </tr>
                </table> @endforeach
            @elseif($debit_count < $first_row_count && $both> $first_row_count)
                    @foreach ($deposits1 as $key => $value)
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                            <tr>
                                <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">

                                </td>
                                <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                                    {{ $currency . '' . number_format($value->paidin, 2) }}
                                </td>
                            </tr>
                        </table>
                    @endforeach
                    {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                                <img width="40" height="40" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                            </td>
                            <td width="15%" align="left"></td>
                            <td width="60%" align="left">
                                {{ $statement->toDate }}

                            </td>
                            <td width="20%" style="padding:0px;" align="right">
                                <img width="120" height="100" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                            </td>
                        </tr>
                    </table>
                    <p>&nbsp;</p>

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                        <tr>
                            <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="left">
                                DATE
                            </td>
                            <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;" align="left">
                                DESCRIPTION
                            </td>
                            <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;" align="left">
                                &nbsp;
                            </td>
                            <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;" align="right">
                                AMOUNT|({{ $currency }})
                            </td>
                        </tr>
                    </table>

                    @foreach ($deposits2 as $key => $value)
                        @if ($key % 45 == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                        <img width="40" height="40" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                                    </td>
                                    <td width="15%" align="left"></td>
                                    <td width="60%" align="left">
                                        {{ $statement->toDate }}

                                    </td>
                                    <td width="20%" style="padding:0px;" align="right">
                                        <img width="120" height="100" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                                    </td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;"
                                        align="left">

                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="right">
                                        {{ $currency . '' . number_format($value->paidin, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;"
                                        align="left">

                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="right">
                                        {{ $currency . '' . number_format($value->paidin, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach

                @elseif ($debit_count > $first_row_count && $both > $first_row_count)

                    @foreach ($deposits as $key => $value)
                        @if ($key % $normal_row_count == 0 && $key !== 0)
                            {{-- page break --}}
                            <div class="page-break"></div>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td width="5%" style="padding:0px;" align="left">
                                        <img width="40" height="40" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                                    </td>
                                    <td width="15%" align="left"></td>
                                    <td width="60%" align="left">
                                        {{ $statement->toDate }}

                                    </td>
                                    <td width="20%" style="padding:0px;" align="right">
                                        <img width="120" height="100" style="margin:0;padding:0"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                                    </td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;"
                                        align="left">

                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="right">
                                        {{ $currency . '' . number_format($value->paidin, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @else
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                                <tr>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="50%" style="padding:0px;"
                                        align="left">
                                        {{ $value->description }}
                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="30%" style="padding:0px;"
                                        align="left">

                                    </td>
                                    <td style="border-bottom:1px #666 solid" width="10%" style="padding:0px;"
                                        align="right">
                                        {{ $currency . '' . number_format($value->paidin, 2) }}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach
            @endif



            <table width="100%" cellspacing="0" class="smsize">
                <tr>
                    <td width="80%" style="padding:0px;" align="left">
                        Total Deposits, credits and interest
                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        = {{ $currency . '' . number_format($calculation['credit'], 2) }}
                    </td>
                </tr>
            </table>



            {{-- page break --}}

            <div class="page-break"></div>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                        <img width="40" height="40" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                    </td>
                    <td width="15%" align="left"></td>
                    <td width="60%" align="left">
                        {{ $statement->toDate }}

                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        <img width="120" height="100" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                    </td>
                </tr>

            </table>

            <div style="border-top:solid 7px #930031;margin-top:20px">
                <h2>Questions, comments or errors?</h2>
            </div>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">

                <tr>
                    <td width="45%" style="padding:0px;" align="left">
                        <p style="text-align:justify">For general questions/comments or to report errors about your
                            statement or
                            account, please call us at 1-800-BANK BBT (1-800-226-5228) 24 hours a day, 7 days a week.
                            BB&T Care
                            Center Associates are available to assist you from 6 a.m. until midnight ET. You may also
                            contact
                            your local BB&T financial center. To locate a BB&T financial center in your area, please
                            visit
                            BBT.com.</p>
                        <p style="text-align:justify"> <strong>Electronic fund transfers (For Consumer Accounts Only.
                                Commercial
                                Accounts refer to the Commercial Bank Services Agreement.)</strong> Services such as
                            Bill
                            Payments and Zelle® are subject to the terms and conditions governing those services, which
                            may not
                            provide an error resolution process in all cases. Please refer to the terms and conditions
                            for those
                            services.</p>
                        <p style="text-align:justify">In case of errors or questions about your electronic fund
                            transfers, if
                            you think your statement or receipt is wrong or if you need more information about a
                            transfer on the
                            statement or receipt, IMMEDIATELY call 1-800-226-5228 or write to:</p>
                        <p style="text-align:center">
                            Fraud Management <br>
                            P.O. Box 1014<br>
                            Charlotte, NC 28201</p>
                        <p style="text-align:justify">Tell us as soon as you can, if you think your statement or receipt
                            is
                            wrong, or if you need more information about a transfer listed on the statement or receipt.
                            We must
                            hear from you no later than sixty (60) days after we sent the FIRST statement
                            on which the problem or error appeared.</p>
                        <p>
                            <li>Tell us your name and deposit account number (if any)</li>
                            <li>Describe the error or transfer you are unsure of, and explain as clearly as you can</li>
                            <li>why you believe it is an error or why you need more information</li>
                            <li>Tell us the dollar amount of the suspected error</li>
                        </p>
                        <p style="text-align:justify">If you tell us orally, we may require that you also send us your
                            complaint
                            or question in writing within ten (10) business days. We will tell you the results of our
                            investigation within ten (10) business days after we hear from you, and we will correct any
                            error
                            promptly. If we need more time, however, we may take up to forty-five (45) days to
                            investigate your complaint or questions for ATM transactions made within the United States
                            and up to
                            ninety (90) days
                            for new accounts, foreign initiated transactions and point-of-sale transactions. If we
                            decide to do</p>
                    </td>
                    <td width="10%" style="padding:0px;" align="left">
                        &nbsp;
                    </td>
                    <td width="45%" style="padding:0px;" align="left">
                        <p>have stopped someone from making electronic transfers without your permission if you had told
                            us, you
                            could lose as much as $500. Also, if your periodic statement shows transfers you did not
                            make, tell
                            us at once. If you do not tell us within sixty (60) days after the statement was mailed to
                            you, you
                            may not get back any money you lost after sixty (60) days if we can prove we could have
                            stopped
                            someone from taking the money if you had told us in time.</p>
                        <p><strong>Important information about your Constant Credit Account</strong>
                            Once advances are made from your Constant Credit Account, an INTEREST CHARGE will
                            automatically be
                            imposed on the account's outstanding “Average daily balance.” The INTEREST CHARGE is
                            calculated by
                            applying the “Daily periodic rate” to the ‘Average daily balance” of your account (including
                            current
                            transactions) and multiplying this figure by the number of days in the billing cycle. To get
                            the
                            “Average daily balance,” we take the beginning account balance each day, add any new
                            advances or
                            debits, and subtract any payments or credits and the last unpaid INTEREST CHARGE. This gives
                            us the
                            daily balance. Then we add all of the daily balances for the billing cycle and divide the
                            total by
                            the number of days in the billing cycle. This gives us the ‘Average daily balance.”</p>

                        <p><strong>Billing Rights Summary</strong><br>
                            <strong>In case of errors or questions about your Constant Credit statement</strong>
                            If you think your statement is incorrect, or if you need more information about a Constant
                            Credit
                            transaction on your statement, please call 1-800-BANK BBT or visit your local BB&T financial
                            center.
                            To dispute a payment, please write to us on a separate sheet of paper at the following
                            address:
                        </p>
                        <p>Bankcard Services Division <br> PO Box 200 <br>
                            Wilson NC 27894-0200</p>
                        <p>We must hear from you no later than sixty (60) days after we sent you the FIRST statement on
                            which
                            the error or problem appeared. You may telephone us, but doing so will not preserve your
                            rights. In
                            your letter, please provide the following information:</p>
                        <p>
                            <li>Your name and account number</li>
                            <li>Describe the error or transfer you are unsure about, and explain in detail why
                                you believe this is an error or why you need more information</li>
                            <li>The dollar amount of the suspected error</li>
                        </p>
                    </td>
                </tr>
            </table>

            {{-- page break --}}

            <div class="page-break"></div>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="5%" style="padding:0px;" align="left">
                        <img width="40" height="40" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt/barcode.png'))) }}">

                    </td>
                    <td width="15%" align="left"></td>
                    <td width="60%" align="left">
                        {{ $statement->toDate }}

                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        <img width="120" height="100" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbt.png'))) }}">
                    </td>
                </tr>

            </table>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">

                <tr>
                    <td width="45%" style="padding:0px;" align="left">
                        <p style="text-align:justify">
                            this, we will re-credit your account within ten (10) business days for the amount you think
                            is in
                            error, minus a maximum of {{ $currency }}50. If we ask you to put your complaint in
                            writing,
                            and we do not receive
                            it within ten (10) business days, we may not re-credit your account and you will not have
                            use of the
                            money during the time it takes us to complete our investigation.</p>
                        <p style="text-align:justify">
                            Tell us AT ONCE if you believe your access device has been lost or stolen, or someone may
                            have
                            electronically transferred money from your account without your permission, or someone has
                            used
                            information from a check to conduct an unauthorized electronic fund transfer. If you tell us
                            within
                            two (2) business days after you learn of the loss or theft of your access device or the
                            unauthorized
                            transaction, you can lose no more than {{ $currency }}50 if someone makes electronic
                            transfers
                            without your
                            permission.</p>
                        <p>If you do NOT tell us within two (2) business days after you learn of the loss or theft of
                            your
                            access device or the unauthorized transaction, and we can prove we could</p>
                    </td>
                    <td width="10%" style="padding:0px;" align="left">
                        &nbsp;
                    </td>
                    <td width="45%" style="padding:0px;" align="left">
                        <p>During our investigation process, you are not responsible for paying any amount in question;
                            you are,
                            however, obligated to pay the items on your statement that are not in question. While we
                            investigate
                            your question, we cannot report you as delinquent or take any action to collect the amount
                            in
                            question.</p>
                        <p>
                            <strong>Mail-in deposits</strong><br>
                            If you wish to mail a deposit, please send a deposit ticket and check to your local BB&T
                            financial
                            center. Visit BBT.com to locate the BB&T financial center closest to you. Please do not send
                            cash.
                        </p>
                        <p style="background:yellow"><strong>Change of address</strong><br>
                            If you need to change your address, please visit your local BB&T financial center or call
                            BB&T
                            Phone24 at 1-800-BANK BBT (1-800-226-5228).</p>
                    </td>
                </tr>
            </table>









            <table width="100%" cellspacing="0" cellpadding="0" border="1" class="smsize">

                <tr>
                    <td width="50%" style="padding:0px;">
                        <div style="text-align:center"> <strong>How to Reconcile Your Account</strong></div>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" ">

                        <tr>
                            <td width=" 5%" style="padding:0px;border-bottom:1px solid #ccc" align="center">
                            1
                    </td>
                    <td width="85%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc" align="left">
                        List the new balance of your account from your latest statement here:
                    </td>
                    <td width="10%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc;" align="left">
                    </td>
                </tr>

                <tr>
                    <td width="5%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc" align="center">
                        2
                    </td>
                    <td width="85%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc" align="left">
                        Record any outstanding debits (checks, check card purchases, ATM withdrawals, electronic
                        transactions,
                        etc.) in section A. Record the transaction date, the check number or type of debit and the debit
                        amount.
                        Add up all of the debits, and enter the sum here:
                    </td>
                    <td width="10%"
                        style="padding:0px;padding:0px;border-bottom:1px solid #ccc;border-left:1px solid #ccc"
                        align="left">
                    </td>
                </tr>

                <tr>
                    <td width="5%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc" align="center">
                        3
                    </td>
                    <td width="85%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc" align="left">
                        Subtract the amount in Line 2 above from the amount in Line 1 above and enter the total here:
                    </td>
                    <td width="10%"
                        style="padding:0px;padding:0px;border-bottom:1px solid #ccc;border-left:1px solid #ccc"
                        align="left">
                    </td>
                </tr>
                <tr>
                    <td width="5%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc" align="center">
                        4
                    </td>
                    <td width="85%" style="padding:0px;padding:0px;border-bottom:1px solid #ccc " align="left">
                        Record any outstanding credits in section B. Record the transaction date, credit type and the
                        credit
                        amount. Add up all of the credits and enter the sum here:
                    <td width="10%" style="padding:0px;border-left:1px solid #ccc" align="left">
                    </td>
                    <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="5%" style="padding:0px;padding:0px;" align="center">
                        5
                    </td>
                    <td width="85%" style="padding:0px;padding:0px;" align="left">
                        Add the amount in Line 4 to the amount in Line 3 to find your balance. Enter the sum here. This
                        amount
                        should match the balance in your register. </td>
                    <td width="10%" style="padding:0px;padding:0px;border-top:1px solid #ccc;border-left:1px solid #ccc"
                        align="left">
                    </td>
                </tr>
            </table>


            </td>





            <td width="50%" style="padding:0px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">

                    <tr width="100%">
                        <td>
                            <div style="text-align:center"> <strong>Outstanding Deposits and Other Credits (Section
                                    A)</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td width=" 25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Date/Check #
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Amount
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Date/Check #
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Amount
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align:center"> <strong>Outstanding Deposits and Other Credits (Section
                                    B)</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td width=" 25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Date/Type
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Amount
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Date/Type
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="center">
                                        Amount
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">
                                        &nbsp;
                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                    <td width="25%"
                                        style="padding:0px;border-top:1px solid #666;border-right:1px solid #666;"
                                        align="left">

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>


            </td>
            </tr>




            </table>

            <div style="text-align:center;padding:10px 0px" class="smsize">For more information, please contact your
                local BB&T
                branch, visit BBT.com
                or contact us at 1-800 BANK BBT (1-800-226-5228). MEMBER FDIC</div>



            <script type="text/php">
                if (isset($pdf)) {
        $x = 70;
        $y = 67;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 9;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>





        </body>

        </html>
