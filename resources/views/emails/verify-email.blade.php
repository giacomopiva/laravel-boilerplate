@extends('emails.layout')

@section('title', 'Verifica il tuo indirizzo email')

@section('content')
    <h2 style="margin:0 0 16px; font-size:20px;">Verifica il tuo indirizzo email</h2>

    <p style="margin:0 0 16px; font-size:15px; line-height:1.5; color:#4a5568;">
        Ciao {{ $name }}, grazie per esserti registrato su <strong>{{ config('app.name') }}</strong>.
    </p>

    <p style="margin:0 0 24px; font-size:15px; line-height:1.5; color:#4a5568;">
        Clicca sul pulsante qui sotto per confermare il tuo indirizzo email e attivare l'account.
    </p>

    @include('emails.partials.button', ['url' => $url, 'label' => 'Verifica email'])

    <p style="margin:0; font-size:13px; line-height:1.5; color:#8a94a6;">
        Se non hai creato tu questo account, puoi ignorare questa email.
    </p>
@endsection
