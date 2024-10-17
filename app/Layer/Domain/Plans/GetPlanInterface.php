<?php

namespace App\Layer\Domain\Plans;

use App\Layer\Domain\Plans\Entity\PlanEntity;

interface GetPlanInterface
{
	public function get(int $planId): PlanEntity;
}