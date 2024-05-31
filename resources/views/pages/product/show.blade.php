@extends('layouts.admin.main')

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

<h1 class="my-4">Detail Produk</h1>
    <div class="card">
        <div class="card-header">
            {{ $produk->nama_produk }}
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $produk->deskripsi_produk }}</p>
            <p><strong>Harga:</strong> {{ $produk->harga_produk }}</p>
            <p><strong>Kategori:</strong> {{ $produk->kategori->nama_kategori }}</p>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</main><!-- End #main -->
@endsection