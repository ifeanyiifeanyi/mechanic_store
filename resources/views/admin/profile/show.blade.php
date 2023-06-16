@extends('admin.layouts.admin_master')

@section('title', 'Profile | ' . $user->name)
@section('css')

@endsection

@section('admin')

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-6">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ $user->photo ? asset($user->photo) : asset('https://placehold.co/800?text=' . urlencode($user->name) . '&font=roboto') }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center"><b>Role: </b> {{ $user->role }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">{{ $user->status }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $user->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{ $user->address }}</a>
                                </li>
                            </ul>

                            <div class="text-center row">

                                <div class="col-md-6">
                                    <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal"
                                        data-target="#modal-default">
                                        <b>Update Password</b>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="Enter Name"
                                        value="{{ $user->name ?? old('name') }}">
                                    @error('name')
                                        <i class="text-danger text-sm">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" placeholder="Enter Username"
                                        value="{{ $user->username ?? old('username') }}">
                                    @error('username')
                                        <i class="text-danger text-sm">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Enter email"
                                        value="{{ $user->email ?? old('email') }}">
                                    @error('email')
                                        <i class="text-sm text-danger">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" id="phone"
                                        placeholder="Enter Phone Number" value="{{ $user->phone ?? old('phone') }}">
                                    @error('phone')
                                        <i class="text-danger text-sm">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Enter Address"
                                        value="{{ $user->address ?? old('address') }}">
                                    @error('address')
                                        <i class="text-danger text-sm">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="address">Profile Image</label>
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                id="image-input" name="photo">
                                            @error('photo')
                                                <i class="text-danger text-sm">{{ $message }}</i>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <img id="profile-image" class="img-responsive img-fluid"
                                                src="{{ $user->photo ? asset($user->photo) : asset('admin/dist/img/user2-160x160.jpg') }}"
                                                alt="profile photo" />
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.row -->

        </div>
    </section>

@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageInput = document.getElementById('image-input');
            var profileImage = document.getElementById('profile-image');
            //  var imageError = document.getElementById('image-error');

            imageInput.addEventListener('change', function() {
                var input = this;
                // imageError.innerHTML = '';

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        profileImage.setAttribute('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // Handle error if no file is selected
                    //imageError.innerHTML = 'Please select an image.';
                }
            });
        });
    </script>
@endsection
