<?php

namespace App\Layer\Presentation\Plans;

use App\Layer\Domain\Common\MonthEnum;
use App\Layer\Domain\Plans\Entity\PlanEntity;

use DateTime;

use App\Models\Plan;
use App\Models\Category;
use App\Models\Month;
use App\Models\User;

class PlanEditView
{
    public function toView(PlanEntity $plan): array
    {
        return [
            'plan' => Plan::findOrFail($plan->getId()),
            'users' => User::select('id', 'name', 'email')->get(),
            'months' => Month::select('id', 'year', 'month')->get(),
            'monthsNames' => MonthEnum::MONTHS_NAME,
            'categories' => Category::select('id', 'name')->get(),
            'missingAmount' => $plan->getPlan() - $plan->getReal(),
        ];
    }
}
