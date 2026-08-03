@extends('layouts.login')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Accedi al tuo account</h2>

            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form id="sign_in" method="POST" action="{{ route('login') }}" autocomplete="off">
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

                <div class="mb-2">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-flat">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="La tua password" required autocomplete="current-password">
                        <span class="input-group-text">
                            <a href="#" id="toggle-password" class="link-secondary" title="Mostra password"
                                data-bs-toggle="tooltip" onclick="return false;">
                                <i class="ti ti-eye" id="icon-eye"></i>
                                <i class="ti ti-eye-off d-none" id="icon-eye-off"></i>
                            </a>
                        </span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 mt-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="form-check-label">{{ __('Ricordami') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <div>
                            <a href="{{ route('password.request') }}">{{ __('Hai dimenticato la password?') }}</a>
                        </div>
                    @endif
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Accedi') }}</button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="text-center text-muted mt-3">
                    {{ __('Non hai un account?') }} <a href="{{ route('register') }}">{{ __('Registrati ora') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const password = document.getElementById('password');
            const eye = document.getElementById('icon-eye');
            const eyeOff = document.getElementById('icon-eye-off');
            const isHidden = password.type === 'password';

            password.type = isHidden ? 'text' : 'password';
            eye.classList.toggle('d-none', isHidden);
            eyeOff.classList.toggle('d-none', !isHidden);
        });
    </script>
@endsection
