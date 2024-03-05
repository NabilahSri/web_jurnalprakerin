@php
    use App\Models\Monitoring;
    use App\Models\Siswa;
@endphp
@extends('component.template')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">Management</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Monitoring</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    @if (auth()->user()->level == 'admin')
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border d-flex justify-content-between align-items-center">
                            <h3 class="box-title">Data Monitoring Kelompok Prakerin</h3>
                            <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">Tambah</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru/Pemonitor</th>
                                            <th>Nama Industri</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monitoring as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->guru->name }}</td>
                                                <td>{{ $item->industri->name }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#hapusModal{{ $item->id_industri }}"><i
                                                            class="fa fa-trash-o"></i></a>
                                                    <a href="#" class="btn btn-sm btn-success"><i class="fa fa-edit"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id_industri }}"></i></a>
                                                    <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rinciModal{{ $item->id_industri }}"
                                                            data-id-industri="{{ $item->id_industri }}"></i></a>
                                                </td>
                                            </tr>
                                            {{-- Modal Hapus --}}
                                            <div class="modal center-modal fade" id="hapusModal{{ $item->id_industri }}"
                                                tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi
                                                                Penghapusan{{ $item->id_industri }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Anda yakin ingin menghapus data ini?</p>
                                                        </div>
                                                        <div
                                                            class="modal-footer modal-footer-uniform d-flex justify-content-between">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <a href="/monitoring/delete/{{ $item->id_industri }}"
                                                                class="btn btn-primary">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Edit --}}
                                            <div id="editModal{{ $item->id_industri }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Edit Data Monitoring
                                                                Kelompok Prakerin
                                                            </h4>
                                                            <button class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="/monitoring/edit/{{ $item->id_industri }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""
                                                                                class="form-label">Guru/Pemonitor</label>
                                                                            <select name="id_guru" id=""
                                                                                class="form-control select2"
                                                                                style="width: 100%" required>
                                                                                <option value="{{ $item->guru->id }}">
                                                                                    {{ $item->guru->name }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""
                                                                                class="form-label">Industri</label>
                                                                            <select name="id_industri" id=""
                                                                                class="form-control select2"
                                                                                style="width: 100%" required>
                                                                                <option value="{{ $item->industri->id }}">
                                                                                    {{ $item->industri->name }}</option>
                                                                                @foreach ($industri as $data)
                                                                                    <option value="{{ $data->id }}">
                                                                                        {{ $data->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $siswa1 = Siswa::all();
                                                                        $monitoring1 = Monitoring::where(
                                                                            'id_industri',
                                                                            $item->id_industri,
                                                                        )
                                                                            ->with('siswa')
                                                                            ->get();
                                                                    @endphp
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Nama Siswa</label>
                                                                            <select name="id_siswa[]"
                                                                                class="form-control select2"
                                                                                multiple="multiple"
                                                                                data-placeholder="Pilih Siswa"
                                                                                style="width: 100%;" required>
                                                                                @foreach ($monitoring1 as $siswaa)
                                                                                    <option
                                                                                        value="{{ $siswaa->siswa->id }}"
                                                                                        selected>
                                                                                        {{ $siswaa->siswa->name }} -
                                                                                        {{ $siswaa->siswa->kelas->kelas }}
                                                                                    </option>
                                                                                @endforeach
                                                                                @foreach ($siswa as $data)
                                                                                    <option value="{{ $data->id }}">
                                                                                        {{ $data->name }} -
                                                                                        {{ $data->kelas->kelas }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-between">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
            <!-- Modal Tambah-->
            <div id="tambahModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Monitoring kelompok Prakerin</h4>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/monitoring/create" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Guru/Pemonitor</label>
                                            <select name="id_guru" id="" class="form-control select2"
                                                style="width: 100%" required>
                                                <option selected="selected">Pilih guru/pemonitor</option>
                                                @foreach ($guru as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Industri</label>
                                            <select name="id_industri" id="" class="form-control select2"
                                                style="width: 100%" required>
                                                <option selected="selected">Pilih industri</option>
                                                @foreach ($industri as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Nama Siswa</label>
                                            <select name="id_siswa[]" class="form-control select2" multiple="multiple"
                                                data-placeholder="Pilih Siswa" style="width: 100%;" required>
                                                @foreach ($siswa as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }} -
                                                        {{ $data->kelas->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            @foreach ($monitoring as $item)
                <!-- Modal Rinci-->
                <div id="rinciModal{{ $item->id_industri }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Detail Kelompok {{ $item->industri->name }}
                                </h4>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>No Telepon</th>
                                        </tr>
                                        @php
                                            $siswa = Monitoring::with('siswa')
                                                ->where('id_industri', $item->id_industri)
                                                // ->groupBy('id_siswa')
                                                ->get()
                                                ->pluck('siswa')
                                                ->unique('id');
                                        @endphp
                                        @foreach ($siswa as $data)
                                            <tr>
                                                <td>{{ $data->nisn }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->kelas->kelas }}</td>
                                                <td>{{ $data->telp }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-uniform d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            @endforeach
        </section>
    @else
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border d-flex justify-content-between align-items-center">
                            <h3 class="box-title">Data Monitoring Kelompok Prakerin</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru/Pemonitor</th>
                                            <th>Nama Industri</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monitoring as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->guru->name }}</td>
                                                <td>{{ $item->industri->name }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rinciModal{{ $item->id_industri }}"
                                                            data-id-industri="{{ $item->id_industri }}"></i></a>
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

            @foreach ($monitoring as $item)
                <!-- Modal Rinci-->
                <div id="rinciModal{{ $item->id_industri }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Detail Kelompok {{ $item->industri->name }}
                                </h4>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>No Telepon</th>
                                        </tr>
                                        @php
                                            $siswa = Monitoring::with('siswa')
                                                ->where('id_industri', $item->id_industri)
                                                // ->groupBy('id_siswa')
                                                ->get()
                                                ->pluck('siswa')
                                                ->unique('id');
                                        @endphp
                                        @foreach ($siswa as $data)
                                            <tr>
                                                <td>{{ $data->nisn }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->kelas->kelas }}</td>
                                                <td>{{ $data->telp }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-uniform d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            @endforeach
        </section>
    @endif
@endsection
