@extends('layouts.admin.forgot')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Imposta una nuova password</h2>

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif

            <form id="reset_password" method="POST" action="{{ route('password.update', ['token' => $token]) }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" minlength="6" placeholder="Nuova password" required autofocus>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Conferma password</label>
                    <input id="password_confirmation" type="password" class="form-control"
                        name="password_confirmation" minlength="6" placeholder="Conferma la nuova password" required>
                </div>

                <div class="form-footer">
                    <button class="btn btn-primary w-100" type="submit">{{ __('Resetta la password') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection