@extends('layouts.app')

@section('title')
    {{ trans('settings.title.admin_user_index') }}
@endsection

@section('content')
<div class="container">
    <div class="header-tablde">
        <div class="page-header">
            <h1>{{ trans('settings.text.manager_word') }}
                <small>{{ trans('settings.text.all_words') }}</small>
            </h1>
        </div>
        <div class="action-word">
            <a href="{{ action('Admin\CategoryController@create') }}" class="btn btn-success">
                {{ trans('settings.button.add_new') }}
            </a>
            <a href="{{ action('HomeController@index') }}" class="btn btn-default">
                {{ trans('settings.button.back') }}
            </a>
        </div>
    </div>
    @include('include.status')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ trans('settings.text.category.id_category') }}</th>
                <th>{{ trans('settings.text.category.name') }}</th>
                <th>{{ trans('settings.text.category.description') }}</th>
                <th>{{ trans('settings.text.category.count_words') }}</th>
                <th>{{ trans('settings.text.category.created_at') }}</th>
                <th>{{ trans('settings.text.category.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->words->count() }}</td>
                    <td>{{ $category->created_at->format('Y-m-d H:i A') }}</td>
                    <td>
                        <ul class="action_admin_with_user">
                            <li>
                                <a class="btn btn-default btn-xs" href="{{ action('Admin\CategoryController@edit', $category->id) }}">
                                    {{ trans('settings.text.edit') }}
                                </a>
                            </li>
                            <li>
                                {!! Form::open(['action' =>
                                    ['Admin\CategoryController@destroy', $category->id],
                                    'method' => 'delete'])
                                !!}
                                    {!! Form::button(trans('settings.button.delete'), [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'onclick' => 'return confirm("' . trans('settings.label.confirm_delete') . '")',
                                    ]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
