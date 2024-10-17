<?php

namespace App\Layer\Persistence\Plans;

use App\Models\Plan;
use App\Layer\Domain\Plans\GetPlansInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Persistence\Models\PlanModel;
use DateTime;

class GetPlansAction implements GetPlansInterface
{

    public function get(?int $monthNumber, ?int $year): array
    {
        $month = $monthNumber ?? (new DateTime())->format('n');
        $year = $year ?? (new DateTime())->format('Y');

        $plans = Plan::orderBy('id', 'DESC')
            ->where('month_id', 
                function ($query) use ($month, $year) {
                    $query
                        ->select('id')
                        ->from('months')
                        ->where('month', $month)
                        ->where('year', $year);
                }
            )
            ->get();

        return $this->toDomain($plans);
    }

    private function toDomain($plans): array
    {
        $plansDomain = [];

        foreach ($plans as $plan) {
            $plansDomain[] = PlanModel::toDomain($plan);
        }

        return $plansDomain;
    }
}