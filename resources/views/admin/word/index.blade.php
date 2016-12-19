@extends('layouts.app')

@section('title')
    {{ trans('settings.title.admin_user_index') }}
@endsection

@section('content')
<div class="container wrapper-manger-words">
    <div class="header-tablde">
        <div class="page-header">
            <h1>{{ trans('settings.text.manager_word') }}
                <small>{{ trans('settings.text.all_words') }}</small>
            </h1>
        </div>
        <div class="action-word">
            <a href="{{ action('Admin\WordController@create') }}" class="btn btn-success">
                {{ trans('settings.button.add_new') }}
            </a>
            <a href="{{ action('Admin\WordController@index') }}" class="btn btn-default">
                {{ trans('settings.button.back') }}
            </a>
        </div>
    </div>
    @include('include.status')

    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ trans('settings.text.answer.id_answer') }}</th>
                <th>{{ trans('settings.text.answer.content') }}</th>
                <th>{{ trans('settings.text.answer.category') }}</th>
                <th>{{ trans('settings.text.answer.created_at') }}</th>
                <th>{{ trans('settings.text.answer.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($words as $word)
                <tr>
                    <td>{{ $word->id }}</td>
                    <td>{{ $word->content }}</td>
                    <td>{{ $word->category->name }}</td>
                    <td>{{ $word->created_at->format('Y-m-d H:i A') }}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-xs btn-info edit-word" data-toggle="modal"
                            data-url-ajax="{{ action('Admin\WordController@edit', ['id' => $word->id])}}">
                            {{ trans('settings.button.edit') }}
                        </a>
                            {!! Form::open(['action' => ['Admin\WordController@destroy', $word->id], 'method' => 'delete',
                                'class' => 'form-delete-words'
                            ]) !!}
                                {!! Form::button(trans('settings.button.delete'), [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => 'return confirm("' . trans('settings.label.confirm_delete') . '")',
                                ]) !!}
                            {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $words->links() }}
    <div id="wrapper-model"></div>
</div>
@endsection
