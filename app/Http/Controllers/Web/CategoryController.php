<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends BaseController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $this->dataView['datas'] = $this->categoryRepository->getAllCategoriesWithLeanedWords();
        return view('web.category.index', $this->dataView);
    }
}
