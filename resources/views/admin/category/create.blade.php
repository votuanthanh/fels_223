@extends('layouts.app')

@section('title')
    {{ trans('settings.title.login') }}
@endsection

@section('content')
<div class="container">
    <div class="header-tablde">
        <div class="page-header">
            <h1>{{ trans('settings.text.manager_category') }}
                <small>{{ trans('settings.text.creat_new_category') }}</small>
            </h1>
        </div>
    </div>
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            {!! Form::open([
                'action' => 'Admin\CategoryController@store',
                'method' => 'POST',
                'class' => 'form-horizontal',
                'role'=>'form',
            ]) !!}
                @include('include.status')
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">
                        {{ trans('settings.label.name') }}
                    </label>

                    <div class="col-md-6">
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'id' => 'name',
                            'autofocus',
                        ]) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">
                        {{ trans('settings.label.description') }}
                    </label>

                    <div class="col-md-6">
                        {!! Form::textarea('description', null, [
                            'class' => 'form-control',
                            'id' => 'description',
                        ]) !!}
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        {!! Form::submit(trans('settings.button.create'), ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('Admin\CategoryController@index') }}" class="btn btn-default">
                            {{ trans('settings.button.back') }}
                        </a>
                    </div>
                </div>
            {!! Form::close() !!}
            <!--END: FORM LOGIN -->
        </div>
    </div>
</div>
@endsection
