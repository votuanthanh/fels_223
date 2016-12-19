@extends('layouts.app')

@section('title')
    {{ trans('settings.title.admin_user_index') }}
@endsection

@section('content')

<div class="container wrapper-manger-words">
    <div class="header-tablde">
        <div class="page-header">
            <h1>{{ trans('settings.text.manager_word') }}
                <small>{{ trans('settings.text.creat_new_word') }}</small>
            </h1>
        </div>
        <div class="action-word">
            <a href="#" class="btn btn-success">{{ trans('settings.button.add_new') }}</a>
            <a href="{{ action('Admin\WordController@index') }}" class="btn btn-default">
                {{ trans('settings.button.back') }}
            </a>
        </div>
    </div>
    @include('include.status')
    <div class="row">
        <div class="col col-md-8 col-md-offset-2">
            {!! Form::open([
                'action' => 'Admin\WordController@store',
                'method' => 'POST',
                'class' => 'form-horizontal',
                'id' => 'form-create-words'
            ]) !!}
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="word" class="col-sm-2 control-label">
                        {{ trans('settings.label.category') }}
                    </label>
                    <div class="col-sm-10'">
                        {!! Form::select('category',
                            ['default' => trans('settings.text.select_category_default')] + $optionCategory,
                            null, ['class' => 'form-control']
                        ) !!}
                    </div>
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content" class="col-sm-2 control-label">
                        {{ trans('settings.label.word') }}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('content', null, [
                            'class' => 'form-control',
                            'autofocus',
                        ]) !!}
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="group-answer">
                    @for($i=0; $i < config('settings.answer.number_choice'); $i++)
                        <div class="form-group{{ $errors->has('answer.' . $i . '.content') ? ' has-error' : '' }}">
                            <label for="answer" class="col-sm-2 control-label">
                                {{ trans('settings.label.answer') }}
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('answer[' . $i . '][content]', null, [
                                    'class' => 'form-control',
                                    'autofocus',
                                ]) !!}
                                <span class="glyphicon glyphicon-trash form-control-feedback delete-answer"></span>
                                <input type="checkbox" name="answer[{{ $i }}][is_correct]"
                                    value="{{ config('settings.answer.is_correct_answer') }}">
                            </div>
                        </div>
                    @endfor
                </div>
                {!! Form::submit(trans('settings.button.create'), [
                    'class' => 'btn btn-primary col-sm-offset-5',
                ]) !!}
                <a href="javascript:void(0)" id="add-answer" class="btn btn-default">
                    {{ trans('settings.button.add_answer') }}
                </a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
