<?php

namespace App\Layer\Persistence\Months;

use App\Models\Month;
use App\Layer\Domain\Months\GetMonthsInterface;
use App\Layer\Domain\Months\Entity\MonthEntity;
use Illuminate\Database\Eloquent\Collection;

use DateTimeImmutable;

class GetMonthsAction implements GetMonthsInterface
{
    public function get(): array
    {
        $months = Month::orderByDesc('id')->get();

        return $this->toDomain($months);
    }

    private function toDomain(Collection $months): array
    {
        $monthsDomain = [];

        foreach ($months as $month) {

            $monthDomain = new MonthEntity(
                $month->id,
                $month->year,
                $month->month,
                new DateTimeImmutable($month->created_at),
                new DateTimeImmutable($month->updated_at),
            );
            
            $monthsDomain[] = $monthDomain;
        }

        return $monthsDomain;
    }
}