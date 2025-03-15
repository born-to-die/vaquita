<?php

namespace App\Layer\Presentation\Plans;

use App\Models\Category;
use DateTimeImmutable;
use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Domain\Plans\Entity\PlanType;

class PlansView
{
    /**
     * @param PlanEntity[] $plans
     */
    static public function toView(
        array $plans,
        ?int $specifyMonthNumber,
        ?int $specifyYearNumber
    ): array {
        $plansData = [];

        $monthPlanMoney = 0;
        $monthRealMoney = 0;
        $monthRealByPlanMoney = 0;

        $date = self::getDate($specifyMonthNumber, $specifyYearNumber);

        // TODO Move to categories system (or types?)
        $expenseTemporaryMoney = 0;
        $expenseUnplannedMoney = 0;

        $categoriesMap = self::getCategories();

        foreach ($plans as $plan) {
            $monthPlanMoney += $plan->getPlan();
            $monthRealMoney += $plan->getReal();
        }

        foreach ($plans as $plan) {
            // TODO Dont use external functions for get data
            $category = Category::findOrFail($plan->getCategoryId());

            $plansData[] = [
                "id" => $plan->getId(),
                "user_id" => $plan->getUserId(),
                "month_id" => $plan->getMonthId(),
                "category_id" => $plan->getCategoryId(),
                "plan" => $plan->getPlan(),
                "real" => $plan->getReal(),
                "desc" => $plan->getDesc(),
                "category_emoji" => $category->emoji,
                "is_completed" => $plan->isCompleted(),
                "plan_percent" => round($plan->getPlan() * 100 / $monthPlanMoney, 1),
            ];
            
            $category = Category::findOrFail($plan->getCategoryId());

            $monthRealByPlanMoney += $plan->getReal() > $plan->getPlan()
                ? $plan->getPlan()
                : $plan->getReal();

            if ($categoriesMap[$plan->getCategoryId()]['isTemporary']) {
                $expenseTemporaryMoney += $plan->getPlan();
            }

            $types = [];

            foreach ($plan->getTypes() as $value) {
                $types[] = $value->value;

                if ($value === PlanType::Unplaned) {
                    $expenseUnplannedMoney += $plan->getReal();
                }
            }
        }

        $previousDate = $date->modify('-1 month');
        $nextDate = $date->modify('+1 month');

        $data = [
            'plans' => $plansData,

            'currentMonthName' => $date->format("F"),
            'currentMonthNumber' => $date->format('m'),
            'currentYear' => $date->format('Y'),

            'dates' => [
                'previous' => [
                    'year' => $previousDate->format('Y'),
                    'month' => $previousDate->format('m'),
                ],
                'next' => [
                    'year' => $nextDate->format('Y'),
                    'month' => $nextDate->format('m'),
                ],
            ],

            'monthPlanMoney' => $monthPlanMoney,
            'monthRealMoney' => $monthRealMoney,
            'monthRealByPlanMoney' => $monthRealByPlanMoney,

            'expenseCategories' => [
                'temporary' => $expenseTemporaryMoney,
                'temporaryPercent' => round($expenseTemporaryMoney * 100 / ($monthPlanMoney !== 0 ? $monthPlanMoney : 1)),
                'basic' => $monthPlanMoney - $expenseTemporaryMoney,
                'basicPercent' => round(($monthPlanMoney - $expenseTemporaryMoney) * 100 / ($monthPlanMoney !== 0 ? $monthPlanMoney : 1)),
                'unplanned' => $expenseUnplannedMoney,
            ],

            'categoriesMap' => $categoriesMap,
        ];

        return $data;
    }

    static private function getCategories(): array
    {
        $categoriesMap = [];

        foreach (Category::all() as $category) {
            $categoriesMap[$category->id] = [
                'isTemporary' => $category->is_temp === 1,
                'name' => $category->name,
            ];
        }

        return $categoriesMap;
    }

    static private function getDate(
        ?int $specifyMonthNumber,
        ?int $specifyYearNumber,
    ): DateTimeImmutable {
        $currentDate = new DateTimeImmutable();
    

        $year = $specifyYearNumber ?? $currentDate->format('Y');

        $month = $specifyMonthNumber ? str_pad($specifyMonthNumber, 2, '0', STR_PAD_LEFT) : null;
    
        if ($month) {
            return new DateTimeImmutable("$year-$month-01");
        }
    
        return $currentDate;
    }
    
}
