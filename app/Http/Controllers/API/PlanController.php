<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Month;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Plan;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use App\Layer\UseCase\Plans\GetPlansUseCase;

class PlanController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    private GetPlansUseCase $getPlansUseCase;

    public function __construct(
        GetPlansUseCase $getPlansUseCase
    )
    {
        $this->getPlansUseCase = $getPlansUseCase;
    }

    public const MONTHS_NAME = [
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь',
    ];

    public function index(Request $request)
    {
        $monthNumber = $request->get('month_id', null);

        return response()->json($this->getPlansUseCase->run($monthNumber));
    }

    public function create()
    {
        return view(
            'plans/create',
            [
                'users' => User::select('id', 'name', 'email')->get(),
                'months' => Month::select('id', 'year', 'month')->get(),
                'monthsNames' => self::MONTHS_NAME,
                'categories' => Category::select('id', 'name')->get(),
            ]
        );
    }

    public function store(Request $request)
    {
        $plan = new Plan();
        $plan->user_id = $request->user_id;
        $plan->month_id = $request->month_id;
        $plan->category_id = $request->category_id;
        $plan->plan = $request->plan;
        $plan->real = $request->real;
        $plan->save();
        return $this->index($request);
    }

    public function edit(int $id)
    {
        $plan = Plan::find($id);
        return view(
            'plans/edit',
            [
                'plan' => $plan,
                'users' => User::select('id', 'name', 'email')->get(),
                'months' => Month::select('id', 'year', 'month')->get(),
                'monthsNames' => self::MONTHS_NAME,
                'categories' => Category::select('id', 'name')->get(),
            ]
        );
    }

    public function update(Request $request, int $id)
    {
        $plan = Plan::find($id);
        $plan->user_id = $request->user_id;
        $plan->month_id = $request->month_id;
        $plan->category_id = $request->category_id;
        $plan->plan = $request->plan;
        $plan->real = $request->real;
        $plan->save();
        return $this->index($request);
    }

    public function delete(int $id)
    {
        return view(
            'plans/delete',
            [
                'plan' => Plan::find($id),
            ]
        );
    }

    public function destroy(Request $request, int $id)
    {
        $plan = Plan::find($id);
        $plan->delete();
        return $this->index($request);
    }
}
