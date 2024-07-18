<!DOCTYPE html>
<html lang="ar" dir="rtl" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--[if mso]>
    <xml>
    <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <style>
    table {border-collapse: collapse;}
    .spacer,.divider {mso-line-height-rule: exactly;}
    td,th,div,p,a {font-size: 13px; line-height: 23px;}
    td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family:"Segoe UI",Helvetica,Arial,sans-serif;}
    </style>
    <![endif]-->

    <style type="text/css">

        @import url('https://fonts.googleapis.com/css?family=Changa:400,700|Open+Sans:400,700');
        @media only screen {
            .column, th, td, div, p {font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI","Roboto",Helvetica,Arial,sans-serif;}
            .serif {font-family: "Changa",-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI","Roboto",Helvetica,Arial,sans-serif;}
            .sans-serif {font-family: "Open Sans",-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI","Roboto",Helvetica,Arial,sans-serif;}
        }

        a {text-decoration: none;}
        img {border: 0; line-height: 100%; max-width: 100%; vertical-align: middle;}

        .wrapper {min-width: 700px;}
        .row {margin: 0 auto; width: 700px;}
        .row .row, th .row {width: 100%;}
        .column {font-size: 13px; line-height: 23px;}

        @media only screen and (max-width: 699px) {

            .wrapper {min-width: 100% !important;}
            .row {width: 90% !important;}
            .row .row {width: 100% !important;}

            .column {
                box-sizing: border-box;
                display: inline-block !important;
                line-height: inherit !important;
                width: 100% !important;
                word-break: break-word;
                -webkit-text-size-adjust: 100%;
            }

            .has-columns .column {
                padding-right: 10px !important;
                padding-left: 10px !important;
            }

            .mobile-collapsed .column {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .mobile-center {
                display: table !important;
                float: none;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .spacer                     {height: 30px; line-height: 100% !important; font-size: 100% !important;}
            .divider th                 {height: 60px;}
        }
    </style>
</head>
<body style="box-sizing:border-box;margin:0;padding:0;width:100%;-webkit-font-smoothing:antialiased;background-color: #EEEEEE;">

<table class="wrapper" align="center" bgcolor="#EEEEEE" cellpadding="0" cellspacing="0" width="100%" role="presentation">
    <tr>
        <td style="padding: 30px 0;">

            <!-- Header Left -->
            <table class="row" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="spacer" height="40" style="line-height: 40px;">&nbsp;</td>
                </tr>
                <tr>
                    <th class="column" width="640" style="padding-left: 30px; padding-right: 30px; text-align: left;">
                        <a href="https://dailydevblog.thethemeai.com" style="text-decoration: none;">
                            <img class="mobile-center" src="https://dailydevblog.thethemeai.com/images/logo-dark.svg" alt="Header Logo" width="105">
                        </a>
                    </th>
                </tr>
                <tr>
                    <td class="spacer" height="40" style="line-height: 40px;">&nbsp;</td>
                </tr>
            </table>
            <!-- /Header Left -->

            <!-- Intro Basic -->
            <table class="row" align="center" bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="spacer" height="80" style="line-height: 80px;">&nbsp;</td>
                </tr>
                <tr>
                    <th class="column sans-serif" width="640" style="padding-left: 30px; padding-right: 30px; font-weight: 400; text-align: left;">
                        <div class="serif" style="color: #1F2225; font-size: 28px; font-weight: 700; line-height: 50px; margin-bottom: 30px;">Hello, our dear member</div>
                        <div style="color: #969AA1; font-size: 18px; line-height: 28px; margin-bottom: 40px;">The secret code to reset your password is</div>
                        <table align="center" cellpadding="0" cellspacing="0" width="100%" style="margin: 0 auto; word-break: break-all;" role="presentation">
                            <tr>
                                <th class="sans-serif" bgcolor="#FFFFFF" style="padding: 20px; border-radius: 3px;">
                                    <div style="color: #3FB58B; font-weight: 400; font-size: 30px; text-decoration: none;">{{$userInfo->reset_code}}</div>
                                </th>
                            </tr>
                        </table>
                    </th>
                </tr>
                <tr>
                    <td class="spacer" height="80" style="line-height: 80px;">&nbsp;</td>
                </tr>
            </table>
            <!-- /Intro Basic -->



        </td>
    </tr>
</table>

</body>
</html>
