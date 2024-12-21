<?php

namespace App\Layer\Domain\Plans\Entity;

class PlanEntity
{
    /**
     * @property PlanType[] $types
     */
    public function __construct(
        private int $id,
        private int $userId,
        private int $monthId,
        private int $categoryId,
        private int $plan,
        private int $real,
        private string $createdAt,
        private string $updatedAt,
        private ?string $deletedAt,
        private array $types,
        private ?string $desc,
        private ?bool $isCompleted,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getMonthId(): int
    {
        return $this->monthId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getPlan(): int
    {
        return $this->plan;
    }

    public function getReal(): int
    {
        return $this->real;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getDesc(): ?string
    {
        return $this->desc;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted ?? false;
    }
}