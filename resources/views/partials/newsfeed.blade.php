@if(count($posts) > 0)
    @foreach($posts as $p)
        <div class="row">
            <div class="col">
                <div class="shadow md card mb-3" style="padding: 10px;">
                    @if($p->post_photo)
                        <img class="img-fluid card-img-top" style="padding-top: 5px;"
                             src="{{ 'data:image/jpeg;base64,' . base64_encode($p->post_photo) }}"
                        >
                        <hr>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
                                 style="padding-right: 0px;padding-left: 0px;"><img
                                    class="rounded-circle img-fluid border rounded"
                                    src="{{ 'data:image/jpeg;base64,' . base64_encode($p->user->profile_picture) }}"
                                    width="80%">
                            </div>
                            <div
                                class="col d-xl-flex align-self-center justify-content-xl-start align-items-xl-center">
                                <h5 class="card-title" style="margin-bottom: 0px;">
                                    <a
                                        href="{{ route('user.profile', [$p->user->name, $p->user_id]) }}"
                                        class="edit">{{ $p->user->name }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <div class="info">
                            @if($p->post_content)
                                <p id="user_post_content" class="card-text" style="margin-top: 10px;">
                                    {{ $p->post_content }}
                                </p>
                            @endif
                        </div>
                        <p class="card-text"><small class="text-muted">{{ $p->created_at }}</small>
                        </p>
                        <div class="row interaction justify-content-start" style="margin-left: 10px;">
                            <div class="col-4">
                                @if(Auth::user()->isFriendWith($p->user->id) || Auth::user() == $p->user)
                                    <a class="btn btn-outline-primary" href="#">Like</a>
                                @endif
                                @if(Auth::user() == $p->user)
                                    <a class="btn btn-outline-info edit" href="#">Edit</a> <!-- Chỗ này chưa làm -->
                                    <a class="btn btn-outline-danger"
                                       href="{{ route('post.delete', ['post_id' => $p->id]) }}">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--                        @if(thisPostHaveComment)--}}
                    <div class="card-footer">

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

                    </div>
                    {{--                    @endif--}}

                </div>
            </div>
        </div>
    @endforeach
@else
    <p>Nothing to show ...</p>
@endif
<!-- Page navigator -->
<div class="row">
    <div class="col-md-6 offset-md-5">
        {!! $posts->render() !!}
    </div>
</div>
<!-- Page navigator -->

<!-- Start modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post_content" class="col-form-label">Content</label>
                        <textarea class="form-control" name="post-content" id="post-content" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- End modal-->
