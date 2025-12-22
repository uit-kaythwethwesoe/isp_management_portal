<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>Invoice</title>

    <style>
        table,
        td,
        div,
        h1,
        p,
        h3 {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body style="margin:0;padding:0;" onload="window.print();">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:2px solid red;border-spacing:0;text-align:left;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0;">
                                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr style="border-bottom:2px solid red">
                                                <td style="width:150px;padding:0;vertical-align:top;">
                                                    <p style="font-size:16px;line-height:24px;"><img src="https://telco.mbt.com.mm/assets/front/img/header_logo_162426094536756743.png" alt="" width="150" style="height:auto;display:block;" /></p>

                                                </td>
                                                <td style="width:10px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                                                <td style="width:350px;padding:0;vertical-align:top;">

                                                    <h3 style="margin:0 0 6px 0;font-size:20px;line-height:24px;">Myanmar Broadband Telecom Co,Ltd</h3>
                                                    <p style="margin:0;font-size:16px;line-height:24px;">No. L-69/70, Corner of Kan Yeik Thar 5th St and Kha Yay Pin Street, FMI City, Hlaing Tharyar Township, Yangon.</p>
                                                    <p style="margin:0 0 8px 0;font-size:16px;line-height:24px;">
                                                        Customer Service: 01 368 4488
                                                    </p>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:28px 0 26px 0;">
                                        <h1 style="font-size:24px;margin:0 0 24px 0;font-family:Arial,sans-serif;text-align: center;">INVOICE</h1>
                                        <p style="margin-left:10px;font-size:18px;line-height:24px;">Invoice #: {{$payment->invoice_no}}</p>
                                        <p style="margin-left:10px;font-size:18px;line-height:24px;">Paying Date: {{$payment->created_at}}</p>
                                        <p style="margin-left:10px;font-size:18px;line-height:24px;">User Id: {{$payment->payment_user_name}}</p>
                                        <p style="margin-left:10px;font-size:18px;line-height:24px;">Name: {{$user['user_real_name']}}</p>
                                        <p style="margin-left:10px;font-size:18px;line-height:24px;">Address: {{$user['user_address']}}</p>
                                        <p style="margin-left:10px;font-size:18px;line-height:24px;">Product Name: {{$payment_rec['products_name']}}</p>
                                        <p style="margin-left:10px;margin-bottom:0;font-size:18px;line-height:24px;">Monthly Cost: {{$payment_rec['checkout_amount']}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr style="background: #F49858;">
                                                <th style="border:1px solid black;">
                                                    <p style="margin:6px;text-align: center;">Description</p>
                                                </th>
                                                <th style="border:1px solid black;">
                                                    <p style="margin:6px;text-align: center;">Period</p>
                                                </th>
                                                <th style="border:1px solid black;">
                                                    <p style="margin:6px;text-align: center;">Month</p>
                                                </th>
                                                <th style="border:1px solid black;">
                                                    <p style="margin:6px;text-align: center;">Amount (MMK)</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">Month Fees</p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">{{$payment->begin_date}} to {{$payment->expire_date}}</p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">
                                                        <?php
                                                            $date1 = new DateTime($payment->begin_date);
                                                            $date2 = new DateTime($payment->expire_date);
                                                            
                                                            $diff = $date1->diff($date2);
                                                            $months =  $diff->format('%m');
                                                        ?>
                                                        {{ $act_months }}
                                                    </p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">{{$payment_rec['checkout_amount'] * $act_months}}</p>
                                                </td>

                                            </tr>
                                            @if($installation_cost > 0)
                                                <tr>
                                                    <td style="border:1px solid black;">
                                                        <p style="margin:6px 0;text-align: center;">Installation Fees</p>
                                                    </td>
                                                    <td style="border:1px solid black;">
                                                        <p style="margin:6px 0;text-align: center;">{{$user['Installation_date']}}</p>
                                                    </td>
                                                    <td style="border:1px solid black;">
                                                        <p style="margin:6px 0;text-align: center;"></p>
                                                    </td>
                                                    <td style="border:1px solid black;">
                                                        <p style="margin:6px 0;text-align: center;">{{$installation_cost}}</p>
                                                    </td>
    
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="3">
                                                    <p style="margin:6px 0;text-align: right;">Charges:</p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">{{$payment_rec['checkout_amount'] * $act_months + $installation_cost}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <p style="margin:6px 0;text-align: right;">Discount:</p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">{{ !empty($pending_pay->discount) ? $pending_pay->discount : '0'}}%</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <p style="margin:6px 0;text-align: right;">Commercial Tax:</p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">{{ !empty($pending_pay->commercial_tax) ? $pending_pay->commercial_tax : '0'}}%</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <p style="margin:6px 0;text-align: right;">Total:</p>
                                                </td>
                                                <td style="border:1px solid black;">
                                                    <p style="margin:6px 0;text-align: center;">{{$payment->total_amt}}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 0 18px;">
                            <p style="text-align:center;font-size:18px;line-height:24px;">
                                * This is a electronic invoice , and does not require a signature.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>