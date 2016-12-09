<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->paginate(config('settings.user.paginate'));

        return view('admin.user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->action('Admin\UserController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.find_error'));
        }
        return view('admin.user.profile_detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->action('Admin\UserController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.find_error'));
        }
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $input = $request->only('name', 'email', 'avatar', 'password');

        if ($this->userRepository->update($input, $id)) {
            return redirect()->action('Admin\UserController@index')
                ->with('status', 'success')
                ->with('message', trans('settings.text.user.update_user_successly'));
        }
        return redirect()->action('Admin\UserController@index')
            ->with('status', 'danger')
            ->with('message', trans('settings.text.user.update_user_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return redirect()->action('Admin\UserController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.find_error'));
        }

        if ($user->delete()) {
            return redirect()->action('Admin\UserController@index')
                ->with('status', 'success')
                ->with('message', trans('settings.text.user.user_delete_successfully'));
        }

        return redirect()->action('Admin\UserController@index')
            ->with('status', 'danger')
            ->with('message', trans('settings.text.user.delete_user_fail'));
    }
}
