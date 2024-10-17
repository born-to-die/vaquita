<?php

namespace App\Layer\Domain\Plans\Entity;

class PlansAmountsByMonthEntity
{
    private int $monthId;
    private int $plan;
    private int $real;

    public function __construct(
        int $monthId,
        int $plan,
        int $real
    ) {
        $this->monthId = $monthId;
        $this->plan = $plan;
        $this->real = $real;
    }

    public function getMonthId(): int
    {
        return $this->monthId;
    }
    
    public function getPlan(): int
    {
        return $this->plan;
    }

    public function getReal(): int
    {
        return $this->real;
    }
}