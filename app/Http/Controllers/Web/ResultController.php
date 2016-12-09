<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonRepository;

class ResultController extends Controller
{
    protected $lessonCategory;

    public function __construct(LessonRepository $lessonCategory)
    {
        $this->lessonCategory = $lessonCategory;
    }

    public function store(Request $request)
    {
        $inputResult = $request->except(['_token', 'idCategory']);
        $idCategory = $request->input('idCategory');
        $collectionResult = $this->lessonCategory->storeLessonOfUser($idCategory, $inputResult);
        $this->dataView['result'] = $this->lessonCategory->getResultOfLesson($collectionResult);
        return view('web.result.index', $this->dataView);
    }
}
