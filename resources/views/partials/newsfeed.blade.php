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
                        @if($p->user->profile_picture)
                            <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
                                 style="padding-right: 0px;padding-left: 0px;"><img
                                    class="rounded-circle img-fluid border rounded"
                                    src="{{ 'data:image/jpeg;base64,' . base64_encode($p->user->profile_picture) }}"
                                    width="80%">
                            </div>
                        @else
                            <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"
                                 style="padding-right: 0px;padding-left: 0px;"><img
                                    class="rounded-circle img-fluid border rounded"
                                    {{--src="{{ 'data:image/jpeg;base64,' . base64_encode($user->profile_picture) }}"--}}
                                    src="{{ URL::to('src/images/default_profile_picture.svg') }}"
                                    width="80%">
                            </div>
                        @endif
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
                    <div class="row interaction" style="margin-left: 10px;">
                        @if(Auth::user() == $p->user)
                            <a href="#" class="edit">Edit</a> | <!-- Chỗ này chưa làm -->
                            <a href="{{ route('post.delete', ['post_id' => $p->id]) }}">Delete</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Page navigator -->
<div class="row">
    <div class="col-md-6 offset-md-3">
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
