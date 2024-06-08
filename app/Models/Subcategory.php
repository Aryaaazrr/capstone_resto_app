<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_subcategories';
    protected $primaryKey = 'id_subcategory';
    protected $guarded = [];
    protected $dates = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'id_subcategory', 'id_subcategory');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
