@if(Auth::user()->isFriendWith($p->user->id) || Auth::user() == $p->user)
    <div class="row">
        <div class="col">
            <form action="{{ route('post.store') }}" method="POST"
                  enctype="multipart/form-data">

                {!! csrf_field() !!}

                <div class="row">

                    <div class="col-10">
                        <div class="form-group">
                                                <textarea class="border-secondary form-control"
                                                          id="post_content"
                                                          name="post_content"
                                                          placeholder="Leave a comment..." rows="1"
                                                          autocomplete="off" spellcheck="true" wrap="soft"
                                                          minlength="1"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button
                                class="btn btn-outline-primary form-group"
                                type="submit" value="Submit" style="margin-bottom: 10px;">Post
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endif

{{--                        @foreach($comments as $c)--}}
<div class="row" style="border: 1px solid lightgray;padding: 5px;border-radius: 3px;">

    <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
         style="padding-right: 0px;padding-left: 0px;"><img
            class="rounded-circle img-fluid border rounded"
            {{--                                        src="{{ 'data:image/jpeg;base64,' . base64_encode($p->user->profile_picture) }}"--}}
            src="{{URL::to('src/images/default_profile_picture.png')}}"
            width="60%">
    </div>

    <div class="col d-xl-flex align-items-center">
        <div class="info">
            <p id="user_post_content" class="card-text">
                {{--                                    {{ $c->content }}--}}
                Something might here
            </p>
        </div>
    </div>
</div>
{{--                            @endforeach--}}
