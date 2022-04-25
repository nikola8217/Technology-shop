@extends('layouts.men_nav')




@section('content')


<div class="container" style="margin: 60px auto;  border-radius: 10px;">
    <reply-component :id="{{ $id }}"></reply-component>
</div>


@endsection