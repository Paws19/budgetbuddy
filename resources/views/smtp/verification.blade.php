<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your BudgetBuddy verification code</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
</head>

<body
    style="margin:0; padding:0; background-color:#F0F7F5; font-family:'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#0F1C2E;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
        style="background-color:#F0F7F5; padding:48px 16px;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                    style="max-width:460px; background-color:#FFFFFF; border-radius:28px; border:1px solid #DCEAE6; box-shadow:0 12px 40px rgba(15,28,46,0.06); overflow:hidden;">

                    <!-- Top teal bar -->
                    <tr>
                        <td style="height:5px; background:linear-gradient(90deg,#00C4A7 0%,#00D4B5 100%);"></td>
                    </tr>

                    <!-- Brand -->
                    <tr>
                        <td style="padding:40px 40px 8px 40px; text-align:center;">
                            <img src="{{ $message->embed(public_path('img/logo.png')) }}" alt="BudgetBuddy"
                                width="110" style="display:block; margin:0 auto 14px auto; height:auto;">
                            <p
                                style="margin:0; font-family:'Nunito','Inter',Arial,sans-serif; font-size:12px; font-weight:700; letter-spacing:0.12em; color:#00A88E; text-transform:uppercase;">
                                BudgetBuddy
                            </p>
                        </td>
                    </tr>

                    <!-- Main content -->
                    <tr>
                        <td style="padding:24px 40px 40px 40px; text-align:center;">

                            <h1
                                style="margin:0 0 12px 0; font-family:'Nunito','Inter',Arial,sans-serif; font-size:28px; font-weight:800; color:#1A2B4A; line-height:1.2; letter-spacing:-0.03em;">
                                One quick step left
                            </h1>

                            <p style="margin:0 0 36px 0; font-size:15.5px; line-height:1.65; color:#5A6A7A;">
                                Here’s your verification code.<br>
                                Enter it to finish creating your account.
                            </p>

                            <!-- The Code -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                style="margin:0 auto 28px auto;">
                                <tr>
                                    <td
                                        style="background-color:#F2FAF8; border:1.5px solid #C5E8DF; border-radius:18px; padding:22px 48px;">
                                        <span
                                            style="font-family:'Nunito','Inter',Arial,sans-serif; font-size:36px; font-weight:800; letter-spacing:12px; color:#00C4A7; line-height:1;">
                                            {{ $code }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 6px 0; font-size:14px; color:#5A6A7A;">
                                This code expires in <strong style="color:#0F1C2E;">10 minutes</strong>
                            </p>
                            <p style="margin:0; font-size:13px; color:#8A9AAB;">
                                Didn’t request this email? You can safely ignore it.
                            </p>

                        </td>
                    </tr>

                    <!-- Soft footer -->
                    <tr>
                        <td
                            style="background-color:#F7FBFA; border-top:1px solid #E8F3F0; padding:24px 40px; text-align:center;">
                            <p style="margin:0 0 4px 0; font-size:13px; color:#5A6A7A;">
                                Questions? Just reply to this email — we’re happy to help.
                            </p>
                            <p style="margin:0; font-size:12px; color:#8A9AAB;">
                                © 2026 BudgetBuddy
                            </p>
                        </td>
                    </tr>

                </table>

                <!-- Tiny bottom text -->
                <p
                    style="margin:28px 0 0 0; font-size:12px; color:#8A9AAB; text-align:center; max-width:360px; line-height:1.5;">
                    You’re receiving this because someone started signing up with this email address.
                </p>

            </td>
        </tr>
    </table>

</body>

</html>
