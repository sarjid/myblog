@extends('layouts.backend.app')
@push('header')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endpush
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
                    <li><a href="#">Create Post</a></li>
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
                        <strong class="card-title">Add Post
                            <a href="{{ route('post.index') }}" style="float: right;" class="btn btn-info btn-sm"><i class="fa fa-list"></i> All Post</a>
                        </strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Title</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="title" placeholder="title" class="form-control">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tags</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="tags" placeholder="tags" class="form-control">
                                    @error('tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Select Category</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="category_id" id="select" class="form-control">
                                        <option value="0">Please select</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Status</label></div>
                                <div class="col-12 col-md-9">
                                    <label for="inline-checkbox1" class="form-check-label ">
                                        <input type="checkbox" value="1" id="inline-checkbox1" name="status"  class="form-check-input"> Published
                                    </label>
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Image</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file-input" name="image" class="form-control-file"></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                                <div class="col-12 col-md-9"><textarea name="body" id="summernote" rows="3" placeholder="Content..." class="form-control"></textarea></div>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $('#summernote').summernote({
      tabsize: 2,
      height: 200,
    });
  </script>

@endsection
