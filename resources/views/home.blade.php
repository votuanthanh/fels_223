@extends('layouts.app')

@section('title')
    {{ trans('settings.title_homepage') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-2 wrapper-information-user">
            <img src="{{ auth()->user()->avatar }}" width="100" width="100" class="img-responsive">
            <p class="text-center" class="name-user">{{ auth()->user()->name }}</p>

            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">{{ $count_word_learned->count() }}</span>
                    {{ trans('settings.text.learned_words') }}
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $count_categories_learned }}</span>
                    {{ trans('settings.text.learned_categories') }}
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $following->count() }}</span>
                    {{ trans('settings.text.learned_followers') }}
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $followers->count() }}</span>
                    {{ trans('settings.text.by_followers') }}
                </li>
            </ul>
        </div>

        <div class="col col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('settings.text.history_activities') }}</div>
                <div class="panel-body">
                    <div class="section-history">
                        @foreach ($datas as $time => $lessons)
                        <p>
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ $time }}
                        </p>
                            <ul>
                                @foreach($lessons as $lesson)
                                <li>
                                    <p>
                                        <span class="label label-info">
                                            {{ $lesson->created_at->format('H:i A') }}
                                        </span>
                                        <span>{{ trans('settings.text.words_learned_category', [
                                            'countWordLearned' => $lesson->answers->count(),
                                            'nameCagory' => $lesson->category->name,
                                        ]) }}
                                        </span>
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
              <!--END BODY PANEL -->
            </div>
        </div>
    </div>
</div>
@endsection
