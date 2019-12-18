<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{{ 1760034 }}</title>
</head>
<body>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h1 class="card-title">{{ !empty($details['title']) ? $details['title'] : '' }}</h1>
            <h3 class="card-text">{{ !empty($details['body']) ? $details['body'] : '' }}</h3>

            @if(!empty($details['url']))
                <a href="{{ $details['url'] }}" class="card-link">Go to profile</a>
            @endif

            @if(!empty($details['messages']))
                <p class="card-text">{{ $details['messages'] }}</p>
            @endif
        </div>
    </div>

</body>
</html>
