<?php
namespace App\Repositories\User;

use Auth;
use App\User;
use App\Repositories\BaseRepository;
use Input;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function update($inputs, $id)
    {
        try {
            $currentUser = Auth::user();
            if (isset($request['password'])) {
                $inputs['password'] = $inputs['password'];
            } else {
                $inputs['password'] = $currentUser->password;
            }

            $oldImage = $currentUser->avatar;

            if (isset($inputs['avatar'])) {
                $inputs['avatar'] = $this->uploadAvatar($oldImage);
            }

            $data = $this->model->where('id', $id)->update($inputs);
        } catch (Exception $e) {
            return view('user.home')->withError(trans('message.update_error'));
        }

        return $data;
    }

    public function uploadAvatar($oldImage)
    {
        $fileAvatar = Input::file('avatar');
        $destinationPath = base_path(). config('settings.user.avatar_path');
        $fileName = uniqid(time()). '.' . $fileAvatar->getClientOriginalExtension();
        Input::file('avatar')->move($destinationPath, $fileName);
        if (!empty($oldImage) && file_exists($oldImage)) {
            File::delete($oldImage);
        }

        return $fileName;
    }

    public function getUserFollowing()
    {
        return $this->model->following()->get();
    }

    public function getUserFollowers()
    {
        return $this->model->followers()->get();
    }
}
