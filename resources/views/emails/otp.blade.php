<!DOCTYPE html>
<html>
<head>
    <title>رمز التحقق الخاص بك</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

    </style>
</head>
<body>
    <div class="container">
        <p>مرحباً,</p>
        <p>رمز التحقق (OTP) الخاص بك لإعادة تعيين كلمة المرور هو:</p>
        <p class="otp-code">{{ $otp }}</p>
        <p>هذا الرمز صالح لمدة 10 دقائق.</p>
        <p>إذا لم تطلب هذا، فيرجى تجاهل هذا البريد الإلكتروني.</p>
        <p>شكراً لك،</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>
