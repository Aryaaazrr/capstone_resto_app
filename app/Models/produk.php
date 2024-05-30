<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_produk', 'id_produk');
    }

    public function detail_transaksi()
    {
        return $this->belongsTo(DetailTransaksi::class, 'id_produk', 'id_produk');
    }
}
