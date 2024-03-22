<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- Admin LTE --}}
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        
        {{-- JQuery --}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        {{-- Datatables --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
        {{-- Datatables --}}
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
        {{-- Admin LTE --}}
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="control-sidebar-slide-open layout-navbar-fixed">
        <div class="min-h-screen bg-gray-100">
            {{-- @include('layouts.navigation') --}}
            @include('layouts.navbar')
            @include('layouts.mainNavbar')
            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>


  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
   <!-- AdminLTE for demo purposes -->
  {{-- <script src="dist/js/demo.js"></script> --}}
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
 
  <script type="text/javascript">
    $(function(){
        var table = $('#categories_table').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
              "processing": true,
              "serverSide": true,
              "ajax": "{{ route('dashboard.getAllCategories') }}",
              "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "created_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } },
                { "data": "updated_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } }
              ]
        });
         var table = $('#products_table').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
              "processing": true,
              "serverSide": true,
              "ajax": "{{ route('dashboard.getAllProducts') }}",
              "columns": [
                { "data": "id" },
                { "data": "name" },
                {
                    "data": "image",
                    "render": function(data, type, row) {
                        return '<img src="' + data + '"onclick="openModal(`'
                        + data +'`)" style="max-width: 60px; max-height: 60px; cursor: pointer;" />';
                    }
                },
                { "data": "price" },
                { "data": "category_id" },
               { "data": "created_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } },
                { "data": "updated_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } },
                {
                    "data": null,
                        "render": function(data, type, row) {
                             return '<a href="#' + data.id + '"><i class="fas fa-edit"></i></a> ' +
                      '<form id="delete-form-' + data.id + '" action="/delete/'+ data.id +
                      '" method="POST" style="display: inline;">' +
                      '@csrf' +
                      '@method("DELETE")' +
                      '<button type="submit" onclick="return confirm(\'You want to delete this product?\')"'+
                      '<i class="fas fa-trash-alt"></i></button>'
                      +
                      '</form>';
                        }
                 },

              ]
        });
        var table = $('#customers_table').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
              "processing": true,
              "serverSide": true,
              "ajax": "{{ route('dashboard.getAllCustomers') }}",
              "columns": [
                { "data": "id" },
                { "data": "email" },
                { "data": "password" },
                { "data": "name" },
                { "data": "created_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } },
                { "data": "updated_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } }
              ]
        });
        var table = $('#orders_table').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
              "processing": true,
              "serverSide": true,
              "ajax": "{{ route('dashboard.getAllOrders') }}",
              "columns": [
                { "data": "id" },
                { "data": "customer_id" },
                { "data": "phone" },
                { "data": "email" },
                { "data": "address" },
                { "data": "total" },
                { "data": "fullname" },
                { "data": "note" },
                { "data": "method" },
               { "data": "created_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } },
                { "data": "updated_at",
                "render": function(data, type, row) {
                    // Sử dụng Moment.js để định dạng ngày giờ
                    return moment(data).format('HH:mm - DD/MM/YYYY');
                } }
              ]
        });
        
    });
   
    function openModal(imageSrc) {
            var modal = document.getElementById("imgModel");
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = imageSrc;
        }

        // Đóng modal khi click vào nút close
        document.getElementsByClassName("close")[0].onclick = function () {
            var modal = document.getElementById("imgModel");
            modal.style.display = "none";
        }
</script>
    </body>
</html>
