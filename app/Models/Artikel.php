<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
