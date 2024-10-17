<?php

namespace App\Http\Controllers;

use App\Layer\Domain\Common\MonthEnum;
use App\Models\Month;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Layer\UseCase\Months\GetMonthsUseCase;
use App\Layer\Presentation\Months\MonthsView;
use App\Layer\UseCase\Months\CreateMonthUseCase;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class MonthController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    private GetMonthsUseCase $getMonthsUseCase;
    private CreateMonthUseCase $createMonthUseCase;
    private MonthsView $monthsView;

    public function __construct(
        GetMonthsUseCase $getMonthsUseCase,
        CreateMonthUseCase $createMonthUseCase,
        MonthsView $monthsView
    )
    {
        $this->getMonthsUseCase = $getMonthsUseCase;
        $this->createMonthUseCase = $createMonthUseCase;
        $this->monthsView = $monthsView;
    }

    public function index()
    {
        $months = $this->getMonthsUseCase->run();
        $monthsView = $this->monthsView->toView($months);
        
        return response(view('months/index', $monthsView));
    }
    
    public function create()
    {
        $currentDate = new DateTime();
        $currentYear = (int) $currentDate->format('Y');
        $currentMonth = (int) $currentDate->format('m');

        $years = [];
        $months = [];

        $predictMonthNumber = $currentMonth + 1 > 12 ? 1 : $currentMonth + 1;

        for ($i = 2023; $i < $currentYear+5; $i++) {
            $years[] = $i;
        }

        for ($i = 0; $i < count(MonthEnum::MONTHS_NAME); $i++) {
            $months[$i+1] = MonthEnum::MONTHS_NAME[$i];
        }

        $data = [
            'years' => $years,
            'months' => $months,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
            'predictMonthNumber' => $predictMonthNumber,
        ];

        return view('months/create', $data);
    }

    public function store(Request $request)
    {
        $this->createMonthUseCase->run($request->year, $request->month);
        return Redirect::route('months');
    }
}
