<!-- Start: Navigation with Button -->
<nav class="navbar navbar-light sticky-top bg-light navbar-expand-md shadow navigation-clean-button">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Welcome</a>
        <button
            data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span
                class="sr-only">Toggle navigation</span><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto justify-content-end">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item" role="presentation"><a class="nav-link active"
                                                                href="{{ route('home') }}"
                        >Home</a></li>
                    <li class="nav-item mr-sm-2" role="presentation"><a
                            class="btn btn-outline-light text-primary shadow-sm" role="button"
                            href="{{ route('user.profile', ['user_name' => Auth::user()->name, 'user_id' => Auth::user()->id]) }}"
                        >
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation"><a
                            class="btn btn-light text-danger border rounded border-danger shadow-sm action-button"
                            role="button" href=""
                            style="background-color: rgba(0,0,0,0);"
                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>

        </div>
    </div>
</nav>
<!-- End: Navigation with Button -->
