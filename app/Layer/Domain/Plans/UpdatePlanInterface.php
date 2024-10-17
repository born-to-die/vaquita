<?php

namespace App\Layer\Domain\Plans;

use App\Layer\Domain\Plans\Entity\PlanEntity;

interface UpdatePlanInterface
{
	public function update(int $id, array $data): PlanEntity;
}