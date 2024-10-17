<?php

namespace App\Layer\UseCase\Months;

use App\Layer\Domain\Months\CreateMonthInterface;

class CreateMonthUseCase
{
    private CreateMonthInterface $createMonth;

    public function __construct(
        CreateMonthInterface $createMonth
    ) {
        $this->createMonth = $createMonth;
    }

    public function run(int $year, int $month): void
    {
        $this->createMonth->create($year, $month);
    }
}