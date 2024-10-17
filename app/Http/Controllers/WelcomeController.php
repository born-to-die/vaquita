<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class WelcomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $plans = Plan::all();

        return view('welcome', [
            'plans' => $plans,
            ]
        );
    }
}
