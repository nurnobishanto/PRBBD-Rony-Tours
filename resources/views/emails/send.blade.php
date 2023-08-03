<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRB BD - Online Travel Agency</title>
    <style type="text/css">
        /* Add your CSS styles here */
        /* For example: */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
        .footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .content {
            padding: 50px;
        }
        div {
            line-height: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <img width="100px" src="{{getSetting('site_logo')}}">
    <h1>PRB BD - Online Travel Agency</h1>
</div>

<div class="content">
    <p>{{ $dynamicData['body'] }}</p>
    <div>Regards,</div>
    <div>PRB BD - Online Travel Agency</div>
    <div>Bakra, High School Road Bakra, Jashore</div>
    <div>Jashore, Dhaka, Bangladesh.</div>
    <div>Hotline: <a href="tel:+881978-250612">+881978-250612</a> | <a href="tel:+8801978-250611">+8801978-250611</a> </div>
    <div>Web: <a href="https://prbbd.com">https://prbbd.com</a> </div>
    <p style="text-align: justify">The contents of this email and any attachments are confidential and may also be legally privileged. If you are not the intended recipient(s), any use of the information contained herein is prohibited and may be unlawful. In such an event, you are requested to delete the email and intimate the sender. We are not responsible for the accuracy or completeness of this email as it has been transmitted over a public network and may suffer from errors, viruses, delay, interception, and amendment. Whenever any agreement is being entered based on the content of this email, the content of the agreement duly approved by PRBBD Online Travel Agency shall be considered as binding and not that of the email.</p>
</div>

<div class="footer">
    <!-- Add your footer content here -->
    <p>&copy; 2023 Your Company. All rights reserved. <a href="{{env('app_url')}}">PRBBD.COM</a>.</p>
</div>
</body>
</html>
