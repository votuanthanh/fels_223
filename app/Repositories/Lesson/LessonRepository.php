<?php
namespace App\Repositories\Lesson;

use Auth;
use App\Repositories\BaseRepository;
use App\Model\Lesson;
use Exception;

class LessonRepository extends BaseRepository
{
    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }

    public function getAllLessonOfUser()
    {
        $lessons = $this->model
            ->with(['answers' => function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            } ])
            ->with('category')
            ->whereUserId($this->getCurrentUser()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($lessons as $key => $lesson) {
            $indexTimeFormat = $lesson->created_at->format('Y-m-d');
            if (!isset($data[$indexTimeFormat])) {
                $data[$indexTimeFormat] = [];
            }
            $data[$indexTimeFormat][] = $lesson;
        }
        return $data;
    }

    public function storeLessonOfUser($idCategory, $dataResult)
    {
        if (!$idCategory || !$dataResult) {
            throw new Exception(trans('settings.text.find_error'));
        }
        $inputs = [
            'category_id' => $idCategory,
            'user_id' => $this->getCurrentUser()->id,
        ];

        $keyResult = 0;
        foreach ($dataResult as $idWord => $idAnswer) {
            $data[] = [
                'word_id' => $idWord,
                'category_id' => $idCategory,
                'answer_id' => $idAnswer,
            ];
            $keyResult++;
        }

        return $this->model->create($inputs)
            ->results()
            ->createMany($data);
    }

    public function getResultOfLesson($collectionResult)
    {
        $mark = 0;
        foreach ($collectionResult as $result) {
            if ($result->answer->is_correct == 1) {
                $mark++;
            }
        }
        $data['countIsCorrectWord'] = $mark;

        $dataResultCurrent = current($collectionResult);
        $idLessonCurrent = $dataResultCurrent->lesson_id;
        $words = $this->model->find($idLessonCurrent)->words()->get();
        $data['countWordOfLesson'] = $words->count();

        if ($words) {
            $words->load('answers');
            foreach ($words as $word) {
                $data['datas'][] = [
                    'word' => $word,
                    'id_answer_choiced' => $dataResultCurrent->answer_id,
                ];
                $dataResultCurrent = next($collectionResult);

            }
        }
        return $data;
    }
}
