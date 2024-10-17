@include('common/head')
<body>
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="">
                <h1> Редактирование плана #{{ $plan->id }}</h1>
            </div>
            <div class="mt-5 p-2 text-gray bg-white rounded shadow">
                <form action="{{ route('plans-update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"> Пользователь </label>
                        <select class="form-select" name="user_id" required>
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
                    <div class="mb-3">
                        <label class="form-label"> Дата </label>
                        <select class="form-select" name="month_id" required>
                            <option disabled> Выберите дату </option>
                            @foreach ($months as $month)
                                @if ($month->id == $plan->month_id)
                                    <option value="{{ $month->id }}" selected> {{ $monthsNames[$month->month - 1] }} {{ $month->year }} </option>
                                @else
                                    <option value="{{ $month->id }}"> {{ $monthsNames[$month->month - 1] }} {{ $month->year }} </option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Категория </label>
                        <select class="form-select" name="category_id" required>
                            <option disabled> Выберите категорию </option>
                            @foreach ($categories as $category)
                                @if ($category->id == $plan->category_id)
                                    <option value="{{ $category->id }}" selected> {{ $category->name }} </option>
                                @else
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm">
                            <label for="plan-value" class="form-label"> План </label>
                            <input type="number" class="form-control" id="plan-value" name="plan" value="{{ $plan->plan }}" min="0" required>
                        </div>
                        <div class="col-12 col-sm">
                            <label for="plan-real" class="form-label"> Факт: <span class="{{ $missingAmount > 0 ? "text-danger" : "text-success" }}"> {{ $missingAmount ? "не хватает " . $missingAmount : " выполнено"}} </span> </label>
                            <div class="row">
                                <div class="col-12 col-sm">
                                    <input type="number" class="form-control" id="plan-real" name="real" value="{{ $plan->real }}" min="0" required>
                                </div>
                                <div class="col-12 col-sm">
                                    <button type="button" id="fillFactButton" class="btn btn-success"> 
                                        <i class="bi bi-clipboard2-check-fill"></i> Заполнить
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm mt-1 col-sm text-start">
                            <a href="/" class="w-100 btn btn-secondary"> <i class="bi bi-arrow-left-circle"></i> Отмена </a>
                        </div>
                        <div class="col-sm mt-1 text-end">
                            <a href="{{ route('plans-delete', $plan->id) }}" class="w-100 btn btn-danger"> <i class="bi bi-trash3"></i> Удалить </a>
                        </div>
                        <div class="col-12 col-sm-6 mt-1 col-sm text-end">
                            <button type="submit" class="w-100 btn btn-primary"> <i class="bi bi-send-fill"></i> Сохранить </button>
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
