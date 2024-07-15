<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from eduadmin-template.multipurposethemes.com/bs5/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Feb 2024 00:21:01 GMT -->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="https://web.smk-ypc.sch.id/wp-content/uploads/2023/12/smk-ypc-png-300x263.png">

        <title>Jurnal Prakerin | SMK YPC Tasikmalaya</title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="{{ asset('asset/css/vendors_css.css') }}">

        <!-- Style-->
        <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/skin_color.css') }}">

        {{-- Icons --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <style>
            .select2-container--open {
                z-index: 99999 !important;
                pointer-events: auto !important;
            }
        </style>
        @yield('css')
    </head>

    <body class="hold-transition light-skin sidebar-mini theme-primary fixed">


        <div class="wrapper">
            <div id="loader"></div>

            <header class="main-header">
                <div class="d-flex align-items-center logo-box justify-content-start">
                    <a href="#"
                        class="waves-effect waves-light nav-link d-none d-md-inline-block mx-5 push-btn bg-transparent"
                        data-toggle="push-menu" role="button">
                        <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></span>
                    </a>
                    <!-- Logo -->
                    <a href="index-2.html" class="logo">
                        <!-- logo-->
                        <div class="logo-lg">
                            <span class="light-logo"><img
                                    src="https://web.smk-ypc.sch.id/wp-content/uploads/2022/02/Logo-we.png"
                                    alt="logo"></span>
                            <span class="dark-logo"><img src="{{ asset('/images/logo-light-text.png') }}"
                                    alt="logo"></span>
                        </div>
                    </a>
                </div>
                @include('component.header-navbar')
            </header>

            <aside class="main-sidebar">
                @include('component.sidebar')
            </aside>

            <div class="content-wrapper">
                <div class="container-full">
                    @yield('content')
                </div>
            </div>
            <!-- /.content-wrapper -->
            @include('component.footer')

            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <!-- Vendor JS -->
        <script src="{{ asset('asset/js/vendors.min.js') }}"></script>
        <script src="{{ asset('asset/js/pages/chat-popup.js') }}"></script>
        <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

        <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
        <script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
        <script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
        <script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

        <!-- EduAdmin App -->
        <script src="{{ asset('asset/js/template.js') }}"></script>
        <script src="{{ asset('asset/js/pages/dashboard.js') }}"></script>
        <script src="{{ asset('asset/js/pages/calendar.js') }}"></script>
        <script src="{{ asset('asset/js/pages/data-table.js') }}"></script>
        <script src="{{ asset('asset/js/pages/advanced-form-element.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });

            $('.modal').on('shown.bs.modal', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this)
                });
            });
        </script>
        @yield('script')

        @include('sweetalert::alert')

    </body>

    <!-- Mirrored from eduadmin-template.multipurposethemes.com/bs5/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Feb 2024 00:23:50 GMT -->

</html>
