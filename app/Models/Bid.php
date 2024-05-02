<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function buyer() {
        return $this->belongsTo(User::class , 'buyer_id' );
    }
    public function seller() {
        return $this->belongsTo(User::class , 'seller_id' );
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

}
