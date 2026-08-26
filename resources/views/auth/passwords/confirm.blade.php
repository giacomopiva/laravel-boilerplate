@extends('layouts.admin.confirm-password')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Conferma la password</h2>
            <p class="text-secondary mb-4">
                Per procedere ti chiediamo di confermare la tua password.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="La tua password" required autocomplete="current-password"
                        autofocus>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Conferma password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
