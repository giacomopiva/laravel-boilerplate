<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset della password</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6fa; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6fa; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:480px; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.08);">

                    {{-- Logo --}}
                    <tr>
                        <td align="center" style="padding:32px 32px 16px;">
                            <img src="{{ asset('images/logo@2x.png') }}" width="160" alt="{{ config('app.name') }}" style="display:block; max-width:160px; height:auto;">
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:0 32px 32px; color:#1a2540;">
                            <h2 style="margin:0 0 16px; font-size:20px;">Hai dimenticato la password?</h2>

                            <p style="margin:0 0 16px; font-size:15px; line-height:1.5; color:#4a5568;">
                                Abbiamo ricevuto una richiesta di reset della password per il tuo account su
                                <strong>{{ config('app.name') }}</strong>.
                            </p>

                            <p style="margin:0 0 24px; font-size:15px; line-height:1.5; color:#4a5568;">
                                Clicca sul pulsante qui sotto per impostare una nuova password. Il link è valido per
                                {{ config('auth.passwords.users.expire', 60) }} minuti.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 24px;">
                                <tr>
                                    <td align="center" style="border-radius:6px; background-color:#4154f1;">
                                        <a href="{{ route('password.reset', $token) }}"
                                            style="display:inline-block; padding:12px 28px; font-size:15px; font-weight:600; color:#ffffff; text-decoration:none;">
                                            Reset password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0; font-size:13px; line-height:1.5; color:#8a94a6;">
                                Se non hai richiesto tu il reset, ignora pure questa email: la tua password resterà invariata.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:20px 32px; background-color:#f4f6fa; text-align:center; font-size:12px; color:#8a94a6;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
