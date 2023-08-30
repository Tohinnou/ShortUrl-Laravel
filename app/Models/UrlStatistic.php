<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UrlStatistic extends Model
{
    use HasFactory;

    public function getClicks()
    {
        if($this->clicks === null)
        {
             $this->clicks = 0;
        }
        return $this->clicks;
    }

    public function scopeDate(Builder $query, $date): Builder 
    {
        $query->where('created_at','like', "{$date}%");
    }

    public function scopeUrl(Builder $query, $url): Builder 
    {
        $query->where('url_id', $url->first()->id);
    }
}
