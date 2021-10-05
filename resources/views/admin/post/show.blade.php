@extends('layouts.backend.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>post</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">post</a></li>
                    <li><a href="#">View Post</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">View Post
                            <a href="{{ route('post.index') }}" style="float: right;" class="btn btn-info btn-sm"><i class="fa fa-list"></i> All Post</a>
                        </strong>
                    </div>
                    <div class="card-body">
                           <div class="row">
                            <div class="col-md-8 m-auto">
                                <img src="{{ !empty($post->image) ? url('storage/post/'.$post->image) : url('backend/images/no_image.jpg') }}" alt="">

                              </div>
                               <div class="col-md-4">
                                   <h1>{{ $post->title }}</h1> <br>
                                   <h5> {{ $post->category->name }}</h5>
                                   <p> {{ ($post->status == 1) ? "Published":"Pending" }}</p>

                                   Tags:
                                   @if ($post->tags)
                                       @foreach ($post->tags as $tag)
                                       <a href="" class="btn btn-sm btn-flat btn-info mt-2">{{ $tag->name }}</a>
                                       @endforeach
                                   @endif
                                   <hr>
                                   <p> Author: {{ $post->user->name }}</p>
                               </div>
                                <span><i class="fa fa-eye"></i> {{ $post->view_count }}</span>
                               <div class="col-md-12">{!! $post->body !!}</div>
                           </div>

                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->



@endsection

