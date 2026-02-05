<?php

namespace App\Services\V1;

use App\Repositories\PositionRepository;

class  PositionService
{
    private $positionRepository;

    public function __construct(
        PositionRepository $positionRepository
    ) {
        $this->positionRepository = $positionRepository;
    }

    public function index($input = [])
    {
        return $this->positionRepository->index($input);
    }
}
