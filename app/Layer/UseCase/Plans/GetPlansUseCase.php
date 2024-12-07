<?php

namespace App\Layer\UseCase\Plans;

use App\Layer\Domain\Plans\GetPlansInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;

class GetPlansUseCase
{
	private GetPlansInterface $getPlans;

	public function __construct(
		GetPlansInterface $getPlans
	) {
		$this->getPlans = $getPlans;
	}

	/**
	 * @return PlanEntity[]
	 */
	public function run(?int $monthNumber, ?int $year): array
	{
		return $this->getPlans->get($monthNumber, $year);
	}
}