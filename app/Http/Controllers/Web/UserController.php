<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\User\UserRepository;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', config('settings.user.page'));

        $this->dataView['users'] = $this->userRepository
            ->getUsersInPage($page, config('settings.user.paginate'));
        if ($request->ajax()) {
            return [
                'users' => view('web.user.ajax.index', $this->dataView)->render(),
            ];
        }
        return view('web.user.index', $this->dataView);
    }

    public function ajaxRelationshipUser($idUser)
    {
        $option = $this->userRepository->hanleRelationshipBetweenUser($idUser);
        if (!$option) {
            return response()->json(['status' => config('settings.status.fail')]);
        }
        return response()->json([
            'status' => config('settings.status.success'),
            'option' => $option,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->dataView['user'] = $this->userRepository->find($id);

        if (!$this->dataView['user']) {
            return redirect()->action('Web\UserController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.find_error'));
        }
        return view('web.user.edit', $this->dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UserRequest $request)
    {
        $input = $request->only('name', 'email', 'avatar', 'password');

        if ($this->userRepository->update($input, $id)) {
            return redirect()->back()
                ->with('status', 'success')
                ->with('message', trans('settings.text.user.update_user_successly'));
        }
        return redirect()->back()
            ->with('status', 'danger')
            ->with('message', trans('settings.text.user.update_user_fail'));
    }
}
