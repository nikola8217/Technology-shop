@extends('layouts.nav')




@section('content')


{{-- <div class="container" style="margin: 60px auto;  border-radius: 10px;"> --}}
    <product-component :id="{{ $id }}"></product-component>
{{-- </div> --}}


@endsection