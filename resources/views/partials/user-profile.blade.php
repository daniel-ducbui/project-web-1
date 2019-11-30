@extends('layouts.app')

@section('head.title')
    {{ $user->name }}
@stop

{{--@extends('partials.navbar')--}}
@section('profile-bar-bottom')
    @if(Auth::user()->id == $user->id)
        <a class="btn btn-light text-info border rounded border-info shadow-sm action-button"
           href="{{ route('user.information') }}"
        >Edit profile</a>
    @endif
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
