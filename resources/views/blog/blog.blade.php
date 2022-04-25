@extends('layouts.men_nav')




@section('content')


<div class="container" style="margin: 60px auto;  border-radius: 10px;">
    <blog-component :id="{{ $id }}"></blog-component>
</div>


@endsection