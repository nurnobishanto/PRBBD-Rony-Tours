<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRB BD -  Online Travel Agency</title>
    <style>
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
        .content{
            padding:50px;
        }
    </style>
</head>
<body>
<div class="header">
    <img width="100px" src="{{getSetting('site_logo')}}">
    <h1>PRB BD -  Online Travel Agency</h1>
</div>

<div class="content">
    <p>{{ $dynamicData['body'] }}</p>
    <br>
    <br>
    Regards.
    PRB BD -  Online Travel Agency
</div>

<div class="footer">
    <!-- Add your footer content here -->
    <p>&copy; 2023 Your Company. All rights reserved. <a href="{{env('app_url')}}">PRBBD.COM</a>.</p>
</div>
</body>
</html>

