<?php

namespace App\Services\V1;

use App\Repositories\CityRepository;
use App\Repositories\ProvinceRepository;

class  GeneralService
{
    private $provinceRepository;
    private $cityRepository;


    public function __construct(
        ProvinceRepository $provinceRepository,
        CityRepository $cityRepository
    ) {
        $this->provinceRepository = $provinceRepository;
        $this->cityRepository = $cityRepository;
    }

    public function provinces($input = [])
    {
        return $this->provinceRepository->index($input);
    }
    public function cities($input = [])
    {
        return $this->cityRepository->index($input);
    }
}
