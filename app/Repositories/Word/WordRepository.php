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

    public function getLearnedWordWithAllCategory()
    {
        $listIdWordLearned = $this->listIdWordLearned();
        return $this->model->whereIn('id', $listIdWordLearned)
            ->with('answers')
            ->orderBy('content', 'asc')
            ->get();
    }

    public function getWordWithCategoryFollowAlpha($collectionWord)
    {
        $data = [];
        if ($collectionWord->isEmpty()) {
            return $data;
        }

        foreach ($collectionWord as $word) {
            $firstCharacter = strtolower($word->content[0]);

            if (!isset($data[$firstCharacter])) {
                $data[$firstCharacter] = [];
            }
            $data[$firstCharacter][] = $word;
        }

        return $data;
    }

    public function getLearnedNotWordWithAllCategory()
    {
        $listIdWordLearned = $this->listIdWordLearned();
        return $this->model->whereNotIn('id', $listIdWordLearned)
            ->with('answers')
            ->orderBy('content', 'asc')
            ->get();
    }

    public function getLearnedNotWordWithCategoryHasTake($idCategory)
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

    public function getLearnedWordsWithCategory($idCategory)
    {
        $listIdWordLearned = $this->listIdWordLearned();
        return $this->model
            ->whereIn('id', $listIdWordLearned)
            ->whereCategoryId($idCategory)
            ->with('answers')
            ->orderBy('content', 'asc')
            ->get();
    }

    public function getLearnedNotWordWithCategory($idCategory)
    {
        $listIdWordLearned = $this->listIdWordLearned();
        return $this->model
            ->whereNotIn('id', $listIdWordLearned)
            ->whereCategoryId($idCategory)
            ->with('answers')
            ->orderBy('content', 'asc')
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
