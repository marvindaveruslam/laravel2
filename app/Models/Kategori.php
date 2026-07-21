<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artikel;

class Kategori extends Model
{
    public function artikels()
    {
        return $this->hasMany(Artikel::class);
    }
}
