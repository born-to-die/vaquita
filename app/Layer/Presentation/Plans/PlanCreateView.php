<?php

namespace App\Layer\Presentation\Plans;

use App\Layer\Domain\Common\MonthEnum;

use DateTime;

use App\Models\Plan;
use App\Models\Category;
use App\Models\Month;
use App\Models\User;

class PlanCreateView
{
    public function toView(): array
    {
        return [
            'users' => User::select('id', 'name', 'email')->get(),
            'months' => Month::select('id', 'year', 'month')->orderByDesc('id')->get(),
            'monthsNames' => MonthEnum::MONTHS_NAME,
            'categories' => Category::select('id', 'name')->get(),
        ];
    }
}
