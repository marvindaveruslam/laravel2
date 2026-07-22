<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'excerpt',
        'gambar',
        'kategori_id',
        'user_id',
        'status',
        'views',
        'likes',
        'is_featured',
        'published_at',
        'meta_title',
        'meta_description',
    ];

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
}
