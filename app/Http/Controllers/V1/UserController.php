<?php

namespace App\Http\Controllers\V1;


use App\Traits\ResponseTrait;
use App\Services\V1\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    use ResponseTrait;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show($user_id)
    {
        $input = [
            'user_id' => $user_id
        ];

        $output = $this->userService->show($input);

        return $this->showResponse($output);
    }

    public function update(UpdateUserRequest $request)
    {
        $input = $request->validated();
        $this->userService->update($input);

        return $this->showResponse();
    }
}
