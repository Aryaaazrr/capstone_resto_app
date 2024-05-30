@extends('layouts.main_admin')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Produk</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Produk</li>
        </ol>
      </nav>
    </div>

    <h1 class="my-4">Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Buat Produk Baru</a>
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
                        <a href="{{ route('produk.show', $produk->id_produk) }}" class="btn btn-info btn-sm">Tampilkan</a>
                        <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main><!-- End #main -->
@endsection