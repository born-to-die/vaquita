@include('common/head')

<body class="bg-dark text-light">
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="">
                <h1> Add month </h1>
            </div>
            <div class="mt-5 p-2 rounded shadow">
                <form action="store" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 col-sm">
                            <label for="month" class="form-label"> Month </label>
                            <select class="form-control bg-secondary" name="month">
                                @foreach ($months as $monthNumber => $month)
                                    <option value="{{ $monthNumber }}" {{ $monthNumber === $predictMonthNumber ? "selected" : "" }}> {{ $month }} </option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-12 col-sm">
                            <label for="year" class="form-label"> Year </label>
                            <select class="form-control bg-secondary" name="year">
                                @foreach ($years as $year)
                                    <option value='{{ $year }}' {{ $year === $currentYear ? "selected" : ""}} > {{ $year }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-3 mt-1 col-sm text-start">
                            <a href="{{ route('months') }}" class="w-100 btn btn-secondary"> Cancel </a>
                        </div>
                        <div class="col-sm"></div>
                        <div class="col-12 col-sm-3 mt-1 col-sm text-end">
                            <button type="submit" class="w-100 btn btn-primary"> Add </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>

</html>
