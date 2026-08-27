  <!-- /.content-wrapper -->
  <footer class="main-footer" style="text-align: center">
    <strong>Copyright &copy; {{getSiteName()}} All rights reserved.</strong>
  </footer>
</div>
  <!-- ./wrapper -->

  <!-- DataTables & Plugins -->
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.2.9/build/pdfmake.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.2.9/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

  <script>
      var table1 = $('#example1').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "dom": 'lBfrtip',
          "oLanguage": {
              "sSearch": "{{__('admin.search')}} : ",
              "sLoadingRecords": "{{__('admin.loading')}}",
              "sInfoEmpty": "{{__('admin.no_result')}}",
              "sEmptyTable": "{{__('admin.no_result')}}"
          },

          'buttons': [
              { extend: 'copy',   text: '<i class="fas fa-copy"></i> {{__('admin.copy')}}',              exportOptions: {columns: ':visible'} },
              { extend: 'excel',  text: '<i class="fas fa-file-excel"></i> {{__('admin.excel')}}',       exportOptions: {columns: ':visible'} },
              { extend: 'csv',    text: '<i class="fas fa-file-csv"></i> {{__('admin.csv')}}',           exportOptions: {columns: ':visible'} },
              { extend: 'pdf',    text: '<i class="fas fa-file-pdf"></i> {{__('admin.pdf')}}',           exportOptions: {columns: ':visible'} },
              { extend: 'print',  text: '<i class="fas fa-print"></i> {{__('admin.print')}}',            exportOptions: {columns: ':visible'} },
              { extend: 'colvis', text: '<i class="fas fa-table-columns"></i> {{__('admin.column_visibility')}}' },
          ],
          "language": {
              "paginate": {
                  "previous": "{{__('admin.previous')}}",
                  "next": "{{__('admin.next')}}",
              }
          },
  });
  </script>
  <!--end data table-->

  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

  <!-- App theme -->
  <script src="{{ asset('assets/admin/js/theme.js') }}"></script>

  <!-- Page specific script -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2, .select2bs4').select2()
    })
  </script>
</body>
</html>
