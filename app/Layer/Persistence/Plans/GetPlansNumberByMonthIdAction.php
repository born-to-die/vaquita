<?php

namespace App\Layer\Persistence\Plans;

use App\Models\Plan;
use App\Layer\Domain\Plans\GetPlansNumberByMonthIdInterface;

class GetPlansNumberByMonthIdAction implements GetPlansNumberByMonthIdInterface
{

    public function get(int $monthId): int
    {
        $plansNumber = Plan::where('month_id', $monthId)->get()->count();

        return $plansNumber;
    }
}