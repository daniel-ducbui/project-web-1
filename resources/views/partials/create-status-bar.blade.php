<div class="row shadow shadow-sm" style="border: 1px solid black;padding: 10px;border-radius: 3px;">
    <div class="col">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">

            {!! csrf_field() !!}

            <div class="form-group">
                <label for="post_content">Create Post</label>
                <textarea class="border-secondary form-control"
                          id="post_content"
                          name="post_content"
                          placeholder="What's on your mind, {{ $user->name }}?" rows="3"
                          autocomplete="off" spellcheck="true" wrap="soft"
                          minlength="1"></textarea></div>
            <hr style="margin-top: 0px;margin-bottom: 5px;">
            <div class="form-row d-xl-flex justify-content-xl-end align-items-xl-center">
                <div class="form-group" style="margin-bottom: 0px;">
                    <input class="border rounded" type="file"
                           id="post_photo"
                           name="post_photo" accept="image/*" multiple>
                </div>
                <div class="form-group" style="margin-bottom: 0px;margin-left: 5px;">
                    <select id="privacy"
                            class="custom-select custom-select-sm"
                            name="privacy">
                        <option value="0" {{ old('privacy') == 0 ? 'selected' : '' }}>Only me</option>
                        <option value="1" {{ old('privacy') == 1 ? 'selected' : '' }}>Friends</option>
                        <option value="2" {{ old('privacy') == 2 ? 'selected' : '' }}>Public</option>
                    </select>
                </div>
            </div>
            <hr style="margin-top: 5px;margin-bottom: 15px;">
            <button
                class="btn btn-outline-primary btn-block form-group"
                type="submit" value="Submit" style="margin-bottom: 10px;">Post
            </button>
        </form>
    </div>
</div>
<hr>
