<?php
namespace App\Repositories\Answer;

use Auth;
use App\Repositories\BaseRepository;
use App\Model\Answer;
use App\Model\Word;

class AnswerRepository extends BaseRepository
{
    public function __construct(Answer $answer)
    {
        $this->model = $answer;
    }

    public function getAnswerFromInput($inputs)
    {
        if (!$inputs) {
            return [];
        }

        foreach ($inputs as $key => $value) {
            if (!isset($value['is_correct'])) {
                $inputs[$key]['is_correct'] = config('settings.answer.not_correct_answer');
            }
        }
        return $inputs;
    }

    public function updateOrCreateAnser($inputs, $idWord)
    {
        if (!$inputs || !$idWord) {
            return false;
        }
        $inputAnswers = $this->getAnswerFromInput($inputs);
        foreach ($inputAnswers as $idAnswer => $value) {
            $this->model->updateOrCreate(['word_id' => $idWord, 'id' => $idAnswer], $value);
        }
        return true;
    }

    public function deleteAnswer($id, $requestAnswers)
    {
        $idAnswers = Word::find($id)->answers()->get()->pluck('id')->toArray();
        $idAnswerRequest = array_keys($requestAnswers);

        $idDeleteAnswer = [];

        foreach ($idAnswers as $id) {
            if (!in_array($id, $idAnswerRequest, true)) {
                $idDeleteAnswer[] = $id;
            }
        }
        if (!$idDeleteAnswer) {
            return false;
        }
        return $this->model->whereIn('id', $idDeleteAnswer)->delete();
    }
}
