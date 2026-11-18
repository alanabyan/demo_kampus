<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = ['judul', 'deskripsi', 'dosen_id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }
}
