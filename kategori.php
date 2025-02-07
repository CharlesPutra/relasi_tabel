<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primarykey = 'id';
    protected $fillable = ['nama_kategori'];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'kategori_id', 'id');
    }
}
