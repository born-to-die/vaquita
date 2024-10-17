<?php

namespace App\Layer\Domain\Plans;

use App\Layer\Domain\Plans\Entity\PlanEntity;

interface GetPlansNumberByMonthIdInterface
{
    /**
     * @param int $monthId
     * @return PlanEntity[]
     */
    public function get(int $monthId): int;
}