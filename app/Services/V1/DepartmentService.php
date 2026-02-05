<?php

namespace App\Services\V1;

use App\Repositories\DepartmentRepository;

class  DepartmentService
{
    private $departmentRepository;

    public function __construct(
        DepartmentRepository $departmentRepository,
    ) {
        $this->departmentRepository = $departmentRepository;
    }

    public function index($input = []) {
        return $this->departmentRepository->index($input);
    }
}
