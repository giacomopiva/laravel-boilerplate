@extends('layouts.forgot')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Password dimenticata</h2>
            <p class="text-secondary mb-4">
                Inserisci l'indirizzo email usato per la registrazione e ti invieremo una email per effettuare il
                reset della tua password.
            </p>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif

            <form id="forgot_password" method="POST" action="{{ route('password.email') }}" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" placeholder="Il tuo indirizzo email" required
                        autocomplete="email" autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
        <div class="hr-text">o</div>
        <div class="card-body">
            <div class="text-center">
                <a href="{{ route('login') }}" tabindex="-1">{{ __('Torna alla schermata di accesso') }}</a>
            </div>
        </div>
    </div>
@endsection
