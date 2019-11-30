<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
            @if($user->profile_picture)
                <img class="img-fluid border rounded border-light"
                     src="{{ 'data:image/jpeg;base64,' . base64_encode($user->profile_picture) }}"
                >
            @else
                <img class="img-fluid border rounded border-light"
                     src="{{ URL::to('src/images/default_profile_picture.svg') }}"
                >
            @endif
        </div>
        <hr>
        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
            <h4 class="card-title">{{ $user->name }}</h4>
        </div>
        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
            {{-- Something might here--}}
        </div>
        <div class="d-block d-xl-flex">
            @yield('profile-bar-bottom')
        </div>
    </div>
</div>
