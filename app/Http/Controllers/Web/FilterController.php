<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Word\WordRepository;
use Exception;

class FilterController extends BaseController
{
    protected $categoryRepository;
    protected $wordRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        WordRepository $wordRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->wordRepository = $wordRepository;
    }

    public function filterWords(Request $request)
    {
        $this->dataView['optionCategory'] = $this->categoryRepository->all()
            ->pluck('name', 'id')
            ->toArray();
        $allInput = $request->only(['optCategory', 'rdOption']);
        $optCategoryCurrent = $allInput['optCategory'];
        $radioOptionCurrent = $allInput['rdOption'];

        if (isset($optCategoryCurrent) && isset($radioOptionCurrent)) {
            if ($radioOptionCurrent == config('settings.filter.learned')) {
                $words = $optCategoryCurrent == config('settings.filter.all')
                    ? $this->wordRepository->getLearnedWordWithAllCategory()
                    : $this->wordRepository->getLearnedWordsWithCategory($optCategoryCurrent);
            } else {
                $words = $optCategoryCurrent == config('settings.filter.all')
                    ? $this->wordRepository->getLearnedNotWordWithAllCategory()
                    : $this->wordRepository->getLearnedNotWordWithCategory($optCategoryCurrent);
            }
            $this->dataView['datas'] = $this->wordRepository->getWordWithCategoryFollowAlpha($words);
        }
        $this->dataView['optCategoryCurrent'] = $optCategoryCurrent;
        $this->dataView['radioOptionCurrent'] = $radioOptionCurrent;

        return view('web.filter.index', $this->dataView);
    }
}
