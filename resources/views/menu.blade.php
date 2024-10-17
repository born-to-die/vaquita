<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <img src={{ config("app.url") . "/storage/logo.svg" }} width="32"> {{ config('app.name') }} </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('plans'); }}"> Main </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('months'); }}"> Months </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories'); }}"> Categories </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
