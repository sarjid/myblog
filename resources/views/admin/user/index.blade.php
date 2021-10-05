@extends('layouts.backend.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>User</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">User</a></li>
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
                        <strong class="card-title">User list</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Role</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Join</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ !empty($item->image) ? url($item->image) : url('backend/images/no_image.jpg') }}" alt="" height="60px;" width="60px;">
                                    </td>
                                    <td>{{ $item->role->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Carbon\Carbon::parse( $item->created_at)->diffForhumans() }}</td>
                                    <td>
                                        <a href="javascript::void(0)" data-toggle="modal" data-target="#viewModal{{ $item->id }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>

                                        <a href="javascript::void(0)" data-toggle="modal" data-target="#editUser{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                                        <form action="{{ route('user.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                          <button type="submit" id="delete"  class="btn btn-danger btn-sm delBtn"><i class="fa fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>

                                {{-- //view modal  --}}
                                <div class="modal fadein" id="viewModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mediumModalLabel">View User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row form-group">
                                                    <div class="col-md-6 m-auto">
                                                        <img src="{{ !empty($item->image) ? url($item->image) : url('backend/images/no_image.jpg') }}" alt="" height="100px;" width="100px;">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Username:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ $item->username }}</div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Role:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ $item->role->name }}</div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Name:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ $item->name }}</div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Email:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ $item->email }}</div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Join Date:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ Carbon\Carbon::parse( $item->created_at)->diffForhumans() }}</div>
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
                                 <div class="modal fade" id="editUser{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mediumModalLabel">Edit User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <form action="{{ route('user.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Name:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ $item->name }}</div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Email:</label>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-control">{{ $item->email }}</div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label for="" class="form-group">Role:</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-check">
                                                        @foreach ($roles as $role)
                                                            <div class="radio">
                                                                <label for="radio{{ $role->id }}" class="form-check-label ">
                                                                    <input type="radio" {{ $item->role_id == $role->id ? 'checked':''}}  id="radio{{ $role->id }}" name="role_id" value="{{ $role->id }}" class="form-check-input" >{{ $role->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
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

@endsection


