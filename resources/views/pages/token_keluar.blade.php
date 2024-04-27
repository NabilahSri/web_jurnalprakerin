@extends('component.template')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">Menu</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Token Keluar</li>
                            <li class="breadcrumb-item active" aria-current="page">Token</li>
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
                        <h3 class="box-title">Data Token Keluar</h3>
                        <form action="/save-token" method="post">
                            @csrf
                            <button class="btn btn-warning">Generate</button>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Token Keluar</th>
                                        <th>Kadaluarsa Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($token as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->token_keluar }}</td>
                                            <td>{{ $item->kadaluarsa_pada }}</td>
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

    </section>
@endsection
