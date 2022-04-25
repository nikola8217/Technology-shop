@extends('layouts.admin_nav')




@section('content')


<div class="container" style="margin: 60px auto;  border-radius: 10px;">
    <products-component :id="{{ $id }}"></products-component>
</div>


@endsection