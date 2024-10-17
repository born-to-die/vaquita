<?php

namespace App\Layer\Persistence\Categories;

use App\Layer\Domain\Categories\CreateCategoryInterface;
use App\Models\Category;

class CreateCategoryAction implements CreateCategoryInterface
{
    public function create(array $data): bool
    {
        $category = new Category();

        $category->name = $data['name'];

        $category->save();

        return $category->id;
    }
}