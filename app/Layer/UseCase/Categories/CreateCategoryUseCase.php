<?php

namespace App\Layer\UseCase\Categories;

use App\Layer\Domain\Categories\CreateCategoryInterface;
use App\Layer\Domain\Exceptions\InvalidException;

class CreateCategoryUseCase
{
	private CreateCategoryInterface $createCategory;

	public function __construct(
		CreateCategoryInterface $createCategory
	) {
		$this->createCategory = $createCategory;
	}

	public function run(array $data): bool
	{
		if (! isset($data['name'])) {
			throw new InvalidException("No name specified for category");
		}

		return $this->createCategory->create($data);
	}
}