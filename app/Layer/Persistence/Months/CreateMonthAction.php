<?php

namespace App\Layer\Persistence\Months;

use App\Layer\Domain\Months\CreateMonthInterface;
use App\Models\Month;

class CreateMonthAction implements CreateMonthInterface
{
    public function create(int $year, int $month): void
    {
        $newMonth = new Month();
        $newMonth->year = $year;
        $newMonth->month = $month;
        $newMonth->save();
    }
}