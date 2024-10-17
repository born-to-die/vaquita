<?php

namespace App\Providers;

use App\Layer\Domain\Categories\CreateCategoryInterface;
use App\Layer\Domain\Categories\GetCategoryInterface;
use App\Layer\Domain\Categories\UpdateCategoryInterface;
use App\Layer\Domain\Months\CreateMonthInterface;
use App\Layer\Domain\Plans\GetPlansInterface;
use App\Layer\Domain\Plans\CreatePlanInterface;
use App\Layer\Domain\Plans\GetPlanInterface;
use App\Layer\Domain\Plans\UpdatePlanInterface;
use App\Layer\Persistence\Plans\GetPlansAction;
use App\Layer\Persistence\Plans\CreatePlanAction;
use App\Layer\Persistence\Plans\GetPlanAction;
use App\Layer\Persistence\Plans\UpdatePlanAction;
use App\Layer\Domain\Months\GetMonthsInterface;
use App\Layer\Domain\Plans\GetPlanByMonthAndCategoryInterface;
use App\Layer\Domain\Plans\GetPlansAmountsByMonthIdInterface;
use App\Layer\Domain\Plans\GetPlansNumberByMonthIdInterface;
use App\Layer\Persistence\Categories\CreateCategoryAction;
use App\Layer\Persistence\Months\CreateMonthAction;
use App\Layer\Persistence\Months\GetMonthsAction;
use App\Layer\Persistence\Categories\GetCategoryAction;
use App\Layer\Persistence\Categories\UpdateCategoryAction;
use App\Layer\Persistence\Plans\GetPlanByMonthAndCategoryAction;
use App\Layer\Persistence\Plans\GetPlansAmountsByMonthIdAction;
use App\Layer\Persistence\Plans\GetPlansNumberByMonthIdAction;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Plan
        $this->app->bind(GetPlansInterface::class, GetPlansAction::class);
        $this->app->bind(CreatePlanInterface::class, CreatePlanAction::class);
        $this->app->bind(GetPlanInterface::class, GetPlanAction::class);
        $this->app->bind(UpdatePlanInterface::class, UpdatePlanAction::class);
        $this->app->bind(GetPlansNumberByMonthIdInterface::class, GetPlansNumberByMonthIdAction::class);
        $this->app->bind(GetPlansAmountsByMonthIdInterface::class, GetPlansAmountsByMonthIdAction::class);
        $this->app->bind(GetPlanByMonthAndCategoryInterface::class, GetPlanByMonthAndCategoryAction::class);
        
        // Months
        $this->app->bind(GetMonthsInterface::class, GetMonthsAction::class);
        $this->app->bind(CreateMonthInterface::class, CreateMonthAction::class);

        // Category
        $this->app->bind(CreateCategoryInterface::class, CreateCategoryAction::class);
        $this->app->bind(GetCategoryInterface::class, GetCategoryAction::class);
        $this->app->bind(UpdateCategoryInterface::class, UpdateCategoryAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
