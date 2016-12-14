@extends('layouts.app')

@section('title')
    {{ trans('settings.title_homepage') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{ trans('settings.text.filter_words') }}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col col-md-8 col-md-offset-3">
                            {!! Form::open([
                                'action' => 'Web\FilterController@filterWords',
                                'method' => 'POST',
                                'class' => 'form-inline',
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::select('optCategory',
                                        ['all' => trans('settings.text.all_category')] + $optionCategory,
                                        $optCategoryCurrent,
                                        ['class' => 'form-control col-md-6']
                                    ) !!}
                                </div>

                                <div class="form-group group-radio">
                                    <label class="checkbox-inline">
                                        {!! Form::radio('rdOption', config('settings.filter.no_learned'),
                                            $radioOptionCurrent == config('settings.filter.no_learned') ? true : null)
                                        !!} {{ trans('settings.text.no_learned') }}
                                    </label>
                                    <label class="checkbox-inline">
                                        {!! Form::radio('rdOption', config('settings.filter.learned'),
                                            $radioOptionCurrent == config('settings.filter.learned') ? true : null )
                                        !!} {{ trans('settings.text.learned') }}
                                    </label>
                                </div>
                                {!! Form::submit(trans('settings.text.filter'), [
                                    'class' => 'btn btn-default form-control',
                                ]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
              <!--END BODY PANEL -->
            </div>

            <div class="panel panel-default word-list">
                <div class="panel-body">
                    <h2 class="text-center">{{ trans('settings.text.result') }}</h2>
                    <div class="row">
                        <div class="col col-md-10 col-md-offset-1">
                            @include('include.status')
                            @if (isset($datas) && $datas)
                                <ol class="section-filter-words">
                                    @foreach($datas as $alpha => $words)
                                        <div class="section-alpha">
                                            <h1>{{ strtoupper($alpha) }}</h1>
                                            @foreach($words as $word)
                                                <li>
                                                    <p class="word-show">
                                                        {{ $word->content }}
                                                        @foreach($word->answers as $answer)
                                                            @if ($answer->is_correct)
                                                                <span class="answer-show">{{ $answer->content }}</span>
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                </li>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </ol>
                            @else
                                <h5 class="text-center text-danger">{{ trans('settings.text.word_not_found') }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
