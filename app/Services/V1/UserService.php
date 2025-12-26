<?php
namespace App\Services\V1;

use App\Repositories\UserRepository;

class  UserService {
    private $userRepository;

    public function __construct
    (
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    public function show($input) {
        return $this->userRepository->find($input['user_id']);
    }

    public function update($input) {
        return $this->userRepository->update($input);
    }

    public function index($input) {
        return $this->userRepository->index();
    }
}
