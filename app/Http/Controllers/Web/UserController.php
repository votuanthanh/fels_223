<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\User\UserRepository;
use App\User;

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
}
