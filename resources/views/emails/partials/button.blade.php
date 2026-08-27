{{-- Pulsante di azione condiviso da tutte le email transazionali. Variabili: $url, $label --}}
<table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 24px;">
    <tr>
        <td align="center" style="border-radius:6px; background-color:#4154f1;">
            <a href="{{ $url }}"
                style="display:inline-block; padding:12px 28px; font-size:15px; font-weight:600; color:#ffffff; text-decoration:none;">
                {{ $label }}
            </a>
        </td>
    </tr>
</table>
