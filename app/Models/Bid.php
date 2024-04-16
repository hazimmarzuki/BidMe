<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'bid_amount',
        'seller_id',
        'buyer_id',
        'bid_time'
    ];

    public function item() {
        return $this->belongsTo(Item::class );
    }
}
