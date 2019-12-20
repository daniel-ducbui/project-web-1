@if(Auth::user()->isFriendWith($p->user->id) || Auth::user()->id == $p->user->id)
    <div class="row">
        <div class="col">
            <form action="{{ route('post.comment.store', ['post' => $p]) }}" method="POST"
                  enctype="multipart/form-data">

                {!! csrf_field() !!}

                <div class="row" style="padding-left:50px;">

                    <div class="col-10">
                        <div class="form-group">
                                                <textarea class="border-secondary form-control"
                                                          id="content"
                                                          name="content"
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

@if($p->comments != null)
    @foreach($p->comments as $c)
        <div class="row" style="border: 1px solid lightgray;padding: 5px; margin: 5px;border-radius: 3px;">

            <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
                 style="padding-right: 0px;padding-left: 0px;"><img
                    class="rounded-circle img-fluid border rounded"
                    src="{{ 'data:image/jpeg;base64,' . base64_encode($c->user->profile_picture) }}"
                    width="60%">
            </div>

            <div class="col- d-xl-flex align-items-center" style="padding: 0px;">
                <p class="card-title" style="margin-bottom: 0px;">
                    <a
                        href="{{ route('user.profile', [$c->user->name, $c->user_id]) }}"
                        class="edit"><strong>{{ $c->user->name }}</strong>
                    </a>
                </p>
            </div>

            <div class="col d-xl-flex align-items-center">
                <p id="user_post_content" class="card-text">
                    {{ $c->content }}
                </p>
            </div>

            <div class="col- d-xl-flex align-items-right">
                <p class="text-muted">
                    <small>
                        {{ $c->created_at }}
                    </small>
                </p>
            </div>
        </div>
    @endforeach
@endif
