<?php

namespace App\Layer\Domain\Categories;

interface UpdateCategoryInterface
{
	public function update(int $id, array $data): void;
}