<?php

namespace App\Layer\Domain\Months;

interface CreateMonthInterface
{
    public function create(int $year, int $month): void;
}