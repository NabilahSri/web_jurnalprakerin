<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from eduadmin-template.multipurposethemes.com/bs5/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Feb 2024 00:38:24 GMT -->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="https://eduadmin-template.multipurposethemes.com/bs5/images/favicon.ico">

        <title>JurnalPrakerin - Log in </title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="asset/css/vendors_css.css">

        <!-- Style-->
        <link rel="stylesheet" href="asset/css/style.css">
        <link rel="stylesheet" href="asset/css/skin_color.css">



    </head>

    <style>
        body {
            background-image: url(https://sewaalatkamera.com/sewa/images/1554/1.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

    <body class="hold-transition theme-primary bg-img">

        <div class="container h-p100">
            <div class="row align-items-center justify-content-md-center h-p100">

                <div class="col-12">
                    <div class="row justify-content-center g-0">
                        <div class="col-lg-5 col-md-5 col-12">
                            <div class="bg-white rounded10 shadow-lg">
                                <div class="content-top-agile p-20 pb-0">
                                    <h2 class="text-primary">Selamat Datang di Website Jurnal Prakerin!</h2>
                                    <p class="mb-0">Silahkan masuk menggunakan akun anda.</p>
                                </div>
                                <div class="p-40">
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-transparent"><i
                                                        class="ti-user"></i></span>
                                                <input type="text" class="form-control ps-15 bg-transparent"
                                                    placeholder="Username" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text  bg-transparent"><i
                                                        class="ti-lock"></i></span>
                                                <input type="password" class="form-control ps-15 bg-transparent"
                                                    placeholder="Password" name="password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-danger mt-10">Masuk</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Vendor JS -->
        <script src="asset/js/vendors.min.js"></script>
        <script src="assetjs/pages/chat-popup.js"></script>
        <script src="../assets/icons/feather-icons/feather.min.js"></script>

        @include('sweetalert::alert')

    </body>

    <!-- Mirrored from eduadmin-template.multipurposethemes.com/bs5/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Feb 2024 00:38:30 GMT -->

</html>
