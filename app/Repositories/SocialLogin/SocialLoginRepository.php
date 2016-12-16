<?php
namespace App\Repositories\SocialLogin;

use Auth;
use App\Model\SocialLogin;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;

class SocialLoginRepository extends BaseRepository
{
    public function __construct(SocialLogin $socialLogin)
    {
        $this->model = $socialLogin;
    }

    public function getAccountSocial($providerName, $providerUser)
    {
        return $this->model->whereSocialId($providerUser->getId())
            ->whereProvider($providerName)
            ->first();
    }
}
