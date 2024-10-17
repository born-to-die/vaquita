<?php

namespace App\Layer\Persistence\Plans;

use App\Models\Plan;
use App\Layer\Domain\Plans\GetPlanInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Persistence\Models\PlanModel;

class GetPlanAction implements GetPlanInterface
{
    public function get(int $planId): PlanEntity
    {
        $plan = Plan::findOrFail($planId);

        return PlanModel::toDomain($plan);
    }
}