@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Gestione Utenti
            <small>Crea un nuovo utente</small>
        </h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2><i class="material-icons">edit</i>Crea nuovo utente</h2>
                </div>
                <div class="body">

                    @if ($errors->any())
                        <div id="errors-container" class="alert alert-danger">
                            <span>Si sono verificati degli errori, per favore controlla e correggi</span>
                            @php /*<ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ ucfirst($error) }}</li>
                                @endforeach
                            </ul>*/ @endphp
                        </div>
                    @endif
            
                    <form action="{{ URL::action([App\Http\Controllers\Admin\UserController::class, 'store']) }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="nome">Nome<span class="required">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line {{ $errors->has('name') ? 'error' : '' }}">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') ?? '' }}" maxlength="255">
                                            </div>
                                            @if ($errors->has('name'))
                                                <label class="error">{{ $errors->first('name') }}</label>
                                            @endif                                                    
                                            <div class="help-info">Nome utente</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="email">Email<span class="required">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line {{ $errors->has('email') ? 'error' : '' }}">
                                                <input type="text" class="form-control" name="email" value="{{ old('email') ?? '' }}" maxlength="255">
                                            </div>
                                            @if ($errors->has('email'))
                                                <label class="error">{{ $errors->first('email') }}</label>
                                            @endif        
                                            <div class="help-info">Email utente</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="email">Password<span class="required">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line {{ $errors->has('password') ? 'error' : '' }}">
                                                <input type="password" class="form-control" name="password" value="{{ old('password') ?? '' }}" maxlength="255">
                                            </div>
                                            @if ($errors->has('password'))
                                                <label class="error">{{ $errors->first('password') }}</label>
                                            @endif
                                            <div class="help-info">Password utente</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <x-admin.select :name="'role'" 
                                                            :options="$roles" 
                                                            :label="'Ruolo'" 
                                                            :description="'Ruolo dell utente'" 
                                                            :required="true" />
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect">
                                        <i class="material-icons">done</i>
                                        <span>Salva</span>
                                    </button>
                                    
                                    <a href="{{ route('admin.users.index') }}" class="btn waves-effect btn-default ml-2">
                                        <i class="material-icons">undo</i><span>Indietro</span></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
