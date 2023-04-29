@extends('layouts.app')

@section('content')
<form action="{{ isset($barang) ? route('barang.edit.update', $barang->id) : route('barang.tambah.simpan') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ isset($barang) ? $title : " Form Tambah Data" }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ isset($barang) ? $barang->kode_barang : "" }}">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ isset($barang) ? $barang->nama_barang : "" }}">
                    </div>
                    <div class="form-group">
                        <label for="kategori_barang">Kategori Barang</label>
                        <input type="text" class="form-control" id="kategori_barang" name="kategori_barang" value="{{ isset($barang) ? $barang->kategori_barang : "" }}">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ isset($barang) ? $barang->harga : "" }}">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ isset($barang) ? $barang->jumlah : "" }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

    
@endsection