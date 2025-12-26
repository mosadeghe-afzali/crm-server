<?php
namespace App\Services\V1;

use App\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    public function register($input) {}

    public function login($input)
    {
        $user = $this->userRepository->show([
            'mobile' => $input['mobile'],
        ]);

        if (empty($user)) {
            throw ValidationException::withMessages(['user' => __('messages.public.error.not_exist', ['pattern' => 'کاربر'])]);
        }

        $token = $this->createToken(['user' => $user]);

        $output = [
            "accessToken" => $token['token'],
            'exprie_at' => $token['expire_at'],
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];

        return $output;
    }

    public function createToken($input)
    {
        $user = $input['user'];

        $token = $user->createToken('AuthToken' . $user->id);
        $accessToken = $token->accessToken;
        $tokenExpiration = $token->token->expires_at->format("Y-m-d H:i:s");

        return [
            'token' => $accessToken,
            'expire_at' => $tokenExpiration,
            'token_type' => 'bearer'
        ];
    }
}
