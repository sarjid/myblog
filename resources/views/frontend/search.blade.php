@extends('frontend.layouts.master')
@section('content')
    <!-- Start top-section Area -->
    <section class="top-section-area section-gap">
        <div class="container">
            <div class="row justify-content-center align-items-center d-flex">
                <div class="col-lg-8">
                    <div id="imaginary_container">
                        <form action="{{ route('search') }}" method="GET">
                        <div class="input-group stylish-input-group">
                            <input type="text" name="search" class="form-control"  placeholder="search here" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Addictionwhen gambling '" required="" value="{{ $search }}">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="lnr lnr-magnifier"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    </div>
                    <p class="mt-20 text-center text-white">{{ $posts->count() }} results found for “{{ $search }}”</p>
                </div>
            </div>
        </div>
    </section>
      <!-- End top-section Area -->

      <!-- Start post Area -->
      <div class="post-wrapper pt-100">
        <!-- Start post Area -->
        <section class="post-area">
          <div class="container">
            <div class="row justify-content-center d-flex">
              <div class="col-lg-8">
                <div class="top-posts pt-50">
                  <div class="container">
                    <div class="row justify-content-center">
                @forelse ($posts as $post)
                      <div class="single-posts col-lg-6 col-sm-6">
                        <img class="img-fluid" src="{{ asset('storage/post/'.$post->image) }}" alt="" />
                        <div class="date mt-20 mb-20">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
                        <div class="detail">
                          <a href="{{ route('post.detail',$post->slug) }}"><h4 class="pb-20">{{ $post->title }}</h4></a>
                          <p>{!! Str::limit($post->body, 400) !!}</p>
                          {{-- <p class="footer pt-20"> --}}
                        @guest
                            <a href="javascript::void(0)" id="like"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                {{ $post->likedUsers->count() }} Likes</a>
                            @else
                                <a onclick="document.getElementById('like-form-{{ $post->id }}').submit();"><i class="fa fa-thumbs-up" aria-hidden="true" style="color:{{auth()->user()->likedPosts()->where('post_id', $post->id)->count() > 0 ? 'red' : ''}}; cursor:pointer; "></i>
                                    {{$post->likedUsers->count()}} Likes</a>
                                <form action="{{ route('post.like',$post->id) }}" method="POST" style="display: none" id="like-form-{{ $post->id }}">
                                    @csrf
                                </form>
                            @endguest
                            <i class="ml-20 fa fa-comment-o"
                              aria-hidden="true"></i>
                            <a href="#">{{ $post->comments->count() }} Comments</a>
                          <p></p>
                        </div>
                      </div>
                @empty

                     <div>
                        <h3 class="text-danger">No Result Found</h3>
                     </div>

                @endforelse
                      <div class="justify-content-center d-flex">
                        {{-- <a class="text-uppercase primary-btn loadmore-btn mt-70 mb-60"
                          href="#">Load More Post</a> --}}
                          {{ $posts->appends(Request::all())->links() }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @include('frontend.layouts.partials.sidebar')
            </div>
          </div>
        </section>
        <!-- End post Area -->
      </div>
      <!-- End post Area -->
@endsection
