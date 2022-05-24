@extends('admin.layouts.app')

@section('title')
    Change Password
@endsection

@section('styles')
    @parent

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class=" content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">Change Password</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card card-primary card-outline">
                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.change-password.update', ['user' => auth()->user()->id]) }}" enctype="multipart/form-data" role="form" id="form" class="needs-validation">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="text" name="current_password" value="{{ old('current_password') }}" class="form-control @error('current_password') is-invalid @enderror">

                                                @error('current_password')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('current_password') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="text" name="new_password" value="{{ old('new_password') }}" class="form-control @error('new_password') is-invalid @enderror">

                                                @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('new_password') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="text" name="confirm_new_password" value="{{ old('confirm_new_password') }}" class="form-control @error('confirm_new_password') is-invalid @enderror">

                                                @error('confirm_new_password')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('confirm_new_password') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm bg-gradient-primary float-right"><i class="fas fa-save"></i>&nbsp; Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    @parent

@endsection
