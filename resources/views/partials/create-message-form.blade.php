<div>
    <div>
        <form action="{{ route('message.store', ['user_id' => $user->id]) }}" class="form" method="POST">
            {!! csrf_field() !!}
            <textarea
                cols="25"
                rows="5"
                class="form-input"
                id="content"
                name="content" style="width: 100%;border: 1px solid #d3e0e9;padding: 5px 10px;outline: none;">
            </textarea>
            <button
                class="btn btn-outline-primary btn-block form-group"
                type="submit" value="Submit" style="margin-bottom: 10px;">Send
            </button>
{{--            <span class="notice">--}}
{{--                Hit Enter to send a message--}}
{{--            </span>--}}
        </form>
    </div>
</div>
