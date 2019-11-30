@extends('layouts.master')

@section('head.title')
    {{ Auth::user()->name }}
@endsection

@section('body.content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="margin-top: 100px;">
                <form action="{{ route('user.update') }}" class="border rounded border-light shadow" method="POST"
                      style="padding: 20px;" enctype="multipart/form-data">

                @include('errors.message-block')

                <!--Generate token-->
                    {{ csrf_field() }}

                    <div class="form-group"><label class="d-block"
                                                   for="name">Your Name</label>
                        <input class="form-control" type="text"
                               id="name" name="name"
                               value="{{ $user->name }}"
                               placeholder="Enter your name"
                               autocomplete="on" required>
                    </div>
                    <div class="form-group"><label class="d-block"
                                                   for="email">Email</label>
                        <input class="form-control" type="email"
                               id="email" name="email"
                               value="{{ $user->email }}"
                               placeholder="Enter email"
                               autocomplete="on" required disabled></div>
                    <div class="form-group"><label class="d-block" for="phone_number">Phone Number</label>
                        <input class="form-control" type="tel"
                               name="phone_number" placeholder="Enter phone-number"
                               value="{{ $user->phone_number }}"
                               autocomplete="on" required disabled></div>

                    <div class="form-group"><label class="d-block"
                                                   for="dob">Birthday</label>
                        <select class="custom-select"
                                name="dob"
                                required>
                            <option>{{ $user->dob }}</option>
                            @for($i = 1990; $i < 2019; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group"><label class="d-block" for="password">Profile
                            Picture</label>
                        <input class="border rounded d-inline" type="file"
                               name="profile_picture"
                               id="profile_picture"
{{--                               value=""--}}
                               accept="image/*">
                    </div>
                    @if($user->profile_picture)
                        <div class="d-block d-xl-flex justify-content-xl-center align-items-xl-center">
                            <img class="img-fluid border rounded border-light"
                                 src="{{ 'data:image/jpeg;base64,' . base64_encode($user->profile_picture) }}"
                            >
                        </div>
                        <hr>
                    @endif
                    <button
                            class="btn btn-outline-primary btn-block form-group"
                            type="submit">Confirm
                    </button>

                    <a class="btn btn-light text-primary border btn-block rounded border-primary shadow-sm action-button"
                       role="button" href="{{ route('password.change') }}" style="background-color: rgba(0,0,0,0);">Change Password
                    </a>

                    <a class="btn btn-light text-danger border btn-block rounded border-danger shadow-sm action-button"
                       role="button" href="{{ route('home') }}" style="background-color: rgba(0,0,0,0);">Done
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
{{-- Password --}}
{{--<div class="form-group"><label class="d-block"--}}
{{--                               for="password">Password</label>--}}
{{--    <input class="form-control" type="password" name="password"--}}
{{--           disabled--}}
{{--           placeholder="Enter password"--}}
{{--           autocomplete="on" required>--}}
{{--</div>--}}
{{--<div class="form-group"><label class="d-block"--}}
{{--                               for="password_confirmation">Confirm Password</label>--}}
{{--    <input class="form-control" type="password"--}}
{{--           disabled--}}
{{--           name="password_confirmation" placeholder="Confirm password"--}}
{{--           required autocomplete="off">--}}
{{--</div>--}}
{{-- Password --}}
