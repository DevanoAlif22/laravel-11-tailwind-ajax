<?php

namespace App\Models;

use App\Models\Film;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['nama'];

    public function films()
    {
        return $this->hasMany(Film::class, 'kategori_id', 'id');
    }
}
