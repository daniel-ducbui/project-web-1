@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 30px;">
            <div class="col-2 offset-1">
                <!-- Left bar -->
                @include('partials.profile-bar')
            </div>
            <div class="col-6">
                <div class="row justify-content-center">
{{--                    <div class="col-md-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">Users</div>--}}
{{--                            <div class="card-body">--}}
{{--                                Users--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Messages</div>
                            <div class="card-body">
                                @include('partials.messages')

                                @include('partials.create-message-form')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-2">
                @include('partials.right-home-page')
            </div>
        </div>
    </div>
@endsection
