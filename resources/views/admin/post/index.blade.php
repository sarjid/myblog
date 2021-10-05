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
                        <strong class="card-title">post list
                            <a href="{{ route('post.create') }}" style="float: right;" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
                        </strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Like & View</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ !empty($item->image) ? url('storage/post/'.$item->image) : url('backend/images/no_image.jpg') }}" alt="" height="60px;" width="60px;">
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-danger">{{ $item->category->name }}</span>
                                    </td>


                                     <td>
                                            <span class="badge badge-pill"><i class="fa fa-eye"></i> {{ $item->view_count }}</span>
                                            <a href="{{ route('liked.users.list',[$item->id]) }}" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-thumbs-up"></i>{{ $item->likedUsers->count() }}</a>
                                    </td>

                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Published</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @endif
                                    </td>

                                    <td>{{ Carbon\Carbon::parse( $item->created_at)->diffForhumans() }}</td>
                                    <td>
                                        <a href="{{ route('post.show',$item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('post.edit',$item->id) }}"class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                                        <form action="{{ route('post.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                          <button type="submit" id="delete"   class="btn btn-danger btn-sm delBtn"><i class="fa fa-trash"></i></button>
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

