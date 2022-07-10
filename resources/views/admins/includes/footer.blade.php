  <!-- /.content-wrapper -->
  <footer class="main-footer" style="text-align: center">
    <strong>Copyright &copy; App Name All rights reserved.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('public/admin/dashboard/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('public/admin/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('public/admin/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Bootstrap 4 rtl -->
  <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js')}}"></script>

  <!-- ChartJS -->
  <script src="{{ asset('public/admin/dashboard/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('public/admin/dashboard/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('public/admin/dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('public/admin/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('public/admin/dashboard/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('public/admin/dashboard/plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('public/admin/dashboard/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('public/admin/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('public/admin/dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('public/admin/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('public/admin/dashboard/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('public/admin/dashboard/dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('public/admin/dashboard/dist/js/pages/dashboard.js')}}"></script>

  @if (app()->getLocale() == 'ar')
  <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
  @endif

<!-- DataTables  & Plugins -->
<script src="{{asset('public/admin/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/pdfmake/vfs_fonts.js')}}')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
