<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title></title>
    <!--
    The style block is collapsed on page load to save you some scrolling.
    Postmark automatically inlines all CSS properties for maximum email client
    compatibility. You can just update styles here, and Postmark does the rest.
  -->

    <!--[if mso]>
    <style type="text/css">
        .f-fallback {
            font-family: Arial, sans-serif;
        }
    </style>
    <![endif]-->
</head>
<body style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;">
<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="email-masthead" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                        <a href="{{ $data->product_url }}" class="f-fallback email-masthead_name" style="color: #3869D4;">
                            {{ $data->product_name }}
                        </a>
                    </td>
                </tr>
                <!-- Email Body -->
                <tr>
                    <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                    <div class="f-fallback">
                                        <h1 style="margin-top: 0;color: #333333;font-size: 22px;font-weight: bold;text-align: left;">Welcome, {{ $data->name }}!</h1>
                                        <p style="margin: .4em 0 1.1875em;font-size: 16px;line-height: 1.625;">Thanks for trying {{ $data->product_name }}. We’re thrilled to have you on board. To get the most out
                                            of {{ $data->product_name }}, do this primary next step:</p>
                                        <!-- Action -->
                                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                                    <!-- Border based button https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td align="center" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                                                            <a href="{{ $data->action_url }}" class="button button--" target="_blank"
                                                                               style="color: #FFF;background-color: #3869D4;border-top: 10px solid #3869D4;border-right: 18px solid #3869D4;border-bottom: 10px solid #3869D4;border-left: 18px solid #3869D4;display: inline-block;text-decoration: none;border-radius: 3px;box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);-webkit-text-size-adjust: none;box-sizing: border-box;">Do
                                                                                this Next</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin: .4em 0 1.1875em;font-size: 16px;line-height: 1.625;">For reference, here's your login information:</p>
                                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="attributes_content" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td class="attributes_item" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;"><strong>Login
                                                                    Page:</strong> {{ $data->login_url }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="attributes_item" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                                                <strong>Username:</strong> {{ $data->username }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin: .4em 0 1.1875em;font-size: 16px;line-height: 1.625;">If you have any questions, feel free to <a href="mailto:{{ $data->support_email }}" style="color: #3869D4;">email
                                                our
                                                customer success team</a>.
                                            <br>{{ $data->sender_name }} and the {{ $data->product_name }} Team</p>
                                        <!-- Sub copy -->
                                        <table class="body-sub">
                                            <tr>
                                                <td style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                                    <p class="sub" style="margin: .4em 0 1.1875em;font-size: 13px;line-height: 1.625;">If you’re having trouble with the button above, copy and paste the URL below into
                                                        your web browser.</p>
                                                    <p class="sub" style="margin: .4em 0 1.1875em;font-size: 13px;line-height: 1.625;">{{ $data->action_url }}</p>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="content-cell" align="center" style="word-break: break-word;font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif;font-size: 16px;">
                                    <p class="f-fallback sub align-center" style="margin: .4em 0 1.1875em;font-size: 13px;line-height: 1.625;text-align: center;">&copy; 2021 {{ $data->product_name }}. All rights
                                        reserved.</p>
                                    <p class="f-fallback sub align-center" style="margin: .4em 0 1.1875em;font-size: 13px;line-height: 1.625;text-align: center;">
                                        {{ $data->company_name }}
                                        <br>{{ $data->company_address }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
