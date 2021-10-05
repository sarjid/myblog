@extends('layouts.backend.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>comment</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">comment</a></li>
                    <li><a href="#">All List</a></li>
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
                        <strong class="card-title">comment list
                        </strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Post</th>
                                    <th>Comment</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($comments as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ !empty($item->user->image) ? url('storage/user/'.$item->user->image) : url('backend/images/no_image.jpg') }}" alt="" height="60px;" width="60px;">
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <a href="{{ route('post.detail',$item->post->slug) }}" target="_blank">{{ Str::limit($item->post->title, 30, '...') }}</a>
                                    </td>
                                    <td>
                                        <textarea  disabled cols="30" rows="3" class="form-control">{{ $item->comment }}</textarea>
                                    </td>
                                    <td>{{ Carbon\Carbon::parse( $item->created_at)->diffForhumans() }}</td>
                                    <td>
                                        <form action="{{ route('admin.comment.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                          <button type="submit" id="delete"  class="btn btn-danger btn-sm delBtn"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

@endsection

