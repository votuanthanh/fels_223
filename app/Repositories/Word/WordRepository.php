<?php
namespace App\Repositories\Word;

use Auth;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Model\Word;
use App\Model\Category;
use App\Model\Result;
use App\Model\Answer;
use App\Model\Lesson;

class WordRepository extends BaseRepository
{
    public function __construct(Word $word)
    {
        $this->model = $word;
    }

    public function getLeanredWordWithAllCategory()
    {
        $listIdWordLearned = $this->listIdWordLearned();
        return $this->model->whereIn('id', $listIdWordLearned)->get();
    }

    public function getLeanredNotWordWithAllCategory()
    {
        $listIdWordLearned = $this->listIdWordLearned();
        return $this->model->whereNotIn('id', $listIdWordLearned)->get();
    }

    public function getLeanredNotWordWithCategory($idCategory)
    {
        $listIdWordLearned = $this->listIdWordLearned();
            return $this->model
                ->whereNotIn('id', $listIdWordLearned)
                ->whereCategoryId($idCategory)
                ->inRandomOrder()
                ->with('answers')
                ->take(config('settings.limit_words_random'))
                ->get();
    }

    public function listIdWordLearned()
    {
        $allLesson = $this->getCurrentUser()
            ->lessons()
            ->whereHas('answers', function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            })
            ->get()
            ->load(['answers' => function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            }]);
        foreach ($allLesson as $lesson) {
            foreach ($lesson->answers as $answer) {
                $idWord[] = $answer->word_id;
            }
        }
        if (empty($idWord)) {
            return false;
        }
        return array_unique($idWord);
    }
}
