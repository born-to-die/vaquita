<?php

namespace App\Layer\Domain\Plans;

use App\Layer\Domain\Plans\Entity\PlansAmountsByMonthEntity;

interface GetPlansAmountsByMonthIdInterface
{
    /**
     * @return PlansAmountsByMonthEntity
     */
    public function get(int $monthId): PlansAmountsByMonthEntity;
}