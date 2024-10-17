<?php

namespace App\Layer\Domain\Plans;

interface CreatePlanInterface
{
	public function create(array $data): bool;
}