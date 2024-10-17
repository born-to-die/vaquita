<?php

namespace App\Layer\Presentation\Plans;

use App\Models\Plan;
use App\Models\Category;
use App\Layer\Domain\Common\MonthEnum;
use DateTimeImmutable;
use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Domain\Plans\Entity\PlanType;

class PlansView
{
    /**
     * @property PlanEntity[] $plans
     * @return Plan[]
     */
    public function toView(
        array $plans,
        ?int $filterMonthParam,
        ?int $filterYearParam
    ): array
    {
        $monthPlanAmount = 0;
        $monthRealAmount = 0;
        $monthByPlanAmount = 0;

        $plansModels = [];

        $filterMonth = null;
        $filterYear = null;
        $filterDate = null;

        if ($filterMonthParam) {
            $filterMonth = (int) $filterMonthParam < 10
                ? "0$filterMonthParam"
                : (string) $filterMonthParam;
        }

        if ($filterYearParam) {
            $filterYear = $filterYearParam;
        }

        if ($filterMonth && $filterYear) {
            $filterDate = new DateTimeImmutable("$filterYear-$filterMonth-01");
        } elseif ($filterMonth) {
            $nowDate = new DateTimeImmutable();
            $filterDate = new DateTimeImmutable($nowDate->format('Y') . "-$filterMonth-01");
        } else {
            $filterDate = new DateTimeImmutable();
        }

        $categories = Category::all();
        $categoriesByIdMap = [];

        foreach ($categories as $category) {
            $categoriesByIdMap[$category->id] = $category;
        }

        $temporaryExpensesAmount = 0;
        $unplannedExpensesAmount = 0;

        foreach ($plans as $plan) {
            $planModel = new Plan();
            $planModel->id = $plan->getId();
            $planModel->user_id = $plan->getUserId();
            $planModel->month_id = $plan->getMonthId();
            $planModel->category_id = $plan->getCategoryId();
            $planModel->plan = $plan->getPlan();
            $planModel->real = $plan->getReal();

            $plansModels[] = $planModel;

            $monthPlanAmount += $plan->getPlan();
            $monthRealAmount += $plan->getReal();

            $monthByPlanAmount += $plan->getReal() > $plan->getPlan()
                ? $plan->getPlan()
                : $plan->getReal();

            if ($categoriesByIdMap[$planModel->category_id]->is_temp === 1) {
                $temporaryExpensesAmount += $planModel->plan;
            }

            $types = [];

            foreach ($plan->getTypes() as $value) {
                $types[] = $value->value;

                if ($value === PlanType::Unplaned) {
                    $unplannedExpensesAmount += $plan->getReal();
                }
            }

            $planModel->types = $types;
        }

        return [
            'plans' => $plansModels,
            'monthsNames' => MonthEnum::MONTHS_NAME,
            'currentMonth' => $filterDate->format("m"),
            'currentMonthName' => $filterDate->format("F"),
            'currentYear' => $filterDate->format('Y'),
            'month_id' => $filterDate,
            'monthPlanAmount' => $monthPlanAmount,
            'monthRealAmount' => $monthRealAmount,
            'monthByPlanAmount' => $monthByPlanAmount,
            'temporaryExpensesAmount' => $temporaryExpensesAmount,
            'basicExpensesAmount' => $monthPlanAmount - $temporaryExpensesAmount,
            'categoriesByIdMap' => $categoriesByIdMap,
            'unplannedExpensesAmount' => $unplannedExpensesAmount,
        ];
    }
}
