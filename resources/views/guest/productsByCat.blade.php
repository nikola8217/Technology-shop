@extends('layouts.nav')




@section('content')


{{-- <div class="container" style="margin: 60px auto;  border-radius: 10px;"> --}}
    <shoppro-component :id="{{ $id }}"></shoppro-component>
{{-- </div> --}}


@endsection