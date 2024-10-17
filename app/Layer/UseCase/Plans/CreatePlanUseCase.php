<?php

namespace App\Layer\UseCase\Plans;

use App\Layer\Domain\Exceptions\DomainException;
use App\Layer\Domain\Exceptions\NotFoundException;
use App\Layer\Domain\Plans\CreatePlanInterface;
use App\Layer\Domain\Plans\GetPlanByMonthAndCategoryInterface;

class CreatePlanUseCase
{
	private CreatePlanInterface $createPlan;
	private GetPlanByMonthAndCategoryInterface $getPlanByMonthAndCategory;

	public function __construct(
		CreatePlanInterface $createPlan,
		GetPlanByMonthAndCategoryInterface $getPlanByMonthAndCategory
	)
	{
		$this->createPlan = $createPlan;
		$this->getPlanByMonthAndCategory = $getPlanByMonthAndCategory;
	}

	public function run(array $data): bool
	{
		try {
			$a = $this->getPlanByMonthAndCategory->get($data['monthId'], $data['categoryId']);
			throw new DomainException("This month there is already such a plan with the category");
		} catch (NotFoundException $e) {

		}

		return $this->createPlan->create($data);
	}
}