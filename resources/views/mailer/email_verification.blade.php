<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Successfully Changed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            text-align: center;
            padding: 20px 0;
        }
        .content h1 {
            color: #333333;
        }
        .content p {
            color: #555555;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            letter-spacing: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/au_logo.png') }}" alt="Company Logo">
        </div>
        <div class="content">            
            <p>Hi {{ $data['fname'] }}, </p>
            <p>We're happy to signed up for Arellano University - ETEEAP App.</p>
            <p>To start exploring and uploading your documents please verify your email with the code below.</p>
            <br />

            <p class="otp">{{ $data['otp'] }}</p>

            <br />
            <p>Welcome to ETEEAP-AU</p>
            <p>ETEEAP-AU Team</p>
        </div>
        <div class="footer">
            <p>If you did not request this code, please ignore this email.</p>
            <p>&copy; 2024 ETEEAP-AU All rights reserved.</p>
        </div>
    </div>
</body>
</html>
