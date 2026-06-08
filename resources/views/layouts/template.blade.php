<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PWL Laravel starter code') }}</title>

    {{-- CSRF Token untuk mengirim token laravel csrf kepada setiap request ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- sweetalert2 --}}
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">

    {{-- Stack CSS UNTUK MEMANGIL CUSTOM CSS --}}
    @stack('css')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100%;
        }

        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 56px;
        }

        .main-sidebar {
            position: fixed;
            left: 0;
            top: 56px;
            bottom: 50px;
            width: 250px;
            overflow-y: auto;
            z-index: 999;
        }

        .content-wrapper {
            position: fixed;
            left: 5px;
            top: 56px;
            right: 0;
            bottom: 50px;
            margin-bottom: 5px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .content-wrapper>div:first-child {
            flex-shrink: 0;
            background: white;
            border-bottom: 1px solid #dee2e6;
            overflow: visible;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 0px;
            margin-bottom: 100px;
        }

        .main-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            height: 50px;
            z-index: 900;
            background: white;
            border-top: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            padding: 10px 20px;
        }

        .control-sidebar {
            display: none;
        }

        /* PERBAIKAN CSS MODAL AGAR TIDAK TERPOTONG */
        .content-wrapper .modal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 2000 !important;
            /* Di atas main-header (1000) */
            overflow-x: hidden;
            overflow-y: auto;
        }

        .content-wrapper .modal-dialog {
            z-index: 2001 !important;
            margin: 30px auto !important;
            /* Memberikan ruang agar tidak mentok ke atas browser */
        }

        /* Menghilangkan backdrop bawaan agar tidak mengunci layar belakang */
        /* Sembunyikan backdrop bawaan Bootstrap agar tidak mengunci layar belakang */
        .modal-backdrop {
            display: none !important;
        }

        /* Biarkan modal menggunakan flow normal, tidak mentok ke atas screen */
        .content-wrapper .modal {
            position: fixed !important;
            top: 56px !important;
            /* Sengaja diturunkan pas di bawah tinggi header (56px) */
            left: 0 !important;
            width: 100vw !important;
            height: calc(100vh - 56px) !important;
            /* Tinggi disesuaikan sisa layar */
            z-index: 1050 !important;
            overflow-x: hidden;
            overflow-y: auto;
            background: rgba(0, 0, 0, 0.4);
            /* Efek background gelap tiruan yang aman */
        }

        /* Atur posisi kotak modal (dialog) agar turun dan rapi */
        .content-wrapper .modal-dialog {
            z-index: 1051 !important;
            margin: 30px auto !important;
            /* Menambahkan margin atas 30px agar ada jarak aman */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('adminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PWL starter code</span>
            </a>

            @include('layouts.sidebar')
        </aside>
        <div class="content-wrapper">
            @include('layouts.breadcrump')

            <section class="content">
                @yield('content')
            </section>
        </div>
        {{-- footer --}}
        @include('layouts.footer')
    </div>

    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    {{-- jquery validation --}}
    <script src="{{ asset('adminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    {{-- sweetalert2 --}}
    <script src="{{ asset('adminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>

    <script>
        // setup csrf token untuk semua request ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('js')
</body>

</html>
