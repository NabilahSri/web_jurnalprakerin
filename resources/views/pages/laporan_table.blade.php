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
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Data Kehadiran siswa</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Total Hadir</th>
                                        <th>Total Sakit</th>
                                        <th>Total Izin</th>
                                        <th>Persentase Hadir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data['absensi'] !== null)
                                        @foreach ($data['absensi'] as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->siswa->name }}</td>
                                                <td>{{ $item->where('status', 'hadir')->where('id_siswa', $item->siswa->id)->count() }}
                                                    Hari
                                                </td>
                                                <td>{{ $item->where('status', 'sakit')->where('id_siswa', $item->siswa->id)->count() }}
                                                    Hari
                                                </td>
                                                <td>{{ $item->where('status', 'izin')->where('id_siswa', $item->siswa->id)->count() }}
                                                    Hari
                                                </td>
                                                <td>
                                                    @php
                                                        $totalHadir = $item
                                                            ->where('status', 'hadir')
                                                            ->where('id_siswa', $item->siswa->id)
                                                            ->count();
                                                        $totalHari = $item->count();

                                                        // Menghindari pembagian oleh nol
                                                        $persentaseHadir =
                                                            $totalHari > 0 ? ($totalHadir / $totalHari) * 100 : 0;

                                                        echo round($persentaseHadir, 2) . '%';
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
@endsection
