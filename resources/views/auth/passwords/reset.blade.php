@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('settings.text.reset_password') }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open([
                        'action' => 'Auth\ResetPasswordController@reset', 
                        'method' => 'POST', 
                        'class' => 'form-horizontal', 
                        'role' => 'form',
                    ]) !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">
                                {{ trans('settings.label.email_address') }}
                            </label>
                            <div class="col-md-6">
                                {!! Form::email('email', null, [
                                    'class' => 'form-control', 
                                    'id' => 'email', 
                                    'autofocus',
                                    'required',
                                ]) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('settings.label.password') }}</label>

                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'class' => 'form-control', 
                                    'id' => 'password', 
                                    'required',
                                ]) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">
                                {{ trans('settings.label.confirm_password') }}
                            </label>
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control', 
                                    'id' => 'password-confirm', 
                                    'required',
                                ]) !!}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   {!! Form::submit(trans('settings.button.reset_password'), ['class' => 'btn btn-primary']) !!}
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--END: RESET FORM -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
