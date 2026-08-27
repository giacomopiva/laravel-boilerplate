@extends('emails.layout')

@section('title', 'Reset della password')

@section('content')
    <h2 style="margin:0 0 16px; font-size:20px;">Hai dimenticato la password?</h2>

    <p style="margin:0 0 16px; font-size:15px; line-height:1.5; color:#4a5568;">
        Abbiamo ricevuto una richiesta di reset della password per il tuo account su
        <strong>{{ config('app.name') }}</strong>.
    </p>

    <p style="margin:0 0 24px; font-size:15px; line-height:1.5; color:#4a5568;">
        Clicca sul pulsante qui sotto per impostare una nuova password. Il link è valido per
        {{ config('auth.passwords.users.expire', 60) }} minuti.
    </p>

    @include('emails.partials.button', ['url' => route('password.reset', $token), 'label' => 'Reset password'])

    <p style="margin:0; font-size:13px; line-height:1.5; color:#8a94a6;">
        Se non hai richiesto tu il reset, ignora pure questa email: la tua password resterà invariata.
    </p>
@endsection
