<?php

namespace App\Layer\Persistence\Plans;

use App\Models\Plan;
use App\Layer\Domain\Plans\CreatePlanInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;

use DateTime;

class CreatePlanAction implements CreatePlanInterface
{
    public function create(array $data): bool
    {
        $plan = new Plan();

        $plan->user_id = $data['userId'];
        $plan->month_id = $data['monthId'];
        $plan->category_id = $data['categoryId'];
        $plan->plan = $data['plan'];
        $plan->real = $data['real'];

        $plan->save();

        return $plan->id;
    }
}