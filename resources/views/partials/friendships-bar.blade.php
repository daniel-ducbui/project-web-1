@foreach($friendships as $f)
    <div class="row" style="margin: 5px;">
        <div class="col">
            <div class="row rounded border" style="padding: 10px;">
                <div class="col-2 d-xl-flex justify-content-xl-center align-items-xl-center"
                     style="padding-right: 0px;padding-left: 0px;">

                    <!-- Load image (Need optimize) -->
                    @if($f->sender == $user)
                        @if($f->recipient->profile_picture)
                            <img class="rounded-circle img-fluid border rounded"
                                 src="{{ 'data:image/jpeg;base64,' . base64_encode($f->recipient->profile_picture) }}"
                                 width="80%">
                        @else
                            <img class="rounded-circle img-fluid border rounded"
                                 src="{{ URL::to('src/images/default_profile_picture.svg') }}" width="80%">
                        @endif
                    @else
                        @if($f->sender->profile_picture)
                            <img class="rounded-circle img-fluid border rounded"
                                 src="{{ 'data:image/jpeg;base64,' . base64_encode($f->sender->profile_picture) }}"
                                 width="80%">
                        @else
                            <img class="rounded-circle img-fluid border rounded"
                                 src="{{ URL::to('src/images/default_profile_picture.svg') }}" width="80%">
                        @endif
                    @endif

                </div>
                <div class="col-6 align-self-center justify-content-xl-start align-items-xl-center">
                    <h5 class="card-title"
                        {{--href="{{ route('user.profile', [$f->recipient->name, $f->recipient->id]) }}"--}}
                        style="margin-bottom: 0px;font-size: 15px;">
                        {{ $f->sender == $user ? $f->recipient->name : $f->sender->name }}
                    </h5>
                </div>
                <div class="col align-self-center justify-content-xl-start align-items-xl-center">
                    <div class="row">
                        <div class="col"
                             style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                class="btn btn-outline-primary btn-sm" role="button" href="">v</a></div>
                        <div class="col"
                             style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                class="btn btn-outline-danger btn-sm" role="button" href="">x</a></div>
                    </div>
                </div>
            </div>
            <figure class="figure highlight"></figure>
        </div>
    </div>
@endforeach
