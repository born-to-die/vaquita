<?php

namespace App\Layer\Persistence\Plans;

use App\Layer\Domain\Exceptions\NotFoundException;
use App\Models\Plan;
use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Domain\Plans\GetPlanByMonthAndCategoryInterface;
use App\Layer\Persistence\Models\PlanModel;

class GetPlanByMonthAndCategoryAction implements GetPlanByMonthAndCategoryInterface
{
    public function get(int $monthId, int $categoryId): PlanEntity
    {
        $plan = Plan::where('month_id', $monthId)->where('category_id', $categoryId)->first();

        if (! $plan) {
            throw new NotFoundException("План не найден");
        }

        return PlanModel::toDomain($plan);
    }
}