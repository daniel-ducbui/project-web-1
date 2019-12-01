@extends('layouts.app')

@section('head.title')
    {{ $user->name }}
@stop

{{--@extends('partials.navbar')--}}
@section('profile-bar-bottom')
    <div class="row justify-content-center">
        <div class="col">
            @if(Auth::user()->id != $user->id) {{-- Check if this is current user profile --}}
                @if(Auth::user()->getFriendship((int)$user->id) == false) {{-- Check if have friend ship --}}
                    @if(Auth::user()->getFriendship((int)$user->id) == false) {{-- Check if this this user sent friend requests to current user --}}
                    <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                       href="{{ '\home' }}"
                    >Accept</a>
                    @else
                        <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                           href=""
                        >Pending</a>
                    @endif
                @else
                    <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                       href="{{ route('request.send', [$user->name, $user->id]) }}"
                    >Add friend</a>
                @endif
                <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
                   href=""
                >Follow</a>
            @else
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
                @include('partials.profile-bar')
            </div>
            <div class="col-6">
                @include('partials.create-status-bar')

                @include('partials.newsfeed')
            </div>
            <div class="col-2">
                <!-- Empty column -->

                @include('errors.message-block')
            </div>
        </div>
    </div>
@stop
