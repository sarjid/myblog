@extends('layouts.backend.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Category</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Category</a></li>
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
                        <strong class="card-title">Category list
                            <button style="float: right;" data-toggle="modal" data-target="#createModal" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New</button>
                        </strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ !empty($item->image) ? url('storage/category/'.$item->image) : url('backend/images/no_image.jpg') }}" alt="" height="60px;" width="60px;">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ Carbon\Carbon::parse( $item->created_at)->diffForhumans() }}</td>
                                    <td>
                                        <a href="javascript::void(0)" data-toggle="modal" data-target="#viewModal{{ $item->id }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>

                                        <a href="javascript::void(0)" data-toggle="modal" data-target="#editCategory{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                                    <form action="{{ route('category.destroy',$item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                      <button type="submit" id="delete"  class="btn btn-danger btn-sm delBtn"><i class="fa fa-trash"></i></button>
                                    </form>
                                    </td>
                                </tr>

                                {{-- //view modal  --}}
                                <div class="modal fadein" id="viewModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mediumModalLabel">View Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="row form-group">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-group">Category name:</label>
                                                            </div>

                                                            <div class="col-md-9">
                                                                <div class="form-control">{{ $item->name }}</div>
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-group">SLug:</label>
                                                            </div>

                                                            <div class="col-md-9">
                                                                <div class="form-control">{{ $item->slug }}</div>
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-group">Desciption:</label>
                                                            </div>

                                                            <div class="col-md-9">
                                                                <div class="form-control">{{ $item->description }}</div>
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-group">Image:</label>
                                                            </div>

                                                            <div class="col-md-9">
                                                                <div class="form-control">{{ $item->image }}</div>
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-group">Create Date:</label>
                                                            </div>

                                                            <div class="col-md-9">
                                                                <div class="form-control">{{ Carbon\Carbon::parse( $item->created_at)->diffForhumans() }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <img src="{{ !empty($item->image) ? url('storage/category/'.$item->image) : url('backend/images/no_image.jpg') }}" alt="" height="250px;" width="250px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- //edit modal  --}}
                                 <div class="modal fade" id="editCategory{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mediumModalLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('category.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="row form-group">
                                                        <div class="col-md-3">
                                                            <label for="" class="form-group">Name:</label>
                                                        </div>

                                                        <div class="col-md-9">
                                                           <input type="text" value="{{ $item->name }}" class="form-control" name="name" placeholder="category name">
                                                           @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                          @enderror
                                                        </div>

                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-md-3">
                                                            <label for="" class="form-group">Description:</label>
                                                        </div>

                                                        <div class="col-md-9">
                                                          <textarea name="description" class="form-control" id="" cols="30" rows="5">{{ $item->description }}</textarea>
                                                          @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                         @enderror
                                                        </div>

                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-md-3">
                                                            <label for="" class="form-group">Image:</label>
                                                        </div>

                                                        <div class="col-md-9">
                                                          <input type="file" name="image" class="form-control" >
                                                          @error('image')
                                                          <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->


  {{-- //create modal  --}}
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="" class="form-group">Name:</label>
                    </div>

                    <div class="col-md-9">
                       <input type="text" class="form-control" name="name" placeholder="category name">
                       @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="" class="form-group">Description:</label>
                    </div>

                    <div class="col-md-9">
                      <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
                      @error('description')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="" class="form-group">Image:</label>
                    </div>

                    <div class="col-md-9">
                      <input type="file" name="image" class="form-control" >
                      @error('image')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Create</button>
            </div>
        </form>
        </div>
    </div>
</div>


@endsection

