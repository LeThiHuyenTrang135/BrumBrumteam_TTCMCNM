<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <title>Email Verification | EShop eCommerce</title>
</head>

<body
    style="background-color: #e7eff8; font-family: trebuchet,sans-serif; margin-top: 0; box-sizing: border-box; line-height: 1.5;">
    <div class="container-fluid">
        <div class="container" style="background-color: #e7eff8; width: 600px; margin: auto;">
            <div class="col-12 mx-auto" style="width: 580px;  margin: 0 auto;">

                <div class="row">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #e7eff8; height: 10px;">

                        </div>
                    </div>
                </div>

                <div class="row"
                    style="height: 100px; padding: 10px 20px; line-height: 90px; background-color: white; box-sizing: border-box;">
                    <h1 class="pl-2"
                        style="color: orange; line-height: 30px; float: left; padding-left: 20px; font-size: 40px; font-weight: 500;">
                        EShop eCommerce
                    </h1>
                </div>

                <div class="row" style="background-color: #00509d; height: 180px; padding: 35px; color: white;">
                    <div class="container-fluid">
                        <h3 class="m-0 p-0 mt-4" style="margin-top: 0; font-size: 28px; font-weight: 500;">
                            <strong style="font-size: 32px;">Email Verification</strong>
                            <br>
                            Welcome to EShop eCommerce
                        </h3>
                        <div class="row mt-5" style="margin-top: 35px; display: flex;">
                            @if ($userName)
                                <div class="col-12"
                                    style="margin-bottom: 25px; flex: 0 0 100%; width: 100%; box-sizing: border-box;">
                                    <b>Hello {{ $userName }},</b>
                                    <br>
                                    <span>Thank you for registering! Please use the verification code below to verify
                                        your email address.</span>
                                </div>
                            @else
                                <div class="col-12"
                                    style="margin-bottom: 25px; flex: 0 0 100%; width: 100%; box-sizing: border-box;">
                                    <b>Hello,</b>
                                    <br>
                                    <span>Thank you for registering! Please use the verification code below to verify
                                        your email address.</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-2 p-4"
                    style="background-color: white; margin-top: 15px; padding: 20px; text-align: center;">
                    <div style="margin: 20px 0;">
                        <div
                            style="background: #fff; border: 2px dashed #4CAF50; border-radius: 5px; padding: 30px; display: inline-block;">
                            <div
                                style="font-size: 42px; font-weight: bold; color: #4CAF50; letter-spacing: 8px; font-family: monospace;">
                                {{ $code }}
                            </div>
                        </div>
                    </div>

                    <div
                        style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; text-align: left;">
                        <strong style="color: #856404;">Important:</strong>
                        <ul style="margin: 10px 0; padding-left: 20px; color: #856404;">
                            <li>This code will expire in <strong>10 minutes</strong></li>
                            <li>Do not share this code with anyone</li>
                            <li>If you didn't request this, please ignore this email</li>
                        </ul>
                    </div>
                </div>

                <div class="row mt-2" style="margin-top: 15px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b>Verification Instructions</b>
                        </div>
                        <div class="row pl-3 py-2" style="background-color: #fff; padding: 20px;">
                            <p>To complete your email verification:</p>
                            <ol style="margin: 10px 0; padding-left: 20px;">
                                <li>Copy the verification code above</li>
                                <li>Go back to the verification page on our website</li>
                                <li>Paste or enter the code in the verification field</li>
                                <li>Click "Verify Email" to complete the process</li>
                            </ol>

                            <p>If you encounter any issues with the verification code, you can request a new one from
                                your account settings.</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-2 mb-4" style="margin-top: 15px; margin-bottom: 25px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b style="color: #00509d; font-size: 18px;">Need Help?</b>
                        </div>
                        <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px;">
                            <p>If you have any questions or need assistance with the verification process, please don't
                                hesitate to contact our support team.</p>

                            <p>You can reach us through:</p>
                            <ul style="margin: 10px 0; padding-left: 20px;">
                                <li>Email: BrumBrum@gmail.com</li>
                                <li>Hotline: +84 123 456 789 (8:00 - 9:00 both Saturday and Sunday)</li>
                            </ul>

                            <p>For security reasons, please do not reply to this email. This is an automated message.
                            </p>

                            <b>Best regards,<br>EShop eCommerce Team</b>
                        </div>
                    </div>
                </div>

                <div class="row"
                    style="background-color: #f4f8fd; padding: 20px; text-align: center; color: #666; font-size: 12px;">
                    <p style="margin: 0;">© {{ date('Y') }} Brum Brum EShop eCommerce. All rights reserved.</p>
                    <p style="margin: 5px 0 0 0;">This is an automated email, please do not reply.</p>
                </div>

                <div class="row">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #e7eff8; height: 10px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
