<?php

namespace App\Services;

use App\User;
use App\Model\SocialLogin;
use Laravel\Socialite\Contracts\Provider;
use App\Repositories\SocialLogin\SocialLoginRepository;
use App\Repositories\User\UserRepository;

class SocialLoginService
{
    protected $socialLoginRepository;
    protected $userRepository;

    public function __construct(SocialLoginRepository $socialLoginRepository, UserRepository $userRepository)
    {
        $this->socialAccountRepository = $socialLoginRepository;
        $this->userRepository = $userRepository;
    }

    public function createOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = $this->socialAccountRepository->getAccountSocial($providerName, $providerUser);

        if ($account) {
            return $account->user;
        }

        $modelSocialLogin = new SocialLogin([
            'social_id' => $providerUser->getId(),
            'provider' => $providerName,
        ]);

        $user = $this->userRepository->getUserWithEmail($providerUser);

        if (!$user) {
            $datas = [
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'avatar' => $providerUser->getAvatar(),
            ];
            $user = $this->userRepository->createSocial($datas);
        }

        $modelSocialLogin->user()->associate($user);
        $modelSocialLogin->save();

        return $user;
    }
}
