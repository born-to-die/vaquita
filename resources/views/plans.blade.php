@include('common/head')

<body class="bg-dark text-light">
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-auto col-xxl-9">
            <div class="text-center">
                <h1> {{ $currentMonthName }} {{ $currentYear }} </h1>
            </div>
            <div class="row mt-4 mb-4 pb-3 border-bottom border-secondary ">
                <div class="col-12 col-xl-auto text-end text-monospace shadow m-1 p-3 border border-secondary rounded">
                    <div class="row pb-2">
                        <div class="col-1 text-start">
                            <span class="h2 text-secondary"> {{ round(($monthRealMoney ?:1) / ($monthPlanMoney ?: 1) * 100) }}% </span>
                        </div>
                        <div class="col text-light">
                            <span class="h2" title="Total spent"> <b> {{ number_format($monthRealMoney, 0, null, ' ') }} 🪙 </b> </span>
                        </div>
                    </div>
                    <div class="row text-muted">
                        <div class="col-1 text-start">
                            <span class="h3"> P </span>
                        </div>
                        <div class="col">
                            <span class="h3" title="Planned expenses"> {{ number_format($monthPlanMoney, 0, null, ' ') }} ¤ </span>
                        </div>
                    </div>
                    <div class="row text-muted">
                        <div class="col-1 text-start">
                            <span class="h3"> W </span>
                        </div>
                        <div class="col">
                            <span class="h4 text-muted" title="Spent within plan"> {{ number_format($monthRealByPlanMoney, 0, null, ' ') }} ¤ </span>
                        </div>
                    </div>
                    <div class="row text-muted">
                        <div class="col-1 text-start">
                            <span class="h5"> O </span>
                        </div>
                        <div class="col">
                            <span class="h5 text-muted" title="Spent outside of plan"> {{ number_format($monthRealMoney - $monthRealByPlanMoney, 0, null, ' ') }} ¤ </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 text-start shadow border border-secondary rounded m-1 p-3">
                    <div>
                        <div class="progress">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated {{ $monthPlanMoney ? (round($monthRealByPlanMoney / $monthPlanMoney * 100) < 100 ? 'bg-primary' : 'bg-success') : 'bg-secondary'}}"
                                 role="progressbar"
                                 style="width: {{ round(($monthRealByPlanMoney ?:1) / ($monthPlanMoney ?: 1) * 100) }}%"
                                 aria-valuenow="30"
                                 aria-valuemin="0"
                                 aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col pe- text-start">
                            <span title="Total spent"> {{ number_format($monthRealMoney, 0, null, ' ') }} ¤ </span>
                            <span class="text-secondary" title="Total percentage of spending from plan"> | {{ round(($monthRealMoney ?:1) / ($monthPlanMoney ?: 1) * 100) }}% </span>
                        </div>
                        <div class="col text-end">
                            <span class="text-secondary"> {{ round(((($monthRealByPlanMoney ?: 1) - ($monthRealByPlanMoney - $monthPlanMoney < 0 ? 0 : $monthRealByPlanMoney - $monthPlanMoney))) / ($monthPlanMoney ?: 1) * 100) }}% |</span>
                            <span title="Planned expenses"> {{ number_format($monthPlanMoney, 0, null, ' ') }} ¤ </span>
                        </div>
                    </div>
                    <div class="row text-secondary">
                        <div class="col text-start">
                            Basic expenses
                        </div>
                        <div class="col text-end">
                            {{ $expenseCategories['basic'] }} ¤
                        </div>
                    </div>
                    <div class="row text-secondary">
                        <div class="col text-start">
                            Temporary expenses
                        </div>
                        <div class="col text-end">
                            {{ $expenseCategories['temporary'] }} ¤
                        </div>
                    </div>
                    <div class="row text-secondary">
                        <div class="col text-start">
                            Unplanned expenses
                        </div>
                        <div class="col text-end">
                            {{ $expenseCategories['unplanned'] }} ¤
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-2 text-end m-1 p-3 shadow border border-secondary rounded">
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
            <div class="row">
            @foreach ($plans as $plan)
                @if ($categoriesMap[$plan['category_id']]['isTemporary'] === false)
                    <div class="col-12 col-sm-5 col-md-3 col-lg-2 col-xl-2 my-3 mx-3 rounded shadow border-start border-5 border-primary">
                @else
                    <div class="col-12 col-sm-5 col-md-3 col-lg-2 col-xl-2 my-3 mx-3 rounded shadow border-start border-5 border-secondary">
                @endif
                    <div>
                        <span class="h3">

                            @if ($plan['category_emoji'])
                                {{ $plan['category_emoji'] }}
                            @endif

                            {{ $categoriesMap[$plan['category_id']]['name'] }}

                            @if ($categoriesMap[$plan['category_id']]['name'] === "Foundation")
                                {{ round($plan['real'] * 100 / ($monthRealMoney == 0 ? 1 : $monthRealMoney)) }} % /
                                {{ round($plan['plan'] * 100 / ($monthPlanMoney == 0 ? 1 : $monthPlanMoney)) }} %
                            @endif
                        </span>
                        <p class="pt-2"> {{ $plan['real'] }} filled out of  <b> {{ $plan['plan'] }} </b> </p>
                        <div class="progress">
                            <div
                                @if ($plan['is_completed'] && $plan['real'] === $plan['plan'])
                                    class="progress-bar bg-success"
                                @elseif ($plan['is_completed'] && $plan['real'] < $plan['plan'])
                                    class="progress-bar bg-success"
                                @elseif ($plan['plan'] === 0)
                                    class="progress-bar bg-danger text-dark"
                                @elseif ($plan['real'] > $plan['plan'] && $plan['plan'] !== 0)
                                    class="progress-bar bg-warning text-dark"
                                @elseif ($plan['real'] < $plan['plan'])
                                    class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                @else
                                    class="progress-bar bg-success"
                                @endif
                                role="progressbar" style="width: {{ round(($plan['real'] ?:1) / ($plan['plan'] ?: 1) * 100) }}%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                            > {{ $plan['plan'] > 0 ? round(($plan['real'] ?:1) / ($plan['plan'] ?: 1) * 100) : 100 }}% </div>
                        
                            @if ($plan['is_completed'] && $plan['real'] < $plan['plan'])
                                
                            @endif

                            @if ($plan['real'] < $plan['plan'])
                                <div
                                    @if ($plan['is_completed'] && $plan['real'] < $plan['plan'])
                                        class="progress-bar bg-secondary"
                                    @else
                                        class="progress-bar progress-bar-striped bg-dark"
                                    @endif
                                    role="progressbar"
                                    style="width: {{ 100 - round(($plan['real'] ?:1) / ($plan['plan'] ?: 1) * 100) }}%"
                                > {{ 100 - round(($plan['real'] ?:1) / ($plan['plan'] ?: 1) * 100) }}% </div>
                            @endif
                        </div>
                        @if ($plan['desc'])
                            <div><pre class="w-100 mt-2">{{ $plan['desc'] }}</pre></div>
                        @endif                        
                    </div>
                    <div>
                        <a href="{{ route('plans-edit', ['id' => $plan['id']]) }}" class="btn btn-secondary"> <img src="{{ asset('img/pencil-fill.svg') }}"> </a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>

</html>
