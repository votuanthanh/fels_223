@extends('layouts.app')

@section('title')
    {{ trans('settings.title.login') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('settings.button.login') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'action' => 'Auth\LoginController@login', 
                        'method' => 'POST', 
                        'class' => 'form-horizontal', 
                        'role'=>'form',
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
                                ]) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">
                                {{ trans('settings.label.password') }}
                            </label>

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('settings.label.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit(trans('settings.button.login'), ['class' => 'btn btn-primary']) !!}
                                <a class="btn btn-link" href="{{ action('Auth\ForgotPasswordController@showLinkRequestForm') }}">
                                    {{ trans('settings.button.forgot_password') }}
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--END: FORM LOGIN -->
                    <div class="wrapper-social">
                        <div class="row">
                            <div class="col col-md-4">
                                <a class="btn" href="#"><i class="fa fa-facebook"></i>{{ trans('settings.text.social.google') }}</a>
                            </div>
                            <div class="col col-md-4">
                                <a class="btn" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i>{{ trans('settings.text.social.facebook') }}</a>
                            </div>
                            <div class="col col-md-4">
                                <a class="btn" href="#"><i class="fa fa-twitter" aria-hidden="true"></i>{{ trans('settings.text.social.twister') }}</a>
                            </div>
                        </div> 
                    </div>
                    <!--END: wrapper-social -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
