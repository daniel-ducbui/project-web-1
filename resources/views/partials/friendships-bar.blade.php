@foreach($friendships as $f)
    <div class="row" style="margin: 5px;">
        <div class="col">
            <div class="row rounded border" style="padding: 10px;">
                <div class="col-2 d-xl-flex justify-content-xl-center align-items-xl-center"
                     style="padding-right: 0px;padding-left: 0px;">

                    <!-- Load image (Optimized) -->
                    <img class="rounded-circle img-fluid border rounded"
                         src="{{ 'data:image/jpeg;base64,' . base64_encode( $f->sender == Auth::user() ? $f->recipient->profile_picture : $f->sender->profile_picture ) }}"
                         width="80%">
                    <!-- End load image (Optimized) -->

                </div>
                <div class="col-6 align-self-center justify-content-xl-start align-items-xl-center">
                    @if($f->sender == Auth::user())
                        <a class="card-title"
                           href="{{ route('user.profile', [$f->recipient->name, $f->recipient->id]) }}"
                           style="margin-bottom: 0px;font-size: 15px;">
                            {{ $f->recipient->name }}
                        </a>
                    @else
                        <a class="card-title"
                           href="{{ route('user.profile', [$f->sender->name, $f->sender->id]) }}"
                           style="margin-bottom: 0px;font-size: 15px;">
                            {{ $f->sender->name }}
                        </a>
                    @endif
                </div>
                <div class="col align-self-center justify-content-xl-start align-items-xl-center">
                    <div class="row">
{{--                        @if(Auth::user()->id != $user->id) --}}{{-- Check if this is my profile --}}
                        @if(Auth::user()->isFriendWith($f->sender == Auth::user() ? $f->recipient : $f->sender)) {{-- Check if this profile is my friend --}}
                        <div class="col"
                             style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                class="btn btn-outline-success btn-sm" role="button" href="">Message</a>
                        </div>
                        @else
                            <div class="col"
                                 style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                    class="btn btn-outline-primary btn-sm" role="button" href="">v</a>
                            </div>
                            <div class="col"
                                 style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                    class="btn btn-outline-danger btn-sm" role="button" href="">x</a>
                            </div>
                        @endif
{{--                        @else  --}}{{-- If this is my profile -> show me the way to my profile details --}}
{{--                        @endif--}}
                    </div>
                </div>
            </div>
            <figure class="figure highlight"></figure>
        </div>
    </div>
@endforeach
