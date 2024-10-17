<?php

namespace App\Layer\Domain\Months\Entity;

use DateTimeImmutable;

class MonthEntity
{
    private int $id;
    private int $year;
    private int $month;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(
        int $id,
        int $year,
        int $month,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->year = $year;
        $this->month = $month;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getYear(): int
    {
        return $this->year;
    }
    
    public function getMonth(): int
    {
        return $this->month;
    }
    
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}