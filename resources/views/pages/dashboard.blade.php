@extends('component.template')
@section('content')
    @if (auth()->user()->level == 'admin')
        <section class="content">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="box bg-primary-light pull-up">
                        <div class="box-body p-xl-0">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-3"><img
                                        src="https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/custom-14.svg"
                                        alt=""></div>
                                <div class="col-12 col-lg-9">
                                    <h2>Selamat datang kembali, {{ auth()->user()['level'] }}!</h2><a
                                        class="text-dark mb-0 fs-16">
                                        Inilah tempat Anda. Silahkan jelajahi dengan nyaman.
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box bg-secondary-light pull-up"
                        style="background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/st-2.svg); background-position: right bottom; background-repeat: no-repeat;">
                        <div class="box-body">
                            <div class="flex-grow-1">

                                <h4 class="mt-25 mb-5">Kelas</h4>
                                <p class="text-fade mb-0 fs-12">{{ $kelas }} Kelas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box bg-secondary-light pull-up"
                        style="background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/st-3.svg); background-position: right bottom; background-repeat: no-repeat;">
                        <div class="box-body">
                            <div class="flex-grow-1">

                                <h4 class="mt-25 mb-5">Industri</h4>
                                <p class="text-fade mb-0 fs-12">{{ $industri }} Industri</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box bg-secondary-light pull-up"
                        style="background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/st-4.svg); background-position: right bottom; background-repeat: no-repeat;">
                        <div class="box-body">
                            <div class="flex-grow-1">

                                <h4 class="mt-25 mb-5">Siswa</h4>
                                <p class="text-fade mb-0 fs-12">{{ $siswa }} Orang Siswa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box bg-secondary-light pull-up"
                        style="background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/st-4.svg); background-position: right bottom; background-repeat: no-repeat;">
                        <div class="box-body">
                            <div class="flex-grow-1">

                                <h4 class="mt-25 mb-5">Admin</h4>
                                <p class="text-fade mb-0 fs-12">{{ $admin }} Orang Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box bg-secondary-light pull-up"
                        style="background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/st-4.svg); background-position: right bottom; background-repeat: no-repeat;">
                        <div class="box-body">
                            <div class="flex-grow-1">
                                <h4 class="mt-25 mb-5">Guru</h4>
                                <p class="text-fade mb-0 fs-12">{{ $guru }} Orang Guru/Pemonitor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif (auth()->user()->level == 'pemonitor')
        <section class="content">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="box bg-primary-light pull-up">
                        <div class="box-body p-xl-0">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-3"><img
                                        src="https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/custom-14.svg"
                                        alt=""></div>
                                <div class="col-12 col-lg-9">
                                    <h2>Selamat datang kembali, {{ auth()->user()['level'] }}!</h2>
                                    <p class="text-dark mb-0 fs-16">
                                        Inilah tempat Anda. Silahkan jelajahi dengan nyaman.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box bg-secondary-light pull-up"
                        style="background-image: url(https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/st-4.svg); background-position: right bottom; background-repeat: no-repeat;">
                        <div class="box-body">
                            <div class="flex-grow-1">
                                <h4 class="mt-25 mb-5">Total Monitoring</h4>
                                <p class="text-fade mb-0 fs-12">{{ $monitoring }} Data Monitoring</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="content">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="box bg-primary-light pull-up">
                        <div class="box-body p-xl-0">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-3"><img
                                        src="https://eduadmin-template.multipurposethemes.com/bs5/images/svg-icon/color-svg/custom-14.svg"
                                        alt=""></div>
                                <div class="col-12 col-lg-9">
                                    <h2>Selamat datang kembali, {{ auth()->user()['level'] }}!</h2>
                                    <p class="text-dark mb-0 fs-16">
                                        Inilah tempat Anda. Silahkan jelajahi dengan nyaman.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
