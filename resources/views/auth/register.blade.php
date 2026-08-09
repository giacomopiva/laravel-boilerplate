@extends('layouts.admin.registration')

@section('content')
<form class="card card-md" method="POST" action="{{ route('register') }}" novalidate>
    @csrf

    <div class="card-body">
        <h2 class="card-title text-center mb-4">Crea un nuovo account</h2>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <i class="ti ti-alert-triangle me-2 flex-shrink-0 mt-1"></i>
                    <div>
                        <h4 class="alert-title">Si è verificato un errore</h4>
                        <div class="text-secondary small">{{ $errors->first() }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label" for="register-name">Nome e cognome</label>
            <input type="text" id="register-name" name="name" value="{{ old('name') }}"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                placeholder="Il tuo nome e cognome" autocomplete="name" required>
            @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="register-email">Indirizzo email</label>
            <input type="email" id="register-email" name="email" value="{{ old('email') }}"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                placeholder="La tua email" autocomplete="email" required>
            @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="register-password">Password</label>
            <div class="input-group input-group-flat">
                <input type="password" id="register-password" name="password"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Password" autocomplete="new-password" minlength="6" required>
                <span class="input-group-text">
                    <button type="button" class="link-secondary border-0 bg-transparent p-0"
                        title="Mostra password" aria-label="Mostra password" aria-pressed="false"
                        data-password-toggle="register-password">
                        <i class="ti ti-eye icon-toggle-show"></i>
                        <i class="ti ti-eye-off icon-toggle-hide d-none"></i>
                    </button>
                </span>
            </div>
            @if ($errors->has('password'))
                <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
            @endif
            <small class="form-hint text-secondary">Almeno 6 caratteri.</small>
        </div>

        <div class="mb-3">
            <label class="form-label" for="register-password-confirmation">Conferma password</label>
            <div class="input-group input-group-flat">
                <input type="password" id="register-password-confirmation" name="password_confirmation"
                    class="form-control" placeholder="Ripeti la password" autocomplete="new-password"
                    minlength="6" required>
                <span class="input-group-text">
                    <button type="button" class="link-secondary border-0 bg-transparent p-0"
                        title="Mostra password" aria-label="Mostra password" aria-pressed="false"
                        data-password-toggle="register-password-confirmation">
                        <i class="ti ti-eye icon-toggle-show"></i>
                        <i class="ti ti-eye-off icon-toggle-hide d-none"></i>
                    </button>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" required>
                <span class="form-check-label">Ho letto e accetto i termini d'uso.</span>
            </label>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Crea account</button>
        </div>
    </div>
</form>

<div class="text-center text-secondary mt-3">
    Hai già un account? <a href="{{ route('login') }}">Accedi</a>
</div>
@endsection

@section('script')
<script>
    // Toggle mostra/nascondi password (funziona per entrambi i campi password)
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-password-toggle]');
        if (!btn) return;

        var input = document.getElementById(btn.getAttribute('data-password-toggle'));
        if (!input) return;

        var showing = input.type === 'password';
        input.type = showing ? 'text' : 'password';

        var label = showing ? 'Nascondi password' : 'Mostra password';
        btn.setAttribute('aria-pressed', showing ? 'true' : 'false');
        btn.setAttribute('aria-label', label);
        btn.setAttribute('title', label);
        btn.querySelector('.icon-toggle-show')?.classList.toggle('d-none', showing);
        btn.querySelector('.icon-toggle-hide')?.classList.toggle('d-none', !showing);
    });
</script>
@endsection
