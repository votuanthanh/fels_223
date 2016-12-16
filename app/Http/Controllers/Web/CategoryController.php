<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Word\WordRepository;

class CategoryController extends BaseController
{
    protected $categoryRepository;
    protected $wordRepository;

    public function __construct(CategoryRepository $categoryRepository, WordRepository $wordRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->wordRepository = $wordRepository;
    }

    public function index()
    {
        $countWordCorrectEachCategory = $this->wordRepository->countWordCorrectEachCategory();
        $this->dataView['datas'] = $this->categoryRepository
            ->allCategoriesWithCorrectWord($countWordCorrectEachCategory);

        return view('web.category.index', $this->dataView);
    }
}
