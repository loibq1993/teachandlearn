<header class="main-header">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    @foreach(__('navbar.header') as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link" href="{{$value['url']}}">{{ $value['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
