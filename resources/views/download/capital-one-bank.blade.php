<?php
$per = number_format(mt_rand(1.0 * 10, 6.0 * 10) / 10, 2);
$tax = number_format(mt_rand(0.1 * 10, 0.9 * 10) / 10, 2);

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

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                <img width="260" height="80" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/capital-one-bank.png'))) }}">
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="40%" style="padding:0px;text-transform:capitalize"  align="left">
                {{ $statement->business_name }}<br> {{ $statement->full_name }}<br> {{ $statement->address }}, <br>
                {{ $statement->city }}, {{ $statement->state }}
                {{ $statement->zip }}
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:50px;color:rgb(15, 64, 87)">
        <tr>
            <th width="50%" style="padding:0px;border-left:solid 2px rgb(15, 64, 87);padding-left:20px;font-size:16px"
                align="left" class>
                Thanks for saving with Capital One 360®
            </th>
            <td width="50%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <th width="50%" style="padding:0px;" align="left" class>
                <p>&nbsp;</p>
            </th>
            <td width="50%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding:0px;font-size:18px" align="left">
                Here's your <strong>{{ $year }}</strong> bank statement.
            </td>
            <td width="50%" style="border-left:solid 2px rgb(15, 64, 87);padding-left:20px" align="left" class="mdsize">
                STATEMENT PERIOD <br>
                <strong> {{ date('M, d, Y', strtotime($statement->fromDate)) }} -
                    {{ date('M, d, Y', strtotime($statement->toDate)) }}
                </strong><br>

            </td>
        </tr>
    </table>

    <div style="background:rgb(15, 64, 87); padding:35px;color:white;margin-top:40px;margin-left: -50px;
    margin-right: -50px; ">

        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td width="10%" style="padding:0px;" align="left">
                    <span style="font-size:50px">
                        {{ $currency . '' . number_format($calculation['total_bal'], 2) }}</span>
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="75%" style="padding:0px;" align="left">
                    <small style="font-size:13px">TOTAL ENDING BALANCE <br> IN ALL ACCOUNTS</small>
                </td>
            </tr>
        </table>

    </div>


    <div style="background:#eee; padding:35px;margin-left: -50px;
    margin-right: -50px; ">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td width="50%" style="padding:0px;" align="left">
                    <h3 style="color:rgb(15, 64, 87);">Account Summary</h3>

                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                        <tr style="color:rgb(15, 64, 87);">
                            <td width="50%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                ACCOUNT NAME
                            </td>
                            <td width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                {{ date('M,d', strtotime($statement->fromDate)) }}
                            </td>
                            <td width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="right">
                                {{ date('M,d', strtotime($statement->toDate)) }}
                            </td>
                            <td width="10%" align="right"></td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                360 Checking...{{ substr($statement->account_card_number, -4) }}
                            </th>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
                            </th>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="right">
                                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
                            </th>
                            <td width="10%" align="right"></td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                Property Tax
                            </th>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc;" align="left">
                                {{ $currency . '' . $tax }}
                            </th>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc;" align="right">
                                {{ $currency . '' . $tax }}
                            </th>
                            <td width="10%" align="right"></td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                Pets
                            </th>
                            <td width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                {{ $currency }} 0.00
                            </td>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="right">
                                {{ $currency }} 0.00
                            </th>
                            <td width="10%" align="right"></td>
                        </tr>
                        <tr>
                            <th width="50%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                All Accounts
                            </th>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="left">
                                {{ $currency . '' . number_format($statement->opening_balance + $tax, 2) }}
                            </th>
                            <th width="20%" style="padding:6px 0px;border-bottom:1px solid #ccc" align="right">
                                {{ $currency }} {{ number_format($calculation['total_bal'] + $tax, 2) }}
                            </th>
                            <td width="10%" align="right"></td>
                        </tr>
                    </table>









                </td>
                <td width="50%" style="border-left:solid 2px;color: rgb(15, 64, 87);padding-left:20px" align="left">
                    <h3>Cashflow Summary</h3>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                        <tr style="color:rgb(15, 64, 87);">
                            <td width="5%" style="padding:0px;" align="left">
                                <img width="40" height="40" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/capital-one/plus.png'))) }}">
                            </td>
                            <td width="15%" style="padding:0px;" align="left">
                                $0.01
                            </td>
                            <td width="20%" style="padding:0px;" align="left">
                                <small style="font-size: 6px">INTEREST EARNED <br> THIS PERIOD</small>
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                                <img width="40" height="30" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/capital-one/minus.png'))) }}">
                            </td>
                            <td width="15%" style="padding:0px;" align="left">
                                $0.00
                            </td>
                            <td width="20%" style="padding:0px;" align="left">
                                <small style="font-size: 6px">FEES <br> THIS PERIOD</small>
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="padding:0px;" align="left">
                                <img width="40" height="30" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/capital-one/minus.png'))) }}">
                            </td>
                            <td width="15%" style="padding:0px;" align="left">
                                $0.00
                            </td>
                            <td width="20%" style="padding:0px;" align="left">
                                <small style="font-size: 6px">FINANCE CHARGES <br> THIS PERIOD</small>
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>

    {{-- page break --}}

    <div class="page-break"></div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr style="font-size: 8px">
            <td width="60%" style="padding:0px;" align="left">
            </td>
            <td width="20%" style="padding-right:8px;" align="right">
                <strong>{{ $statement->full_name }}</strong>
            </td>
            <td width="20%" style="border-left:solid 1px rgb(19, 81, 109);color: rgb(19, 81, 109);padding-left:20px"
                align="right">
                STATEMENT PERIOD <br>
                <strong> {{ date('M, d, Y', strtotime($statement->fromDate)) }} -
                    {{ date('M, d, Y', strtotime($statement->toDate)) }}
                </strong><br>

            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px;color: rgb(19, 81, 109);">
        <tr>
            <td width="100%" style="padding:0px;" align="left">
                <span style="font-weight: 700"> 360 Checking - </span> {{ $statement->account_card_number }}
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px;color: rgb(19, 81, 109);">
        <tr>
            <td width="30%" style="padding:0px;" align="left">
                0.07%
            </td>
            <td width="30%" style="padding:0px;font-weight:700;color:green" align="left">
                $0.03
            </td>
            <td width="40%" style="padding:0px;" align="left">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="30%" style="padding:0px;" align="left">
                <span style="font-size: 8px"> ANNUAL PERCENTAGE YIELD <br>(APY) EARNED</span>
            </td>
            <td width="30%" style="padding:0px;" align="left">
                <span style="font-size: 8px">YTD INTEREST AND BONUSES</span>
            </td>
            <td width="40%" style="padding:0px;" align="left">
                <span style="font-size: 8px">DAYS IN STATEMENT <br> CYCLE</span>
            </td>
        </tr>

    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr style="color: rgb(19, 81, 109)">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                DATE
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                DESCRIPTION
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
                CATEGORY
            </td>
            <td width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
                AMOUNT
            </td>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                BALANCE
            </td>
        </tr>
        <tr style="font-weight:700;background:#eee">
            <td width="10%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;" align="left">
                {{ date_format(date_create($statement->fromDate), 'm/d') }}
            </td>
            <td width="40%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;" align="left">
                Opening balance
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </th>
            <td width="20%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;" align="right">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </td>
        </tr>
    </table>
    @foreach ($transactions as $key => $value)
        @if ($key % 41 == 0 && $key !== 0)
            {{-- page break --}}

            <div class="page-break"></div>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:30px">
                <tr style="font-size: 8px">
                    <td width="60%" style="padding:0px;" align="left">
                    </td>
                    <td width="20%" style="padding-right:8px;" align="right">
                        <strong>{{ $statement->full_name }}</strong>
                    </td>
                    <td width="20%"
                        style="border-left:solid 1px rgb(19, 81, 109);color: rgb(19, 81, 109);padding-left:20px"
                        align="right">
                        STATEMENT PERIOD <br>
                        <strong> {{ date('M, d, Y', strtotime($statement->fromDate)) }} -
                            {{ date('M, d, Y', strtotime($statement->toDate)) }}
                        </strong><br>

                    </td>
                </tr>
            </table>

        @else
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="" class="sssize">
                <tr>
                    <td width="10%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;"
                        align="left">
                        {{ date_format(date_create($value->theDate), 'm/d') }}
                    </td>
                    <td width="40%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;"
                        align="left">
                        {{ $value->description }}
                    </td>
                    <td width="10%"
                        style="padding-top:2px;padding-bottom:2px;padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                        align="right">
                        {{ $value->paidin == 0 ? 'Debit' : '' }}
                        {{ $value->paidout == 0 ? 'Credit' : '' }}
                    </td>
                    <th width="20%"
                        style="padding-top:2px;padding-bottom:2px;padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                        align="right">
                        <span
                            style="color:green">{{ $value->paidin != 0 ? '+' . $currency . '' . number_format($value->paidin, 2) : '' }}</span>
                        {{ $value->paidout != 0 ? '-' . $currency . number_format($value->paidout, 2) : '' }}
                    </th>
                    <td width="20%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;"
                        align="right">
                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1,
                        $transactions_ordinary); ?>
                    </td>
                </tr>
            </table>
        @endif
    @endforeach
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="" class="sssize">
        <tr style="font-weight:700;background:#eee">
            <td width="10%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;" align="left">
                {{ date_format(date_create($statement->toDate), 'm/d') }}
            </td>
            <td width="40%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;" align="left">
                closing balance
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </th>
            <td width="20%" style="padding-top:2px;padding-bottom:2px;border-bottom:1px solid #ccc;" align="right">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </td>
        </tr>
    </table>

    {{-- page break --}}

    <div class="page-break"></div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr style="font-size: 8px">
            <td width="60%" style="padding:0px;" align="left">
            </td>
            <td width="20%" style="padding-right:8px;" align="right">
                <strong>{{ $statement->full_name }}</strong>
            </td>
            <td width="20%" style="border-left:solid 1px rgb(19, 81, 109);color: rgb(19, 81, 109);padding-left:20px"
                align="right">
                STATEMENT PERIOD <br>
                <strong> {{ date('M, d, Y', strtotime($statement->fromDate)) }} -
                    {{ date('M, d, Y', strtotime($statement->toDate)) }}
                </strong><br>

            </td>
        </tr>
    </table>


    <h3 style="color: rgb(19, 81, 109);margin-top:30px">Fees Summary
    </h3>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="50%" style="padding:0px;" align="left">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr style="color: rgb(19, 81, 109);font-size:8px">
                        <td width="50%" style="padding:2px 0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="25%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            TOTAL FOR THIS <br> PERIOD
                        </td>
                        <td width="25%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            TOTAL YEAR-TO- <br>DATE

                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:2px 0px;border-bottom:1px solid #ccc" align="left">
                            Total Overdraft Fees
                        </td>
                        <th width="25%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            $0.00
                        </th>
                        <th width="25%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            $0.00
                        </th>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:2px 0px;" align="left">
                            Total Return Item Fees
                        </td>
                        <th width="25%" style="padding:0px;" align="right">
                            $0.00
                        </th>
                        <th width="25%" style="padding:0px;" align="right">
                            $0.00
                        </th>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>





    <div style="color: rgb(19, 81, 109);margin-top:30px">

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="20%" style="padding:0px;" align="left">
                    <h3>Property Tax - </h3>
                </td>
                <td width="20%" style="padding:0px;" align="left">
                    <span>{{ $statement->account_card_number }}</span>
                </td>
                <td width="60%" style="padding:0px;" align="left">
                </td>
            </tr>
        </table>
    </div>




    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:5px;color: rgb(19, 81, 109);">
        <tr>
            <td width="100%" style="padding:0px;" align="left">
                <span class="sssize" style="font-weight: 700"> 360 SAVINGS
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:5px;color: rgb(19, 81, 109);">
        <tr>
            <td width="30%" style="padding:0px;" align="left">
                0.00%
            </td>
            <td width="30%" style="padding:0px;font-weight:700;color:green" align="left">
                $0.00
            </td>
            <td width="40%" style="padding:0px;" align="left">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="30%" style="padding:0px;" align="left">
                <span style="font-size: 8px"> ANNUAL PERCENTAGE YIELD <br>(APY) EARNED</span>
            </td>
            <td width="30%" style="padding:0px;" align="left">
                <span style="font-size: 8px">YTD INTEREST AND BONUSES</span>
            </td>
            <td width="40%" style="padding:0px;" align="left">
                <span style="font-size: 8px">DAYS IN STATEMENT <br> CYCLE</span>
            </td>
        </tr>

    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr style="color: rgb(19, 81, 109)">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                DATE
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                DESCRIPTION
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
                CATEGORY
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
                AMOUNT
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                BALANCE
            </td>
        </tr>
        <tr style="font-weight:700;background:#eee">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                {{ date_format(date_create($statement->fromDate), 'm/d') }}
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                Opening balance
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                {{ $currency . '' . number_format($tax, 2) }}
            </td>
        </tr>
        <tr style="font-weight:700;background:#eee">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                {{ date_format(date_create($statement->fromDate), 'm/d') }}
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                Closing balance
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                {{ $currency . '' . number_format($tax, 2) }}
            </td>
        </tr>
    </table>








    <h3 style="color: rgb(19, 81, 109);margin-top:30px">Fees Summary
    </h3>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="50%" style="padding:0px;" align="left">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr style="color: rgb(19, 81, 109);font-size:8px">
                        <td width="40%" style="padding:2px 0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            TOTAL FOR THIS PERIOD
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            TOTAL YEAR-TO-DATE

                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:2px 0px;border-bottom:1px solid #ccc" align="left">
                            Total Fees
                        </td>
                        <th width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            $0.00
                        </th>
                        <th width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            $0.00
                        </th>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>










    <div style="color: rgb(19, 81, 109);margin-top:30px">

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="10%" style="padding:0px;" align="left">
                    <h3>Pets - </h3>
                </td>
                <td width="30%" style="padding:0px;" align="left">
                    <span>{{ $statement->account_card_number }}</span>
                </td>
                <td width="60%" style="padding:0px;" align="left">
                </td>
            </tr>
        </table>
    </div>




    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:5px;color: rgb(19, 81, 109);">
        <tr>
            <td width="100%" style="padding:0px;" align="left">
                <span class="sssize" style="font-weight: 700"> 360 SAVINGS
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:5px;color: rgb(19, 81, 109);">
        <tr>
            <td width="30%" style="padding:0px;" align="left">
                0.00%
            </td>
            <td width="30%" style="padding:0px;font-weight:700;color:green" align="left">
                $0.00
            </td>
            <td width="40%" style="padding:0px;" align="left">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="30%" style="padding:0px;" align="left">
                <span style="font-size: 8px"> ANNUAL PERCENTAGE YIELD <br>(APY) EARNED</span>
            </td>
            <td width="30%" style="padding:0px;" align="left">
                <span style="font-size: 8px">YTD INTEREST AND BONUSES</span>
            </td>
            <td width="40%" style="padding:0px;" align="left">
                <span style="font-size: 8px">DAYS IN STATEMENT <br> CYCLE</span>
            </td>
        </tr>

    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr style="color: rgb(19, 81, 109)">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                DATE
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                DESCRIPTION
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
                CATEGORY
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
                AMOUNT
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                BALANCE
            </td>
        </tr>
        <tr style="font-weight:700;background:#eee">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                {{ date_format(date_create($statement->fromDate), 'm/d') }}
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                Opening balance
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                {{ $currency . '0.00' }}
            </td>
        </tr>
        <tr style="font-weight:700;background:#eee">
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                {{ date_format(date_create($statement->fromDate), 'm/d') }}
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #ccc;" align="left">
                Closing balance
            </td>
            <td width="10%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </td>
            <th width="20%" style="padding-right:10px;border-bottom:1px solid #ccc;border-right:1px solid #ccc"
                align="right">
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #ccc;" align="right">
                {{ $currency . '0.00' }}
            </td>
        </tr>
    </table>



    <h3 style="color: rgb(19, 81, 109);margin-top:30px">Fees Summary
    </h3>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="50%" style="padding:0px;" align="left">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr style="color: rgb(19, 81, 109);font-size:8px">
                        <td width="40%" style="padding:2px 0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            TOTAL FOR THIS PERIOD
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            TOTAL YEAR-TO-DATE

                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:2px 0px;border-bottom:1px solid #ccc" align="left">
                            Total Fees
                        </td>
                        <th width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            $0.00
                        </th>
                        <th width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            $0.00
                        </th>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>













    {{-- page break --}}

    <div class="page-break"></div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr style="font-size: 8px">
            <td width="60%" style="padding:0px;" align="left">
            </td>
            <td width="20%" style="padding-right:8px;" align="right">
                <strong>{{ $statement->full_name }}</strong>
            </td>
            <td width="20%" style="border-left:solid 1px rgb(19, 81, 109);color: rgb(19, 81, 109);padding-left:20px"
                align="right">
                STATEMENT PERIOD <br>
                <strong> {{ date('M, d, Y', strtotime($statement->fromDate)) }} -
                    {{ date('M, d, Y', strtotime($statement->toDate)) }}
                </strong><br>

            </td>
        </tr>
    </table>



    <h3 style="color: rgb(19, 81, 109);margin-top:30px">If anything in your statement looks incorrect, please
        let us know immediately.
    </h3>
    <div class="sssize">
        In case of error or questions about your electronic transfers, we can be reached by telephone at 1-888-464-0727,
        or mail at P.O. Box 60, St. Cloud, MN 56302. Or, log in to your account at capitalone.com and click on the
        transaction. If you think your statement or receipt is wrong or if you need more information about a transfer
        listed on your statement or receipt, you must let us know within 60 days after we sent you the FIRST statement
        on which the error appeared.
    </div>
    <table class="sssize" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:5px">
        <tr>
            <td width="8%" style="padding:0px;" align="left">
            </td>
            <td width="92%" style="padding:0px;" align="left">

                (1) Tell us your name and account number. <br>
                (2) Describe the error or the transfer you are unsure about, and provide an explanation of why you
                believe it is an error or why you need more
                information.<br>
                (3) Tell us the dollar amount of the suspected error.

            </td>
        </tr>
    </table>

    <div class="sssize">
        We will investigate your complaint and will correct any error promptly. If we take more than 10 business days to
        do this, we will credit your account for the
        amount you think is in error, so that you will have the use of the money during the time it takes us to complete
        our investigation.
    </div>













    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td width="50%" style="padding:0px;" align="left">
            </td>
            <td width="30%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>


    <script type="text/php">
        if (isset($pdf)) {
        $x = 260;
        $y = 820;
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
