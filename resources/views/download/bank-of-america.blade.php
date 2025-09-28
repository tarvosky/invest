<?php
use App\Models\Transaction;
$rand = number_format(rand(100, 300), 2);
$rand1 = number_format(rand(100, 300), 2);
$year = date('Y', strtotime($statement->toDate));
$mfees = number_format(12,2);

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


$deposits = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->where('paidout', 0)
->get();
$debits = Transaction::where('statement_id', $statement->id)
//->orderBy('id', 'DESC')
->where('paidin', 0)
->get();

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

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="90%" style="padding:0px;" align="left">

            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="60" height="60" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/barcode.png'))) }}">
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="20%" style="padding:0px;" align="right">
                <img width="380" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america.png'))) }}">
            </td>
            <td width="80%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <th width="30%" style="padding:0px;" align="left">
                P.O.Box 15284 <br>
                wilmington,DE 19850
            </th>
            <td width="35%" style="padding:0px;" align="left">
            </td>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="30%" style="padding:0px;" align="left">
                <h3> Customer Service information</h3>
            </th>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="mdsize">
        <tr>
            <td width="50%" style="padding:0px;text-transform:uppercase" align="left">
                <img width="380" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/barcode2.png'))) }}"><br>
                <span>{{ $statement->business_name }} <br />{{ $statement->full_name }}</span><br />
                <span>{{ $statement->address }} </span><br />
                <span>{{ $statement->city }}, {{ $statement->state }}  {{ $statement->zip }}</span>
            </td>
            <td width="10%" style="padding:0px;" align="left">

            </td>
            <td width="5%" style="padding:0px;" align="right">
                <img width="20" height="20" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/phone.png'))) }}"><br><br><br>
                <img width="20" height="20" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/laptop.png'))) }}">
                <br><br>
                <img width="20" height="20" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/email.png'))) }}">
            </td>
            <td width="35%" style="padding:0px;" align="left">
                Customer Service: 1.800.432.1000<br>
                TDD/TTY users only: 1.800.288.4408<br>
                En Español: !.800.688.6086<br>
                bankofamerica.com<br>
                Bank of America, N.A<br>
                P.O. Box 25118<br>
                Tampa, FL 33622-5118<br>
            </td>
        </tr>
    </table>

    <div style="margin-top:20px" class="mdsize">
        <h2>Your BofA Checking Advantage</h2>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="mdsize">
        <tr>
            <td width="40%" style="padding:0px;" align="left">
                For {{ date(' M, d, Y', strtotime($statement->fromDate)) }} to
                {{ date(' M, d, Y', strtotime($statement->toDate)) }}
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td width="40%" style="padding:0px;" align="right">
                Account Number {{ $statement->account_card_number }}
            </td>
        </tr>
    </table>
    <div style="margin-top:10px;text-transform:uppercase">
        <strong>{{ $statement->full_name }}</strong>
    </div>
    <div style="margin-top:10px;color:rgb(255, 102, 0)">
        <strong>Account Summary</strong>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="mdsize">
        <tr>
            <td width="60%" style="padding:0px;" align="left">


                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="50%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                            Begining Balance on {{ $statement->fromDate }}
                        </td>
                        <td width="20%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            {{ $currency . '' . number_format($statement->opening_balance, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                            Deposits and other additions
                        </td>
                        <td width="20%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            {{ $currency . '' . number_format($calculation['credit'], 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                            Withdrawals and other subtractions
                        </td>
                        <td width="20%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            - {{ $currency . '' . number_format($calculation['debit'], 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                            Checks
                        </td>
                        <td width="20%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            - {{ $currency }}0.00
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                            Service Fees
                        </td>
                        <td width="20%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                            - {{ $currency . number_format($mfees,2) }}
                        </td>
                    </tr>
                    <tr style="font-weight:700;color:rgb(68, 58, 129)">
                        <td width="50%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                            Ending Balance on {{ $statement->toDate }}
                        </td>
                        <td width="20%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                        </td>
                        <td width="30%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                         {{ $currency . '' . number_format($calculation['total_bal'] - $mfees, 2) }}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="40%" style="padding:0px;" align="left">

            </td>
        </tr>
    </table>


    {{-- page break --}}

    <div class="page-break"></div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="90%" style="padding:0px;" align="right">
                <span style="margin-top:10px;color:rgb(255, 102, 0);font-weight:700">Your checking account</span>
            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="60" height="60" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/barcode.png'))) }}">
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="20%" style="padding:0px;" align="right">
                <img width="380" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america.png'))) }}">
            </td>
            <td width="80%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <th width="100%" style="padding:0px;" align="left">
                {{ $statement->full_name }} | Account # {{ $statement->account_card_number }} | from
                {{ date('l M, d, Y', strtotime($statement->fromDate)) }}
                to {{ date('l M, d, Y', strtotime($statement->toDate)) }}
            </th>
        </tr>
    </table>

    <div style="margin-top:30px;color:rgb(255, 102, 0)">
        <strong>Deposits and other additions</strong>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="mdsize">
        <tr>
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                Date
            </td>
            <td width="80%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                Description
            </td>
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                Amount
            </td>
        </tr>
        @foreach ($deposits as $key => $value)
            <tr >
                <td style="border-bottom:1px #ccc solid" width="10%" style="padding:0px;" align="left">
                    {{ $value->theDate }}
                </td>
                <td style="border-bottom:1px #ccc solid" width="80%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td style="border-bottom:1px #ccc solid" width="10%" style="padding:0px;" align="right">
                    {{  $currency . '' . number_format($value->paidin, 2) }}
                </td>
            </tr>
        @endforeach
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mdsize">
        <tr style="font-weight:700;color:rgb(68, 58, 129)">
            <td width="90%" style="padding:0px;" align="left">
                Total Deposits and other additions
            </td>
            <td width="10%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($calculation['credit'], 2) }}
            </td>
        </tr>
    </table>


    <div style="margin-top:30px;color:rgb(255, 102, 0)">
        <strong>Withdrawals and other subtractions</strong>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="mdsize">
        <tr>
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                Date
            </td>
            <td width="80%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                Description
            </td>
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                Amount
            </td>
        </tr>
        @foreach ($debits as $key => $value)

            <tr >
                <td style="border-bottom:1px #ccc solid" width="10%" style="padding:0px;" align="left">
                    {{ $value->theDate }}
                </td>
                <td style="border-bottom:1px #ccc solid" width="50%" style="padding:0px;" align="left">
                    {{ $value->description }}
                </td>
                <td style="border-bottom:1px #ccc solid" width="10%" style="padding:0px;" align="right">
                    - {{ $currency . '' . number_format($value->paidout, 2) }}
                </td>
            </tr>
        @endforeach
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mdsize">
        <tr style="font-weight:700;color:rgb(68, 58, 129)">
            <td width="90%" style="padding:0px;" align="left">
                Total Withdrawals and other subtractions
            </td>
            <td width="10%" style="padding:0px;" align="right">
                - {{ $currency . '' . number_format($calculation['debit'], 2) }}
            </td>
        </tr>
    </table>





    {{-- page break --}}

    <div class="page-break"></div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="90%" style="padding:0px;" align="right">
                <span style="margin-top:10px;color:rgb(255, 102, 0);font-weight:700">Your checking account</span>
            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="60" height="60" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/barcode.png'))) }}">
            </td>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="20%" style="padding:0px;" align="right">
                <img width="380" height="40" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america.png'))) }}">
            </td>
            <td width="80%" style="padding:0px;" align="left">
            </td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <th width="100%" style="padding:0px;" align="left">
                {{ $statement->full_name }} | Account # {{ $statement->account_card_number }} | from
                {{ date('l M, d, Y', strtotime($statement->fromDate)) }}
                to {{ date('l M, d, Y', strtotime($statement->toDate)) }}
            </th>
        </tr>
    </table>




    <div style="margin-top:30px;color:rgb(255, 102, 0)">
        <strong>Service fees</strong>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="mdsize">
        <tr>
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                Date
            </td>
            <td width="80%" style="padding:0px;border-bottom:1px solid #ccc" align="left">
                Transaction Description
            </td>
            <td width="10%" style="padding:0px;border-bottom:1px solid #ccc" align="right">
                Amount
            </td>
        </tr>
        <tr>
            <td style="border-bottom:1px #ccc solid" width="10%" style="padding:0px;" align="left">
                {{ $statement->fromDate }}
            </td>
            <td style="border-botDeposits and other additionstom:1px #ccc solid" width="50%" style="padding:0px;" align="left">
                Monthly Maintenance Fee
            </td>
            <td style="border-bottom:1px #ccc solid" width="10%" style="padding:0px;" align="right">
                {{ $currency . number_format($mfees,2) }}
            </td>
        </tr>

    </table>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mdsize">
        <tr style="font-weight:700;color:rgb(68, 58, 129)">
            <td width="90%" style="padding:0px;" align="left">
                Total Service Fees
            </td>
            <td width="10%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($mfees, 2) }}
            </td>
        </tr>
        <tr>
            <td width="90%" style="padding:0px;" align="left">
                <i> Note your ending balance already reflects the subtraction of service fees</i>
            </td>
            <td width="10%" style="padding:0px;" align="right">

            </td>
        </tr>
    </table>


    <div style="margin-top:520px">
        <img width="700px" height="230px" style="margin:0;padding:0"
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bank-of-america/footer.png'))) }}">
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
        $x = 520;
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
