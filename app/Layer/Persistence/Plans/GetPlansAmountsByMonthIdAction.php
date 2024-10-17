<?php

namespace App\Layer\Persistence\Plans;

use App\Layer\Domain\Plans\Entity\PlansAmountsByMonthEntity;
use App\Layer\Domain\Plans\GetPlansAmountsByMonthIdInterface;
use App\Models\Plan;

class GetPlansAmountsByMonthIdAction implements GetPlansAmountsByMonthIdInterface
{

    public function get(int $monthId): PlansAmountsByMonthEntity
    {
        $plans = Plan::where('month_id', $monthId)->get(); 
        $plan = $plans->sum('plan');
        $real = $plans->sum('real');

        return new PlansAmountsByMonthEntity($monthId, $plan, $real);
    }
}