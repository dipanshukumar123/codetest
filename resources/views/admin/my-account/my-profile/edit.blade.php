@extends('admin.layouts.app')

@section('title')
    My Profile
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
                        <h4 class="m-0 text-dark">My Profile</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
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
                    <div class="col-md-8">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card card-primary card-outline">
                            <form id="remove-avatar-form" action="{{ route('admin.my-profile.avatar.delete', [$user]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>

                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.my-profile.update', [$user]) }}" enctype="multipart/form-data" role="form" id="form" class="needs-validation">
                                @csrf

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <img src="{{ $user->avatar_url }}" onerror="this.onerror=null; this.src='{{ asset('themes/AdminLTE/dist/img/avatar5.png') }}';" id="profile_img" class="img-circle mb-2" height="200"
                                                     width="200" alt=""/>

                                                <div class="w-100 d-flex" style="justify-content: space-evenly">
                                                    <a class="btn btn-sm btn-primary" onclick="$('.js-image-upload').click();">
                                                        <i class="fa fa-upload mr-1"></i> Set Avatar
                                                    </a>

                                                    @unless (!$user->avatar)
                                                        <a class="btn btn-sm btn-danger" onclick="event.preventDefault(); $('#remove-avatar-form').submit();">
                                                            <i class="fa fa-times mr-1"></i> Remove Avatar
                                                        </a>
                                                    @endunless
                                                </div>

                                                <input type="file" name="avatar" class="js-image-upload form-control d-none" accept='.jpg, .jpeg, .png'
                                                       onchange="document.getElementById('profile_img').src = window.URL.createObjectURL(this.files[0]);"/>

                                                @error('avatar')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control @error('first_name') is-invalid @enderror">

                                                @error('first_name')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" name="middle_name" value="{{ $user->middle_name }}" class="form-control @error('middle_name') is-invalid @enderror">

                                                @error('middle_name')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control @error('last_name') is-invalid @enderror">

                                                @error('last_name')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" readonly>

                                                @error('email')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control @error('mobile') is-invalid @enderror" readonly>

                                                @error('mobile')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Select Gender</option>
                                                    <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                                                    <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Female</option>
                                                </select>

                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    This field is required
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
