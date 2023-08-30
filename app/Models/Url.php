<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'shortUrl',
        'longUrl',
        'domain'
    ];

    public function statistics()
    {
        return $this->hasMany(UrlStatistic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
