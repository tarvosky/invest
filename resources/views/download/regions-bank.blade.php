<?php
use App\Models\Transaction;
$fees = number_format(rand(10, 90), 2);
$rand1 = rand(10000, 300000);
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
$deposits = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->where('paidout', 0)
->get();
$debits = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->where('paidin', 0)
->get();



$my_fees = Transaction::where('statement_id', $statement->id)
->inRandomOrder()
->where('paidin', 0)
->first();
$dbs   = Transaction::where('statement_id', $statement->id)->get();
$dbs1  = Transaction::where('statement_id', $statement->id)
->skip(0)
->take(20)
->get();
$dbs2  = Transaction::where('statement_id', $statement->id)
->skip(20)
->take(1000)
->get();

$deposit_count = count($deposits);
$debit_count = count($debits);

$first_row_count = 16;
$normal_row_count = 33;

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
$transactions = Transaction::where('statement_id', $statement->id)->get();

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

    </style>
</head>

<body>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="20%" style="padding-bottom:4px;" align="right">
                <img width="200" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
            </td>
            <td width="20%" style="padding-left:5px;" align="left">
                <strong>Regions Bank</strong> <br>
                Brewton <br>
                1116 Douglas Avenue <br>Brewton, AL 36426
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="10%" style="padding-bottom:4px;" align="right">
            </td>
            <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                {{ $statement->business_name }} <br>{{ $statement->full_name }}<br>
                {{ $statement->address }}<br>
                {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
    <div class="sssize" style="text-align:center;padding:5px 0px">
        <strong> LIFEGREEN CHECKING</strong> <br>
        {{ date('F d, Y', strtotime($statement->fromDate)) }} through {{ date('F d, Y', strtotime($statement->toDate)) }}

    </div>
    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>






    <div style="margin: 30px 0px;border:solid 1px #000" class="sssize">

        <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc">
            <strong>SUMMARY</strong>
        </div>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:10px">
            <tr>
                <th width="20%" style="padding-left:2px;" align="left">
                    Beginning Balance
                </th>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . number_format($statement->opening_balance, 2) }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Minimum Balance
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency }}4.00
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Deposits & Credits
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . number_format($calculation['credit'], 2) }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Average Balance
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . number_format($calculation['total'], 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Withdrawals
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . number_format($calculation['debit'], 2) }} -
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Fees
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . $fees }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Automatic Transfers
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . 0.0 }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Returned Checks
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . 100.0 }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Checks Converted
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . 100.0 }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <td width="20%" style="padding-left:2px;" align="left">
                    Checks
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . 0.0 }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
            <tr>
                <th width="20%" style="padding-left:2px;" align="left">
                    Ending Balance
                </th>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . number_format($calculation['total_bal'], 2) }} +
                </td>
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
            </tr>
        </table>

    </div>

    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
    <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc" class="sssize">
        <strong>DEPOSIT & CREDITS</strong>
    </div>





    @if ($both <= $first_row_count)
        @foreach ($deposits as $key => $value) 
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
            <tr >
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding-left:2px;" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="45%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td width="20%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="center">
                    {{ $currency . '' . number_format($value->paidin, 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="right">

                </td>
            </tr>
        </table>
        @endforeach 

    @elseif($deposit_count < $first_row_count && $both> $first_row_count)
        @foreach ($deposits as $key => $value)    
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
            <tr >
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding-left:2px;" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="45%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td width="20%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="center">
                    {{ $currency . '' . number_format($value->paidin, 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="right">

                </td>
            </tr>
        </table>
        @endforeach 
    @elseif ($deposit_count == $first_row_count)   
            @foreach ($deposits as $key => $value)    
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr >
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="5%" style="padding-left:2px;" align="left">
                        {{ date_format(date_create($value->theDate), 'm/d') }}
                    </td>
                    <td width="5%" style="padding:0px;" align="right">
                    </td>
                    <td width="45%" style="padding:0px;" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="center">
                        {{ $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                    <td width="5%" style="padding:0px;" align="right">

                    </td>
                </tr>
            </table>
            @endforeach    
                    {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                        <tr>
                            <td width="20%" style="padding-bottom:4px;" align="right">
                                <img width="200" height="40" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                            </td>
                            <td width="20%" style="padding-left:5px;" align="left">
                                <strong>Regions Bank</strong> <br>
                                Brewton <br>
                                1116 Douglas Avenue <br>Brewton, AL 36426
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>

                        </tr>
                    </table>


                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                        <tr>
                            <td width="10%" style="padding-bottom:4px;" align="right">
                            </td>
                            <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                                {{ $statement->business_name }} <br>{{ $statement->full_name }}<br>
                                {{ $statement->address }}<br>
                                {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>

                        </tr>
                    </table>

<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
                    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>

    @elseif($deposit_count > $first_row_count && $both > $first_row_count)

        @foreach ($deposits1 as $key => $value)
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
            <tr >
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding-left:2px;" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="45%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td width="20%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="center">
                    {{ $currency . '' . number_format($value->paidin, 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="right">

                </td>
            </tr>
        </table>
        @endforeach    


            {{-- page break --}}
            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width="20%" style="padding-bottom:4px;" align="right">
                        <img width="200" height="40" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                    </td>
                    <td width="20%" style="padding-left:5px;" align="left">
                        <strong>Regions Bank</strong> <br>
                        Brewton <br>
                        1116 Douglas Avenue <br>Brewton, AL 36426
                    </td>
                    <td width="60%" style="padding:0px;" align="left">
                    </td>

                </tr>
            </table>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                <tr>
                    <td width="10%" style="padding-bottom:4px;" align="right">
                    </td>
                    <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                        {{ $statement->business_name }} <br>{{ $statement->full_name }}<br>
                        {{ $statement->address }}<br>
                        {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                    </td>
                    <td width="60%" style="padding:0px;" align="left">
                    </td>

                </tr>
            </table>

           <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
            <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
            <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                <strong>DEPOSIT & CREDITS (CONTINUES)</strong>
            </div>
            @foreach ($deposits2 as $key => $value)
                @if ($key % $normal_row_count == 0 && $key !== 0)
                {{-- page break --}}
            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width="20%" style="padding-bottom:4px;" align="right">
                        <img width="200" height="40" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                    </td>
                    <td width="20%" style="padding-left:5px;" align="left">
                        <strong>Regions Bank</strong> <br>
                        Brewton <br>
                        1116 Douglas Avenue <br>Brewton, AL 36426
                    </td>
                    <td width="60%" style="padding:0px;" align="left">
                    </td>

                </tr>
            </table>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                <tr>
                    <td width="10%" style="padding-bottom:4px;" align="right">
                    </td>
                    <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                        {{ $statement->business_name }} <br>{{ $statement->full_name }}<br>
                        {{ $statement->address }}<br>
                        {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                    </td>
                    <td width="60%" style="padding:0px;" align="left">
                    </td>

                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
            <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
            <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                <strong>DEPOSIT & CREDITS (CONTINUES)</strong>
            </div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr >
                    <td width="5%" style="padding:0px;" align="left">
                    </td>
                    <td width="5%" style="padding-left:2px;" align="left">
                        {{ date_format(date_create($value->theDate), 'm/d') }}
                    </td>
                    <td width="5%" style="padding:0px;" align="right">
                    </td>
                    <td width="45%" style="padding:0px;" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="center">
                        {{ $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                    <td width="5%" style="padding:0px;" align="right">
    
                    </td>
                </tr>
            </table>
                @else
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                    <tr >
                        <td width="5%" style="padding:0px;" align="left">
                        </td>
                        <td width="5%" style="padding-left:2px;" align="left">
                            {{ date_format(date_create($value->theDate), 'm/d') }}
                        </td>
                        <td width="5%" style="padding:0px;" align="right">
                        </td>
                        <td width="45%" style="padding:0px;" align="left">
                            {{ $value->description }}
                        </td>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="15%" style="padding:0px;" align="center">
                            {{ $currency . '' . number_format($value->paidin, 2) }}
                        </td>
                        <td width="5%" style="padding:0px;" align="right">
        
                        </td>
                    </tr>
                </table>
                @endif
            @endforeach    
    @endif    







    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:4px" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="5%" style="padding-left:2px;" align="left">

            </th>
            <td width="5%" style="padding:0px;" align="right">
            </td>
            <td width="45%" style="padding:0px;" align="left">
            </td>
            <td width="20%" style="padding:0px;" align="left">
                Total Deposits & Credits
            </td>
            <td width="15%" style="padding:0px;border-top:1px solid #000;" align="center">
                {{ $currency . '' . number_format($calculation['credit'], 2) }}
            </td>
            <td width="5%" style="padding:0px;" align="right">

            </td>
        </tr>
    </table>



    @if($deposit_count > $first_row_count && $both > $first_row_count)
    {{-- page break --}}
    <div class="page-break"></div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="20%" style="padding-bottom:4px;" align="right">
                <img width="200" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
            </td>
            <td width="20%" style="padding-left:5px;" align="left">
                <strong>Regions Bank</strong> <br>
                Brewton <br>
                1116 Douglas Avenue <br>Brewton, AL 36426
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="10%" style="padding-bottom:4px;" align="right">
            </td>
            <td width="30%" style="padding-left:5px;" align="left">
                {{ $statement->business_name }}<br> {{ $statement->full_name }}<br>
                {{ $statement->state }}<br>
                {{ $statement->city }},{{ $statement->zip }}
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
    @endif






    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
    <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
        <strong>WITHDRAWALS</strong>
    </div>




    @if ($both < $first_row_count)
        @foreach ($debits as $key => $value)
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
            <tr >
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding-left:2px;" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="45%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td width="20%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="center">
                    {{  $currency . '' . number_format($value->paidout, 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
        </table>
        @endforeach
    @elseif($deposit_count < $first_row_count && $both> $first_row_count)
        @foreach ($debits1 as $key => $value)
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
            <tr >
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding-left:2px;" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="45%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td width="20%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="center">
                    {{  $currency . '' . number_format($value->paidout, 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
        </table>
        @endforeach
         {{-- page break --}}
         <div class="page-break"></div>
         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
             <tr>
                 <td width="20%" style="padding-bottom:4px;" align="right">
                     <img width="200" height="40" style="margin:0;padding:0"
                         src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                 </td>
                 <td width="20%" style="padding-left:5px;" align="left">
                     <strong>Regions Bank</strong> <br>
                     Brewton <br>
                     1116 Douglas Avenue <br>Brewton, AL 36426
                 </td>
                 <td width="60%" style="padding:0px;" align="left">
                 </td>

             </tr>
         </table>


         <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
             <tr>
                 <td width="10%" style="padding-bottom:4px;" align="right">
                 </td>
                 <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                    {{ $statement->business_name }}<br> {{ $statement->full_name }}<br>
                    {{ $statement->address }}<br>
                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                </td>
                 <td width="60%" style="padding:0px;" align="left">
                 </td>

             </tr>
         </table>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
         <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
         <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
             <strong>WITHDRAWALS (CONTINUES)</strong>
         </div>

         @foreach ($debits2 as $key => $value)
                @if ($key % $normal_row_count == 0 && $key !== 0)
                        {{-- page break --}}
                        <div class="page-break"></div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr>
                                <td width="20%" style="padding-bottom:4px;" align="right">
                                    <img width="200" height="40" style="margin:0;padding:0"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                                </td>
                                <td width="20%" style="padding-left:5px;" align="left">
                                    <strong>Regions Bank</strong> <br>
                                    Brewton <br>
                                    1116 Douglas Avenue <br>Brewton, AL 36426
                                </td>
                                <td width="60%" style="padding:0px;" align="left">
                                </td>

                            </tr>
                        </table>


                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                            <tr>
                                <td width="10%" style="padding-bottom:4px;" align="right">
                                </td>
                                <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                                    {{ $statement->business_name }} <br>{{ $statement->full_name }}<br>
                                    {{ $statement->address }}<br>
                                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                                </td>
                                <td width="60%" style="padding:0px;" align="left">
                                </td>

                            </tr>
                        </table>

                      <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
                        <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
                        <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                            <strong>WITHDRAWALS (CONTINUES)</strong>
                        </div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr >
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="5%" style="padding-left:2px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                                <td width="45%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="20%" style="padding:0px;" align="left">
                                </td>
                                <td width="15%" style="padding:0px;" align="center">
                                    {{  $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                            </tr>
                        </table>


                        @else

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr >
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="5%" style="padding-left:2px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                                <td width="45%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="20%" style="padding:0px;" align="left">
                                </td>
                                <td width="15%" style="padding:0px;" align="center">
                                    {{  $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
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
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                             <tr>
                                 <td width="20%" style="padding-bottom:4px;" align="right">
                                     <img width="200" height="40" style="margin:0;padding:0"
                                         src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                                 </td>
                                 <td width="20%" style="padding-left:5px;" align="left">
                                     <strong>Regions Bank</strong> <br>
                                     Brewton <br>
                                     1116 Douglas Avenue <br>Brewton, AL 36426
                                 </td>
                                 <td width="60%" style="padding:0px;" align="left">
                                 </td>
 
                             </tr>
                         </table>
 
 
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                             <tr>
                                 <td width="10%" style="padding-bottom:4px;" align="right">
                                 </td>
                                 <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                                    {{ $statement->business_name }}<br> {{ $statement->full_name }}<br>
                                    {{ $statement->address }}<br>
                                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                                </td>
                                 <td width="60%" style="padding:0px;" align="left">
                                 </td>
 
                             </tr>
                         </table>
 
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
                         <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
                         <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                             <strong>WITHDRAWALS (CONTINUES)</strong>
                         </div>
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr >
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="5%" style="padding-left:2px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                                <td width="45%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="20%" style="padding:0px;" align="left">
                                </td>
                                <td width="15%" style="padding:0px;" align="center">
                                    {{  $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                            </tr>
                        </table>
 
                         @else
 
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr >
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="5%" style="padding-left:2px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                                <td width="45%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="20%" style="padding:0px;" align="left">
                                </td>
                                <td width="15%" style="padding:0px;" align="center">
                                    {{  $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
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
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                             <tr>
                                 <td width="20%" style="padding-bottom:4px;" align="right">
                                     <img width="200" height="40" style="margin:0;padding:0"
                                         src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                                 </td>
                                 <td width="20%" style="padding-left:5px;" align="left">
                                     <strong>Regions Bank</strong> <br>
                                     Brewton <br>
                                     1116 Douglas Avenue <br>Brewton, AL 36426
                                 </td>
                                 <td width="60%" style="padding:0px;" align="left">
                                 </td>
 
                             </tr>
                         </table>
 
 
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                             <tr>
                                 <td width="10%" style="padding-bottom:4px;" align="right">
                                 </td>
                                 <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                                    {{ $statement->business_name }} <br>{{ $statement->full_name }}<br>
                                    {{ $statement->address }}<br>
                                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                                </td>
                                 <td width="60%" style="padding:0px;" align="left">
                                 </td>
 
                             </tr>
                         </table>
 
                       <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
                         <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
                         <div width="100%" style="margin:10px;text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                             <strong>WITHDRAWALS (CONTINUES)</strong>
                         </div>
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr >
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="5%" style="padding-left:2px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                                <td width="45%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="20%" style="padding:0px;" align="left">
                                </td>
                                <td width="15%" style="padding:0px;" align="center">
                                    {{  $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                            </tr>
                        </table>
 
 
                         @else
                         <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                            <tr >
                                <td width="5%" style="padding:0px;" align="left">
                                </td>
                                <td width="5%" style="padding-left:2px;" align="left">
                                    {{ date_format(date_create($value->theDate), 'm/d') }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                                <td width="45%" style="padding:0px;" align="left">
                                    {{ $value->description }}
                                </td>
                                <td width="20%" style="padding:0px;" align="left">
                                </td>
                                <td width="15%" style="padding:0px;" align="center">
                                    {{  $currency . '' . number_format($value->paidout, 2) }}
                                </td>
                                <td width="5%" style="padding:0px;" align="right">
                                </td>
                            </tr>
                        </table>
                         @endif
                         @endforeach

    @endif
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="5%" style="padding-left:2px;" align="left">

            </th>
            <td width="5%" style="padding:0px;" align="right">
            </td>
            <td width="45%" style="padding:0px;" align="left">
            </td>
            <td width="20%" style="padding:0px;" align="left">
                Total Withdrawals
            </td>
            <td width="15%" style="padding:0px;border-top:1px solid #000;" align="center">
                {{ $currency . '' . number_format($calculation['debit'], 2) }}
            </td>
            <td width="5%" style="padding:0px;" align="right">

            </td>
        </tr>
    </table>

    {{-- page break --}}

    <div class="page-break"></div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="20%" style="padding-bottom:4px;" align="right">
                <img width="200" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
            </td>
            <td width="20%" style="padding-left:5px;" align="left">
                <strong>Regions Bank</strong> <br>
                Brewton <br>
                1116 Douglas Avenue <br>Brewton, AL 36426
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="10%" style="padding-bottom:4px;" align="right">
            </td>
            <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                    {{ $statement->business_name }}<br> {{ $statement->full_name }}<br>
                    {{ $statement->address }}<br>
                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
    <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc" class="sssize">
        <strong>FEES</strong>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:10px" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="10%" style="padding-left:2px;" align="left">
                
                 {{ date_format(date_create($my_fees->theDate), 'm/d') }}
            </th>
            <td width="5%" style="padding:0px;" align="right">
            </td>
            <td width="45%" style="padding:0px;" align="left">
                {{ $my_fees->description }}
            </td>
            <td width="10%" style="padding:0px;" align="left">
            </td>
            <td width="20%" style="padding:0px;" align="center">
            </td>
            <td width="5%" style="padding:0px;" align="right">
                {{  $currency . '' . number_format($my_fees->paidout, 2) }}
            </td>
        </tr>
    </table>


    <div style="margin: 20px 0px;border:solid 1px #000" class="sssize">

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:10px 0px">
            <tr>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="40%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    <h3> Total For This <br> Statement Period</h3>
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    <h3> Total Calendar <br> Year-to-Date</h3>
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
            <tr>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="40%" style="padding:0px;" align="left">
                    Total Overdraft Fees (may include waived fees) 0.00
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    0.00
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    0.00
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>
            <tr>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="40%" style="padding:0px;" align="left">
                    Total Returned Item Fees (may include waived fees)
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    {{ $currency . '' . number_format($fees, 2) }}
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
                <td width="20%" style="padding:0px;" align="right">
                    0.00
                </td>
                <td width="5%" style="padding:0px;" align="right">
                </td>
            </tr>

        </table>


    </div>
    




        @if(count($dbs) <= 30 )
                    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
                        <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                            <strong>DAILY BALANCE SUMMARY</strong>
                        </div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px" class="sssize">
                            <tr>
                                <td width="20%" style="padding:0px;border-bottom: 1px solid #000;" align="left">
                                    Date
                                </td>
                                <td width="50%" style="padding:0px;border-bottom: 1px solid #000;" align="right">
                                    Balance
                                </td>
                            </tr>
                        </table>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0"  class="sssize">
                            @foreach ($dbs as $key => $value)
                                <tr>
                                    <td width="20%" style="padding:0px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding:0px;" align="right">
                                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1, $transactions_ordinary,$statement->id);
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
        @else

                    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
                        <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                            <strong>DAILY BALANCE SUMMARY</strong>
                        </div>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px" class="sssize">
                            <tr>
                                <td width="20%" style="padding:0px;border-bottom: 1px solid #000;" align="left">
                                    Date
                                </td>
                                <td width="50%" style="padding:0px;border-bottom: 1px solid #000;" align="right">
                                    Balance
                                </td>
                            </tr>
                        </table>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0"  class="sssize">
                            @foreach ($dbs1 as $key => $value)
                                <tr>
                                    <td width="20%" style="padding:0px;" align="left">
                                        {{ date_format(date_create($value->theDate), 'm/d') }}
                                    </td>
                                    <td width="50%" style="padding:0px;" align="right">
                                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1, $transactions_ordinary,$statement->id);
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                       {{-- new line setup --}}
                       {{-- page break --}}
                    <div class="page-break"></div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                        <tr>
                            <td width="20%" style="padding-bottom:4px;" align="right">
                                <img width="200" height="40" style="margin:0;padding:0"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
                            </td>
                            <td width="20%" style="padding-left:5px;" align="left">
                                <strong>Regions Bank</strong> <br>
                                Brewton <br>
                                1116 Douglas Avenue <br>Brewton, AL 36426
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>

                        </tr>
                    </table>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
                        <tr>
                            <td width="10%" style="padding-bottom:4px;" align="right">
                            </td>
                            <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                                    {{ $statement->business_name }}<br> {{ $statement->full_name }}<br>
                                    {{ $statement->address }}<br>
                                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
                            </td>
                            <td width="60%" style="padding:0px;" align="left">
                            </td>
                        </tr>
                    </table>
                   <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
                    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
                    <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc" class="sssize">
                        <strong>DAILY BALANCE SUMMARY  (CONTINUES)</strong>
                    </div>











  @foreach ($dbs2 as $key => $value)
             @if ($key % 35 == 0 && $key !== 0)
   {{-- page break --}}
    <div class="page-break"></div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="20%" style="padding-bottom:4px;" align="right">
                <img width="200" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/regions-bank.png'))) }}">
            </td>
            <td width="20%" style="padding-left:5px;" align="left">
                <strong>Regions Bank</strong> <br>
                Brewton <br>
                1116 Douglas Avenue <br>Brewton, AL 36426
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>

        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="10%" style="padding-bottom:4px;" align="right">
            </td>
            <td width="30%" style="padding-left:5px;text-transform:uppercase" align="left">
                    {{ $statement->business_name }}<br> {{ $statement->full_name }}<br>
                    {{ $statement->address }}<br>
                    {{ $statement->city }} {{ $statement->state }} {{ $statement->zip }}
            </td>
            <td width="60%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:70px" class="sssize">
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                <h3> ACCOUNT #</h3>
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                <h3 style="background:#ccc;padding:3px"> {{ $statement->account_card_number }}</h3>
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Cycle
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                001
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
            Enclosures
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $day }}
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
                Page
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">
                
            </td>
        </tr>
        <tr>
            <td width="60%" style="padding-bottom:4px;" align="right"></td>
            <td width="15%" style="padding-left:5px;" align="right">
               
            </td>
            <td width="10%" style="padding-left:5px;" align="right">
            </td>
            <td width="15%" style="padding:0px 10px;" align="right">

            </td>
        </tr>
    </table>
    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
    <div width="100%" style="text-align:center;padding:5px 0px;background:#ccc" class="sssize">
        <strong>DAILY BALANCE SUMMARY  (CONTINUES)</strong>
    </div>
        @else 

           <table width="100%" cellspacing="0" cellpadding="0" border="0"  class="sssize">
       
            <tr>
                <td width="20%" style="padding:0px;" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="50%" style="padding:0px;" align="right">
                    <?php echo cal_bal_by_key($statement->opening_balance, $key + 1, $transactions_ordinary,$statement->id);
                    ?>
                </td>
            </tr>
            </table>
        @endif
@endforeach
@endif



   









    <div style="border-top:1px solid #000;border-bottom:1px solid #000;height:2px"></div>
    <div style="text-align:center;font-weight:bolder;padding:20px 0px">
        You may request account disclosures containing <br>
        terms, fees, and rate information (if applicable) <br>
        for your account by contacting any Regions office.
    </div>














    {{-- page break --}}

    <div class="page-break"></div>




    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="45%" style="padding:0px;" align="left">
                <h3>Easy Steps to Balance Your Account</h3>

                <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top:10px">
                    <tr>
                        <td width="20%" style="padding:0px;" align="center">
                        </td>
                        <td width="50%" style="padding:0px;" align="">
                        </td>
                        <td width="30%" style="padding:0px;" align="center">
                            Checking <br> Account
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:10px;" align="center">
                            1
                        </td>
                        <td width="50%" style="padding:10px;" align="">
                            Write here the amount shown on <br>statement for <strong>ENDING BALANCE</strong>
                        </td>
                        <td width="30%" style="padding:10px;" align="left">
                            $
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:10px;" align="center">
                            2
                        </td>
                        <td width="50%" style="padding:10px;" align="">
                            Enter any deposits which have not been credited on this statement.</td>
                        <td width="30%" style="padding:10px;" align="left">
                            $ <br>+
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:10px;" align="center">
                            3
                        </td>
                        <td width="50%" style="padding:10px;" align="">
                            Total lines 1 & 2</td>
                        <td width="30%" style="padding:10px;" align="left">
                            $ <br>=
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:10px;" align="center">
                            4
                        </td>
                        <td width="50%" style="padding:10px;" align="">
                            Enter total from 4a <br>
                            (column on right side of page)</td>
                        <td width="30%" style="padding:10px;" align="left">
                            $ <br> -
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:10px;" align="center">
                            5
                        </td>
                        <td width="50%" style="padding:10px;" align="">
                            Subtract line 4 from line 3. <br>
                            This should be your checkbook balance.</td>
                        <td width="30%" style="padding:10px;" align="left">
                            $ <br> =
                        </td>
                    </tr>
                </table>



            </td>
            <td width="10%" style="padding:0px;" align="left">
            </td>
            <td width="45%" style="padding:0px;" align="left">
                4a List any checks, payments, transfers or other <br>withdrawals from your account that are not on
                <br>
                this statement.


                <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top:10px">
                    <tr>
                        <td width="20%" style="padding:2px;" align="center">
                            Check <br> No.
                        </td>
                        <td width="80%" style="padding:2px;" align="center">
                            Amount
                        </td>
                    </tr>
                </table>


                <table width="100%" cellspacing="0" cellpadding="0" border="1" style="margin-top:10px">
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>

                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:3px;" align="center">
                        </td>
                        <td width="70%" style="padding:3px;" align="left">
                            $
                        </td>
                        <td width="10%" style="padding:3px;" align="center">
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
    <hr>

    <div class="sssize" style="margin:16px 0px;">
        The law requires you to use "reasonable care and promptness" in examining your bank statement and any checks
        sent with it and to report to the Bank an unauthorized signature (i.e., a forgery), any alteration of a
        check,
        or any unauthorized endorsement. You must report any forged signatures, alterations or forged endorsements
        to
        the Bank within the time periods specified under the Deposit Agreement. If you do not do this, the Bank will
        not
        be liable to you for the losses or claims arising from the forged signatures, forged endorsements or
        alterations. Please see the Deposit Agreement for further explanation of your responsibilities with regard
        to
        your statement and checks. A copy of our current Deposit Agreement may be requested at any of our branch
        locations.
    </div>

    <div class="sssize" style="margin:16px 0px;text-align:center">
        Summary of Our Error Resolution Procedures <br>
        In Case of Errors or Questions About Your Electronic Transfers<br> Telephone us toll-free at
        1-800-734-4667<br>
        or write us at<br>
        Regions Electronic Funds Transfer Services<br>
        Post Office Box 413<br>
        Birmingham, Alabama 35201

    </div>

    <div class="sssize" style="margin:16px 0px;">
        Please contact Regions as soon as you can, if you think your statement is wrong or if you need more
        information
        about a transfer listed on your statement. We must hear from you no later than sixty (60) days after we sent
        the
        FIRST statement on which the problem or error appeared.
        <ol>
            <li>Tell us your name and account number.</li>
            <li>Describe the error or the transfer you are unsure about and explain as clearly as you can why you
                believe it is an error or why you need more information.</li>
            <li>Tell us the dollar amount of the suspected error.</li>
        </ol>
        If you tell us verbally, we may require that you send us your complaint or question in writing within ten
        (10)
        business days.
    </div>

    <div class="sssize" style="margin:16px 0px;">
        We will determine whether an error occurred within ten (10) business days after we hear from you and will
        correct any error promptly. If we need more time, however, we may take up to forty-five (45) days to
        investigate
        your complaint or question (ninety (90) days for POS transactions or for transfers initiated outside of the
        United States). If we decide to do this, we will credit your account within ten (10) business days for the
        amount you think is in error. If, after the investigation, we determine that no bank error occurred, we will
        debit your account to the extent previously credited. If we ask you to put your complaint in writing and we
        do
        not receive it within ten (10) business days, we may not credit your account.
    </div>

    <div class="sssize" style="margin:16px 0px">
        New Accounts- If an alleged error occurred within thirty (30) days after your first deposit to your account
        was
        made, we may have up to ninety (90) days to investigate your complaint, provided we credit your account
        within
        twenty (20) business days for the amount you think is in error.
    </div>
    <div class="sssize" style="margin:16px 0px">
        If we decide there was no error, we will send you a written explanation within three (3) business days after
        we
        finish our investigation. You may ask for copies of the documents that we used in our investigation.
    </div>
    <div class="sssize" style="margin:16px 0px">
        FOR QUESTIONS CONCERNING THIS STATEMENT OR FOR VERIFICATION OF A PREAUTHORIZED DEPOSIT, PLEASE CALL
        1-800-REGIONS (734-4667) OR VISIT YOUR NEAREST REGIONS LOCATION.
    </div>
    <hr>





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
        $x = 540;
        $y = 278;
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
