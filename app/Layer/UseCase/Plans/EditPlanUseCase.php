<?php

namespace App\Layer\UseCase\Plans;

use App\Layer\Domain\Plans\CreatePlanInterface;

class CreatePlanUseCase
{
	private CreatePlanInterface $createPlan;

	public function __construct(
		CreatePlanInterface $createPlan
	)
	{
		$this->createPlan = $createPlan;
	}

	public function run(array $data): bool
	{
		return $this->createPlan->create($data);
	}
}