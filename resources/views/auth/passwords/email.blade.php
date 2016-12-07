@extends('layouts.app')

@section('title')
    {{ trans('settings.title.reset_email') }}
@endsection

<!-- Main Content -->
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
                        'action' => 'Auth\ForgotPasswordController@sendResetLinkEmail', 
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('settings.button.reset_password'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--END: RESET PASSWORD FORM -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
