@extends('layouts.admin.main')

@section('content')
    <div class="pagetitle">
        <h1>Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Daftar Tugas</h5>
                            <div class="h-10 d-flex align-items-center">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add Product</a>
                            </div>
                        </div>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                aria-labelledby="home-tab">

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produks as $produk)
                                            <tr>
                                                <td>{{ $produk->nama_produk }}</td>
                                                <td>{{ $produk->deskripsi_produk }}</td>
                                                <td>Rp. {{ $produk->harga_produk }}</td>
                                                <td>{{ $produk->kategori->nama_kategori }}</td>
                                                <td>
                                                    <a href="{{ route('admin.prduct.show', $produk->id_produk) }}"
                                                        class="btn btn-info btn-sm">Tampilkan</a>
                                                    <a href="{{ route('admin.prduct.edit', $produk->id_produk) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('admin.product.destroy', $produk->id_produk) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
