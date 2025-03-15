@include('common/head')

<body>
    @include('menu')
    <div class="row px-5 pt-3 bg-dark text-light">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="row">
                <div class="col text-start">
                    <h1> Categories </h1>
                </div>
                <div class="col text-end">
                    <a class="btn btn-success" href="{{ route('categories-create') }}"> <span class="h5">+</span> Add category </a>
                </div>
            </div>
            @foreach ($categories as $category)
                <div class="row px-3 pt-3">
                    <div class="col p-2 text-gray rounded shadow">
                        <div class="row">
                            <div class="col">
                                <p class="h3"> {{ $category['name'] }} </p>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('categories-edit', $category->id) }}" class="btn btn-danger"> <img src="{{ asset('img/trash3.svg') }}"> </a>
                                <a href="{{ route('categories-edit', $category->id) }}" class="btn btn-secondary"> <img src="{{ asset('img/pencil-fill.svg') }}"> </a>
                            </div>
                        </div>
                        @if ($category['is_temp'] === 0)
                            <div class="row">
                                <div class="col text-info">
                                    REQUIRED
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>
</body>

</html>
