<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';
    protected $fillable = ['kategori_id','judul','deskripsi','gambar','tahun'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }
}
