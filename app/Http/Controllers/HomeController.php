<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Word\WordRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\User\UserRepository;
use Auth;

class HomeController extends BaseController
{
    protected $wordRepository;
    protected $categoryRepository;
    protected $lessonRepository;
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        WordRepository $wordRepository,
        CategoryRepository $categoryRepository,
        LessonRepository $lessonRepository,
        UserRepository $userRepository
    ) {
        $this->middleware('auth');
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['count_word_learned'] = $this->wordRepository->getLearnedWordWithAllCategory();
        $this->dataView['count_categories_learned'] = $this->categoryRepository->getCountCategoriesOfLearned();
        $this->dataView['following'] = $this->userRepository->getUserFollowing();
        $this->dataView['followers'] = $this->userRepository->getUserFollowers();
        $this->dataView['datas'] = $this->lessonRepository->getAllLessonOfUser();

        return view('home', $this->dataView);
    }
}
