@extends('layouts.app')

@section('title')
    {{ trans('settings.title_homepage') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">{{ trans('settings.text.user.list_users') }}</div>
                <div class="panel-body">
                    <div class="row section-user">
                        @include('web.user.ajax.index')
                    </div>
                    <div class="loading text-center">
                        <img src="{{ asset('images/loading.gif') }}">
                    </div>
                    <!-- END: ROW-->
                </div>
              <!--END BODY PANEL -->
            </div>
        </div>
    </div>
</div>
@endsection
