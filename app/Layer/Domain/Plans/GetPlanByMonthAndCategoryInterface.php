<?php

namespace App\Layer\Domain\Plans;

use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Domain\Exceptions\NotFoundException;

interface GetPlanByMonthAndCategoryInterface
{
	/**
	 * @throw NotFoundException
	 */
	public function get(int $monthId, int $categoryId): PlanEntity;
}