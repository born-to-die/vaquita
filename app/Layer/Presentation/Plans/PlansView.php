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
    ): array {
        $monthPlanMoney = 0;
        $monthRealMoney = 0;
        $monthRealByPlanMoney = 0;

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

        $expenseTemporaryMoney = 0;
        $expenseUnplannedMoney = 0;

        $categoriesMap = $this->getCategories();

        foreach ($plans as $plan) {
            $planModel = new Plan();
            $planModel->id = $plan->getId();
            $planModel->user_id = $plan->getUserId();
            $planModel->month_id = $plan->getMonthId();
            $planModel->category_id = $plan->getCategoryId();
            $planModel->plan = $plan->getPlan();
            $planModel->real = $plan->getReal();

            $plansModels[] = $planModel;

            $monthPlanMoney += $plan->getPlan();
            $monthRealMoney += $plan->getReal();

            $monthRealByPlanMoney += $plan->getReal() > $plan->getPlan()
                ? $plan->getPlan()
                : $plan->getReal();

            if ($categoriesMap[$planModel->category_id]['isTemporary']) {
                $expenseTemporaryMoney += $planModel->plan;
            }

            $types = [];

            foreach ($plan->getTypes() as $value) {
                $types[] = $value->value;

                if ($value === PlanType::Unplaned) {
                    $expenseUnplannedMoney += $plan->getReal();
                }
            }

            $planModel->types = $types;
        }

        $data = [
            'plans' => $plansModels,

            'currentMonthName' => $filterDate->format("F"),
            'currentYear' => $filterDate->format('Y'),

            'monthPlanMoney' => $monthPlanMoney,
            'monthRealMoney' => $monthRealMoney,
            'monthRealByPlanMoney' => $monthRealByPlanMoney,

            'expenseCategories' => [
                'temporary' => $expenseTemporaryMoney,
                'basic' => $monthPlanMoney - $expenseTemporaryMoney,
                'unplanned' => $expenseUnplannedMoney,
            ],

            'categoriesMap' => $categoriesMap,
        ];

        return $data;
    }

    private function getCategories(): array
    {
        $categoriesMap = [];

        $categories = Category::all();

        foreach ($categories as $category) {
            $categoriesMap[$category->id] = [
                'isTemporary' => $category->is_temp === 1,
            ];
        }

        return $categoriesMap;
    }
}
