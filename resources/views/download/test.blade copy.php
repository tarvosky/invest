<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="{{ public_path('css/test.css') }}" type="text/css" media="all">

</head>

<body>





    <table width="100%" cellspacing="" cellpadding="0" border="0">
        <tr>
            <td width="50%">
                <small>Primary Account: {{ $order->account_card_number }}</small><br />
                <small> Beginning {{ date('F d Y', strtotime($order->fromDate)) }} - Ending
                    {{ date('F d Y', strtotime($order->toDate)) }}</small> <br />

            </td>
            <td style="padding:0px;" align="right"> <img width="250" height="80" style="margin:0;padding:0"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logos/bbva_logo.jpeg'))) }}">
            </td>
        </tr>

        <tr>
            <td width="20%" style="padding:0px;" align="right">
            </td>
            <td width="50%" style="padding:0px;" align="right">
            </td>
            <td width="30%" style="padding:0px;" align="right">
            </td>
        </tr>

    </table>

    <table width="100%" cellspacing="" cellpadding="0" border="0">

        <tr>
            <td width="20%" style="padding:0px;" align="right">
            </td>
            <td width="50%" style="padding:0px;" align="right">
            </td>
            <td width="30%" style="padding:0px;" align="right">
            </td>
        </tr>

        <tr>
            <td width="20%" style="padding:0px;" align="right">
            </td>
            <td width="50%" style="padding:0px;" align="right">
            </td>
            <td width="30%" style="padding:0px;" align="right">
            </td>
        </tr>

    </table>

</body>

</html>


<li>Tell us your name and account number (ifany).</li>
<li>Describe the error or the transfer you are unsure about,ande xplain as clearly as you can
    why you believe it is an error or what you need more information.</li>
<li>Tell us the dollar amount of the suspected error.</li>
<p>You can stop the automatic deduction of the Minimum Payment from you 
    checking account if you think your statement is wrong. To stop the payment,
     your letter must reach us three (3) business days before the automatic deduction is scheduled to occur.</p>
            
<h3>Reporting Other Problems</h3>
<p>Please review your statement carefully. It is essential that any account errors or any improper transactions on your account be reported to us as soon as reasonably possible. If you fail to notify us of any suspected problems, errors or unauthorized transactions within the time periods specified in the deposit account agreement,
</p>


<p style="padding-top:20px">
    BBVA and BBVA Compass are trade names of BBVA USA, a member of the BBVA Group. BBVA USA, Member FDIC.
</p>