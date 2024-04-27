@php
    use App\Models\Kegiatan;
@endphp
@extends('component.template')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">Mobile</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kehadiran & Kegiatan</li>
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
                        <h3 class="box-title">Data Kehadiran & Kegiatan Siswa</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Total Jam</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensi as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->siswa->name }}</td>
                                            <td>{{ $item->siswa->kelas->kelas }}</td>
                                            <td>
                                                @if ($item->jam_masuk)
                                                    {{ $item->jam_masuk }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->jam_pulang)
                                                    {{ $item->jam_pulang }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->jam_masuk && $item->jam_pulang)
                                                    <?php
                                                    // Hitung perbedaan waktu antara jam masuk dan jam pulang
                                                    $jamMasuk = strtotime($item->jam_masuk);
                                                    $jamPulang = strtotime($item->jam_pulang);
                                                    $selisihWaktu = $jamPulang - $jamMasuk;

                                                    // Konversi selisih waktu ke dalam format jam:menit
                                                    $totalJam = floor($selisihWaktu / 3600); // 1 jam = 3600 detik
                                                    $totalMenit = floor(($selisihWaktu % 3600) / 60);

                                                    // Tampilkan total jam
                                                    echo $totalJam . ' jam ' . $totalMenit . ' menit';
                                                    ?>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'hadir')
                                                    <span class="badge badge-pill badge-success">Hadir</span>
                                                @elseif ($item->status == 'izin')
                                                    <span class="badge badge-pill badge-secondary">Izin</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Sakit</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status == 'hadir')
                                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#kegiatanModal{{ $item->id }}">Lihat
                                                        Kegiatan</a>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $item->id }}">Lihat Detail</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        @foreach ($absensi as $key => $item)
            {{-- Modal Kegiatan --}}
            <div class="modal center-modal fade" id="kegiatanModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kegiatan {{ $item->siswa->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>Aktivitas/Kegiatan Harian</th>
                                        <th>Foto Kegiatan</th>
                                        <th>Durasi (menit)</th>
                                    </tr>
                                    @php
                                        $kegiatan = Kegiatan::where('id_absensi', $item->id)
                                            // ->groupBy('id_siswa')
                                            ->get();
                                        // ->pluck('siswa')
                                        // ->unique('id');
                                        $totalDurasi = array_sum($kegiatan->pluck('durasi')->toArray());
                                        $jam = floor($totalDurasi / 60);
                                        $menit = $totalDurasi % 60;
                                    @endphp
                                    @foreach ($kegiatan as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->deskripsi }}</td>
                                            <td>
                                                @if ($data->foto)
                                                    <img src="{{ asset('storage/' . $data->foto) }}" alt="foto"
                                                        style="border-radius: 50%; width: 100px; height: 100px;">
                                                @else
                                                    <span class="text-danger">Tidak ada foto kegiatan</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->durasi }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan = '2'></th>
                                        <th>Total Durasi</th>
                                        <th>{{ $jam }} jam {{ $menit }} menit</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-uniform d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Detail --}}
            <div class="modal center-modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Alasan {{ $item->siswa->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="catatan" class="form-label">Catatan</label>
                                        <input type="text" name="catatan" id="catatan" value="{{ $item->catatan }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="bukti" class="form-label">Bukti</label>
                                        @if ($item->bukti)
                                            <img src="{{ asset('storage/' . $item->bukti) }}" alt="bukti"
                                                style="border-radius: 2%; height:200px;" class="img-fluid">
                                        @else
                                            <span class="text-danger">Tidak Ada Bukti</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-uniform d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
