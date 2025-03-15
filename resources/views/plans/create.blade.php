@include('common/head')

<body class="bg-dark text-light">
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="">
                <h1> Create plane </h1>
            </div>
            <div class="mt-5 p-2 text-gray rounded shadow">
                <form action="{{ route('plans-store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"> Profile </label>
                        <select class="bg-dark text-light form-select" name="user_id" required>
                            <option disabled> Select profile </option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"> {{ $user->name }} ({{ $user->email }}) </option>
                            @endforeach
                          </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Date </label>
                        <select class="bg-dark text-light form-select" name="month_id" required>
                            <option disabled> Select date </option>
                            @foreach ($months as $month)
                                <option value="{{ $month->id }}"> {{ $monthsNames[$month->month - 1] }} {{ $month->year }} </option>
                            @endforeach
                          </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Category </label>
                        <select class="bg-dark text-light form-select" name="category_id" required>
                            <option disabled> Select category </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endforeach
                          </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm">
                            <label for="plan-value" class="form-label"> Plan </label>
                            <input type="number" class="bg-dark text-light form-control" id="plan-value" name="plan" value="0" min="0" required>
                        </div>
                        <div class="col-12 col-sm">
                            <label for="plan-real" class="form-label"> Real </label>
                            <input type="number" class="bg-dark text-light form-control" id="plan-real" name="real" value="0" min="0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-3 mt-1 col-sm text-start">
                            <a href="{{ route('plans') }}" class="w-100 text-dark btn btn-secondary"> Cancel </a>
                        </div>
                        <div class="col-sm"></div>
                        <div class="col-12 col-sm-3 mt-1 col-sm text-end">
                            <button type="submit" class="w-100 text-dark btn btn-primary"> Create </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>

</html>
