<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'price',
        'countdown_date',
        'image',
        'seller_id'
    ];

    public function user() {
        return $this->belongsTo(User::class , 'seller_id');
    }

    public function bids() {

        return $this->hasMany(Bid::class);
    }

    public function getCountdownDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getDurationAttribute()
    {
        $now = \Carbon\Carbon::now();
        $duration = $this->countdown_date->diffInSeconds($now);

        if ($duration < 0) {
            return 'EXPIRED';
        }

        $days = floor($duration / 86400);
        $hours = floor(($duration % 86400) / 3600);
        $minutes = floor(($duration % 3600) / 60);
        $seconds = $duration % 60;

        return "{$days}d {$hours}h {$minutes}m {$seconds}s";
    }

    public function getImageUrlAttribute()
    {
        return asset('images/' . $this->image);
    }



}
