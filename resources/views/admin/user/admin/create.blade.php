@extends('admin.layouts.app')

@section('title')
    Create
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
                        <h4 class="m-0 text-dark">Create</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.admins.index') }}">Admins</a></li>
                            <li class="breadcrumb-item active">Create</li>
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
                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.users.admins.store') }}" role="form" autocomplete="off" enctype="multipart/form-data" id="form" class="needs-validation">
                                @csrf

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <img src="" onerror="this.onerror=null; this.src='{{ asset('themes/AdminLTE/dist/img/default-1000x1000.png') }}';" id="profile_img" class="rounded mb-2" width="300"
                                                     height="auto" alt=""/>

                                                <div class="w-100 d-flex" style="justify-content: space-evenly">
                                                    <a class="btn btn-sm btn-primary" onclick="$('.js-image-upload').click();">
                                                        <i class="fa fa-upload mr-1"></i> Set Avatar
                                                    </a>
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
                                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror">

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
                                                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control @error('middle_name') is-invalid @enderror">

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
                                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror">

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
                                                <label>Civil ID Number</label>
                                                <input type="text" name="civil_id_number" value="{{ old('civil_id_number') }}" class="form-control @error('civil_id_number') is-invalid @enderror">

                                                @error('civil_id_number')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">

                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror">

                                                @error('mobile')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('mobile') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Select Gender</option>
                                                    <option value="1" {{ old('gender') == '1' ? 'selected' : null }}>Male</option>
                                                    <option value="2" {{ old('gender') == '2' ? 'selected' : null }}>Female</option>
                                                </select>

                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">

                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="text" name="confirm_password" value="{{ old('confirm_password') }}" class="form-control @error('confirm_password') is-invalid @enderror">

                                                @error('confirm_password')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('confirm_password') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="roles[]" multiple class="form-control js-select2 @error('roles') is-invalid @enderror">
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {!! (collect(old('roles'))->contains($role->name)) ? 'selected' : null !!}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('roles')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                    <option value="">Select Status</option>
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                                                </select>

                                                @error('status')
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
                                    <button type="submit" class="btn btn-sm bg-gradient-primary float-right"><i class="fas fa-save"></i>&nbsp; Save</button>
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

    <script type="text/javascript">
        $(document).ready(function () {
            // initialize Select2
            $('.js-select2').select2({
                minimumResultsForSearch: -1,
                width: '100%'
            });
        });
    </script>
@endsection
