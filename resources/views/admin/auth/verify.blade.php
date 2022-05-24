@extends('admin.layouts.app')

@section('title')
    Verify Email
@endsection

@section('styles')
    @parent

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">Verify Your Email Address</div>

                            <div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        A fresh verification link has been sent to your email address.
                                    </div>
                                @endif

                                Before proceeding, please check your email for a verification link.
                                If you did not receive the email,

                                <form class="d-inline" method="POST" action="{{ route('admin.verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Click here to request another</button>
                                </form>
                            </div>
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
