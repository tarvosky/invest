<?php
$fees = number_format(rand(10, 90), 2);
$rand = rand(999, 1000);
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

$my_number = 14;
$trans = $transactions
->skip(0)
->take($my_number)
->get();
$tranz = $transactions
->skip($my_number)
->take(1000)
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

        .smsize {
            font-size: 10px;
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


    <div style=" position: absolute;left:705px;top:100px;z-index:-1">
        <img width="40" height="130" style="margin:0;padding:0"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase/barcode.png'))) }}"><br>
    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="50%" class="smsize" style="padding:0px;" align="left">
                <img width="120" height="25" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase.png'))) }}"><br>
                JPMorgan Chase Bank, N.A. <br>P O Box 182051 <br>
                Columbus, OH 43218 - 2051


                <div class="sssize" style="margin-top: 30px;text-transform:uppercase">
                    <small class="smsize" >{{ $statement->routing_number }} DRE 021 219 35420 NNNNNNNNNNN 1 000000000 14 {{$rand}}</small><br>
                    <span style="text-transform: capitalize"> {{ $statement->business_name }} <br> {{ $statement->full_name }}</span><br>
                    <span > 
                    {{ $statement->address }}<br>
                        {{ $statement->city }} {{ $statement->state }}, {{ $statement->zip }}
                    </span>
                </div>
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td width="30%" class="smsize" style="padding:0px;" align="right">
                {{ date('F d, Y', strtotime($statement->fromDate)) }} through
                {{ date('F d, Y', strtotime($statement->toDate)) }} <br>Account Number:
                <strong> {{ $statement->account_card_number }}</strong>


                <div style="margin-top:15px;border-bottom: 2px solid #000;border-top: 2px solid #000;height:14px">
                    CUSTOMER SERVICE INFORMATION
                </div>

                <table class="smsize" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:2px">
                    <tr>
                        <td width="60%" style="padding:0px;" align="left">
                            Web site:
                        </td>
                        <th width="40%" style="padding:0px;" align="right">
                            Chase.com
                        </th>
                    </tr>
                    <tr>
                        <td width="60%" style="padding:0px;" align="left">
                            Service Center:
                        </td>
                        <th width="40%" style="padding:0px;" align="right">
                            1-800-935-9935
                        </th>
                    </tr>
                    <tr>
                        <td width="60%" style="padding:0px;" align="left">
                            Deaf and Hard of Hearing
                        </td>
                        <td width="40%" style="padding:0px;" align="right">
                            1-800-242-7383
                        </td>
                    </tr>
                    <tr>
                        <td width="60%" style="padding:0px;" align="left">
                            Para Espanol:
                        </td>
                        <td width="40%" style="padding:0px;" align="right">
                            1-877-312-4273
                        </td>
                    </tr>
                    <tr>
                        <td width="60%" style="padding:0px;" align="left">
                            International Calls:
                        </td>
                        <td width="40%" style="padding:0px;" align="right">
                            1-713-262-1679
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>




    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:150px">
        <tr>
            <td width="25%" style="padding:1px;border:1px solid #000" align="left">
                <strong>CHECKING SUMMARY</strong>
            </td>
            <td class="sssize" width="75%" style="padding-left:4px;border-bottom:1px solid #000" align="left">
                Chase Premier Plus Checking
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="40%" style="padding:0px;" align="left">
            </td>
            <th width="40%" style="padding:0px;" align="right">
                AMOUNT
            </th>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <th width="40%" style="padding:0px;" align="left">
                Beginning Balance
            </th>
            <th width="40%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </th>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                Deposits and Additions
            </td>
            <td width="40%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($calculation['credit'], 2) }}
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                ATM & Debit Card Withdrawals
            </td>
            <td width="40%" style="padding:0px;" align="right">
                - {{ $currency . '' . number_format($calculation['debit'], 2) }}
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <th width="40%" style="padding:0px;" align="left">
                Ending Balance
            </th>
            <th width="40%" style="padding:0px;border-top:1px solid #000" align="right">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </th>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                <p>&nbsp;</p>
            </td>
            <td width="40%" style="padding:0px;" align="right">

            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                Annual Percentage Yield Earned This Period
            </td>
            <td width="40%" style="padding:0px;" align="right">
                0.00%
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="40%" style="padding:0px;border-bottom:1px solid #000" align="left">
                interest Paid Year-to-Date
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #000" align="right">
                $0.00
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>

    <div class="sssize" style="margin-top:20px">
        Thank you for your military service and commitment to our country. Your monthly service fee was waived as a
        benefit of
        Chase Military Banking.
    </div>





    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:50px">
        <tr>
            <td width="26%" style="padding:1px;border:1px solid #000" align="left">
                <strong>TRANSACTION DETAIL</strong>
            </td>
            <td class="sssize" width="74%" style="padding-left:4px;border-bottom:1px solid #000" align="left">

            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="10%" style="padding:0px;" align="left">
                DATE
            </td>
            <th width="50%" style="padding:0px;" align="left">
                DESCRIPTION
            </th>
            <th width="20%" style="padding:0px;" align="left">
                AMOUNT
            </th>
            <th width="20%" style="padding:0px;" align='right'>
                BALANCE
            </th>
        </tr>
        <tr>
            <td width="10%" style="padding:0px;" align="left">
            </td>
            <th width="50%" style="padding:0px; border-bottom:1px solid #000" align="left">
                Beginning Balance
            </th>
            <td width="20%" style="padding:0px;border-bottom:1px solid #000" align="left">
            </td>
            <th width="20%" style="padding:0px;border-bottom:1px solid #000" align="right">
                {{ $currency . '' . number_format($statement->opening_balance, 2) }}
            </th>
        </tr>
    </table>

    @foreach ($trans as $key => $value)
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
            <tr>
                <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    {{ date_format(date_create($value->theDate), 'm/d') }}
                </td>
                <td width="50%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    {{ $value->description }}
                </td>
                <td width="20%" style="padding:0px;border-bottom:1px solid #000" align="left">
                    {{ $value->paidout == 0 ? '' : '-' . $currency . '' . number_format($value->paidout, 2) }}
                    <strong>{{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}</strong>
                </td>
                <td width="20%" style="padding:0px;border-bottom:1px solid #000" align="right">
                    <?php echo cal_bal_by_key($statement->opening_balance, $key + 1, $transactions_ordinary);
                    ?>
                </td>
            </tr>
        </table>
    @endforeach





    @if (count($tranz) > $my_number)
        {{-- page break --}}
        <div class="page-break"></div>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize" style="margin-bottom:50px">
            <tr>
                <td width="50%" class="smsize" style="padding:0px;" align="left">
                    <img width="120" height="25" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase.png'))) }}"><br>
                </td>
                <td width="20%" style="padding:0px;" align="left">
                </td>
                <td width="30%" class="smsize" style="padding:0px;" align="right">
                    {{ date('F d, Y', strtotime($statement->fromDate)) }} through
                    {{ date('F d, Y', strtotime($statement->toDate)) }} <br>Account Number:
                    <strong> {{ $statement->account_card_number }}</strong>
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:50px">
            <tr>
                <td width="26%" style="padding:1px;border:1px solid #000" align="left">
                    <strong>TRANSACTION DETAIL</strong>
                </td>
                <td class="sssize" width="74%" style="padding-left:4px;border-bottom:1px solid #000" align="left">
                    (continued)
                </td>
            </tr>
        </table>
    @endif




    @foreach ($tranz as $key => $value)
        @if ($key % 36 == 0 && $key !== 0)

            {{-- page break --}}

            <div class="page-break"></div>

            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
                <tr>
                    <td width="50%" class="smsize" style="padding:0px;" align="left">
                        <img width="120" height="25" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase.png'))) }}"><br>
                    </td>
                    <td width="20%" style="padding:0px;" align="left">
                    </td>
                    <td width="30%" class="smsize" style="padding:0px;" align="right">
                        {{ date('F d, Y', strtotime($statement->fromDate)) }} through
                        {{ date('F d, Y', strtotime($statement->toDate)) }} <br>Account Number:
                        <strong> {{ $statement->account_card_number }}</strong>
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:50px">
                <tr>
                    <td width="26%" style="padding:1px;border:1px solid #000" align="left">
                        <strong>TRANSACTION DETAIL</strong>
                    </td>
                    <td class="sssize" width="74%" style="padding-left:4px;border-bottom:1px solid #000" align="left">
                        (continued)
                    </td>
                </tr>
            </table>
        @else
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                <tr>
                    <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ date_format(date_create($value->theDate), 'm/d') }}
                    </td>
                    <td width="50%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="20%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ $value->paidout == 0 ? '' : '-' . $currency . '' . number_format($value->paidout, 2) }}
                        <strong>{{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}</strong>
                    </td>
                    <td width="20%" style="padding:0px;border-bottom:1px solid #000" align="right">
                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1,
                        $transactions_ordinary); ?>
                    </td>
                </tr>
            </table>
        @endif
    @endforeach



    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="10%" style="padding:0px;" align="left">
            </td>
            <th width="50%" style="padding:0px; " align="left">
                Ending Balance
            </th>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <th width="20%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </th>
        </tr>
    </table>



    {{-- page break --}}

    <div class="page-break"></div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="50%" class="smsize" style="padding:0px;" align="left">
                <img width="120" height="25" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase.png'))) }}"><br>
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td width="30%" class="smsize" style="padding:0px;" align="right">
                {{ date('F d, Y', strtotime($statement->fromDate)) }} through
                {{ date('F d, Y', strtotime($statement->toDate)) }} <br>Account Number:
                <strong> {{ $statement->account_card_number }}</strong>
            </td>
        </tr>
    </table>


    <div style=" position: absolute;left:705px;top:100px;z-index:-1">
        <img width="40" height="130" style="margin:0;padding:0"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase/barcode.png'))) }}"><br>
    </div>
    <div style="border-top:1px solid #000;border-bottom:1px solid #000;padding:10px 10px;margin-top:60px "
        class="sssize">
        <span>
            <strong>IN CASE OF ERRORS OR QUESTIONS ABOUT YOUR ELECTRONIC FUNDS TRANSFERS: </strong> Call us at
            1-866-564-2262 or write us at the address on the front of this statement (non-personal accounts contact
            Customer Service) immediately if you think your statement or receipt is incorrect or if you need more
            information about a transfer listed on the statement or receipt. <br>
        </span>
        <span>For personal accounts only: We must hear from you no later than 60 days after we sent you the FIRST
            statement on which the problem or error appeared. Be prepared to give us the following information:
            <br></span>
        <ul>
            <li>Your name and account number</li>
            <li>The dollar amount of the suspected error</li>
            <li>A description of the error or transfer you are unsure of, why you believe it is an error, or why you
                need more information.</li>
        </ul>
        <span>We will investigate your complaint and will correct any error promptly. If we take more than 10 business
            days (or 20 business days for new accounts) to do this, we will credit your account for the amount you think
            is in error so that you will have use of the money during the time it takes us to complete our
            investigation. <br></span>
        <span><strong>IN CASE OF ERRORS OR QUESTIONS ABOUT NON-ELECTRONIC TRANSACTIONS:</strong> Contact the bank
            immediately if your statement is incorrect or if you need more information about any non-electronic
            transactions (checks or deposits) on this statement. If any such error appears, you must notify the bank in
            writing no later than 30 days after the statement was made available to you. For more complete details, see
            the Account Rules and Regulations or other applicable account agreement that governs your account. Deposit
            products and services are offered by JPMorgan Chase Bank, N.A. Member FDIC</span>

        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="60%" style="padding:0px;" align="left">
                </td>
                <td width="5%" style="padding:0px;" align="left">
                    <img width="40" height="40" style="margin:0;padding:0"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase/house.png'))) }}">
                </td>
                <td width="35%" style="padding:0px;" align="left">
                    <strong>JPMorgan Chase Bank, N.A. Member FDIC</strong>
                </td>
            </tr>
        </table>
    </div>





    {{-- page break --}}

    <div class="page-break"></div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="50%" class="smsize" style="padding:0px;" align="left">
                <img width="120" height="25" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/chase.png'))) }}"><br>
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td width="30%" class="smsize" style="padding:0px;" align="right">
                {{ date('F d, Y', strtotime($statement->fromDate)) }} through
                {{ date('F d, Y', strtotime($statement->toDate)) }} <br>Account Number:
                <strong> {{ $statement->account_card_number }}</strong>
            </td>
        </tr>
    </table>





    <div style="padding:10px 10px;margin-top:400px;text-align:center;" class="sssize">
        This Page Intentionally Left Blank

    </div>





    <script type="text/php">
        if (isset($pdf)) {
        $x = 444;
        $y = 825;
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
