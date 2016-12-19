<!-- Modal -->
<div class="modal fade" id="word-edit-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ trans('settings.text.edit_word') }}</h4>
            </div>
            <div class="modal-body ctz-body">
                {!! Form::model($word, [
                    'action' => ['Admin\WordController@update', $word->id],
                    'method' => 'PATCH',
                    'class' => 'form-horizontal ctz-form',
                    'id' => 'form-create-words',
                ]) !!}
                    <div class="form-group">
                        <label for="word" class="col-sm-2 control-label">
                            {{ trans('settings.label.category') }}
                        </label>
                        <div class="col-sm-10'">
                            {!! Form::select('category', $optionCategory, $word->category_id, ['class' => 'form-control']
                            ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="word" class="col-sm-2 control-label">
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
                        @foreach($word->answers as $answer)
                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                <label for="answer" class="col-sm-2 control-label">
                                    {{ trans('settings.label.answer') }}
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('answer['.$answer->id.'][content]', $answer->content, [
                                        'class' => 'form-control',
                                        'autofocus',
                                    ]) !!}
                                    @if ($errors->has('answer'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('answer') }}</strong>
                                        </span>
                                    @endif
                                    <span class="glyphicon glyphicon-trash form-control-feedback delete-answer"></span>
                                    <input type="checkbox" name="answer[{{ $answer->id }}][is_correct]"
                                        value="{{ config('settings.answer.is_correct_answer') }}"
                                        {{ $answer->isChecked() }}>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="javascript:void(0)" id="add-answer" class="btn btn-default col-sm-offset-5">
                        {{ trans('settings.button.add_answer') }}
                    </a>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{ trans('settings.button.close') }}
                </button>
                <button class="btn btn-primary action-edit-words">
                    {{ trans('settings.button.save_changes') }}
                </button>
            </div>
        </div>
    </div>
</div>
