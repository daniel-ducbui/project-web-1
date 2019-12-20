@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 10px;">
        <div class="col-2 offset-1">
            @include('partials.left-home-page')
        </div>
        <div class="col-6">
            @include('partials.create-status-bar')

            @include('partials.newsfeed')
        </div>
        <div class="col-2">
            @include('partials.right-home-page')
        </div>
    </div>
</div>
@endsection
