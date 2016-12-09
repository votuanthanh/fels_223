<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Model\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCountCategoriesOfLearned()
    {
        return $this->getCurrentUser()->categories()->get()->count();
    }

    public function getAllCategoriesWithLeanedWords()
    {
        $categories = $this->model->all()
            ->load(['answers' => function ($query) {
                $query->whereIsCorrect(config('settings.answer.is_correct_answer'));
            }])
            ->load('words');
        foreach ($categories as $key => $category) {
            $data[$key]['category'] = $category;
            $idWord = [];
            foreach ($category->answers as $answer) {
                $idWord[] = $answer->word_id;
            }
            $countWordsLearned = count(array_unique($idWord));
            $data[$key]['countWordsLearned'] = $countWordsLearned;
        }
        return $data;
    }
}
