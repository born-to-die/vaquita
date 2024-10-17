<?php

namespace App\Layer\UseCase\Plans;

use App\Layer\Domain\Plans\UpdatePlanInterface;
use App\Layer\Domain\Plans\Entity\PlanEntity;

class UpdatePlanUseCase
{
	private UpdatePlanInterface $updatePlan;

	public function __construct(
		updatePlanInterface $updatePlan
	)
	{
		$this->updatePlan = $updatePlan;
	}

	public function update(int $id, array $data): PlanEntity
	{
		return $this->updatePlan->update($id, $data);
	}
}