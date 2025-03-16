<?php

namespace App\Layer\Domain\Categories\Entity;

class CategoryEntity
{
    public function __construct(
        readonly public int $id,
        readonly public string $name,
        readonly public bool $isTemp,
        readonly public ?string $emoji,
    ) {
    }
}