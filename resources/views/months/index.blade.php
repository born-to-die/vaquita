@include('common/head')

<body>
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="row">
                <div class="col text-start">
                    <h1> Months </h1>
                </div>
                <div class="col text-end">
                    <a class="btn btn-success" href="months/create"> <span class="h5">+</span> Add month </a>
                </div>
            </div>
            @foreach ($months as $month)
                <div class="mt-3 p-2 text-gray bg-white rounded shadow">
                
                    <div class="row">
                        <div class="col">
                            <h5>
                                {{ $monthsNames[$month['month'] - 1] }}
                                {{ $month['year'] }}
                            </h5>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col text-secondary">
                            <div> Plans number: {{ $month['plansNumber'] }} </div>
                            <div> Rate: {{ $month['realForMonth'] }} from {{ $month['planForMonth'] }}</div>
                        </div>
                        <div class="col text-end">
                            <a class="btn btn-secondary" href="{{ route('plans') }}?m={{ $month['month'] }} ">
                                View plans
                            </a>
                        </div>
                    </div>
                
                </div>
            @endforeach
        </div>
        <div class="col col-xxl"></div>
    </div>
</body>

</html>
