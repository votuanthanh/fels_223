@extends('layouts.app')

@section('title')
    {{ trans('settings.title.admin_user_index') }}
@endsection

@section('content')
<div class="container">
    @include('include.status')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ trans('settings.text.user.id_user') }}</th>
                <th>{{ trans('settings.text.user.name_user') }}</th>
                <th>{{ trans('settings.text.user.avatar_user') }}</th>
                <th>{{ trans('settings.text.user.email_user') }}</th>
                <th>{{ trans('settings.text.user.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img class="img-responsive" src="{{ $user->avatar }}" width="50" height="50"></td>
                    <td>
                        <ul class="action_admin_with_user">
                            <li>
                                <a class="btn btn-default btn-xs" href="{{ action('Admin\UserController@edit', $user->id) }}">
                                    {{ trans('settings.text.edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-primary btn-xs" href="{{ action('Admin\UserController@show', $user->id ) }}">
                                    {{ trans('settings.text.view') }}
                                </a>
                            </li>
                            <li>
                                @if(! $user->isAdmin())
                                    {!! Form::open(['action' => ['Admin\UserController@destroy', $user->id], 'method' => 'delete']) !!}
                                        {!! Form::button('DELETE', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'onclick' => 'return confirm("' . trans('settings.label.confirm_delete') . '")',
                                            'id' => 'form-delete-user',
                                        ]) !!}
                                    {!! Form::close() !!}
                                @endif
                            </li>
                        </ul>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
