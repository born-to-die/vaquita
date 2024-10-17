<?php

namespace App\Layer\Domain\Plans;

interface GetPlansInterface
{
	public function get(?int $monthNumber, ?int $year): array;
}