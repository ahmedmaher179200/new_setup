<!-- SweetAlert2 -->
<script src="{{ asset('admin/dashboard/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('admin/dashboard/plugins/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dashboard/dist/js/adminlte.min.js')}}"></script>
@if (session('success'))
    <script>
        $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });

        toastr.success("{{ session('success') }}");
        });
    </script>

@elseif( session('error') )
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
        });

        toastr.error("{{ session('error') }}")
        });
    </script>
@endif
