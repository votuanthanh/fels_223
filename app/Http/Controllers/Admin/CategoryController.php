<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepository;
use App\Http\Requests\CategoryRequest;

class CategoryController extends BaseController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['categories'] = $this->categoryRepository->allWithPaginate();

        return view('admin.category.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $inputs = $request->only('name', 'description');

        if ($category = $this->categoryRepository->create($inputs)) {
            return redirect()->action('Admin\CategoryController@index')
                ->with('status', 'success')
                ->with('message', trans('settings.text.category.create_category_successfully'));
        }
        return redirect()->action('Admin\CategoryController@index')
            ->with('status', 'danger')
            ->with('message', trans('settings.text.category.create_category_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$id) {
            return redirect()->action('Admin\CategoryController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.category.not_found_category'));
        }
        $this->dataView['category'] = $this->categoryRepository->find($id);
        return view('admin.category.edit', $this->dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if (!$id) {
            return redirect()->action('Admin\CategoryController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.category.not_found_category'));
        }

        $inputs = $request->only('name', 'description');

        if ($this->categoryRepository->update($inputs, $id)) {
            return back()
                ->with('status', 'success')
                ->with('message', trans('settings.text.category.update_category_successfully'));
        }
        return back()
            ->with('status', 'danger')
            ->with('message', trans('settings.text.category.update_category_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$id) {
            return back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.category.not_found_category'));
        }
        if ($this->categoryRepository->delete($id)) {
            return back()
                ->with('status', 'success')
                ->with('message', trans('settings.text.category.delete_category_successfully'));
        }
        return back()
            ->with('status', 'danger')
            ->with('message', trans('settings.text.category.delete_category_fail'));
    }
}
