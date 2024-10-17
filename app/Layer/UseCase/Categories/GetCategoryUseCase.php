<?php

namespace App\Layer\UseCase\Categories;

use App\Layer\Domain\Categories\GetCategoryInterface;
use App\Layer\Domain\Categories\Entity\CategoryEntity;

class GetCategoryUseCase
{

	public function __construct(
		private GetCategoryInterface $getCategory
	) {
	}

	public function get(int $id): CategoryEntity
	{
		return $this->getCategory->get($id);
	}
}