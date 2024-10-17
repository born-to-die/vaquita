<?php

namespace App\Layer\Domain\Categories;

use App\Layer\Domain\Categories\Entity\CategoryEntity;

interface GetCategoryInterface
{
	public function get(int $id): CategoryEntity;
}