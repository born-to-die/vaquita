<?php

namespace App\Layer\UseCase\Plans;

use App\Layer\Domain\Plans\GetPlanInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;

class GetPlanUseCase
{
	private GetPlanInterface $getPlan;

	public function __construct(
		GetPlanInterface $getPlan
	)
	{
		$this->getPlan = $getPlan;
	}

	public function get(int $planId): PlanEntity
	{
		return $this->getPlan->get($planId);
	}
}