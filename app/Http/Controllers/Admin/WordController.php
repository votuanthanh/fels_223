<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Word\WordRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Http\Requests\WordRequest;
use App\Model\Word;
use App\Model\Answer;

class WordController extends BaseController
{
    protected $wordRepository;
    protected $categoryRepository;
    protected $answerRepository;

    public function __construct(
        WordRepository $wordRepository,
        CategoryRepository $categoryRepository,
        AnswerRepository $answerRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {
        $this->dataView['words'] = $this->wordRepository->all();
        return view('admin.word.index', $this->dataView);
    }

    public function create()
    {
        $this->dataView['optionCategory'] = $this->categoryRepository->all()
                ->pluck('name', 'id')
                ->toArray();
        return view('admin.word.create', $this->dataView);
    }

    public function store(WordRequest $request)
    {
        $inputAnswers = $this->answerRepository->getAnswerFromInput($request->get('answer'));
        $inputWords = $request->only('content', 'category');
        $dataAnswers = $this->wordRepository->createWordWithAnswer($inputWords, $inputAnswers);

        if (!$dataAnswers) {
            return back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.process_create_error'));
        }
        return back()
                ->with('status', 'success')
                ->with('message', trans('settings.text.process_create_sucess'));
    }

    public function edit($id, Request $request)
    {
        if ($request->ajax()) {
            $this->dataView['optionCategory'] = $this->categoryRepository->all()
                ->pluck('name', 'id')
                ->toArray();
            $this->dataView['word'] = $this->wordRepository->find($id);

            return view('admin.word.ajax.edit', $this->dataView)->render();
        }
    }

    public function update($id, Request $request)
    {
        $inputWords = [
            'category_id' => $request->get('category'),
            'content' => $request->get('content'),
        ];

        $requestAnswers = $request->get('answer');

        //Delete Answer If have to request
        $this->answerRepository->deleteAnswer($id, $requestAnswers);

        if ($this->answerRepository->updateOrCreateAnser($requestAnswers, $id)
            && $this->wordRepository->update($inputWords, $id)
        ) {
            return back()
                ->with('status', 'success')
                ->with('message', trans('settings.text.process_update_sucess'));
        }

        //redirect if fail
        return back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.process_update_error'));
    }

    public function destroy($id)
    {
        if (!$id) {
            return back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.not_find_word'));
        }

        $word = $this->wordRepository->delete($id);

        if ($word) {
            return back()
                ->with('status', 'success')
                ->with('message', trans('settings.text.word_delete_successfully'));
        }

        return back()
            ->with('status', 'danger')
            ->with('message', trans('settings.text.delete_word_fail'));
    }
}
