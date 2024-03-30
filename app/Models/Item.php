<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'starting_price', 'duration', 'image', 'end_time'];

    public function getEndTimeAttribute()
    {
        return Carbon::parse($this->start_time)->addSeconds($this->duration);
    }

    public function timeRemaining()
    {
        $now = Carbon::now();
        $end = $this->end_time;
        return $now->diffInSeconds($end);
    }
}
