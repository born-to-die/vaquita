<?php

namespace App\Layer\UseCase\Months;

use App\Layer\Domain\Months\GetMonthsInterface;
use App\Layer\Domain\Plans\GetPlansAmountsByMonthIdInterface;
use App\Layer\Domain\Plans\GetPlansNumberByMonthIdInterface;
use App\Layer\UseCase\Months\Entity\GetMonthDTO;

class GetMonthsUseCase
{
    private GetMonthsInterface $getMonths;
    private GetPlansNumberByMonthIdInterface $getPlansNumberByMonthId;
    private GetPlansAmountsByMonthIdInterface $getPlansAmountsByMonthId;

    public function __construct(
        GetMonthsInterface $getMonths,
        GetPlansNumberByMonthIdInterface $getPlansNumberByMonthId,
        GetPlansAmountsByMonthIdInterface $getPlansAmountsByMonthId
    ) {
        $this->getMonths = $getMonths;
        $this->getPlansNumberByMonthId = $getPlansNumberByMonthId;
        $this->getPlansAmountsByMonthId = $getPlansAmountsByMonthId;
    }

    public function run(): GetMonthDTO
    {
        $months = $this->getMonths->get();
        $plansByMonthIdNumbers = [];

        foreach ($months as $month) {
            $plansByMonthIdNumbers[$month->getId()] = [
                'plansNumber' => $this->getPlansNumberByMonthId->get($month->getId()),
                'planForMonth' => $this->getPlansAmountsByMonthId->get($month->getId())->getPlan(),
                'realForMonth' => $this->getPlansAmountsByMonthId->get($month->getId())->getReal(),
            ];
        }
        
        return new GetMonthDTO($months, $plansByMonthIdNumbers);
    }
}