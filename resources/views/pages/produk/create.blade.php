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
    </div><!-- End Page Title -->

<h1 class="my-4">Buat Produk Baru</h1>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_kategori">Kategori</label>
            <select name="id_kategori" class="form-control" required>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="deskripsi_produk">Deskripsi Produk</label>
            <textarea name="deskripsi_produk" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="harga_produk">Harga Produk</label>
            <input type="number" step="0.01" name="harga_produk" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main><!-- End #main -->
@endsection