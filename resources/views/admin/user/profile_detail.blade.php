@extends('layouts.app')

@section('title')
    {{ trans('settings.title.admin_user_profile') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="{{ $user->avatar }}" class="img-thumbnail">
                    <div class="list-group">
                        <div class="list-group-item">{{ trans('settings.text.user.email_user') }}: {{ $user->name }}</div>
                        <div class="list-group-item">{{{ trans('settings.text.user.name_user') }}: {{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
