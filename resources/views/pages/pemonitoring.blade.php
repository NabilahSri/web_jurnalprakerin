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
                            <li class="breadcrumb-item" aria-current="page">Guru/Pemonitor</li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                        <h3 class="box-title">Data Pemonitor</h3>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>No Telepon</th>
                                        <th>alamat</th>
                                        <th>Foto</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->user->username }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>
                                                @if ($item->foto)
                                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="User Photo"
                                                        style="border-radius: 50%; width: 100px; height: 100px;">
                                                @else
                                                    <div class="text-danger">
                                                        Foto tidak tersedia
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#hapusModal{{ $item->id }}"><i
                                                        class="fa fa-trash-o"></i></a>
                                                <a href="#" class="btn btn-sm btn-success"><i class="fa fa-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->id }}"></i></a>
                                            </td>
                                        </tr>
                                        {{-- Modal Hapus --}}
                                        <div class="modal center-modal fade" id="hapusModal{{ $item->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
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
                                                        <a href="/users/pemonitoring/delete/{{ $item->id }}"
                                                            class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal Edit --}}
                                        <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Edit Data Pemonitor
                                                        </h4>
                                                        <button class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/users/pemonitoring/edit/{{ $item->id }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="form-label">Nama</label>
                                                                        <input type="text" name="name" id=""
                                                                            placeholder="Masukan nama" class="form-control"
                                                                            value="{{ $item->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="form-label">Email</label>
                                                                        <input type="email" name="email" id=""
                                                                            placeholder="Masukan email" class="form-control"
                                                                            value="{{ $item->email }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="form-label">Username</label>
                                                                        <input type="text" name="username"
                                                                            id="" placeholder="Masukan username"
                                                                            class="form-control"
                                                                            value="{{ $item->user->username }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="form-label">Password</label>
                                                                        <input type="password" name="password"
                                                                            id=""
                                                                            placeholder="Masukan password jika ingin di ubah"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="form-label">Foto</label>
                                                                        <input type="file" name="foto"
                                                                            id="" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="" class="form-label">No
                                                                            Telepon</label>
                                                                        <input type="number" name="telp"
                                                                            id=""
                                                                            placeholder="Masukan no telepon"
                                                                            class="form-control"
                                                                            value="{{ $item->telp }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="form-label">Alamat</label>
                                                                        <textarea name="alamat" id="" cols="30" rows="2" class="form-control" required>{{ $item->alamat }}</textarea>
                                                                    </div>
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
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Pemonitor</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/users/pemonitoring/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" name="name" id="" placeholder="Masukan nama"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" name="email" id="" placeholder="Masukan email"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Username</label>
                                        <input type="text" name="username" id=""
                                            placeholder="Masukan username" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">No Telepon</label>
                                        <input type="number" name="telp" id=""
                                            placeholder="Masukan no telepon" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Foto</label>
                                        <input type="file" name="foto" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="" cols="30" rows="2" class="form-control" required></textarea>
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
    </section>
@endsection
