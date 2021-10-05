<style>
    ul li .active{
         color: #62bdfc;
     }
 </style>
<!-- Start Header Area -->
<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container px-3">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('frontend/img') }}/logo.png" alt="">
          </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
              </button>

              <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent" >
                <ul class="navbar-nav scrollable-menu">
                    <li><a href="{{ url('/') }}" class="{{ \Request::is('/') ? 'active':'' }}">Home</a></li>
                    <li><a href="{{ route('all.post') }}"  class="{{ \Request::is('posts') ? 'active':'' }}">Posts</a></li>
                    <li><a href="{{ route('categories') }}" class="{{ \Request::is('category-all') ? 'active':'' }}">Categories</a></li>
                    <li><a href="#about">About</a></li>
                    <!-- Dropdown -->

                   <li class="dropdown">
                    <a href="javascript::void(0)" class="dropdown-toggle"  onclick="dropMenu()">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;
                        <!-- <i class="fas fa-user"></i> -->
                    </a>
                    <div id="dropMenu" class="dropdown-menu menu1" style="display: none;">
                    @auth

                        @if (auth()->user()->role_id == 1)
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa fa-tv" aria-hidden="true"></i>&nbsp; Dashboard</a>
                        @else
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fa fa-tv" aria-hidden="true"></i>&nbsp; Dashboard</a>

                            <a class="dropdown-item" href="{{ route('like.list') }}"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; Favorite List</a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Register</a>
                    @endauth
                    </div>
                  </li>

                  <script>
                      function dropMenu(){
                      var dropmenu = document.getElementById('dropMenu');
                          if (dropmenu.style.display === "none") {
                              dropmenu.style.display = "block";
                          } else {
                              dropmenu.style.display = "none";
                          }
                          }
                  </script>
                </ul>
              </div>
        </div>
    </nav>
</header>
  <!-- End Header Area -->
