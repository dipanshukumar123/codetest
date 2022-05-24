<!-- jQuery -->
<script src="{{ asset('themes/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('themes/AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Moment JS -->
<script src="{{ asset('themes/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('themes/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('themes/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('themes/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('themes/AdminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('themes/AdminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- daterange picker -->
<script src="{{ asset('themes/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('themes/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('themes/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('themes/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('themes/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
<!-- jquery-easy-loading -->
<script src="{{ asset('themes/AdminLTE/plugins/jquery-easy-loadings/jquery.loading.min.js') }}"></script>
<!-- File Manager -->
<script src="{{ asset('js/lfm.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('themes/AdminLTE/dist/js/adminlte.min.js') }}"></script>

<!-- CSRF Protection -->
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('themes/AdminLTE/dist/js/demo.js') }}"></script>
