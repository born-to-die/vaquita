<?php

namespace App\Layer\Domain\Categories\Entity;

class CategoryEntity
{
    public function __construct(
        readonly private int $id,
        readonly private string $name
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}