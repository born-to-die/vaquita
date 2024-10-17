<?php

namespace App\Layer\Persistence\Models;

use App\Layer\Domain\Plans\Entity\PlanEntity;
use App\Layer\Domain\Plans\Entity\PlanType;
use App\Models\Plan;

class PlanModel 
{
    public static function toDomain(Plan $plan): PlanEntity
    {
        $typesStrings = $plan->types
            ? explode(';', $plan->types)
            : [];

        $types = [];

        foreach ($typesStrings as $value) {
            $types[] = PlanType::from($value);
        }

        return new PlanEntity(
            $plan->id,
            $plan->user_id,
            $plan->month_id,
            $plan->category_id,
            $plan->plan,
            $plan->real,
            $plan->created_at,
            $plan->updated_at,
            $plan->deleted_at,
            $types
        );
    }
}