<?php
use App\Models\Transaction;


$rand = number_format(rand(100, 300), 2);
$rand1 = number_format(rand(100, 300), 2);
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

$transactions_ordinary = $transactions;
$transactions= Transaction::where('statement_id', $statement->id)->get();
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

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="70%" style="padding:0px;" align="left">
                <h3>Wells Fargo Business Choice Checking</h3>
                <span class="sssize">Account number: <strong>{{ $statement->account_card_number }}</strong> &nbsp;&nbsp;
                    {{ $statement->fromDate }} - {{ $statement->toDate }}
                </span>

            </td>
            <td width="10%" style="padding:0px;" align="left">

            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="100" height="100" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/wells-fargo.png'))) }}">
            </td>
        </tr>
    </table>



    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:50px" class="sssize">
        <tr>
            <td width="60%" style="padding:0px;border-right:3px #000 solid;text-transform:uppercase" align="left">
                <span>{{ $statement->business_name }}<br /> {{ $statement->full_name }}</span><br />
                <span>{{ $statement->address }} </span><br />
                <span>{{ $statement->city }}, {{ $statement->state }} {{ $statement->zip }}</span>
            </td>
            <td width="40%" style="padding-left:10px;" align="left">
                <h3>Questions?</h3>
                <i>Available by phone 24 hours a day, 7 days a week:</i> <br>
                Telecommunications Relay Services calls accepted <br>
                <strong> 1-800-CALL-WELLS</strong> (1-800-225-5935)<br><br>
                <i>TTY: 1-800-877-4833</i> <br>
                <i>En español: 1-877-337-7454</i> <br><br>
                <i> Online: wellsfargo.com/biz</i><br>
                <i>Write:</i> Wells Fargo Bank, N.A. (808)<br>
                P.O. Box 6995<br>
                Portland, OR 97228-6995<br>
            </td>
        </tr>
    </table>

    <div style="border-top:2px solid #000;margin-top:30px">
        <h3>Your Business and Wells Fargo</h3>
        <span class="sssize">Visit wellsfargoworks.com to explore videos, articles, infographics, interactive tools, and
            other resources on the topics of business growth, <br> credit, cash flow management, business planning,
            technology, marketing, and more.
        </span>
    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px" class="sssize">
        <tr>
            <td width="40%" style="padding:0px;border-top:1px #000 solid" align="left">
                <h3>Activity summary</h3>

                <table width="100%" class="sssize" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="40%" style="padding:0px;" align="left">
                            Beginning balance on {{ date_format(date_create($statement->fromDate), 'm/d') }}
                        </td>
                        <td width="40%" align="right">
                            {{ $currency . '' . number_format($statement->opening_balance, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="40%" style="padding:0px;" align="left">
                            Deposits/Credits
                        </td>
                        <td width="40%" align="right">
                            {{ $currency . '' . number_format($calculation['credit'], 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="40%" style="padding:0px;" align="left">
                            Withdrawals/Debits
                        </td>
                        <td width="40%" align="right">
                            - {{ $currency . '' . number_format($calculation['debit'], 2) }}
                        </td>
                    </tr>
                </table>


                <table width="100%" class="sssize" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="20%" align="left">
                        </td>
                        <th width="40%" style="border-top:3px #000 solid" align="left">
                            <strong>Ending balance on {{ date_format(date_create($statement->toDate), 'm/d') }}</strong>
                        </th>
                        <th width="40%" style="border-top:3px #000 solid" align="right">
                            <strong> {{ $currency . '' . number_format($calculation['total_bal'], 2) }}</strong>
                        </th>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                            &nbsp;
                        </td>
                        <td width="40%" style="padding:0px;" align="left">
                        </td>
                        <td width="40%" align="right">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="40%" style="padding:0px;" align="left">
                            Average ledger balance this period
                        </td>
                        <th width="40%" align="right">
                            {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
                        </th>
                    </tr>
                </table>




            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td class="sssize" width="40%" style="padding-left:20px;border-left:3px #000 solid" align="left">
                Account number: <strong>{{ $statement->account_card_number }}</strong> <br><br>
                <strong>{{ $statement->full_name }}</strong><br><br>
                Texas/Arkansas account terms and conditions apply<br><br>
                For Direct Deposit use<br>
                Routing Number (RTN): {{ $statement->routing_number }}<br><br>
                For Wire Transfers use<br>
                Routing Number (RTN): {{ $statement->routing_number }}<br>
            </td>
        </tr>
    </table>




    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:30px">
        <tr>
            <td width="40%" style="padding:0px;border-top:1px #000 solid" align="left">
                <h3>Interest summary</h3>

                <table width="100%" class="sssize" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            Interest paid this statement
                        </td>
                        <td width="30%" align="right">
                            {{ $currency . '' . number_format($rand, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            Average collected balance
                        </td>
                        <td width="30%" align="right">
                            {{ $currency . '' . number_format($calculation['debit'], 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            Annual percentage yield earned
                        </td>
                        <td width="30%" align="right">
                            0.00%
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            Interest earned this statement period
                        </td>
                        <td width="30%" align="right">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            Interest paid this year
                        </td>
                        <td width="30%" align="right">
                            {{ $currency . '' . number_format($rand, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="padding:0px;" align="left">
                        </td>
                        <td width="50%" style="padding:0px;" align="left">
                            Total interest paid in {{ $year }}
                        </td>
                        <td width="30%" align="right">
                            {{ $currency . '' . number_format($rand1, 2) }}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
            <td class="sssize" width="40%" style="padding-left:20px;" align="left">
            </td>
        </tr>
    </table>


    {{-- page break --}}
    <div class="page-break"></div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="70%" style="padding:0px;" align="left">
                <h3>Wells Fargo Business Choice Checking</h3>
                <span class="sssize">Account number: <strong>{{ $statement->account_card_number }}</strong> &nbsp;&nbsp;
                    {{ $statement->fromDate }} - {{ $statement->toDate }}
                </span>

            </td>
            <td width="10%" style="padding:0px;" align="left">

            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="100" height="100" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/wells-fargo.png'))) }}">
            </td>
        </tr>
    </table>


    <div style="border-top:3px solid #000;margin-top:30px">
        <div>&nbsp;</div>
    </div>


    <div style="border-top:1px solid #000;">
        <h3>Transaction history</h3>
    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px" class="sssize">
        <tr>
            <td width="5%" align="left">
            </td>
            <td width="5%" style="padding:0px;border-bottom:1px solid #000;font-style:italic" align="left">
                Date
            </td>
            <td width="60%" style="padding:0px;border-bottom:1px solid #000;font-style:italic" align="left">
                Description
            </td>
            <td width="10%" style="padding:0px;border-bottom:1px solid #000;font-style:italic" align="left">
                Deposits/ <br> Credits
            </td>
            <td width="10%" style="padding:0px;border-bottom:1px solid #000;font-style:italic" align="left">
                Withdrawals/ <br>Debits
            </td>
            <td width="10%" style="padding:0px;border-bottom:1px solid #000;font-style:italic" align="left">
                Ending daily <br> balance
            </td>

        </tr>
    </table>
    @foreach ($transactions as $key => $value)

        @if ($key % 32 == 0 && $key !== 0)

            {{-- page break --}}
            <div class="page-break"></div>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="70%" style="padding:0px;" align="left">
                        <h3>Wells Fargo Business Choice Checking</h3>
                        <span class="sssize">Account number: <strong>{{ $statement->account_card_number }}</strong>
                            &nbsp;&nbsp;
                            {{ $statement->fromDate }} - {{ $statement->toDate }}
                        </span>

                    </td>
                    <td width="10%" style="padding:0px;" align="left">

                    </td>
                    <td width="20%" style="padding:0px;" align="right">
                        <img width="100" height="100" style="margin:0;padding:0"
                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/wells-fargo.png'))) }}">
                    </td>
                </tr>
            </table>


            <div style="border-bottom:1px solid #000;border-top:3px solid #000;margin-top:30px">
                <div>&nbsp;</div>
            </div>
        @else
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
                <tr>
                    <td width="5%" align="left">
                    </td>
                    <td width="5%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ date_format(date_create($value->theDate), 'm/d') }}
                    </td>
                    <td width="60%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ $value->description }}
                    </td>
                    <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ $value->paidin == 0 ? '' : $currency . '' . number_format($value->paidin, 2) }}
                    </td>
                    <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        {{ $value->paidout == 0 ? '' : $currency . '' . number_format($value->paidout, 2) }}
                    </td>
                    <td width="10%" style="padding:0px;border-bottom:1px solid #000" align="left">
                        <?php echo cal_bal_by_key($statement->opening_balance, $key + 1,
                        $transactions_ordinary,$statement->id); ?>
                    </td>
                </tr>
            </table>
        @endif
    @endforeach


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="5%" align="left">
            </td>
            <th width="60%" style="padding:0px;border-bottom:3px solid #000" align="left">
                Ending balance on {{ date_format(date_create($statement->toDate), 'm/d') }}
            </th>
            <td width="5%" style="padding:0px;border-bottom:3px solid #000" align="left">
            </td>
            <td width="10%" style="padding:0px;border-bottom:3px solid #000" align="left">
            </td>
            <td width="10%" style="padding:0px;border-bottom:3px solid #000" align="left">
            </td>
            <th width="10%" style="padding:0px;border-bottom:3px solid #000" align="left">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </th>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="60%" style="padding:0px;" align="left">
                Totals
            </th>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="10%" style="padding:0px;" align="left">
            </td>
            <td width="10%" style="padding:0px;" align="left">
                {{ $currency . '' . number_format($calculation['debit'], 2) }}
            </td>
            <th width="10%" style="padding:0px;" align="left">

            </th>
        </tr>
    </table>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="95%" style="padding:0px;font-style:italic" align="left">
                The Ending Daily Balance does not reflect any pending withdrawals or holds on deposited funds that may
                have been outstanding on your account when your <br>
                transactions posted. If you had insufficient available funds when a transaction posted, fees may have
                been assessed. <br><br>


                * Indicates transaction counts toward the Regulation D and Wells Fargo savings withdrawal and transfer
                limit. Except outgoing wire transfers, there is no limit
                on the number of withdrawals or transfers made in person at an ATM or Wells Fargo location or on any
                types of deposits. For more information, please refer to your Account Agreement.
            </td>
        </tr>
    </table>

    <div style="margin-top:30px" class="sssize">
        <h3>Monthly service fee summary</h3>
        <p>For a complete list of fees and detailed account information, please see the Wells Fargo Fee and Information
            Schedule and Account Agreement applicable to your account or talk to a banker. Go to wellsfargo.com/feefaq
            to find answers to common questions about the monthly service fee on your account.</p>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px" class="sssize">
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #000;" align="left">
                Fee period {{ $statement->fromDate }} - {{ $statement->toDate }}
            </td>
            <td width="40%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                Standard monthly service fee $10.00
            </td>
            <td width="15%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                You paid $0.00
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="40%" style="padding:0px;" align="left">
                How to avoid the monthly service fee
            </th>
            <td width="40%" style="padding:0px;" align="right">
                Minimum required
            </td>
            <td width="15%" style="padding:0px;" align="right">
                This fee period
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="40%" style="padding:0px;" align="left">
                Have any <strong>ONE</strong> of the following account requirements
            </td>
            <td width="40%" style="padding:0px;" align="right">
            </td>
            <td width="15%" style="padding:0px;" align="right">
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="40%" style="padding:0px;" align="left">
                Minimum daily balance
            </td>
            <td width="40%" style="padding:0px;" align="right">
                $8,000.00
            </td>
            <td width="15%" style="padding:0px;" align="right">
                {{ $currency . '' . number_format($calculation['total_bal'], 2) }}
            </td>
        </tr>
    </table>

    <div style="border-top:1px solid #000;">
        <h3>Account transaction fees summary</h3>
    </div>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;" class="sssize">
        <tr style="padding:0px;font-style:italic">
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="35%" style="padding:0px;border-bottom:1px solid #000;" align="left">
                Service charge description
            </td>
            <td width="12%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                Units used
            </td>
            <td width="12%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                Units <br>included
            </td>
            <td width="12%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                Excess <br> units
            </td>
            <td width="12%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                Service charge per <br>excess units ($)
            </td>
            <td width="12%" style="padding:0px;border-bottom:1px solid #000;" align="right">
                Total service <br>charge ($)
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="35%" style="padding:0px;" align="left">
                Deposited Items
            </td>
            <td width="12%" style="padding:0px;" align="right">
                0
            </td>
            <td width="12%" style="padding:0px;" align="right">
                20
            </td>
            <td width="12%" style="padding:0px;" align="right">
                0
            </td>
            <td width="12%" style="padding:0px;" align="right">
                0.50
            </td>
            <td width="12%" style="padding:0px;" align="right">
                0.00
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <td width="35%" style="padding:0px;border-top:2px solid yellow;" align="left">
                Cash Deposited ($)
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid yellow;" align="right">
                0
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid yellow;" align="right">
                5000
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid yellow;" align="right">
                0
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid yellow;" align="right">
                0.0030
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid yellow;" align="right">
                0.00
            </td>
        </tr>
        <tr>
            <td width="5%" style="padding:0px;" align="left">
            </td>
            <th width="35%" style="padding:0px;border-top:2px solid #000;" align="left">
                Total service charges
            </th>
            <td width="12%" style="padding:0px;border-top:2px solid #000;" align="right">
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid #000;" align="right">
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid #000;" align="right">
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid #000;" align="right">
            </td>
            <td width="12%" style="padding:0px;border-top:2px solid #000;" align="right">
                0.00
            </td>
        </tr>
    </table>



    {{-- page break --}}

    <div class="page-break"></div>







    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="70%" style="padding:0px;" align="left">
                <h3>Wells Fargo Business Choice Checking</h3>
                <span class="sssize">Account number: <strong>{{ $statement->account_card_number }}</strong> &nbsp;&nbsp;
                    {{ $statement->fromDate }} - {{ $statement->toDate }}
                </span>

            </td>
            <td width="10%" style="padding:0px;" align="left">

            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="100" height="100" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/wells-fargo.png'))) }}">
            </td>
        </tr>
    </table>


    <div style="margin-top:30px;border-top:2px solid #000;" class="sssize">
        <h1>IMPORTANT ACCOUNT INFORMATION</h1>
        <p>Amendment to our Funds Availability Policy</p>
        <p>Good news! Effective April 5, 2020, we've updated our funds availability policy to remove the delay of funds
            by one additional business day for certain checks deposited at a Wells Fargo location in Alaska. This
            applies only if the check was drawn on or payable at or through a paying bank not located in Alaska. Other
            funds availability policies are still in effect. Please see our Consumer Account Agreement for additional
            funds availability policies and details.</p>
        <p>Periodically, we may evaluate the timing of statements, monthly service fee assessment and interest payments
            to your accounts. We may adjust the timing in order to align your statement, monthly service fee assessment
            (if any) and interest payment dates with one another. You may receive a partial statement that reflects
            activity and interest payments from the last statement date to the date of
            the change. No monthly service fees will be assessed during a partial statement period and there will be no
            impact to your interest rate or compounding frequency.</p>
    </div>



    {{-- page break --}}

    <div class="page-break"></div>







    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="70%" style="padding:0px;" align="left">
                <h3>Wells Fargo Business Choice Checking</h3>
                <span class="sssize">Account number: <strong>{{ $statement->account_card_number }}</strong> &nbsp;&nbsp;
                    {{ $statement->fromDate }} - {{ $statement->toDate }}
                </span>

            </td>
            <td width="10%" style="padding:0px;" align="left">

            </td>
            <td width="20%" style="padding:0px;" align="right">
                <img width="100" height="100" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/wells-fargo.png'))) }}">
            </td>
        </tr>
    </table>

    <div class="sssize" style="margin-top:30px;border-top:2px solid #000;">
        <h3>General statement policies for Wells Fargo Bank</h3>
    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;text-align:justify"
        class="sssize">
        <tr>
            <td width="45%" style="padding:0px;text-align:justify" align="left">
                <strong>■ Notice:</strong> Wells Fargo Bank, N.A. may furnish information about accounts belonging to
                individuals, including sole proprietorships, to consumer reporting agencies. If this applies to you, you
                have the right to dispute the accuracy of information that we have reported by writing to us at:
                Overdraft Collections and Recovery, P.O. Box 5058, Portland, OR 97208-5058.
            </td>
            <td width="10%" style="padding:0px;" align="left">
            </td>
            <td width="45%" style="padding:0px;text-align:justify" align="left">
                You must describe the specific information that is inaccurate or in dispute and the basis for any
                dispute with supporting documentation. In the case of information that relates to an identity theft, you
                will need to provide us with an identity theft report.
            </td>
        </tr>
    </table>

    <div style="margin-top:30px;border-top:1px solid #000;">
    </div>


    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="sssize">
        <tr>
            <td width="45%" style="padding:0px;" align="left">

                <table width="100%" cellspacing="0" cellpadding="0" border="0" ">
                    <tr>
                        <td  style=" padding:0px;" align="left">
                    <h3>Account Balance Calculation Worksheet</h3>
            </td>
        </tr>
        <tr>
            <td style="padding:0px;" align="left">
                1. Use the following worksheet to calculate your overall account balance. <br><br>
            </td>
        </tr>
        <tr>
            <td style="padding:0px;" align="left">
                2. Go through your register and mark each check, withdrawal, ATM transaction, payment, deposit or other
                credit listed on your statement.
                Be sure that your register shows any interest paid into your account and any service charges, automatic
                payments or ATM transactions withdrawn from your account during this statement period. <br><br>
            </td>
        </tr>
        <tr>
            <td style="padding:0px;" align="left">
                3. Use the chart to the right to list any deposits, transfers to your account, outstanding checks, ATM
                withdrawals, ATM payments or any other withdrawals (including any from previous months) which are listed
                in your register but not shown on your statement
            </td>
        </tr>

    </table>

    <div>
        <h3>ENTER</h3>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                A. The ending balance
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                shownonyourstatement......................
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
    </table>
    <div>
        <h3>ADD</h3>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                B. Any deposits listed in your your
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                register or transfers into
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                your account which are not
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                account which are not shown on your statement.
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                ......................$total
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
    </table>
    <div>
        <h3>CALCULATE THE SUBTOTAL</h3>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                (Add Parts A and B)
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                ......................$total
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
    </table>
    <div>
        <h3>SUBTRACT</h3>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                C. The total outstanding checks and
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                withdrawals from the chart above . . . . . . . . . . . . .
            </td>
            <td width="20%" style="padding:0px;" align="left">
                $_______________
            </td>
        </tr>
    </table>
    <div>
        <h3>CALCULATE THE ENDING BALANCE</h3>
    </div>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                (Part A + Part B - Part C)
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                This amount should be the same
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                as the current balance shown in
            </td>
            <td width="20%" style="padding:0px;" align="left">
            </td>
        </tr>
        <tr>
            <td width="80%" style="padding:0px;" align="left">
                your check register.........................
            </td>
            <td width="20%" style="padding:0px; border:1px #000 solid" align="left">
                $_______________
            </td>
        </tr>
    </table>


    </td>

    <td width="10%" style="padding:0px;" align="left">
    </td>


    <td width="45%" style="padding:0px;" align="left">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px">
            <tr>
                <td width="10%" style="padding:0px;" align="center">
                    Number
                </td>
                <td width="80%" style="padding:0px;" align="center">
                    Items Outstanding
                </td>
                <td width="10%" style="padding:0px;" align="center">
                    Amount
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            <tr>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                    &nbsp;
                </td>
                <td width="80%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
                <td width="10%"
                    style="padding:0px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
            </tr>
            <tr>
                <td width="10%" style="padding:0px;border-top:1px solid #000;" align="left">
                    &nbsp;
                </td>
                <th width="80%" style="padding:0px;border-top:1px solid #000;" align="right">
                    Total amount $
                </th>
                <td width="10%"
                    style="padding:0px;border-bottom:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;"
                    align="left">
                </td>
            </tr>
        </table>







    </td>
    </tr>
    </table>





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
        $x = 250;
        $y = 90;
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
