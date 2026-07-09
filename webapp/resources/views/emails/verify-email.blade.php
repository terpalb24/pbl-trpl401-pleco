<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLECO | Atur Ulang Kata Sandi Anda</title>
</head>

<body
    style="background-color: #EEF0FC; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; margin: 0; padding: 0; width: 100%;">

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="background-color: #EEF0FC; table-layout: fixed; border-collapse: collapse; margin: 0; padding: 0;">
        <tr>
            <td align="center" style="padding: 40px 16px;">

                <div style="max-width: 450px; width: 100%; text-align: center; margin: 0 auto;">

                    <div style="margin-bottom: 32px;">
                        <img src="{{ asset('images/logo_text_black.png') }}" alt="PLECO"
                            style="height: 20px; max-height: 20px; display: block; margin: 0 auto; border: 0; object-fit: contain;">
                    </div>

                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="background-color: #ffffff; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-collapse: collapse; margin-bottom: 24px;">
                        <tr>
                            <td style="padding: 32px; text-align: center;">

                                <div style="margin-bottom: 24px;">
                                    <img src="{{ asset('images/forgot-password-img.png') }}"
                                        alt="Ilustrasi Atur Ulang Kata Sandi" width="192"
                                        style="width: 192px; max-width: 100%; display: block; margin: 0 auto; border: 0; object-fit: contain;">
                                </div>

                                <h1
                                    style="color: #0D0D0D; font-size: 20px; font-weight: bold; letter-spacing: 0.5px; margin: 0 0 8px 0; padding: 0;">
                                    Atur Ulang Kata Sandi Anda
                                </h1>

                                <p
                                    style="color: #595959; font-size: 14px; line-height: 1.6; margin: 0 0 24px 0; padding: 0;">
                                    Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda di <span
                                        style="font-weight: bold;">Website PLECO</span>. Silakan klik tombol di bawah
                                    ini untuk melanjutkan pembaruan kata sandi anda.
                                </p>

                                <p style="color: #595959; font-size: 12px; margin: 0; padding: 0;">
                                    Tautan ini hanya berlaku selama <span style="font-weight: bold;">1 menit</span>.
                                </p>

                            </td>
                        </tr>
                    </table>

                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="border-collapse: collapse;">
                        <tr>
                            <td style="padding: 0 16px; text-align: center;">

                                <div style="margin-bottom: 20px;">
                                    <a href="{{ $url }}"
                                        style="background-color: #2D2CD1; color: #ffffff; font-size: 14px; font-weight: 500; text-decoration: none; padding: 10px 24px; border-radius: 6px; display: inline-block; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                        Ganti Sandi
                                    </a>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <a href="{{ $url }}"
                                        style="color: #2D2CD1; font-size: 12px; text-decoration: underline; word-break: break-all; display: inline-block; max-width: 100%;">
                                        {{ $url }}
                                    </a>
                                </div>

                                <p
                                    style="color: #595959; font-size: 14px; line-height: 1.5; max-width: 320px; margin: 0 auto; padding: 0;">
                                    Jika Anda tidak melakukan permintaan ini, silakan abaikan email ini.
                                </p>

                            </td>
                        </tr>
                    </table>

                </div>

            </td>
        </tr>
    </table>

</body>

</html>
