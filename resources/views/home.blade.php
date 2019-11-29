@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">Dashboard</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    You are logged in!--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

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
@endsection
