@extends('layouts.app')

@section('head.title')
    {{ $user->name }}
@stop
{{--@extends('partials.navbar')--}}
@section('profile-bar-bottom')
    <div class="row justify-content-center">
        <div class="col">
            @if(Auth::user()->id != $user->id) {{-- Check if this is my profile --}}
                @if(Auth::user()->isFriendWith($user)) {{-- Check if this profile is my friend --}}
                    <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                       href="{{ route('request.unfriend', [$user->name, $user->id]) }}"
                    >Unfriend</a>
                @else
                    @if(Auth::user()->hasSentFriendRequestTo($user)) {{-- Check if I have already sent friend request to this profile --}}
                        <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
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
@stop

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 30px;">
            <div class="col-2 offset-1">
                @include('partials.left-home-page')
            </div>
            <div class="col-6">
                @include('partials.create-status-bar')

                @include('partials.newsfeed')
            </div>
            <div class="col-2">
                @include('partials.right-home-page')
            </div>
        </div>
    </div>
@endsection
