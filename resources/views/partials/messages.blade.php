@foreach($messages as $m)
    <div class="message self">

        <div class="row justify-content-center">
            <div class="col-10 border" style="margin: 3px; padding: 10px;">
                <strong class="user">{{ $m->sender }}</strong>
                <p class="body" style="margin: 0px;"> {{ $m->content }} </p>
            </div>
            <div class="col-">
                <a class="btn btn-outline-danger"
                   href="{{ route('message.delete', ['user_id' => Auth::user()->id, 'message_id' => $m->id]) }}">Delete</a>
            </div>
        </div>

    </div>
@endforeach
