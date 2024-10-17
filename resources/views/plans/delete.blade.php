@include('common/head')

<body>
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="">
                <h1> Удаление плана #{{ $plan->id }}</h1>
            </div>
            <div class="mt-5 p-2 text-gray bg-white rounded shadow">
                <div class="h3 text-center"> Вы уверены ? </div>
                <form action="{{ route('plans-destroy', $plan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-12 col-sm">
                            <a href="" class="w-100 btn btn-secondary"> Отмена </a>
                        </div>
                        <div class="col-12 col-sm mt-1">
                            <button type="submit" class="w-100 btn btn-danger"> Удалить </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>

</html>
