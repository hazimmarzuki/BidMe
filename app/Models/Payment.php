<?php

namespace App\Models;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'bid_id',
        'status'
    ];

    public function bid() {
        return $this->belongsTo(Bid::class, 'bid_id');
    }
}
