@php
    use App\Models\Siswa;
@endphp
@extends('component.template')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">Laporan</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kehadiran</li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Report Kehadiran Siswa</h3>
                    </div>
                    <form method="get" action="/report/kehadiran/action">
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                        <input type="date" name="tanggal_awal" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_awal" class="form-label">Tanggal Akhir</label>
                                        <input type="date" name="tanggal_akhir" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="id_kelas" class="form-label">Pilih Kelas</label>
                                        <select name="id_kelas" id="id_kelas" class="form-control select2"
                                            onchange="getSiswa(this.value)">
                                            <option selected=""selected>Pilih Kelas</option>
                                            @foreach ($kelas as $data)
                                                <option value="{{ $data->id }}">{{ $data->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-primary mt-4 cariButton">Cari Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
