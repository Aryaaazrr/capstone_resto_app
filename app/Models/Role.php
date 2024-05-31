<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_roles';
    protected $primaryKey = 'id_role';
    protected $guarded = [];
    protected $dates = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id_role', 'id_role');
    }
}