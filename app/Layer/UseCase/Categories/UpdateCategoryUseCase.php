<?php

namespace App\Layer\UseCase\Categories;

use App\Layer\Domain\Categories\UpdateCategoryInterface;

class UpdateCategoryUseCase
{
	public function __construct(
		private UpdateCategoryInterface $updateCategory
	) {
	}

	public function update(int $id, array $data): void
	{
		$this->updateCategory->update($id, $data);
	}
}