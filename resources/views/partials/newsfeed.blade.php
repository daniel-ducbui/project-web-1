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

                        <div class="row justify-content-start">
                            <div class="col-2">
                                <div class="alert alert-light" role="alert" style="padding: 5px; margin: 0px;">
                                    &#10084; {{ count($p->countLikes($p)) }}
                                </div>
                            </div>
                        </div>
                        <div class="row interaction justify-content-start" style="margin-left: 10px;">
                            <div class="col-4">
                                @if(Auth::user()->isFriendWith($p->user->id) || Auth::user() == $p->user)
                                    @if ($p->isLike($p))
                                        <a class="btn btn-primary"
                                           href="{{ route('like.like', ['post_id' => $p->id]) }}">Unlike</a>
                                    @else
                                        <a class="btn btn-outline-primary"
                                           href="{{ route('like.like', ['post_id' => $p->id]) }}">Like</a>
                                    @endif

                                @endif
                                @if(Auth::user() == $p->user)
                                    <a class="btn btn-outline-info edit" href="">Edit</a> <!-- Chỗ này chưa làm -->
                                    <a class="btn btn-outline-danger"
                                       href="{{ route('post.delete', ['post_id' => $p->id]) }}">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--                        @if(thisPostHaveComment)--}}
                    <div class="card-footer">

                        @include('partials.comments')

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
                <a class="btn btn-primary" href="">Save</a>
            </div>
        </div>
    </div>
</div>
<!-- End modal-->
