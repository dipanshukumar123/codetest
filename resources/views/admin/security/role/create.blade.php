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
                            <li class="breadcrumb-item">Security</li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.security.roles.index') }}">Roles</a></li>
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
                            <form method="POST" action="{{ route('admin.security.roles.store') }}" role="form" autocomplete="off" enctype="multipart/form-data" id="form" class="needs-validation">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">

                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Permission</label>

                                            <div class="row @error('permissions') is-invalid @enderror">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                                       id="checkboxPrimary{{ $loop->index }}" {!! (collect(old('permissions'))->contains($permission->name)) ? 'checked' : null !!} />
                                                                <label for="checkboxPrimary{{ $loop->index }}">{{ $permission->name }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div><!-- /.row -->

                                            @error('permissions')
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                            @enderror
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

@endsection
