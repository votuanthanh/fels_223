@extends('layouts.app')

@section('title')
    {{ trans('settings.title_homepage') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{ trans('settings.text.list_categories') }}</div>
                <div class="panel-body">
                    @foreach ($datas as $data)
                    <div class="secction-category">
                        <div class="row">
                            <div class="col col-md-10">
                                @if ($data['countWordsLearned'] != $data['category']->words->count())
                                    <h4>
                                        <span class="label label-info">{{ $data['category']->name }}</span>
                                        <span>You have leaned {{ $data['countWordsLearned'] }}/{{ $data['category']->words->count() }}</span>
                                    </h4>
                                    <p><em>{{ $data['category']->description }}</em></p>
                                @else
                                    <h4>
                                        <span class="label label-success">
                                            {{ $data['category']->name }}
                                        </span>
                                        <span>You have leaned {{ $data['countWordsLearned'] }}/{{ $data['category']->words->count() }}</span>
                                        <span><b>&#9001;completed&#9002;</b></span>
                                    </h4>
                                    <p><em>{{ $data['category']->description }}</em></p>
                                @endif
                            </div>
                            <div class="col col-md-2">
                                <a class="btn btn-primary" href="{{ action('Web\LessonController@index', [$data['category']->id]) }}" class="pull-left">{{ trans('settings.text.start') }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              <!--END BODY PANEL -->
            </div>
        </div>
    </div>
</div>
@endsection
