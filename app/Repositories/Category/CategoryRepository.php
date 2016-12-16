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
        return $this->getCurrentUser()->categories()->get()->unique()->count();
    }

    public function allCategoriesWithCorrectWord($countWordCorrectEachCategory)
    {
        $categories = $this->model->all()->load('words');
        foreach ($categories as $category) {
            $data[] = [
                'category' => $category,
                'countCorrectWord' => array_key_exists($category->id, $countWordCorrectEachCategory)
                    ? $countWordCorrectEachCategory[$category->id]
                    : 0,
            ];
        }

        return $data;
    }
}
