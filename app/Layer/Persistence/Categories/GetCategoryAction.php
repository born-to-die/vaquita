<?php

namespace App\Layer\Persistence\Categories;

use App\Layer\Domain\Categories\GetCategoryInterface;
use App\Layer\Domain\Categories\Entity\CategoryEntity;
use App\Models\Category;

class GetCategoryAction implements GetCategoryInterface
{
    public function get(int $id): CategoryEntity
    {
        $category = Category::findOrFail($id);

        return $this->toDomain($category);
    }

    private function toDomain(Category $category): CategoryEntity
    {
        return new CategoryEntity(
            $category->id,
            $category->name,
            $category->is_temp,
        );
    }
}