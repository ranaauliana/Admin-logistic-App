@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>
<br>
    <form method="GET" action="{{ route('barang') }}"
class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
<div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
        aria-label="Search" aria-describedby="basic-addon2" name="key" 
        value="{{ $key }}"
        >
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
        </button>
    </div>
</div>
</form>

    <div class="card-body">
        <a href="{{ route('barang.tambah') }}" class="btn btn-primary mb-3">Tambah +</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        ($no = 1);
                    @endphp
@foreach ($barang as $item)
    
<tr>
    <td>{{ $no++ }}</td>
    <td>{{ $item->kode_barang }}</td>
    <td>{{ $item ->nama_barang }}</td>
    <td>{{ $item->kategori_barang }}</td>
    <td>{{ $item->harga }}</td>
    <td>{{ $item->jumlah }}</td>
    <td>
        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning"> Edit </a>
        <a href="{{ route('barang.hapus', $item->id) }}" class="btn btn-danger"> Hapus </a>
    </td>
</tr>
@endforeach
                </tbody>
            </table>
            {{ $barang->links() }}
        </div>
    </div>
</div>
    
@endsection