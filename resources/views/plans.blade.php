@include('common/head')

<body>
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="text-center">
                <h1> {{ $currentMonthName }} {{ $currentYear }} </h1>
            </div>
            <div class="row mt-4 mb-4 pb-3 border-3 border-bottom border-muted">
                <div class="col text-end">
                    <h4> <u> {{ $monthRealMoney }} </u> </h4>
                </div>
                <div class="col-12 col-md-9 text-start">
                    <div>
                        <div class="progress">
                            <div
                                class="progress-bar-striped {{ $monthPlanMoney ? (round($monthRealByPlanMoney / $monthPlanMoney * 100) < 100 ? 'bg-primary' : 'bg-success') : 'bg-secondary'}}"
                                 role="progressbar"
                                 style="width: {{ round(($monthRealByPlanMoney ?:1) / ($monthPlanMoney ?: 1) * 100) }}%"
                                 aria-valuenow="30"
                                 aria-valuemin="0"
                                 aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col pe-5 text-start">
                            <span> {{ $monthRealByPlanMoney }} / {{ $monthRealMoney }} </span>
                            <span class="text-secondary"> {{ round(($monthRealMoney ?:1) / ($monthPlanMoney ?: 1) * 100) }}% </span>
                        </div>
                        <div class="col text-end">
                            <span class="text-secondary"> {{ round(((($monthRealByPlanMoney ?: 1) - ($monthRealByPlanMoney - $monthPlanMoney < 0 ? 0 : $monthRealByPlanMoney - $monthPlanMoney))) / ($monthPlanMoney ?: 1) * 100) }}% </span>
                            <span> {{ $monthPlanMoney }} </span>
                        </div>
                    </div>
                    <div class="row text-secondary">
                        <div class="col text-start">
                            Basic expenses
                        </div>
                        <div class="col text-end">
                            {{ $expenseCategories['basic'] }}
                        </div>
                    </div>
                    <div class="row text-secondary">
                        <div class="col text-start">
                            Temporary expenses
                        </div>
                        <div class="col text-end">
                            {{ $expenseCategories['temporary'] }}
                        </div>
                    </div>
                    <div class="row text-secondary">
                        <div class="col text-start">
                            Unplanned expenses
                        </div>
                        <div class="col text-end">
                            {{ $expenseCategories['unplanned'] }}
                        </div>
                    </div>
                </div>
                <div class="col text-end">
                    <div class="row mb-1">
                        <a class="btn btn-success" href="{{ route('plans-create') }}"> <span class="h5">+</span> Add plan </a>
                    </div>
                    <div class="row">
                        <div class="col p-0 m-1">
                            <a class="btn btn-sm w-100 btn-secondary" href="" title="Prev month"> 🠜 </a>
                        </div>
                        <div class="col p-0 m-1">
                            <a class="btn btn-sm w-100 btn-secondary" href="?m=8" title="Next month"> 🠞 </a>
                        </div>
                    </div>
                </div>
            </div>
            @if (!$plans)
            <div class="rowbg-white">
                <div class="col p-2">
                    <h1 class="text-center text-secondary"> Oops :( </h1>
                    <h3 class="text-center text-secondary"> you have no plans for this month </h3>
                </div>
            </div>
            @endif
            @foreach ($plans as $plan)
                @if ($categoriesMap[$plan->category->id]['isTemporary'] === false)
                    <div class="row mt-4 rounded shadow border-start border-5 border-primary">
                @else
                    <div class="row mt-4 rounded shadow border-start border-5 border-secondary">
                @endif
                    <div class="col-12 col-sm-8 p-3">
                        <p class="h3"> {{ $plan->category->name }} @if ($plan->real > $plan->plan) ⚠️ @endif</p>
                        <p> {{ $plan->real }} filled out of  <b> {{ $plan->plan }} </b> </p>
                        @foreach ($plan->types as $type)
                            {{ $type }}
                        @endforeach
                        <div class="progress">
                            <div class="progress-bar-striped {{ $plan->plan ? (round($plan->real / ($plan->plan  ?: 1) * 100) < 100 ? 'bg-primary' : 'bg-success') : 'bg-warning'}}" role="progressbar" style="width: {{ round(($plan->real ?:1) / ($plan->plan ?: 1) * 100) }}%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @if ($plan->desc)
                            <div><pre class="w-100 mt-2">{{ $plan->desc }}</pre></div>
                        @endif                        
                    </div>
                    <div class="col-sm"></div>
                    <div class="col-12 col-sm-3 text-end p-3">
                        <a href="{{ route('plans-edit', ['id' => $plan->id]) }}" class="w-50 btn btn-secondary"> <img src="{{ asset('img/pencil-fill.svg') }}"> </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>

</html>
