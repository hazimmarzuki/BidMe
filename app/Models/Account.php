<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'password', 'password_confirmation'];

    public function items(){
        return $this->hasMany(Item::class);
    }
}
