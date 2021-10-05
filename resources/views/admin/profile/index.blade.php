@extends('layouts.backend.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashaboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">My</a></li>
                    <li><a href="#">Profile</a></li>
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
                        <strong class="card-title">My Profile</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <img class="rounded-circle mx-auto d-block" src="{{ !empty($user->image) ? url('storage/user/'.$user->image) : url('backend/images/no_image.jpg') }}" alt="{{ $user->name }}" id="showImage">
                                                <h5 class="text-sm-center mt-2 mb-1">{{ $user->name }}</h5>
                                                <div class="location text-sm-center"><i class="fa fa-email"></i> {{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                <div class="col-md-7">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Credentials</a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content pl-3 p-1" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                         <div class="row form-group">
                                                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                                                             <div class="col-12 col-md-9">
                                                                 <input type="text" id="text-input" name="username" placeholder="username" value="{{ $user->username }}" class="form-control">
                                                                 @error('username')
                                                                     <span class="text-danger">{{ $message }}</span>
                                                                 @enderror
                                                             </div>
                                                         </div>

                                                         <div class="row form-group">
                                                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                                                             <div class="col-12 col-md-9">
                                                                 <input type="text" id="text-input" name="name" placeholder="name" value="{{ $user->name }}" class="form-control">
                                                                 @error('name')
                                                                     <span class="text-danger">{{ $message }}</span>
                                                                 @enderror
                                                             </div>
                                                         </div>

                                                         <div class="row form-group">
                                                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                                             <div class="col-12 col-md-9">
                                                                 <input type="text" disabled id="text-input" value="{{ $user->email }}" class="form-control">

                                                             </div>
                                                         </div>

                                                         <div class="row form-group">
                                                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">Image</label></div>
                                                             <div class="col-12 col-md-9">
                                                                 <input type="file" id="text-input" name="image" id="image" placeholder="image" class="form-control">
                                                                 @error('image')
                                                                     <span class="text-danger">{{ $message }}</span>
                                                                 @enderror
                                                             </div>

                                                         </div>


                                                         <div class="row form-group">
                                                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">About</label></div>
                                                             <div class="col-12 col-md-9">
                                                                 <input type="text" id="text-input" name="about" placeholder="about" class="form-control">
                                                                 @error('about')
                                                                     <span class="text-danger">{{ $message }}</span>
                                                                 @enderror
                                                             </div>
                                                         </div>
                                                         <div class="col col-md-3"></div>
                                                         <div class="col-12 col-md-9">
                                                             <button type="submit" class="btn btn-primary btn-sm">
                                                                 <i class="fa fa-dot-circle-o"></i> Update
                                                             </button>
                                                         </div>

                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                        <form action="{{ route('admin.password.update') }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                         <div class="row form-group">
                                                             <div class="col col-md-3"><label for="text-input" class=" form-control-label">Current Password</label></div>
                                                             <div class="col-12 col-md-9">
                                                                 <input type="password" id="text-input" name="old_password" placeholder="old password"  class="form-control">
                                                                 @error('old_password')
                                                                     <span class="text-danger">{{ $message }}</span>
                                                                 @enderror
                                                             </div>
                                                         </div>

                                                         <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">New Password</label></div>
                                                            <div class="col-12 col-md-9">
                                                                <input type="password" id="text-input" name="password" placeholder="new password"  class="form-control">
                                                                @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm Password</label></div>
                                                            <div class="col-12 col-md-9">
                                                                <input type="password" id="text-input" name="password_confirmation" placeholder="Re-Type Password"  class="form-control">
                                                                @error('password_confirmation')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                         <div class="col col-md-3"></div>
                                                         <div class="col-12 col-md-9">
                                                             <button type="submit" class="btn btn-primary btn-sm">
                                                                 <i class="fa fa-dot-circle-o"></i> Update
                                                             </button>
                                                         </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->



@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#image').change(function (e) {
                alert('okk');
                e.preventDefault();
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

