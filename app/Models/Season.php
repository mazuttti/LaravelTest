<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'anime_id'];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
