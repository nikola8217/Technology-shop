@extends('layouts.nav')




@section('content')

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="../img/home1.jfif" style="height: 600px" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../img/home2.jfif" style="height: 600px" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../img/home3.jfif" style="height: 600px" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../img/home4.jfif" style="height: 600px" alt="Fourth slide">
      </div>
    </div>
  </div>

{{-- <div class="container"> --}}
    <home-component></home-component>
{{-- </div> --}}

@endsection