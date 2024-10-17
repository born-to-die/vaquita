<?php

namespace App\Layer\UseCase\Months\Entity;

class GetMonthDTO
{
    private array $months;
    private array $plansByMonthsIds;

    public function __construct(
        array $months,
        array $plansByMonthsIds
    )
    {
        $this->months = $months;
        $this->plansByMonthsIds = $plansByMonthsIds;
    }

    public function getMonths(): array
    {
        return $this->months;
    }

    public function getPlansByMonthsIds(): array
    {
        return $this->plansByMonthsIds;
    }
}