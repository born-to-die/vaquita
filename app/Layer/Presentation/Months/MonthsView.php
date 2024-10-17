<?php

namespace App\Layer\Presentation\Months;

use DateTime;
use App\Layer\Domain\Common\MonthEnum;
use App\Layer\UseCase\Months\Entity\GetMonthDTO;

class MonthsView
{
    /**
     * @param GetMonthDTO[] $months
     * @return Plan[]
     */
    public function toView(
        GetMonthDTO $months,
    ): array
    {
        $monthsModels = [];

        foreach ($months->getMonths() as $month) {
            $monthsModels[] = [
                'id' => $month->getId(),
                'year' => $month->getYear(),
                'month' => $month->getMonth(),
                'createdAt' => $month->getCreatedAt(),
                'plansNumber' => $months->getPlansByMonthsIds()[$month->getId()]['plansNumber'],
                'planForMonth' => $months->getPlansByMonthsIds()[$month->getId()]['planForMonth'],
                'realForMonth' => $months->getPlansByMonthsIds()[$month->getId()]['realForMonth'],
            ];
        }

        return [
            'months' => $monthsModels,
            'monthsNames' => MonthEnum::MONTHS_NAME,
        ];
    }
}
