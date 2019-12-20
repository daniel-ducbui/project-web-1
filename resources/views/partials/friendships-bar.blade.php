@if(count($pending) > 0)
    <p>Friend requests</p>
    @foreach($pending as $p)
        <div class="row" style="margin: 5px;">
            <div class="col">
                <div class="row rounded border border-warning" style="padding: 10px;">
                    <div class="col-2 d-xl-flex justify-content-xl-center align-items-xl-center"
                         style="padding-right: 0px;padding-left: 0px;">

                        <!-- Load image (Optimized) -->
                        <img class="rounded-circle img-fluid border rounded"
                             src="{{ 'data:image/jpeg;base64,' . base64_encode( $p->sender == Auth::user()->id ? $p->findUserById($p->recipient)->profile_picture : $p->findUserById($p->sender)->profile_picture ) }}"
                             width="80%">
                        <!-- End load image (Optimized) -->

                    </div>
                    <div class="col-6 align-self-center justify-content-xl-start align-items-xl-center">
                        @if($p->sender == Auth::user()->id)
                            <a class="card-title"
                               href="{{ route('user.profile', [$p->findUserById($p->recipient), $p->recipient]) }}"
                               style="margin-bottom: 0px;font-size: 15px;">
                                {{ $p->findUserById($p->recipient)->name }}
                            </a>
                        @else
                            <a class="card-title"
                               href="{{ route('user.profile', [$p->findUserById($p->sender)->name, $p->sender]) }}"
                               style="margin-bottom: 0px;font-size: 15px;">
                                {{ $p->findUserById($p->sender)->name }}
                            </a>
                        @endif
                    </div>
                    <div class="col align-self-center justify-content-xl-start align-items-xl-center">
                        <div class="row">
                            @if(Auth::user()->id == $p->sender)
                                <div class="col-">
                                    <a class="btn btn-outline-danger btn-sm" role="button"
                                       href="{{ route('request.cancel', [$p->findUserById($p->recipient), $p->recipient]) }}">Cancel</a>
                                </div>
                            @else
                                <div class="col-"
                                     style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                        class="btn btn-outline-primary btn-sm" role="button"
                                        href="{{ route('request.accept', [$p->findUserById($p->sender)->name, $p->sender]) }}">V</a>
                                </div>
                                <div class="col-"
                                     style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                        class="btn btn-outline-danger btn-sm" role="button"
                                        href="{{ route('request.deny', [$p->findUserById($p->sender)->name, $p->sender]) }}">X</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <figure class="figure highlight"></figure>
            </div>
        </div>
    @endforeach
    <hr>
@endif

@if(count($accepted) > 0)
    @foreach($accepted as $a)
        <div class="row" style="margin: 5px;">
            <div class="col">
                <div class="row rounded border" style="padding: 10px;">
                    <div class="col-2 d-xl-flex justify-content-xl-center align-items-xl-center"
                         style="padding-right: 0px;padding-left: 0px;">

                        <!-- Load image (Optimized) -->
                        <img class="rounded-circle img-fluid border rounded"
                             src="{{ 'data:image/jpeg;base64,' . base64_encode( $a->sender == Auth::user()->id ? $a->findUserById($a->recipient)->profile_picture : $a->findUserById($a->sender)->profile_picture ) }}"
                             width="80%">
                        <!-- End load image (Optimized) -->

                    </div>
                    <div class="col-6 align-self-center justify-content-xl-start align-items-xl-center">
                        @if($a->sender == Auth::user()->id)
                            <a class="card-title"
                               href="{{ route('user.profile', [$a->findUserById($a->recipient)->name, $a->recipient]) }}"
                               style="margin-bottom: 0px;font-size: 15px;">
                                {{ $a->findUserById($a->recipient)->name }}
                            </a>
                        @else
                            <a class="card-title"
                               href="{{ route('user.profile', [$a->findUserById($a->sender)->name, $a->sender]) }}"
                               style="margin-bottom: 0px;font-size: 15px;">
                                {{ $a->findUserById($a->sender)->name }}
                            </a>
                        @endif
                    </div>
                    <div class="col align-self-center justify-content-xl-start align-items-xl-center">
                        <div class="row">
                            <div class="col"
                                 style="padding-right: 0px;padding-left: 0px;margin-right: 2px;margin-left: 2px;"><a
                                    class="btn btn-outline-success btn-sm" role="button" href="{{ route('chat.message', ['user_id' => ($a->sender == Auth::user()->id ? $a->recipient : $a->sender)]) }}">Message</a>
                            </div>
                        </div>
                    </div>
                </div>
                <figure class="figure highlight"></figure>
            </div>
        </div>
    @endforeach
@else
    <p>You don't have any friend :(</p>
@endif
