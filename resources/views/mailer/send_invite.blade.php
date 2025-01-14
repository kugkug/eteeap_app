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
        text-align: left;
        padding: 20px 0;
    }

    .header img {
        max-width: 150px;
    }

    .content {
        text-align: left;
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

            <p>Based on the initial evaluation of your documents, you have met the minimum qualifications to apply for
                admission in the ETEEAP.</p>

            <p>Please be advised that the alignment of your preferred course to your work experience and your acceptance
                in
                the program will be decided upon by our panel of assessors after they have further evaluated your
                credentials.</p>

            <p>
                Kindly submit the documents on-site if available (on the day of interview);<br />
                Notarized COEs<br />
                Honorable Dismissal<br />
                TOR for Evaluation purposes<br />
            </p>

            <p>Good Moral Character</p>

            <p>In line with this, kindly prepare your 2 (Pink) Clearbook and insert all the requirements and kindly wait
                for the scheduled interview email</p>


            <p>We're happy to signed up for Arellano University - ETEEAP App.</p>
            <p>ETEEAP-AU</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 ETEEAP-AU All rights reserved.</p>
        </div>
    </div>
</body>

</html>