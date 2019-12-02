<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
            <img class="img-fluid border rounded border-light"
                 src="{{ 'data:image/jpeg;base64,' . base64_encode($user->profile_picture) }}"
            >
        </div>
        <hr>
        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
            <h4 class="card-title">{{ $user->name }}</h4>
        </div>
        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
            {{-- Something might here--}}
        </div>
        <div class="d-block d-xl-flex">
            <div class="row justify-content-center">
                <div class="col">
                    @if(Auth::user()->id != $user->id) {{-- Check if this is my profile --}}
                        @if(Auth::user()->isFriendWith($user)) {{-- Check if this profile is my friend --}}
                        <a class="btn btn-light text-danger border rounded border-danger shadow-sm action-button"
                           href="{{ route('request.unfriend', [$user->name, $user->id]) }}"
                        >Unfriend</a>
                        @else
                            @if(Auth::user()->hasSentFriendRequestTo($user)) {{-- Check if I have already sent friend request to this profile --}}
                            <a class="btn btn-light text-warning border rounded border-warning shadow-sm action-button disabled"
                               href=""
                            >Pending</a>
                            @elseif(Auth::user()->hasFriendRequestFrom($user)) {{-- Check if this profile sent me a friend request --}}
                            <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                               href="{{ route('request.accept', [$user->name, $user->id]) }}"
                            >Accept</a>
                            <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                               href="{{ route('request.deny', [$user->name, $user->id]) }}"
                            >Deny</a>
                            @else
                                <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                                   href="{{ route('request.send', [$user->name, $user->id]) }}"
                                >Add friend</a>
                            @endif
                        @endif
                    @else  {{-- If this is my profile -> show me the way to my profile details --}}
                    <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                       href="{{ route('user.information') }}"
                    >Edit profile</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
