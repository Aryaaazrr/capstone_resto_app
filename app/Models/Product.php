<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_products';
    protected $primaryKey = 'id_product';
    protected $guarded = [];
    protected $dates = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function shopping_cart()
    {
        return $this->hasMany(ShoppingCart::class, 'id_product', 'id_product');
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetails::class, 'id_product', 'id_product');
    }
}