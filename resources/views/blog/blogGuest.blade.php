@extends('layouts.nav')




@section('content')


<div class="container" style="margin: 60px auto;  border-radius: 10px;">
    <blogview-component :id="{{ $id }}"></blogview-component>
</div>


@endsection