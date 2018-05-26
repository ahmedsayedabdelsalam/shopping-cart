<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $fillable = ['name', 'address', 'payment_id', 'user_id', 'cart'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
