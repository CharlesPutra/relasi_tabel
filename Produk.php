<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $primarykey = 'id';
    protected $fillable = ['nama', 'harga','kategori_id', 'deskripsi', 'image'];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id', 'id');
    }
}
