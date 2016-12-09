@extends('layouts.app')

@section('title')
    {{ trans('settings.title_homepage') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">{{ trans('settings.text.list_categories') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'action' => 'Web\ResultController@store',
                        'method' => 'POST',
                        'role' => 'form',
                        'id' => 'form-logout',
                    ]) !!}
                        {!! Form::hidden('idCategory', $idCategory) !!}
                        @foreach ($words as $key => $word)
                        <div class="section-words">
                            <h4>{{ $key + 1 }}. {{ $word->content }}</h4>
                            <div class="section-answer">
                                @foreach ($word->answers as $answer)
                                <div class="radio">
                                    <label>
                                        {!! Form::radio($word->id, $answer->id) !!}
                                        {{ $answer->content }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        {!! Form::submit('Check', ['class' => 'btn btn-primany']) !!}
                    {!! Form::close() !!}
                </div>
              <!--END BODY PANEL -->
            </div>
        </div>
    </div>
</div>
@endsection
