<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Word\WordRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Lesson\LessonRepository;

class LessonController extends BaseController
{
    protected $wordRepository;
    protected $userRepository;
    protected $lessonRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        WordRepository $wordRepository,
        UserRepository $userRepository,
        lessonRepository $lessonRepository
    ) {
        $this->middleware('auth');
        $this->wordRepository = $wordRepository;
        $this->userRepository = $userRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index($idCategory)
    {
        $this->dataView['idCategory'] = $idCategory;
        $this->dataView['words'] = $this->wordRepository->getLearnedNotWordWithCategoryHasTake($idCategory);
        return view('web.lesson.index', $this->dataView);
    }
}
