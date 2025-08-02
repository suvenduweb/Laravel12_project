@extends('home.home_master')
@section('home')



@include('home.homelayout.slider')
  <!-- end hero -->
@include('home.homelayout.features')
  <!-- end content -->

@include('home.homelayout.clarifes')
  <!-- end content -->

@include('home.homelayout.get_all')

  <div class="lonyo-content-shape3">
    <img src="{{asset('frontend/assets/images/shape/shape2.svg')}}" alt="">
  </div>
  <!-- end content -->

@include('home.homelayout.usability')

  <div class="lonyo-content-shape1">
    <img src="{{asset('frontend/assets/images/shape/shape3.svg')}}" alt="">
  </div>
  <!-- end video -->

@include('home.homelayout.review')
  <!-- end testimonial -->

@include('home.homelayout.answers')
  <div class="lonyo-content-shape3">
    <img src="{{asset('frontend/assets/images/shape/shape2.svg')}}" alt="">
  </div>
  <!-- end faq -->
@include('home.homelayout.apps')

  <!-- end cta -->



@endsection
