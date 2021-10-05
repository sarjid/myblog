@extends('frontend.layouts.master')
@section('content')

  <!-- Start top-section Area -->
  <section class="top-section-area section-gap">
    <div class="container">
      <div class="row justify-content-between align-items-center d-flex">
        <div class="col-lg-8 top-left">
          <h1 class="text-white mb-20">All Category</h1>
          <ul>
            <li>
              <a href="{{ url('/') }}">Home</a
              ><span class="lnr lnr-arrow-right"></span>
            </li>
            <li>
              <a href="category.html">Category</a
              >
            </li>

          </ul>
        </div>
      </div>
    </div>
</section>

  <!-- Start fashion Area -->
  <section class="fashion-area section-gap" id="fashion">
    <div class="container">
      <div class="row">
    @forelse ($categories as $cat)
        <div class="col-lg-3 col-md-6 single-fashion" style="margin-bottom: 25px;">
          <img class="img-fluid" src="{{ asset('storage/category/'.$cat->image) }}" alt="" />
          <h4 class="text-center mt-3"><a href="{{ route('category.post',$cat->slug) }}">{{ $cat->name }}</a></h4>
          <div class="meta-bottom d-flex justify-content-between">
          </div>
        </div>
    @empty
    <div class="col-lg-12 col-md-12 single-fashion">
        <strong class="text-danger">Not Found</strong>
    </div>
    @endforelse
      </div>
    </div>
  </section>
  <!-- End fashion Area -->
@endsection
