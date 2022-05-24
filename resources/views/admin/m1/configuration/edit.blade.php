@extends('admin.layouts.app')

@section('title')
    Configurations
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
                        <h4 class="m-0 text-dark">Configurations</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item">Spinning Cycle</li>
                            <li class="breadcrumb-item active">Configurations</li>
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
                            <form method="POST" action="{{ route('admin.m1.configurations.update', [$setting]) }}" role="form" id="form" class="needs-validation">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <h6 class="mb-2 mt-0">Member</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Seat Price</label>
                                                <input type="text" name="m1_seat_price" value="{{ $setting->m1_seat_price }}" class="form-control @error('m1_seat_price') is-invalid @enderror" placeholder="Price Per Seat">

                                                @error('m1_seat_price')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">

                                        </div>
                                    </div><!-- /.row -->

                                    <h6 class="mb-2 mt-3">Coach</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Floor Price</label>
                                                <input type="text" name="m1_floor_price" value="{{ $setting->m1_floor_price }}" class="form-control @error('m1_floor_price') is-invalid @enderror">

                                                @error('m1_floor_price')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Commission</label>
                                                <input type="text" name="m1_commission" value="{{ $setting->m1_commission }}" class="form-control @error('m1_commission') is-invalid @enderror" placeholder="Per Seat">

                                                @error('m1_commission')
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
