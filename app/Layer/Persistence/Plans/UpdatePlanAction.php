<?php

namespace App\Layer\Persistence\Plans;

use App\Models\Plan;
use App\Layer\Domain\Plans\UpdatePlanInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Persistence\Models\PlanModel;

class UpdatePlanAction implements UpdatePlanInterface
{
    public function update(int $id, array $data): PlanEntity
    {
        $plan = Plan::findOrFail($id)->fill($data);
        $plan->save();

        return PlanModel::toDomain($plan);
    }
}