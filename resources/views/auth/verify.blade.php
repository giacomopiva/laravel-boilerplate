@extends('layouts.admin.verify-email')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Verifica il tuo indirizzo email</h2>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    Ti abbiamo inviato una nuova email di verifica.
                </div>
            @endif

            <p class="text-secondary mb-4">
                Prima di procedere, controlla la tua casella di posta: ti abbiamo inviato un link di verifica.
                Se non hai ricevuto l'email, puoi richiederne una nuova.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Invia di nuovo l'email di verifica</button>
                </div>
            </form>
        </div>
    </div>
@endsection
