@extends('frontend.layouts.master')
@section('content')
    <!-- Start top-section Area -->
    <section class="top-section-area section-gap">
        <div class="container">
          <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
              <h1 class="text-white mb-20">{{ $query }} Tag Posts</h1>
              <ul>
                <li>
                  <a href="{{ url('/') }}">Home</a
                  ><span class="lnr lnr-arrow-right"></span>
                </li>
                <li>
                    <a href="javascript::void(0)">Tags</a
                    ><span class="lnr lnr-arrow-right"></span>
                </li>
                <li><a href="javascript::void(0)">{{ $query }}</a></li>
              </ul>
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
                @forelse ($tags as $tag)
                      <div class="single-posts col-lg-6 col-sm-6">
                        <img class="img-fluid" src="{{ asset('storage/post/'.$tag->post->image) }}" alt="" />
                        <div class="date mt-20 mb-20">{{ Carbon\Carbon::parse($tag->post->created_at)->diffForHumans() }}</div>
                        <div class="detail">
                          <a href="{{ route('post.detail',$tag->post->slug) }}"><h4 class="pb-20">{{ $tag->post->title }}</h4></a>
                          {{-- <p>{!! Str::limit($tag->post->body, 400, '...') !!}</p> --}}
                        @guest
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            <a href="javascript::void(0)">{{ $tag->post->likedUsers->count() }} Likes</a>
                        @else
                            <a onclick="document.getElementById('like-form-{{ $tag->post->id }}').submit();"><i class="fa fa-thumbs-up" aria-hidden="true" style="color:{{auth()->user()->likedPosts()->where('post_id', $tag->post->id)->count() > 0 ? 'red' : ''}}; cursor:pointer; "></i>
                                {{$tag->post->likedUsers->count()}} Likes</a>

                            <form action="{{ route('post.like',$tag->post->id) }}" method="POST" style="display: none" id="like-form-{{ $tag->post->id }}">
                                @csrf
                            </form>
                        @endguest
                            <i
                              class="ml-20 fa fa-comment-o"
                              aria-hidden="true"
                            ></i>
                            <a href="#">02 Comments</a>
                         <p></p>
                        </div>
                      </div>
                @empty
                    <div class="single-posts col-lg-12 col-sm-12">
                        No Post Founds
                    </div>
                @endforelse
                      <div class="justify-content-center d-flex">
                        {{-- <a class="text-uppercase primary-btn loadmore-btn mt-70 mb-60"
                          href="#">Load More Post</a> --}}
                          {{ $tags->appends(Request::all())->links() }}
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
