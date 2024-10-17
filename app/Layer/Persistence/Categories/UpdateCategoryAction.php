<?php

namespace App\Layer\Persistence\Categories;

use App\Models\Category;
use App\Layer\Domain\Categories\UpdateCategoryInterface;

class UpdateCategoryAction implements UpdateCategoryInterface
{
    public function update(int $id, array $data): void
    {
        $category = Category::findOrFail($id)->fill($data);
        $category->save();
    }
}