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
        return $this->getCurrentUser()->following()->get();
    }

    public function getUserFollowers()
    {
        return $this->getCurrentUser()->followers()->get();
    }

    public function getUsersInPage($page, $perPage)
    {
        if (!$page || !$perPage) {
            return [];
        }

        return $this->model->newQuery()
            ->where('role', '<>', config('settings.user.is_admin'))
            ->where('id', '<>', $this->getCurrentUser()->id)
            ->get()
            ->load('following', 'followers')
            ->forPage($page, $perPage);
    }

    public function hanleRelationshipBetweenUser($idUser)
    {
        if (!$idUser) {
            return false;
        }
        $userCurrent = $this->getCurrentUser();
        $listUserFollowing = $userCurrent->following();

        if ($listUserFollowing->get()->contains('id', $idUser)) {
            $listUserFollowing->detach($idUser);
            $option = config('settings.action.remove');
        } else {
            $listUserFollowing->attach($idUser);
            $option = config('settings.action.add');
        }
        return $option;
    }
}
