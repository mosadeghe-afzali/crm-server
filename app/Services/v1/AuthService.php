<?php

namespace App\Services\V1;

use App\Repositories\UserRepository; 
class AuthService {

   private $userRepository;

    public function __construct
    (
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;

    }

    public function register($input) {

    }

    public function login($input) {

        $user = $this->userRepository->show([
            'mobile' => $input['mobile'],
        ]);

        if(empty($user)) {
            $user = $this->userRepository->create([
                'mobile' => $input['mobile']
            ]);
        }

        $token = $this->createToken(['user' => $user]);

        $output = [
            "accessToken" => $token['token'],
            'refreshToken' => $token['token'],
            'exprie_at' => $token['expire_at'],
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            'is_verified' => $is_verified
        ];

        return $output;
    }

    public function createToken($input) {
        $user = $input['user'];

        $tokenResult = $user->createToken('AuthToken'. $user->id);
        $accessToken = $tokenResult->accessToken;
        $tokenExpiration = $tokenResult->token->expires_at->format("Y-m-d H:i:s");

        return [
            'token' => $accessToken,
            'expire_at' => $tokenExpiration,
            'token_type' => 'bearer'
        ];
    }

}
