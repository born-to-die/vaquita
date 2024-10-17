<?php

namespace App\Layer\Domain\Categories;

interface CreateCategoryInterface
{
	public function create(array $data): bool;
}