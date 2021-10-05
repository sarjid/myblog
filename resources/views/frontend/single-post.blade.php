@extends('frontend.layouts.master')
@section('content')
    <!-- Start top-section Area -->
    <section class="top-section-area section-gap">
        <div class="container">
          <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
              <h1 class="text-white mb-20">Post Details</h1>
              <ul>
                <li>
                  <a href="{{ url('/') }}">Home</a
                  ><span class="lnr lnr-arrow-right"></span>
                </li>
                <li>
                  <a href="category.html">Category</a
                  ><span class="lnr lnr-arrow-right"></span>
                </li>
                <li><a href="javascript::void(0)">{{ $post->category->name }}</a></li>
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
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="single-page-post">
                  <img class="img-fluid" src="{{ asset('storage/post/'.$post->image) }}" alt="image" />
                  <div class="top-wrapper">
                    <div class="row d-flex justify-content-between">
                      <h2 class="col-lg-8 col-md-12 text-uppercase">
                       {{ $post->title }}
                      </h2>
                      <div
                        class="col-lg-4 col-md-12 right-side d-flex justify-content-end"
                      >
                        <div class="desc">
                          <h2>{{ $post->user->name }}</h2>
                          <h3>{{ Carbon\Carbon::parse($post->created_at)->format('d M Y g:i A') }}</h3>
                        </div>
                        <div class="user-img">
                          <img src="{{ asset('storage/user/'.$post->user->image) }}" width="50px;" style="border-radius: 50%;" alt="" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tags">
                    <ul>
                    @foreach ($post->tags as $tag)
                      <li><a href="{{ route('tag.posts',$tag->name) }}">{{ $tag->name }}</a></li>
                    @endforeach
                    </ul>
                  </div>
                  <div>
                      <i class="fa fa-eye"></i>
                      {{ $post->view_count }}
                  </div>
                  <div class="single-post-content">
                    <p>{!! $post->body !!}</p>
                  </div>
                  <div class="bottom-wrapper">
                    <div class="row">
                      <div class="col-lg-4 single-b-wrap col-md-12">
                        @guest
                            <i class="fa fa-thumbs-up" aria-hidden="true" style="font-size: 30px;"></i>
                                 {{ $post->likedUsers->count() }} people like this
                        @else
                            <a onclick="document.getElementById('like-form-{{ $post->id }}').submit();"><i class="fa fa-thumbs-up" aria-hidden="true" style="font-size: 30px; color:{{auth()->user()->likedPosts()->where('post_id', $post->id)->count() > 0 ? 'red' : ''}}; cursor:pointer; "></i></a>
                            {{$post->likedUsers->count()}}
                            people like this

                            <form action="{{ route('post.like',$post->id) }}" method="POST" style="display: none" id="like-form-{{ $post->id }}">
                                @csrf
                            </form>
                        @endguest

                      </div>
                      <div class="col-lg-4 single-b-wrap col-md-12">
                        <i class="fa fa-comment-o" aria-hidden="true"></i> {{ $post->comments->count() }}
                        comments
                      </div>
                      <div class="col-lg-4 single-b-wrap col-md-12">
                        <ul class="social-icons">
                          <li>
                            <a href="#"
                              ><i class="fa fa-facebook" aria-hidden="true"></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-twitter" aria-hidden="true"></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-dribbble" aria-hidden="true"></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-behance" aria-hidden="true"></i
                            ></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- Start nav Area -->
                  {{-- <section class="nav-area pt-50 pb-100">
                    <div class="container">
                      <div class="row justify-content-between">
                        <div
                          class="col-sm-6 nav-left justify-content-start d-flex"
                        >
                          <div class="thumb">
                            <img src="img/prev.jpg" alt="" />
                          </div>
                          <div class="details">
                            <p>Prev Post</p>
                            <h4 class="text-uppercase">
                              <a href="#">A Discount Toner</a>
                            </h4>
                          </div>
                        </div>
                        <div
                          class="col-sm-6 nav-right justify-content-end d-flex"
                        >
                          <div class="details">
                            <p>Prev Post</p>
                            <h4 class="text-uppercase">
                              <a href="#">A Discount Toner</a>
                            </h4>
                          </div>
                          <div class="thumb">
                            <img src="img/next.jpg" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </section> --}}
                  <!-- End nav Area -->

                  <!-- Start comment-sec Area -->
                  <section class="comment-sec-area pt-80 pb-80">
                    <div class="container">
                      <div class="row flex-column">
                        <h5 class="text-uppercase pb-80">{{ $post->comments()->count() }} Comments</h5>
                        <br />
                        <!-- Frist Comment -->
                        <div class="comment">
                        @foreach ($post->comments as $comment)
                          <div class="comment-list">
                            <div
                              class="single-comment justify-content-between d-flex"
                            >
                              <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                  <img src="{{ !empty($comment->user->image) ? url('storage/user/'.$comment->user->image) : url('backend/images/no_image.jpg') }}" style="border-radius: 50%;" height="50px;"  alt="" />
                                </div>
                                <div class="desc">
                                  <h5><a href="#">{{ $comment->user->name }}</a></h5>
                                  <p class="date">{{ Carbon\Carbon::parse($comment->created_at)->format('d M Y g:i A') }}</p>
                                  <p class="comment">
                                   {{ Str::title($comment->comment) }}
                                  </p>
                                </div>
                              </div>
                              <div class="">
                                  @auth
                                  <button class="btn-reply text-uppercase" id="reply-btn"
                                  onclick="showReplyForm('{{$comment->id}}','{{$comment->user->name}}')">reply</button>
                                  @endauth
                              </div>
                            </div>
                          </div>

                          {{-- //commment reply start  --}}
                        @if ($comment->replies->count() > 0)
                            @foreach ($comment->replies as $reply)
                            <div class="comment-list left-padding">
                                <div
                                    class="single-comment justify-content-between d-flex"
                                    >
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                        <img src="{{ !empty($reply->user->image) ? url('storage/user/'.$reply->user->image) : url('backend/images/no_image.jpg') }}" width="50px;" alt="" />
                                        </div>
                                        <div class="desc">
                                        <h5><a href="#">{{ $reply->user->name }}</a></h5>
                                        <p class="date">{{ Carbon\Carbon::parse($reply->created_at)->format('d M Y g:i A') }}</p>
                                        <p class="comment">
                                            {{ $reply->message }}!
                                        </p>
                                        </div>
                                    </div>
                                    <div class="">
                                        {{-- //show when login user  --}}
                                        @auth
                                        <button class="btn-reply text-uppercase" id="reply-btn"
                                        onclick="showReplyForm('{{ $comment->id }}','{{ $reply->user->name }}')">reply</button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- //commment reply end  --}}
                        @else
                        @endif

                        @auth
                          <div class="comment-list left-padding" id="reply-form-{{ $comment->id }}" style="display: none">
                            <div
                              class="single-comment justify-content-between d-flex">
                              <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                  <img src="{{ !empty(auth()->user()->image) ? url('storage/user/'.auth()->user()->image) : url('backend/images/no_image.jpg') }}" width="50px;" alt="" />
                                </div>
                                <div class="desc">
                                  <h5><a href="#">{{ auth()->user()->name }}</a></h5>
                                  <p class="date">{{ Carbon\Carbon::now()->format('d M Y g:i A') }}</p>
                                  <div class="row flex-row d-flex">
                                  <form action="{{ route('comment.reply',$comment->id) }}" method="POST">
                                      @csrf
                                    <div class="col-lg-12">
                                      <textarea
                                        id="reply-form-{{ $comment->id }}-text"
                                        cols="60"
                                        rows="2"
                                        class="form-control mb-10"
                                        name="message"
                                        placeholder="Messege"
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Messege'"
                                        required=""
                                      ></textarea>
                                    </div>
                                    <button type="submit" class="btn-reply text-uppercase ml-3">Reply</button>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        @endauth

                        @endforeach
                        </div>
                      </div>
                    </div>
                  </section>
                  <!-- End comment-sec Area -->

                  <!-- Start commentform Area -->
                  <section class="commentform-area pb-120 pt-80 mb-100">
                    <div class="container">
                      @guest
                      <h4>Please Sign in to post comments - <a href="{{route('login')}}">Sing in</a> or <a href="{{route('register')}}">Register</a></h4>
                        @else
                        <form action="{{ route('usercomment.store',$post->id) }}" method="POST">
                            @csrf
                            <h5 class="text-uppercas pb-50">Leave a Reply</h5>
                            <div class="row flex-row d-flex">
                                <div class="col-lg-12">
                                <textarea
                                    class="form-control mb-10"
                                    name="comment"
                                    placeholder="Messege"
                                    onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Messege'"
                                    required=""
                                ></textarea>
                                <button type="submit" class="primary-btn mt-20">Comment</button>
                                </div>
                            </div>
                        </form>
                      @endguest
                    </div>
                  </section>
                  <!-- End commentform Area -->
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

@section('scripts')
<script type="text/javascript">
    function showReplyForm(commentId,user) {
      var x = document.getElementById(`reply-form-${commentId}`);
      var input = document.getElementById(`reply-form-${commentId}-text`);

      if (x.style.display === "none") {
        x.style.display = "block";
        input.innerText=`@${user} `;

      } else {
        x.style.display = "none";
      }
    }
    </script>
@endsection
