@if(Storage::disk('local')->has($user->phone_number . '-' . $user->id . '.jpg'))
    <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
         style="padding-right: 0px;padding-left: 0px;"><img
                class="rounded-circle img-fluid border rounded"
                {{--                                    src="{{ 'data:image/jpeg;base64,' . base64_encode($user->profile_picture) }}"--}}

                src="{{ route('user.image', ['filename' => $user->phone_number . '-' . $user->id . '.jpg']) }}"
                width="80%">
    </div>
@else
    <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
         style="padding-right: 0px;padding-left: 0px;"><img
                class="rounded-circle img-fluid border rounded"
                src="{{ 'data:image/jpeg;base64,' . base64_encode($user->profile_picture) }}"

                {{--                src="{{ route('user.image', ['filename' => $user->phone_number . '-' . $user->id . '.jpg']) }}"--}}
                width="80%">
    </div>
@endif