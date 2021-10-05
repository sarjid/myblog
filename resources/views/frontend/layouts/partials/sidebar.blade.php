<div class="col-lg-4 sidebar-area">
    <div class="single_widget search_widget">
      <div id="imaginary_container">
        <form action="{{ route('search') }}" method="get">
        <div class="input-group stylish-input-group">
            <input
            type="text" name="search"
            class="form-control"
            placeholder="Search"
          />
          <span class="input-group-addon">
            <button type="submit">
              <span class="lnr lnr-magnifier"></span>
            </button>
          </span>
        </div>
    </form>
      </div>
    </div>

    {{-- <div class="single_widget about_widget">
      <img src="img/asset/s-img.jpg" alt="" />
      <h2 class="text-uppercase">Adele Gonzalez</h2>
      <p>
        MCSE boot camps have its supporters and its detractors. Some
        people do not understand why you should have to spend money
      </p>
      <div class="social-link">
        <a href="#"
          ><button class="btn">
            <i class="fa fa-facebook" aria-hidden="true"></i> Like
          </button></a
        >
        <a href="#"
          ><button class="btn">
            <i class="fa fa-twitter" aria-hidden="true"></i> follow
          </button></a
        >
      </div>
    </div> --}}
    <div class="single_widget cat_widget">
      <h4 class="text-uppercase pb-20">post categories</h4>
      <ul>
        @forelse ($categories as $cat)
            <li>
            <a href="{{ route('category.post',$cat->slug) }}">{{ ucwords($cat->name) }} <span>{{ count($cat->posts) }}</span></a>
            </li>
        @empty
            <li>
                <strong class="text-danger">No Category Found..!</strong>
            </li>
        @endforelse
      </ul>
    </div>

    <div class="single_widget recent_widget">
      <h4 class="text-uppercase pb-20">Recent Posts</h4>
      <div class="active-recent-carusel">
        @forelse ($recentPosts as $post)
            <div class="item">
              <img src="{{ asset('storage/post/'.$post->image) }}" alt="" />
              <p class="mt-20 title text-uppercase">{{ $post->title }}</p>
              <p>
                  {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                  <span>
                  <i class="fa fa-heart-o" aria-hidden="true"></i> 06
                  <i class="fa fa-comment-o" aria-hidden="true"></i
                  >{{ $post->comments->count() }}</span
                  >
              </p>
            </div>
        @empty
            <div class="item">
                <strong class="text-danger">Not  Found..!</strong>
            </div>
        @endforelse
      </div>
    </div>

    {{-- <div class="single_widget cat_widget">
      <h4 class="text-uppercase pb-20">post archive</h4>
      <ul>
        <li>
          <a href="#">Dec'17 <span>37</span></a>
        </li>
        <li>
          <a href="#">Nov'17 <span>37</span></a>
        </li>
        <li>
          <a href="#">Oct'17 <span>37</span></a>
        </li>
        <li>
          <a href="#">Sept'17 <span>37</span></a>
        </li>
        <li>
          <a href="#">Aug'17 <span>37</span></a>
        </li>
        <li>
          <a href="#">Jul'17 <span>37</span></a>
        </li>
        <li>
          <a href="#">Jun'17 <span>37</span></a>
        </li>
      </ul>
    </div> --}}

    <div class="single_widget tag_widget">
      <h4 class="text-uppercase pb-20">Recent Tags</h4>
      <ul>
        @forelse ($recentTags->unique('name')->take(10) as $tag)
            <li>
            <a href="{{ route('tag.posts',$tag->name) }}">{{ ucwords($tag->name) }}</a>
            </li>
        @empty
        <li>
            <strong class="text-danger">No Tags Found..!</strong>
        </li>
        @endforelse
      </ul>
    </div>
  </div>
