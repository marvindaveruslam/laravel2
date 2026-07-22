<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Artikel;

class Artikel extends Model
{
    public function user()

{
    return $this->belongsTo(User::class);
}

public function kategori()
{
    return $this->belongsTo(Kategori::class);
}

public function komentars()
{
    return $this->hasMany(Komentar::class);
}
    protected $fillable = [

    'judul',

    'slug',

    'isi',

    'excerpt',

    'gambar',

    'kategori_id',

    'user_id',

    'status',

    'published_at'

];
    use SoftDeletes;

}
