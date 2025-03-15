<?php

namespace App\Http\Controllers;

use App\Layer\UseCase\Categories\CreateCategoryUseCase;
use App\Layer\UseCase\Categories\GetCategoryUseCase;
use App\Layer\UseCase\Categories\UpdateCategoryUseCase;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        readonly private CreateCategoryUseCase $createCategoryUseCase,
        readonly private GetCategoryUseCase $getCategoryUseCase,
        readonly private UpdateCategoryUseCase $updateCategoryUseCase
    ) {
    }

    public function index()
    { 
        $categories = Category::all();
        return view(
            'categories',
            [
                'categories' => $categories,
            ]
        );
    }

    public function create()
    {
        return view('categories/create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];

        $this->createCategoryUseCase->run($data);

        return Redirect::route('categories');
    }

    public function edit(int $id)
    {
        $category = $this->getCategoryUseCase->get($id);

        return view(
            'categories/edit',
            [
                "name" => $category->name,
                "isTemp" => $category->isTemp,
            ],
        );
    }

    public function update(Request $request, int $id)
    {
        $data = [
            'name' => $request->name,
            'is_temp' => (int) (! $request->is_temp),
        ];

        $this->updateCategoryUseCase->update($id, $data);

        return Redirect::route('categories');
    }
}
