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
                                    <th>image</th>
                                    <th>Title</th>
                                    <th>Liked</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $item)
                                <tr>
                                    <td>
                                       <a href="{{ route('post.detail',$item->slug) }}" target="_blank">
                                        <img src="{{ !empty($item->image) ? url('storage/post/'.$item->image) : url('backend/images/no_image.jpg') }}" alt="" height="60px;" width="60px;">
                                       </a>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                     <td>
                                        <a href="{{ route('post.detail',$item->slug) }}" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-thumbs-up"></i>{{ $item->likedUsers->count() }}</a>
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

