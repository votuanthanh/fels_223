<?php
namespace App\Repositories\User;

use Auth;
use App\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUserWithEmail($providerUser)
    {
        return $this->model->whereEmail($providerUser->getEmail())->first();
    }

    public function createSocial($inputs)
    {
        return $this->model->create($inputs);
    }

    public function create($request)
    {
        $fileName = isset($request['avatar'])
            ? $this->uploadAvatar()
            : config('settings.user.avatar_default');

        $user = [
            'name' => $request['name'],
            'email' => $request['email'],
            'avatar' => $fileName,
            'password' => $request['password'],
        ];

        $createUser = $this->model->create($user);

        if (!$createUser) {
            throw new Exception('message.create_error');
        }

        return $createUser;
    }

    public function update($inputs, $id)
    {
        try {
            $currentUser = Auth::user();
            $inputs['password'] = isset($request['password']) ? $inputs['password'] : $currentUser->password;
            $oldImage = $currentUser->avatar;
            $inputs['avatar'] = isset($inputs['avatar']) ? $this->uploadAvatar($oldImage) : $oldImage;
            $data = $this->model->where('id', $id)->update($inputs);
        } catch (Exception $e) {
            return view('user.home')->withError(trans('message.update_error'));
        }

        return $data;
    }

    public function uploadAvatar($oldImage = null)
    {
        $fileAvatar = Input::file('avatar');
        $destinationPath = config('settings.user.avatar_path');
        $fileName = uniqid(time()) . '.' . $fileAvatar->getClientOriginalExtension();
        Input::file('avatar')->move($destinationPath, $fileName);
        $imageOldDestinationPath = $destinationPath.$oldImage;
        if (!empty($oldImage) && file_exists($imageOldDestinationPath)) {
            File::delete($imageOldDestinationPath);
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
