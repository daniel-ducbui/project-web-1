<!-- Start: Navigation with Button -->
<nav class="navbar navbar-light navbar-expand-md shadow navigation-clean-button">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Daniel</a>
        <button
                data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span
                    class="sr-only">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item" role="presentation"><a class="nav-link active"
                                                            href="{{ route('home') }}">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link"
                                                            href="#">Friends</a></li>
                <li class="nav-item" role="presentation"><a
                            class="btn btn-outline-light text-primary shadow-sm" role="button"
{{--                            href="{{ route('user.profile', ['user_name' => Auth::user()->name, 'user_id' => Auth::user()->id]) }}"--}}
                    >
{{--                        {{ Auth::user()->name }}--}}
                    </a>
                </li>
                <!-- Cần sửa lại navbar phát -->
            </ul>
            {{--            Add button here--}}
            @yield('navbar-right')
            <div style="margin-left: 5px;">
                <span class="navbar-text actions"> <a
                            class="btn btn-light text-danger border rounded border-danger shadow-sm action-button"
                            role="button" href="{{ route('user.logout') }}"
                            style="background-color: rgba(0,0,0,0);">LogOut</a>
                </span>
            </div>
        </div>
    </div>
</nav>
<!-- End: Navigation with Button -->
