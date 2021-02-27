@extends('layout.template')
@section('content')
<div class="box">
    <div class="box-header">
        <div class="pull-left">
            <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-money"></i> Tambah Transaksi
            </a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @if(session('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fa fa-check-circle-o"></i>{{ session('pesan') }}</h5>
        </div>
        @endif
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($transaksi as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->keterangan}}</td>
                    <td>{{$data->jenis}}</td>
                    <td>{{$data->tanggal}}</td>
                    <td>Rp {{number_format($data->jumlah,2,',','.')}}</td>
                    <td>
                        <a data-toggle="modal" data-target="#edit{{$data->id}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"> Edit</i>
                        </a>
                        <a href="/keuangan/delete/{{$data->id}}" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"> Delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td>Total Pemasukan :</td>
                    <td>Rp {{number_format($pemasukans,2,',','.')}} </td>
                </tr>
                <tr>
                    <td>Total Pengeluaran :</td>
                    <td>Rp {{number_format($pengeluarans,2,',','.')}} </td>
                </tr>
                <tr>
                    <td>Sisa Saldo :</td>
                    <td>Rp {{number_format($jml,2,',','.')}} </td>
                </tr>
            </tfoot>

        </table>
    </div>
    <!-- /.box-body -->
</div>

<!-- modal add -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
                <form action="/keuangan/insert" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" id="" class="form-control">
                            <option value="Kas Masuk">Kas Masuk</option>
                            <option value="Kas Keluar">Kas Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@foreach($transaksi as $data)
<div class="modal fade" id="edit{{$data->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Transaksi</h4>
            </div>
            <div class="modal-body">
                <form action="/keuangan/update/{{$data->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" value="{{$data->keterangan}}" class="form-control" name="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" id="" class="form-control">
                            <option value="Kas Masuk" {{$data->jenis == "Kas Masuk" ? 'selected' : null}}>Kas Masuk</option>
                            <option value="Kas Keluar" {{$data->jenis == "Kas Keluar" ? 'selected' : null}}>Kas Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" value="{{$data->tanggal}}" class="form-control" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" value="{{$data->jumlah}}" class="form-control" name="jumlah" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach
@endsection