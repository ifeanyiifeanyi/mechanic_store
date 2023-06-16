@extends('admin.layouts.admin_master')

@section('title', 'Update Password')
@section('css')

@endsection

@section('admin')

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <form method="post" action="{{ route('admin.profile.passwordUpdate') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control @error('curent_password') is-invalid @enderror"
                                    name="current_password" id="current_password" placeholder="Enter Curent Password">
                                @error('current_password')
                                    <i class="text-danger text-sm">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Enter Password">
                                @error('password')
                                    <i class="text-danger text-sm">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation"
                                    placeholder="Confirm New Password">
                                @error('password_confirmation')
                                    <i class="text-danger text-sm">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>

@endsection


@section('js')

@endsection
