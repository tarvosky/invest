<?php
use App\Models\Transaction;
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

$transactions_ordinary = $transactions;
$transactions = $transactions->get();
$first_row_count = 6;
$normal_row_count = 33;


$tranHistory = Transaction::where('statement_id', $statement->id)->get();


$tranx = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->get();
$tranx1 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->skip(0)
        ->take($first_row_count)
        ->get();
$tranx2 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->skip($first_row_count)
        ->take(1000)
        ->get();
$tranx_count = count($tranx);
$tranx1_count = count($tranx1);
$tranx2_count = count($tranx2);

if($tranx_count < $first_row_count ){
    $tranx = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->get(); 
}else{
$tranx1 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->skip(0)
        ->take($first_row_count)
        ->get();
$tranx2 = Transaction::where('statement_id', $statement->id)
        //->orderBy('id', 'DESC')
        ->skip($first_row_count)
        ->take(1000)
        ->get();

}



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










    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="">

        <tr>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="25%" style="padding:0px;" align="left">
                SUNTRUST BANK <br>
                PO BOX 305183 <br>
                NASHVILLE TN 37230-5183
            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <strong>______ ______</strong>
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <br> 78/A15/8775/0/66 <br> {{ $statement->account_card_number }} <br> {{ $statement->toDate }}
            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
        </tr>

        <tr>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="25%" style="padding:0px;" align="left">

            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <strong>______ ______</strong>
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <h2> Account <br>Statement</h2>
            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
        </tr>

    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
        <td width="10%" style="padding:0px;" align="left">
        </td>
        <td width="20%" style="padding:0px;" align="left">
            <img width="120" height="100" style="margin:0;padding:0"
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/sun-trust-bank.png'))) }}">
        </td>
        <td width="25%" style="padding:0px;" align="left">
        </td>
        <td width="15%" style="padding:0px;" align="left">
        </td>
        <td width="15%" style="padding:0px;" align="left">
        </td>
        <td width="15%" style="padding:0px;" align="left">
        </td>
        </tr>
    </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="15%" style="padding:0px;" align="left">
                </td>
               
                <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                    <span>{{ $statement->business_name }} <br />{{ $statement->full_name }}</span><br />
                    <span>{{ $statement->address }} </span><br />
                    <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Questions? Please call <br> 1-800-786-8787
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>

    <div class="smsize"
        style="border:2px solid #000; border-radius:10px;text-align:center;padding:10px;margin-top:50px">
        Zelle (R) is here and now available in Online Banking. <br>
        Zelle is the fast, safe and easy way to move money and pay people in 3 easy steps. <br> Simply sign on.
        Select
        "Move Money." Then "Send Money with Zelle (R)." <br>
        Send payments to friends and family fast at no additional charge to SunTrust customers. <br> All you need is
        an
        email address or U.S. mobile phone number.
    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px">

        <tr>
            <td width="5%" style="padding:0px; border-top:2px solid #000" align="left">
                <strong>Account Summary</strong>
            </td>
            <td width="5%" style="padding:10px 0px; border-top:2px solid #000" align="left">
            </td>
            <td width="30%" class="smsize" style="padding:0px;border-top:2px solid #000" align="left">
                <strong>Account Type </strong> <br><br>
                ESSENTIAL CHECKING
            </td>
            <td width="30%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="left">
                <strong>Account Number</strong> <br><br> {{ $statement->account_card_number }}
            </td>
            <td width="30%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="right">
                <strong>Statement Period</strong> <br><br> {{ $statement->fromDate }} - {{ $statement->toDate }}
            </td>
        </tr>

    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="margin-top:20px">
        <tr>
            <th width="5%" style="padding:0px;" align="left">
            </th>
            <th width="5%" style="padding:0px; " align="left">
            </th>
            <th width="30%" style="padding:0px;border-top:2px solid #000" align="left">
                Description
            </th>
            <th width="15%" style="padding:0px;border-top:2px solid #000" align="right">
                Amount
            </th>
            <th width="5%" style="padding:0px;border-top:2px solid #000" align="">
            </th>
            <th width="30%" style="padding:0px; border-top:2px solid #000" align="left">
                Description
            </th>
            <th width="15%" style="padding:0px; border-top:2px solid #000" align="right">
                Amount
            </th>
        </tr>

        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px; " align="left">
            </td>
            <td width="30%" style="padding:0px;" align="left">
                Beginning Balance
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency }}{{ number_format($statement->opening_balance, 2) }}
            </td>
            <td width="5%" style="padding:0px;" align="">
            </td>
            <td width="30%" style="padding:0px; " align="left">
                Average Balance
            </td>
            <td width="15%" style="padding:0px; " align="right">
                {{ $currency }}<?php
                $rand = number_format(rand(200, 900), 2);
                echo $rand;
                ?>
            </td>
        </tr>

        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px; " align="left">
            </td>
            <td width="30%" style="padding:0px;" align="left">
                Deposits/Credits
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency }}{{ number_format($calculation['credit'], 2) }}
            </td>
            <td width="5%" style="padding:0px;" align="">
            </td>
            <td width="30%" style="padding:0px; " align="left">
                Average Collected Balance
            </td>
            <td width="15%" style="padding:0px; " align="right">
                {{ $currency }}{{ $rand }}
            </td>
        </tr>

        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px; " align="left">
            </td>
            <td width="30%" style="padding:0px;" align="left">
                Checks
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency }}0.00
            </td>
            <td width="5%" style="padding:0px;" align="">
            </td>
            <td width="30%" style="padding:0px; " align="left">
                Number of Days in Statement Period
            </td>
            <td width="15%" style="padding:0px; " align="right">
                <?php
                $from = strtotime($statement->fromDate);
                $to = strtotime($statement->toDate);
                $datediff = $to - $from;

                echo round($datediff / (60 * 60 * 24));
                ?>
            </td>
        </tr>

        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px; " align="left">
            </td>
            <td width="30%" style="padding:0px;" align="left">
                Withdrawals/Debits
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency }}{{ number_format($calculation['debit'], 2) }}
            </td>
            <td width="5%" style="padding:0px;" align="">
            </td>
            <td width="30%" style="padding:0px; " align="left">
            </td>
            <td width="15%" style="padding:0px; " align="right">
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px; " align="left">
            </td>
            <td width="30%" style="padding:0px;" align="left">
                Ending Balance
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </td>
            <td width="5%" style="padding:0px;" align="">
            </td>
            <td width="30%" style="padding:0px; " align="left">
            </td>
            <td width="15%" style="padding:0px; " align="right">
            </td>
        </tr>

    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px">

        <tr>
            <td width="5%" style="padding:5px 0px; border-top:2px solid #000" align="left">
                <strong>Overdraft Protection</strong>
            </td>
            <td width="5%" class="smsize" style="padding:10px 0px; border-top:2px solid #000" align="left">
            </td>
            <td width="20%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="left">
                <strong>Account Number</strong> <br><br>
                {{ $statement->account_card_number }}
            </td>
            <td width="30%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="right">
                <strong>Protected By</strong> <br><br> Not enrolled
            </td>
            <td width="40%" style="padding:10px 0px;border-top:2px solid #000" align="left">
            </td>
        </tr>

    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="margin-top:10px">

        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="90%" style="padding:0px" align="left">
                For more information about SunTrust's Overdraft Protected By Not enrolled Services, visit
                www.suntrust.com/overdraft
            </td>
        </tr>

    </table>

    <div style="border-top:2px solid #000;padding:10px 0px;margin-top:10px">
        <strong>Transaction History</strong>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">

        <tr>
            <th width="5%" style="padding:0px;border-bottom:5px solid #000;" align="left">
                Date
            </th>
            <th width="10%" style="padding:0px;border-bottom:5px solid #000;" align="left">
                Check #
            </th>
            <th width="52%" style="padding:0px;border-bottom:5px solid #000;" align="left">
                Transaction Description Details
            </th>
            <th width="10%" style="padding:0px;border-bottom:5px solid #000;" align="right">
                Deposits/<br> Credits
            </th>
            <th width="13%" style="padding:0px;border-bottom:5px solid #000;" align="right">
                Withdrawals/<br> Debits
            </th>
            <th width="10%" style="padding:0px;border-bottom:5px solid #000;" align="right">
                Current<br> Balance
            </th>
        </tr>
    </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
        <tr>
            <td width="5%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">
               {{ date_format(date_create($statement->fromDate), 'm/d')  }}
            </td>
            <td width="10%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">

            </td>
            <th width="52%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">
                Beginning Balance
            </th>
            <td width="10%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">

            </td>
            <td width="13%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">

            </td>
            <td width="10%" style="padding-left:2px;background-color:#eee;border:2px solid #fff" align="right">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }} </td>

        </tr>
    </table>

@if($tranx_count < $first_row_count )
                @foreach ($tranx as $key => $value)
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="5%"
                        style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                        align="left">
                        {{ date_format(date_create($value->theDate), 'm/d') }}
                    </td>
                    <td width="10%"
                        style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                        align="left">
    
                    </td>
                    <td width="52%"
                        style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                        align="left">
                        {{ $value->description }}
                    </td>
                    <td width="10%"
                        style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                        align="right">
                        {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                    <td width="13%"
                        style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                        align="right">
                        {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                    </td>
                    <td width="10%"
                        style="padding-left:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                        align="right">
                        <?php echo ($key + 1) % 5 === 0 ? cal_bal_by_key($statement->opening_balance, $key + 1,
                        $transactions_ordinary,$statement->id) : ''; ?>
                    </td>
                </tr>
            </table>
                @endforeach
   @else 
            @foreach ($tranx1 as $key => $value)
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
            <tr>
                <td width="5%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">

                </td>
                <td width="52%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">
                    {{ $value->description }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                </td>
                <td width="13%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                </td>
                <td width="10%"
                    style="padding-left:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    <?php echo ($key + 1) % 5 === 0 ? cal_bal_by_key($statement->opening_balance, $key + 1,
                    $transactions_ordinary,$statement->id) : ''; ?>
                </td>
            </tr>
            </table>
            @endforeach

            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="">
        
                <tr>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="25%" style="padding:0px;" align="left">
                        SUNTRUST BANK <br>
                        PO BOX 305183 <br>
                        NASHVILLE TN 37230-5183
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <strong>______ ______</strong>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <br> 78/A15/8775/0/66 <br> {{ $statement->account_card_number }} <br> {{ $statement->toDate }}
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                </tr>
        
                <tr>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="25%" style="padding:0px;" align="left">
        
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <strong>______ ______</strong>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <h2> Account <br>Statement</h2>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                </tr>
        
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="left">
                    <img width="120" height="100" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/sun-trust-bank.png'))) }}">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>
        
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="15%" style="padding:0px;" align="left">
                </td>
               
                <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                    <span>{{ $statement->business_name }} <br />{{ $statement->full_name }}</span><br />
                    <span>{{ $statement->address }} </span><br />
                    <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Questions? Please call <br> 1-800-786-8787
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>
            <div style="border-top:2px solid #000;padding:10px 0px;margin-top:10px">
                <strong>Transaction History</strong>
            </div>
        
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <th width="5%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                        Date
                    </th>
                    <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                        Check #
                    </th>
                    <th width="52%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                        Transaction Description Details
                    </th>
                    <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                        Deposits/ <br> Credits
                    </th>
                    <th width="13%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                        Withdrawals/ <br> Debits
                    </th>
                    <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                        Current <br>Balance
                    </th>
                </tr>
            </table>

            @foreach ($tranx2 as $key => $value)

            @if ($key % $normal_row_count == 0 && $key !== 0)
            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="">
        
                <tr>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="25%" style="padding:0px;" align="left">
                        SUNTRUST BANK <br>
                        PO BOX 305183 <br>
                        NASHVILLE TN 37230-5183
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <strong>______ ______</strong>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <br> 78/A15/8775/0/66 <br> {{ $statement->account_card_number }} <br> {{ $statement->toDate }}
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                </tr>
        
                <tr>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="25%" style="padding:0px;" align="left">
        
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <strong>______ ______</strong>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <h2> Account <br>Statement</h2>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                </tr>
        
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="left">
                    <img width="120" height="100" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/sun-trust-bank.png'))) }}">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>
        
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="15%" style="padding:0px;" align="left">
                </td>
               
                <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                    <span>{{ $statement->business_name }} <br />{{ $statement->full_name }}</span><br />
                    <span>{{ $statement->address }} </span><br />
                    <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Questions? Please call <br> 1-800-786-8787
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>
            <div style="border-top:2px solid #000;padding:10px 0px;margin-top:10px">
                <strong>Transaction History</strong>
            </div>
        
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <th width="5%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                        Date
                    </th>
                    <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                        Check #
                    </th>
                    <th width="52%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                        Transaction Description Details
                    </th>
                    <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                        Deposits/ <br> Credits
                    </th>
                    <th width="13%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                        Withdrawals/ <br> Debits
                    </th>
                    <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                        Current <br>Balance
                    </th>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
            <tr>
                <td width="5%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">

                </td>
                <td width="52%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">
                    {{ $value->description }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                </td>
                <td width="13%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    <?php echo ($key + 1) % 5 === 0 ? cal_bal_by_key($statement->opening_balance, $key + 1,
                    $transactions_ordinary,$statement->id) : ''; ?>
                </td>
            </tr>
        </table>
            @else
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
            <tr>
                <td width="5%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">

                </td>
                <td width="52%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="left">
                    {{ $value->description }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                </td>
                <td width="13%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                </td>
                <td width="10%"
                    style="padding:0px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'background-color:#eee;'; ?>border:2px solid #fff"
                    align="right">
                    <?php echo ($key + 1) % 5 === 0 ? cal_bal_by_key($statement->opening_balance, $key + 1,
                    $transactions_ordinary,$statement->id) : ''; ?>
                </td>
            </tr>
        </table>
            @endif
            @endforeach

   @endif             

           <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <tr>
                    <th width="5%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">
                         {{ date_format(date_create($statement->toDate), 'm/d') }}
                    </th>
                    <td width="10%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">

                    </td>
                    <th width="52%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">
                        Ending Balance
                    </th>
                    <td width="10%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">

                    </td>
                    <td width="13%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">

                    </td>
                    <th width="10%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">
                        {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
                    </th>
                </tr>
    </table>










    {{-- page break --}}

    <div class="page-break"></div>



    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="">

        <tr>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="25%" style="padding:0px;" align="left">
                SUNTRUST BANK <br>
                PO BOX 305183 <br>
                NASHVILLE TN 37230-5183
            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <strong>______ ______</strong>
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <br> 78/A15/8775/0/66 <br> {{ $statement->account_card_number }} <br> {{ $statement->toDate }}
            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
        </tr>

        <tr>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="25%" style="padding:0px;" align="left">

            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <strong>______ ______</strong>
            </td>
            <td width="15%" style="padding:0px;" align="left">
                <h2> Account <br>Statement</h2>
            </td>
            <td width="15%" style="padding:0px;" align="left">
            </td>
        </tr>

    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
        <td width="10%" style="padding:0px;" align="left">
        </td>
        <td width="20%" style="padding:0px;" align="left">
            <img width="120" height="100" style="margin:0;padding:0"
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/sun-trust-bank.png'))) }}">
        </td>
        <td width="25%" style="padding:0px;" align="left">
        </td>
        <td width="15%" style="padding:0px;" align="left">
        </td>
        <td width="15%" style="padding:0px;" align="left">
        </td>
        <td width="15%" style="padding:0px;" align="left">
        </td>
        </tr>
    </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="15%" style="padding:0px;" align="left">
                </td>
               
                <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                    <span>{{ $statement->business_name }} <br />{{ $statement->full_name }}</span><br />
                    <span>{{ $statement->address }} </span><br />
                    <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Questions? Please call <br> 1-800-786-8787
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>








    <div style="border-top:2px solid #000;padding:10px 0px;margin-top:10px">
        <strong>Transaction History</strong>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">

        <tr>
            <th width="5%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                Date
            </th>
            <th width="10%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                Check #
            </th>
            <th width="40%" style="padding:0px;border-bottom:2px solid #000;" align="left">
                Transaction Description Details
            </th>
            <th width="15%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                Deposits/ <br> Credits
            </th>
            <th width="15%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                Withdrawals/ <br> Debits
            </th>
            <th width="15%" style="padding:0px;border-bottom:2px solid #000;" align="right">
                Current <br>Balance
            </th>
        </tr>

        <tr>
            <td width="5%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">
                {{ date_format(date_create($statement->toDate), 'm/d') }}
            </td>
            <td width="10%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">

            </td>
            <th width="40%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="left">
                Credit and Debit Totals
            </th>
            <td width="15%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">
                {{ $currency . '' . number_format($calculation['credit_and_bal'], 2) }}
            </td>
            <td width="15%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">
                {{ $currency . '' . number_format($calculation['debit'], 2) }}
            </td>
            <td width="15%" style="padding:0px;background-color:#eee;border:2px solid #fff" align="right">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </td>

        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px">

        <tr>
            <td width="10%" style="padding:5px 0px; border-top:2px solid #000" align="left">
                <strong>Balance Activity History</strong>
            </td>
            <td width="20%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="left">
                <strong>Date</strong>
            </td>
            <td width="30%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="left">
                <strong>Balance</strong>
            </td>
            <td width="40%" style="padding:10px 0px;border-top:2px solid #000" align="left">
            </td>
        </tr>

    </table>




  
        @foreach ($tranHistory as $key => $value)
             @if ($key % 33 == 0 && $key !== 0)

    
    {{-- page break --}}

    <div class="page-break"></div>



    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize" style="">
                <tr>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="25%" style="padding:0px;" align="left">
                        SUNTRUST BANK <br>
                        PO BOX 305183 <br>
                        NASHVILLE TN 37230-5183
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <strong>______ ______</strong>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <br> 78/A15/8775/0/66 <br> {{ $statement->account_card_number }} <br> {{ $statement->toDate }}
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                </tr>
                <tr>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="25%" style="padding:0px;" align="left">

                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <strong>______ ______</strong>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                        <h2> Account <br>Statement</h2>
                    </td>
                    <td width="15%" style="padding:0px;" align="left">
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="10%" style="padding:0px;" align="left">
                </td>
                <td width="20%" style="padding:0px;" align="left">
                    <img width="120" height="100" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/sun-trust-bank.png'))) }}">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                <td width="15%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="smsize">
                <td width="15%" style="padding:0px;" align="left">
                </td>
               
                <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                    <span>{{ $statement->business_name }} <br />{{ $statement->full_name }}</span><br />
                    <span>{{ $statement->address }} </span><br />
                    <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                <td width="25%" style="padding:0px;" align="left">
                    Questions? Please call <br> 1-800-786-8787
                </td>
                <td width="5%" style="padding:0px;" align="left">
                </td>
                </tr>
            </table>
             
    
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px">

        <tr>
            <td width="10%" style="padding:5px 0px; border-top:2px solid #000" align="left">
                <strong>Balance Activity History</strong>
            </td>
            <td width="20%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="left">
                <strong>Date</strong>
            </td>
            <td width="30%" class="smsize" style="padding:10px 0px;border-top:2px solid #000" align="left">
                <strong>Balance</strong>
            </td>
            <td width="40%" style="padding:10px 0px;border-top:2px solid #000" align="left">
            </td>
        </tr>

    </table>

             @else


        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:0px">

            <tr >
                <td width="5%" align="left">
                </td>
                <td width="5%" class="smsize" align="left">
                </td>
                <td width="20%" class="smsize" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="30%" class="smsize" align="left">
                    {{cal_bal_by_key($statement->opening_balance, $key + 1, $transactions_ordinary,$statement->id) }}
                </td>
                <td width="40%" align="left">
                </td>
            </tr>
        </table>
            @endif
        @endforeach

 

    <div class="smsize"
        style="border-top:2px solid #000; border-bottom:2px solid #000; text-align:center;padding:10px;margin-top:10px">
        Paying for college? Know your options. <br>
        In addition to private student loans, SunTrust offers tools & resources to help you plan for college costs.
        <br>
        Visit suntrust.com/studentloans to learn more.
    </div>

    <div class="smsize" style="border-radius:10px;text-align:center;padding:10px;margin-top:10px">
        Activate SunTrust Deals! <br>
        You can earn up to 10% cash back when you shop with your SunTrust debit or credit card at select retailers.
        <br>
        Clients must be enrolled in Online or Mobile Banking to participate. <br>
        Log in, activate deals, shop and get cash back.SunTrust Deals is separate from SunTrust Rewards.
    </div>


    <script type="text/php">
        if (isset($pdf)) {
        $x = 402;
        $y = 36;
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
