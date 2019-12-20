@extends('layouts.master')

@section('head.title')
    {{ Auth::user()->name }}
@endsection

@section('body.content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="margin-top: 100px;">
                <form action="{{ route('password.change') }}" class="border border-light shadow shadow-lg p-3 mb-5 bg-white rounded" method="POST"
                      style="padding: 20px;" enctype="multipart/form-data">

                @include('errors.message-block')

                <!--Generate token-->
                    {{ csrf_field() }}

                    {{-- Password --}}
                    <div class="form-group"><label class="d-block"
                                                   for="current_password">Current Password</label>
                        <input class="form-control" type="password" name="current_password"
                               {{--disabled--}}
                               placeholder="Enter your current password"
                               autocomplete="on" required>
                    </div>
                    <div class="form-group"><label class="d-block"
                                                   for="new_password">New Password</label>
                        <input class="form-control" type="password" name="new_password"
                               {{--disabled--}}
                               placeholder="Enter your new password"
                               autocomplete="on" required>
                    </div>
                    <div class="form-group"><label class="d-block"
                                                   for="new_password_confirmation">Confirm Password</label>
                        <input class="form-control" type="password"
                               {{--disabled--}}
                               name="new_password_confirmation" placeholder="Confirm your new password"
                               required autocomplete="off">
                    </div>
                    {{-- Password --}}
                    <button
                        class="btn btn-outline-primary btn-block form-group"
                        type="submit">Confirm
                    </button>

                    <a class="btn btn-light text-danger border btn-block rounded border-danger shadow-sm action-button"
                       role="button" href="{{ route('home') }}" style="background-color: rgba(0,0,0,0);">Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
