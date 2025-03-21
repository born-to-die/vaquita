@include('common/head')

<body class="bg-dark text-light">
    @include('menu')
    <div class="row px-5 pt-3">
        <div class="col col-xxl"> </div>
        <div class="col-12 col-xxl-6">
            <div class="">
                <h1> New category </h1>
            </div>
            <div class="mt-5 p-2 text-gray rounded shadow">
                <form action="store" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 col-sm">
                            <label for="name" class="form-label"> Name </label>
                            <input type="text" class="form-control bg-secondary" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-3 mt-1 col-sm text-start">
                            <a href="{{ route('categories') }}" class="w-100 btn btn-secondary"> Cancel </a>
                        </div>
                        <div class="col-sm"></div>
                        <div class="col-12 col-sm-3 mt-1 col-sm text-end">
                            <button type="submit" class="w-100 btn btn-primary"> Create </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col-xxl"> </div>
    </div>
</body>

</html>
