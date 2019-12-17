@foreach($messages as $m)
    {{--@dd($m->user)--}}
    <div class="message self">
        <strong class="user">{{ $m->sender }}</strong>
        <p class="body"> {{ $m->content }} </p>
    </div>

@endforeach
