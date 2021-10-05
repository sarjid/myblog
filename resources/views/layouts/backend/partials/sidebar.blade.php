<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            {{-- <a class="navbar-brand" href="./"><img src="{{ asset('backend/images') }}/logo.png" alt="Logo"></a> --}}
            <a href="{{ route('user.dashboard') }}" class="navbar-brand">Hi..{{ auth()->user()->name }}</a>
            <a class="navbar-brand hidden" href="./"><img src="{{ asset('backend/images') }}/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
            @if (auth()->user()->role_id == 1)
                <li class="{{ Request::is('admin/dashboard') ? 'active':'' }}">
                    <a href="{{ route('admin.dashboard') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>

                <li class="{{ Request::is('admin/user*') ? 'active':'' }}">
                    <a href="{{ route('user.index') }}"> <i class="menu-icon fa fa-user"></i>Users Management</a>
                </li>

                  <li class="{{ Request::is('admin/category*') ? 'active':'' }}">
                    <a href="{{ route('category.index') }}"> <i class="menu-icon fa fa-user"></i>Category Management</a>
                </li>

                <li class="{{ Request::is('admin/post*') ? 'active':'' }}">
                    <a href="{{ route('post.index') }}"> <i class="menu-icon fa fa-user"></i>Post Management</a>
                </li>

                <li class="{{ Request::is('admin/comment*') ? 'active':'' }}">
                    <a href="{{ route('admin.comments.index') }}"> <i class="menu-icon fa fa-user"></i>Comment Management</a>
                </li>

                <li class="{{ Request::is('admin/comment*') ? 'active':'' }}">
                    <a href="{{ route('admin.reply.all') }}"> <i class="menu-icon fa fa-user"></i>Comment Replies</a>
                </li>

                {{--  <li class="{{ Request::is('admin/settings*') ? 'active':'' }}">
                    <a href="{{ route('admin.settings.update') }}"> <i class="menu-icon fa fa-user"></i>Comment Replies</a>
                </li>  --}}

            @else
                <li class="{{ Request::is('user/comment*') ? 'active':'' }}">
                    <a href="{{ route('comment.index') }}"> <i class="menu-icon fa fa-user"></i>My Comments</a>
                </li>

                <li class="{{ Request::is('user/replies*') ? 'active':'' }}">
                    <a href="{{ route('user.reply.all') }}"> <i class="menu-icon fa fa-user"></i>My Replies</a>
                </li>

                <li>
                    <a href="{{ route('like.list') }}"> <i class="menu-icon fa fa-user"></i>Favourite Posts</a>
                </li>
            @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
