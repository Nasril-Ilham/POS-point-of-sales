<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name','PWL Laravel starter code')}}</title>

  {{-- CSRF Token untuk mengirim token laravel csrf kepada setiap request ajax --}}
 <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset ('adminLTE/plugins/datatables-bs4/css/datatables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('adminLTE/dist/css/adminlte.min.css')}}">

  {{-- Stack CSS UNTUK MEMANGIL CUSTOM CSS --}}
  @stack('css')

  <style>
    html, body {
      height: 100%;
    }
    
    .main-sidebar {
      min-height: calc(100vh - 56px);
      overflow-y: auto;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('adminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PWL starter code</span>
    </a>

    <!-- Sidebar -->
    @include('layouts.sidebar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   @include('layouts.breadcrump')

    <!-- Main content -->
    <section class="content">

   @yield('content')
   @stack('js')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  {{-- footer --}}
  @include('layouts.footer')
  {{-- footer --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('adminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>

<script>
  // setup csrf token untuk semua request ajax
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

</script>

// Stack JS untuk memanggil custom JS di setiap halaman selalu taruh paling bawah sebelum tag </body> itu sangat sangat penting
// bug saya di sini karena saya taruh di atas tag </body> jadi tidak bisa jalan, karena kalau kita push ke stack js itu akan di render di posisi kita memanggil stack js tersebut
  @stack('js')
</body>
</html>
