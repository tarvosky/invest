<?php
use App\Models\Transaction;
$fees = number_format(rand(10, 90), 2);
$rand1 = rand(10000, 300000);
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
$rowCount = 31;
$rowCount2 = 35;
$tranx1 = Transaction::where('statement_id', $statement->id)
->orderBy('id', 'DESC')
->skip(0)
->take($rowCount)
->get();

$tranx2 = Transaction::where('statement_id', $statement->id)
->orderBy('id', 'DESC')
->skip($rowCount)
->take(100000)
->get();


$transactions_count = count($transactions);
$tranx2_count = count($tranx2);


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
    <title>{{ $bank->name }}</title>
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





    <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
        <tr>
            <td width="50%">
                <small>Primary Account: {{ $statement->account_card_number }}</small><br />
                <small> Beginning {{ date('F d Y', strtotime($statement->fromDate)) }} - Ending
                    {{ date('F d Y', strtotime($statement->toDate)) }}</small> <br />

            </td>
            <td width="25%"> </td>
            <td style="padding:0px;" align="left"> <img   height="60" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/customize/'.$statement->logo))) }}">
            </td>
        </tr>
        <tr>
            <td width="50%"> </td>
            <td width="25%"> </td>
            <td style="padding:0px;" align="left"> 
               <strong> {{ $statement->bank_name}}</strong>
            </td>
        </tr>

    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0">

        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="50%" style="padding:0px;text-transform: uppercase;padding:20px" align="left">
                <span>{{ $statement->full_name }}</span><br />
                <span>{{ $statement->address }}</span><br />
                <span>{{ $statement->city }},{{ $statement->state }} {{ $statement->zip }}</span>
            </td>
            <td width="45%" style="padding:0px;" align="right">
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">

        <tr>
            <td width="60%" style="padding:0px;" align="left">
            </td>
            <td width="40%" style="padding:0px;padding:50px;text-transform: capitalize;" align="left">

                <h2>Contacting Us</h2>
                <small>Available by phone 24/7 </small><br />
                <small>Phone: {{ $statement->bank_phone}}</small><br />
                <small  style="text-transform:lowercase">Online: {{ $statement->bank_website}}</small><br />
                <small style="text-transform:capitalize">Write: {{ $statement->bank_name}} </small><br />
                <small>Customer Service</small><br />
                <small> {{ $statement->bank_address}},</small><br />
                <small> {{ $statement->bank_city}}, {{ $statement->bank_state}} {{ $statement->bank_zip}}.</small><br />


            </td>

        </tr>
    </table>



    <table width="100%" cellspacing="" cellpadding="0" border="0">

        <tr>
            <td width="60%" style="padding:0px;" align="left">
                <h2>Summary of Accounts</h2>
                <h3 style="font-weight: bolder">Deposit Accounts/ Other Products</h3>
            </td>
        </tr>
    </table>





    <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">

        <tr>
            <td style="border-bottom: 1px solid #666;" width="" style="padding:0px;"><small>Account</small></td>
            <td style="border-bottom: 1px solid #666;" width="" style="padding:0px;"><small>Account number</small></td>
            <td style="border-bottom: 1px solid #666;" width="" style="padding:0px;"><small> Ending balance
                    <br>last statement</small></td>
            <td style="border-bottom: 1px solid #666;" width="" style="padding:0px;"><small> Ending balance <br>this
                    statement</small></td>
        </tr>
        <tr>
            <td width="" style="border-bottom: 1px solid #666; padding:0px;"><small>FREE CHECKING</small></td>
            <td width="" style="border-bottom: 1px solid #666; padding:0px;"><small>
                    {{ $statement->account_card_number }}</small></td>
            <td width="" style="border-bottom: 1px solid #666; padding:0px;"><small>
                    {{ $currency }}{{ number_format($statement->opening_balance, 2) }}</small></td>
            <td width="" style="border-bottom: 1px solid #666; padding:0px;"><small>
                {{ $currency }}{{ number_format($calculation['credit_and_bal'], 2) }} </small></td>
        </tr>
        <tr>
            <td width="" style=" border-bottom: 1px solid #666;padding:0px;"><small><b>Total Deposit
                        Accounts</b></small></td>
            <td width="" style=" border-bottom: 1px solid #666;padding:0px;"><small> </small></td>
            <td width="" style=" border-bottom: 1px solid #666;padding:0px;"><small> </small></td>
            <td width="" style=" border-bottom: 1px solid #666;padding:0px;"><small>
                    <b>{{ $currency }}{{ number_format($calculation['total'], 2) }}</b></small></td>
        </tr>
    </table>

    <div>
        <p class="mdsize">What are you saving for? We can help! Start the new year with a plan that includes one of our
            great savings
            options.</p>
    </div>

    {{-- page break --}}

    <div class="page-break"></div>
    <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
        <tr>
            <td width="50%">
                <small>Primary Account: {{ $statement->account_card_number }}</small><br />
                <small> Beginning {{ date('F d Y', strtotime($statement->fromDate)) }} - Ending
                    {{ date('F d Y', strtotime($statement->toDate)) }}</small> <br />

            </td>
            <td width="25%"> </td>
            <td style="padding:0px;" align="left"> <img   height="60" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/customize/'.$statement->logo))) }}">
            </td>
        </tr>
        <tr>
            <td width="50%"> </td>
            <td width="25%"> </td>
            <td style="padding:0px;" align="left"> 
                {{ $statement->bank_name}}
            </td>
        </tr>

    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0">
        <tr>
            <td width="50%" style="padding-top:40px; text-transform: uppercase;" align="left">
                <span class="bigheading">FREE CHECKING</span><br>
                <span class="smsize">Account Number: {{ $statement->account_card_number }} -
                    {{ $statement->full_name }}</span>

            </td>
            <td width="50%" style="padding-top:40px" align="right">
            </td>
        </tr>

        <tr>
            <td width="50%" style="padding:0px;" align="left">

                <table style="margin-top:20px" class="smsize" width="100%" cellspacing="" cellpadding="0" border="0">
                    <tr>
                        <th style="border-bottom: 2px solid #666;" width="20%" style="paddingtop:0px;" align="left">
                            <span>Activity Summary </span>
                        </th>
                        <td style="border-bottom: 2px solid #666;" width="50%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding-top:2px;padding-bottom:2px;">
                            <small>Beginning Balance on {{ $statement->fromDate }} </small>
                        </td>
                        <td width="50%" style="padding-top:2px;padding-bottom:2px;">
                            <small> {{ $currency }}{{ number_format($statement->opening_balance,2) }}</small>
                        </td>
                    </tr>

                    <tr>
                        <td width="50%" style="padding-top:2px;padding-bottom:2px;">
                            <small>Deposits/Credits </small>
                        </td>
                        <td width="30%" style="padding-top:2px;padding-bottom:2px;">
                            <small> + {{ $currency }}{{ number_format($calculation['credit'], 2) }}</small>
                        </td>
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #666;" width="50%"
                            style="padding-top:2px;padding-bottom:2px;">
                            <small>Withdrawals/Debits</small>
                        </td>
                        <td style="border-bottom: 1px solid #666;" width="30%"
                            style="padding-top:2px;padding-bottom:2px;">
                            <small> - {{ $currency }}{{ number_format($calculation['debit'], 2) }}</small>
                        </td>
                    </tr>
                    <tr>
                        <th width="50%" style="padding:0px;" align="left">
                            <small>Ending Balance on {{ $statement->toDate }}</small>
                        </th>
                        <td width="30%" style="padding:0px;">
                            <small> {{ $currency }}{{ number_format($calculation['total_bal'], 2) }}</small>
                            </th>
                    </tr>

                </table>




            </td>
            <td width="50%" style="padding:0px;" align="right">
            </td>
        </tr>

    </table>

    <div style="padding-top: 50px;padding-bottom: 10px">
        <hr>
        <span><strong>Transaction History</strong></span>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">

        <tr>
            <th width="10%" align="left" style="border-bottom: 2px solid #666; padding:0px;">
                Date
            </th>
            <th width="10%" align="left" style="border-bottom: 2px solid #666; padding:0px;">
                Check #
            </th>
            <th width="40%" align="left" style="border-bottom: 2px solid #666; padding:0px;">
                Transaction Description Details
            </th>
            <th width="12%" align="left" style="border-bottom: 2px solid #666; padding:0px;">
                Deposits/<br> Credits
            </th>
            <th width="12%" align="left" style="border-bottom: 2px solid #666; padding:0px;">
                Withdrawals/<br> Debits
            </th>
            <th width="11%" align="left" style="border-bottom: 2px solid #666; padding:0px;">
                Current Balance
            </th>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td style="padding:2px" width="10%">
                {{ $statement->fromDate }}
            </td>
            <td width=" 10%">

            </td>
            <td style="padding:2px" width=" 40%">
                Beginning Balance
            </td>
            <td width=" 12%">

            </td>
            <td width=" 12%">

            </td>
            <td style="padding:2px" width=" 11%">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </td>
        </tr>
    </table>
    @foreach ($tranx1 as $key => $value)

        @if ($key % $rowCount == 0 && $key !== 0)

            {{-- page break --}}

            <div class="page-break"></div>
            <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="50%">
                        <small>Primary Account: {{ $statement->account_card_number }}</small><br />
                        <small> Beginning {{ date('F d Y', strtotime($statement->fromDate)) }} - Ending
                            {{ date('F d Y', strtotime($statement->toDate)) }}</small> <br />
        
                    </td>
                    <td width="25%"> </td>
                    <td style="padding:0px;" align="left"> <img   height="60" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/customize/'.$statement->logo))) }}">
                    </td>
                </tr>
                <tr>
                    <td width="50%"> </td>
                    <td width="25%"> </td>
                    <td style="padding:0px;" align="left"> 
                        {{ $statement->bank_name}}
                    </td>
                </tr>
        
            </table>
            <div style="padding-top: 50px;padding-bottom: 10px">
                <hr>
                <span><strong>Transaction History</strong></span>
            </div>
            {{-- page break --}}
        @else
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width=" 10%"
                        style="padding:2px;border:2px solid #fff;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>">
                        {{ $value->theDate }}
                    </td>
                    <td width="10%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">

                    </td>
                    <td width="40%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">
                        {{ $value->description }}
                    </td>
                    <td width="12%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">
                        {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                    <td width="12%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">
                        {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                    </td>
                    <td width="11%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">


                         <?php echo ($key + 1) % 4 != 0 ?  $currency ."". cal_bal_by_key($statement->opening_balance, $key +
                        1, $transactions_ordinary) : ''; ?>
                    </td>
                </tr>
            </table>
        @endif
    @endforeach

{{-- ///////////////////  br before secon check starts--}}
 {{-- page break --}}
            @if($tranx2_count > 0)
            <div class="page-break"></div>
            <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="50%">
                        <small>Primary Account: {{ $statement->account_card_number }}</small><br />
                        <small> Beginning {{ date('F d Y', strtotime($statement->fromDate)) }} - Ending
                            {{ date('F d Y', strtotime($statement->toDate)) }}</small> <br />
        
                    </td>
                    <td width="25%"> </td>
                    <td style="padding:0px;" align="left"> <img   height="60" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/customize/'.$statement->logo))) }}">
                    </td>
                </tr>
                <tr>
                    <td width="50%"> </td>
                    <td width="25%"> </td>
                    <td style="padding:0px;" align="left"> 
                        {{ $statement->bank_name}}
                    </td>
                </tr>
        
            </table>
            <div style="padding-top: 50px;padding-bottom: 10px">
                <hr>
                <span><strong>Transaction History</strong></span>
            </div>
           

    @foreach ($tranx2 as $key => $value)

        @if ($key % $rowCount2  == 0 && $key !== 0)

            {{-- page break --}}

            <div class="page-break"></div>
            <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
                <tr>
                    <td width="50%">
                        <small>Primary Account: {{ $statement->account_card_number }}</small><br />
                        <small> Beginning {{ date('F d Y', strtotime($statement->fromDate)) }} - Ending
                            {{ date('F d Y', strtotime($statement->toDate)) }}</small> <br />
        
                    </td>
                    <td width="25%"> </td>
                    <td style="padding:0px;" align="left"> <img   height="60" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/customize/'.$statement->logo))) }}">
                    </td>
                </tr>
                <tr>
                    <td width="50%"> </td>
                    <td width="25%"> </td>
                    <td style="padding:0px;" align="left"> 
                        {{ $statement->bank_name}}
                    </td>
                </tr>
        
            </table>
            <div style="padding-top: 50px;padding-bottom: 10px">
                <hr>
                <span><strong>Transaction History</strong></span>
            </div>
            {{-- page break --}}
        @else
        
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width=" 10%"
                        style="padding:2px;border:2px solid #fff;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>">
                        {{ $value->theDate }}
                    </td>
                    <td width="10%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">

                    </td>
                    <td width="40%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">
                        {{ $value->description }}
                    </td>
                    <td width="12%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">
                        {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                    <td width="12%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">
                        {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                    </td>
                    <td width="11%"
                        style="padding:2px;<?php echo ($key + 1) % 2 != 0 ? 'background-color:#ccc;' : 'even'; ?>;border:2px solid #fff">


                       <?php echo ($key + 1) % 4 != 0 ?  $currency ."". cal_bal_by_key($statement->opening_balance, $key +
                        1, $transactions_ordinary) : ''; ?>
                    </td>
                </tr>
            </table>
        @endif
    @endforeach
 @endif















    <table width="100%" style="margin:30px 0px" cellspacing="" cellpadding="0" border="0" class="sssize">

        <tr>
            <td width="20%" style=" border-bottom:1px solid #ccc">
                Ending Balance on {{ $statement->toDate }}
            </td>
            <td width=" 40%" style=" border-bottom:1px solid #ccc">


            </td>
            <td width=" 12%" style=" border-bottom:1px solid #ccc">

            </td>
            <td width=" 12%" style="border-bottom:1px solid #ccc">

            </td>
            <th width=" 11%" align="left" style="border-bottom:1px solid #ccc;padding:2px">
                {{ $currency }}{{ number_format($calculation['total_bal'], 2) }}
            </th>
        </tr>

        <tr>
            <th width="20%">
                Totals
            </th>
            <th width=" 40%">

            </th>
            <th style="padding:2px;"align="left" width=" 12%">
                {{ $currency }}{{ number_format($calculation['credit'], 2) }}
            </th>
            <th style="padding:2px;" align="left" width=" 12%">
                {{ $currency }}{{ number_format($calculation['debit'], 2) }}
            </th>
            <th width=" 11%">

            </th>
        </tr>
    </table>




    <div style="padding: 20px; border:1px solid #666">
        <table width="100%" cellspacing="" cellpadding="0" border="0" class="sssize">
            <tr>
                <td width="70%" style="padding:0px;border-bottom:2px solid #666">
                    <strong>Periodic Non-sufficient Funds and Overdraft Charge Summary</strong>
                </td>
                <td width="15%" style="padding:0px;border-bottom:2px solid #666">

                </td>
                <td width="15%" style="padding:0px;border-bottom:2px solid #666">

                </td>
            </tr>
            <tr>
                <td width="70%" style="padding:0px;">
                </td>
                <td width="15%" style="padding:0px;">
                    Total this Period
                </td>
                <td width="15%" style="padding:0px;">
                    Total this Period
                </td>
            </tr>

            <tr>
                <td width="70%" style="padding:0px;">
                    Total overdraft (OD) fees (includes NSF-paid item charges and extended OD charges)
                </td>
                <td width="15%" style="padding:0px;">
                    {{ $currency }}0.00
                </td>
                <td width="15%" style="padding:0px;">
                    {{ $currency }}0.00
                </td>
            </tr>

            <tr>
                <td width="70%" style="padding:0px;">
                    NSF-returned item charges
                </td>
                <td width="15%" style="padding:0px;">
                    {{ $currency }}0.00
                </td>
                <td width="15%" style="padding:0px;">
                    {{ $currency }}0.00
                </td>
            </tr>
        </table>
    </div>






    {{-- page break --}}

    <div class="page-break"></div>
    <table width="100%" cellspacing="" cellpadding="0" border="0" class="smsize">
        <tr>
            <td width="50%">
                <small>Primary Account: {{ $statement->account_card_number }}</small><br />
                <small> Beginning {{ date('F d Y', strtotime($statement->fromDate)) }} - Ending
                    {{ date('F d Y', strtotime($statement->toDate)) }}</small> <br />

            </td>
            <td width="25%"> </td>
            <td style="padding:0px;" align="left"> <img   height="60" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/customize/'.$statement->logo))) }}">
            </td>
        </tr>
        <tr>
            <td width="50%"> </td>
            <td width="25%"> </td>
            <td style="padding:0px;" align="left"> 
                {{ $statement->bank_name}}
            </td>
        </tr>

    </table>


    <table width="100%" class="sssize" cellspacing="0" cellpadding="0" border="0" style="margin-top:50px" class="table">

        <tr>
            <td width="40%" style="padding-right:10px;" align="left">
                <h3>How to Balance Your Account</h3>
                <table width="100%" style="padding:0px;">
                    <tr>
                        <th width="20%">Step 1</th>
                        <td>
                            <li>Enter all checks, deposits, and other automated teller card (ATM) transactions in your
                                register.</li>
                            <li>Record all automated deductions, debit card transactions and electronic bill payments.
                            </li>
                            <li>Record and deduct service charges, check printing charges, or other bank fees</li>
                            <li>If you have an interest bearing account, add any interest earned shown on this
                                statement.</li>
                        </td>
                    </tr>
                    <tr>
                        <th>Step 2</th>
                        <td>
                            <li>If applicable, sort checks in numerical order and mark in your register each check or
                                other transaction that is listed on this statement.</li>
                        </td>
                    </tr>
                    <tr>
                        <th>Step 3</th>
                        <td>
                            <li>List any deposits or credits your have made that do not appear on this statement (see
                                space provided below).</li>
                        </td>
                    </tr>
                    <tr>
                        <th>Step 4</th>
                        <td>
                            <li>List any checks you have written, debit card transactions, electronic payments and other
                                deductions that do not appear on this statement (see space provided below).</li>
                        </td>
                    </tr>
                </table>




                <table width="100%" border="1" cellspacing="" cellpadding="0" style="margin-top:20px">

                    <tr>
                        <td width="50%" style="padding:0px;">
                            Date/Description
                        </td>
                        <td width="50%" style="padding:0px;">
                            Amount
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="50%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="50%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="50%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="50%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="50%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;" align="left">
                            Step 3 Total
                        </td>
                        <td width="50%" style="padding:0px;">
                            {{ $currency }}
                        </td>
                    </tr>
                </table>

                <table width="100%" border="1" cellspacing="" cellpadding="0" style="margin-top:20px">

                    <tr>
                        <td width="40%" style="padding:0px;">
                            Date/Description
                        </td>
                        <td width="20%" style="padding:0px;">
                            Check #
                        </td>
                        <td width="40%" style="padding:0px;">
                            Amount
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:0px;">
                            <span>&nbsp;</span>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="padding:0px;">
                        </td>
                        <td width="20%" style="padding:0px;">
                            Step 4 Total
                        </td>
                        <td width="40%" style="padding:0px;">
                            {{ $currency }}
                        </td>
                    </tr>
                </table>

                <h3>Balancing Your Register to this Statement</h3>

                <table width="100%" border="1" cellspacing="" cellpadding="0" style="margin-top:20px">

                    <tr>
                        <th width="20%" style="padding:0px;">
                            Step 5
                        </th>
                        <td width="40%" style="padding:0px;">
                            <li>Enter the "current balance" shown on this statement</li>
                        </td>
                        <td width="20%" style="padding:0px;">

                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                            <li> Subtotal</li>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                            <li>Subtract total from Step 4</li>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                            <li>This balance should equal your register balance</li>
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;">
                        </td>
                        <td width="40%" style="padding:0px;">
                            If it does not agree, see steps below $
                        </td>
                        <td width="20%" style="padding:0px;">
                        </td>
                    </tr>
                </table>
                <div class="sssize" style="margin-top: 20px;padding-bottom:100px">
                    If your account does not balance, review the following:
                    <li>Check all your addition and subtraction above in your register.</li>
                    <li>Make sure you remembered to subtract service charges listed on
                        this statement and add any interest earned to your register.</li>
                    <li>Amounts of deposits and withdrawals on this statement should
                        match your register entries</li>
                    <li>If you have questions or need assistance, please refer to the phone
                        number on the front of this statement</li>
                </div>









            </td>


            {{-- second side --}}
            <td width="50%" style="padding-left:10px;border-left: 1px solid #666;padding-top:0px;">
                <h3>Change of Address</h3>
                <p>Please call us at the telephone number listed on the front of this statement to tell us about a
                    change of address.</p>

                <h3>Electronic Transfers (for consumer accounts only)</h3>
                <p>In case of errors or questions about your Electronic Transfers, write to {{ strtoupper($statement->bank_name) }} , Operations Compliance
                    Support,  <span style="text-transform:capitalize;"> {{ $statement->bank_address}}, {{ $statement->bank_city}}, {{ $statement->bank_state}} {{ $statement->bank_zip}}</span>. Or simply call your local customer service number
                    printed on the front of this statement. Call or write as soon as you can, if you think your
                    statement or receipt is wrong or if you need more information about a transfer on the statement or
                    receipt. We must hear from you no later than 60 days after we sent the first statement on which the
                    error or problem appeared.
                    .</p>
                <li>Tell us your name and account number (if any)</li>
                <li>Describe the error or the transfer you are unsure about,and explain as clearly as you can why you
                    believe it is an error or why you need more information.</li>
                <li>Tell us the dollar amount of the suspected error</li>
                <p>We will investigate your complaint and will correct any error promptly. If we take more than 10
                    business days (20 on claims on accounts opened less than 30 calendar days) to do this, we will
                    credit your account for the amount you think is in error, so that you will have the use of the money
                    during the time it takes us to complete our investigation.

                </p>
                <p><i>*For Non-Consumer Account customers, please refer to your current Non-Consumer Account Agreement
                        for details regarding Electronic Fund Transfers.</i></p>

                <h3>Overdraft Protection</h3>
                <h3>Calculation of Interest Charge and Balance Subject to Interest Rate.</h3>
                <p>he interest charge is computed using your annual percentage rate divided by 365 or,
                    in the case of a leap year, 366, which gives you the “Applicable Rate.” Although
                    we calculate the interest charge by applying the Applicable Rate to each daily
                    balance, the interest charge can also be calculated by multiplying the Applicable
                    Rate by the “average daily balance”(Balance Subject to Interest Rate) shown
                    on this statement, then multiplying that sum by the number of days in the billing cycle.
                    To get the “Balance Subject to Interest Rate” shown on this statement
                    we take the beginning balance of your account less any unpaid finance
                    charges each day, add any new advances or debits, and subtract any payments or credits.
                    This gives us the daily balance. Then we add all the daily balances for
                    the billing cycle and divide by the number of days in the billing cycle.
                    This give us the “average daily balance” shown on the statement as
                    “Balance Subject to Interest Rate”. Payments. Payments to your overdraft
                    protection loan account made through our tellers or deposited at our
                    automated teller machines (ATM s) Monday through Friday before the
                    posted cut-off time will be posted to your account on the date they are accepted.
                    Otherwise, they will be posted on the next business day.
                    Payments made through our ATM s via a funds transfer will be posted
                    on the date they are received or on the next business day if made
                    after 6pm CT (6pm MT for Arizona accounts and 6pm PT for California
                    accounts) Monday through Friday or anytime Saturday, Sunday or bank holidays.
                    {{ strtoupper($statement->bank_name) }}  business days are Monday through Friday, excluding holidays.</p>

                <h3>In Case of Errors or Questions About Your Statement (Overdraft Protection Only).</h3>
                <p>If you think your statement is wrong, or if you need more information about a transaction on your
                    statement, write your issue on a separate document and send it to Bankcard Center,  <span style="text-transform:capitalize;"> {{ $statement->bank_address}}, {{ $statement->bank_city}}, {{ $statement->bank_state}} {{ $statement->bank_zip}}</span>. Telephone inquires may be made by calling your local {{ strtoupper($statement->bank_name) }}  branch listed on
                    the front of this statement to speak with a Customer Service Representative. Please note: a
                    telephone inquiry will not preserve your rights under federal law. We must hear from you no later
                    than sixty (60) days after we sent you the first statement on which the error or problem appeared.
                </p>
                <p style="padding-top:10px">
                    {{ strtoupper($statement->bank_name) }}  and {{ strtoupper($statement->bank_name) }}  Compass are trade names of {{ strtoupper($statement->bank_name) }}  USA, a member of the {{ strtoupper($statement->bank_name) }}  Group. {{ strtoupper($statement->bank_name) }}  USA, Member
                    FDIC.
                </p>

            </td>
        </tr>
    </table>

    <script type="text/php">
        if (isset($pdf)) {
            $x = 35;
            $y = 37;
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
