<?php

namespace App\Http\Controllers;

use App\Layer\UseCase\Plans\GetPlansUseCase;
use App\Layer\UseCase\Plans\CreatePlanUseCase;
use App\Layer\UseCase\Plans\GetPlanUseCase;
use App\Layer\UseCase\Plans\UpdatePlanUseCase;
use App\Layer\Presentation\Plans\PlansView;
use App\Layer\Presentation\Plans\PlanCreateView;
use App\Layer\Presentation\Plans\PlanEditView;
use App\Models\Plan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use DateTime;
use DateTimeImmutable;
use Illuminate\Support\Facades\Redirect;

class PlanController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private GetPlansUseCase $getPlansUseCase;
    private CreatePlanUseCase $createPlanUseCase;
    private GetPlanUseCase $getPlanUseCase;
    private UpdatePlanUseCase $updatePlanUseCase;

    public function __construct(
        GetPlansUseCase $getPlansUseCase,
        CreatePlanUseCase $createPlanUseCase,
        GetPlanUseCase $getPlanUseCase,
        UpdatePlanUseCase $updatePlanUseCase
    )
    {
        $this->getPlansUseCase = $getPlansUseCase;
        $this->createPlanUseCase =  $createPlanUseCase;
        $this->getPlanUseCase = $getPlanUseCase;
        $this->updatePlanUseCase = $updatePlanUseCase;
    }

    public function index(Request $request)
    {
        $filterMonthParam = $request->get('m', (new DateTime())->format('n'));
        $filterYearParam = $request->get('y', (new DateTime())->format('Y'));

        $filterMonthParam = $filterMonthParam ? (int) $filterMonthParam : null;
        $filterYearParam = $filterYearParam ? (int) $filterYearParam : null;

        $plans = $this->getPlansUseCase->run($filterMonthParam, $filterYearParam);

        $data = PlansView::toView($plans, $filterMonthParam, $filterYearParam);

        return response(view('plans', $data));
    }

    public function create()
    {
        return view(
            'plans/create',
            (new PlanCreateView())->toView()
        );
    }

    public function store(Request $request)
    {
        $data = [
            'userId' => $request->user_id,
            'monthId' => $request->month_id,
            'categoryId' => $request->category_id,
            'plan' => $request->plan,
            'real' => $request->real,
        ];

        $this->createPlanUseCase->run($data);
        return Redirect::route('plans');
    }

    public function edit(int $id)
    {
        $plan = $this->getPlanUseCase->get($id);

        return view(
            'plans/edit',
            (new PlanEditView())->toView($plan)
        );
    }

    public function update(Request $request, int $id)
    {
        $data = [
            'user_id' => $request->user_id,
            'month_id' => $request->month_id,
            'category_id' => $request->category_id,
            'plan' => $request->plan,
            'real' => $request->real,
            'desc' => $request->desc,
        ];

        $this->updatePlanUseCase->update($id, $data);

        return Redirect::route('plans');
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

    public function updateAsComplete(Request $request, int $id)
    {
        $data = [
            'user_id' => $request->user_id,
            'month_id' => $request->month_id,
            'category_id' => $request->category_id,
            'plan' => $request->plan,
            'real' => $request->real,
        ];

        $this->updatePlanUseCase->update($id, $data);

        return Redirect::route('plans');
    }
}
