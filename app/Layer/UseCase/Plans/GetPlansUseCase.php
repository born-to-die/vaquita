<?php

namespace App\Layer\UseCase\Plans;

use App\Layer\Domain\Plans\GetPlansInterface;

class GetPlansUseCase
{
	private GetPlansInterface $getPlans;

	public function __construct(
		GetPlansInterface $getPlans
	) {
		$this->getPlans = $getPlans;
	}

	public function run(?int $monthNumber, ?int $year): array
	{
		return $this->getPlans->get($monthNumber, $year);
	}
}