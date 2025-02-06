<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Verification OTP</title>
    </head>

    <body style="width: 100%;height: 100dvh;background: #fff;display:block;">

        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: roboto;
                overflow: hidden;
            }
        </style>



        <img src="https://www.herocollectives.com.ng/public/images/gpt.png" alt="Logo" loading="lazy"
            style="width: 60px;height:60px;object-fit:cover;display:block;margin:20px auto;">

        <div style="padding: 10px 19px;">
            <h1 style="font-size:12px;font-weight:600;">Dear <span
                    style="text-transform:capitalize;">{{ $user->username }}</span>,</h1>

            <p style="margin: 10px 0px">Your One Time Password for signup is:</p>

            <div style="width:fit-content;margin:40px 30px;background:#777;padding:10px 7px;font-size:2rem;color:#fff;">
                {{ $otp }}</div>


            <p style="margin-top: 30px;color:red;font-size:12px;">If you did not signup on our platform, please
                ignore this
                message. Thank you!</p>

            <a href=""
                style="position: absolute;text-decoration: none;bottom:30px; left:50%;transform: translateX(-50%);color:black;">
                Genesis
                Inc &copy; 2024</a>
        </div>






    </body>

</html>
