@include('common/head')
<body class="bg-dark text-light">
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="">
                <h1> Edit plan #{{ $plan->id }}</h1>
            </div>
            <div class="mt-5 p-2 text-gray rounded shadow">
                <form action="{{ route('plans-update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3" style="display: none">
                        <label class="form-label"> Пользователь </label>
                        <select class="form-select bg-secondary" name="user_id" required>
                            <option disabled> Выберите пользователя </option>
                            @foreach ($users as $user)
                                @if ($user->id == $plan->user_id)
                                    <option value="{{ $user->id }}" selected> {{ $user->name }} ({{ $user->email }}) </option>
                                @else
                                    <option value="{{ $user->id }}"> {{ $user->name }} ({{ $user->email }}) </option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <label class="form-label"> Date </label>
                            <select class="form-select bg-secondary text-light" name="month_id" required>
                                <option disabled> Select date </option>
                                @foreach ($months as $month)
                                    @if ($month->id == $plan->month_id)
                                        <option value="{{ $month->id }}" selected> {{ $monthsNames[$month->month - 1] }} {{ $month->year }} </option>
                                    @else
                                        <option value="{{ $month->id }}"> {{ $monthsNames[$month->month - 1] }} {{ $month->year }} </option>
                                    @endif
                                @endforeach
                              </select>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <label class="form-label"> Category </label>
                            <select class="form-select bg-secondary text-light" name="category_id" required>
                                <option disabled> Select category </option>
                                @foreach ($categories as $category)
                                    @if ($category->id == $plan->category_id)
                                        <option value="{{ $category->id }}" selected> {{ $category->emoji }} {{ $category->name }} </option>
                                    @else
                                        <option value="{{ $category->id }}"> {{ $category->emoji }} {{ $category->name }} </option>
                                    @endif
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <label for="plan-value" class="form-label"> Plan </label>
                            <input type="number" class="form-control bg-secondary text-light" id="plan-value" name="plan" value="{{ $plan->plan }}" min="0" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="plan-real" class="form-label"> Real: <span class="{{ $missingAmount > 0 ? "text-danger" : "text-success" }}"> {{ $missingAmount ? "not enough " . $missingAmount : " completed"}} </span> </label>
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <input type="number" class="form-control bg-secondary text-light" id="plan-real" name="real" value="{{ $plan->real }}" min="0" required>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <button type="button" id="fillFactButton" class="btn btn-success bg-secondary text-light"> 
                                        <i class="bi bi-clipboard2-check-fill"></i> Fill
                                    </button>
                                </div>
                            </div> 
                        </div>
                        <div class="col-12 col-sm">
                            <label for="plan-desc" class="form-label"> Commment: </label>
                            <div class="row">
                                <div class="col-12 col-sm">
                                    <textarea 
                                        class="form-control bg-secondary text-light" 
                                        id="plan-desc" 
                                        name="desc" 
                                    >{{ $plan->desc }}</textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="col-12 col-sm">
                            <div class="row">
                                <div class="col-12 col-sm h4 text-end pe-5 pt-3">
                                    <input
                                        class="form-check-input bg-secondary text-light"
                                        type="checkbox"
                                        id="is_completed"
                                        name="is_completed"
                                        @if ($plan->is_completed)
                                            checked
                                        @endif
                                    >
                                    <label
                                        class="form-check-label"
                                        for="is_completed"
                                    > Completed </label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm mt-1 col-sm text-start">
                            <a href="{{ route('plans') }}" class="w-100 btn btn-secondary"> <i class="bi bi-arrow-left-circle"></i> Cancel </a>
                        </div>
                        <div class="col-sm mt-1 text-end">
                            <a href="{{ route('plans-delete', $plan->id) }}" class="w-100 btn btn-danger"> <i class="bi bi-trash3"></i> Delete </a>
                        </div>
                        <div class="col-12 col-sm-6 mt-1 col-sm text-end">
                            <button type="submit" class="w-100 btn btn-primary"> <i class="bi bi-send-fill"></i> Save </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>
<script>
    let fillButton = document.getElementById("fillFactButton");
    let planInput = document.getElementById("plan-value");
    let factInput = document.getElementById("plan-real");

    fillButton.onclick = fillFact;
    
    function fillFact()
    {
        const plan = parseFloat(planInput.value);
        factInput.value = plan;
    }
</script>
</html>
