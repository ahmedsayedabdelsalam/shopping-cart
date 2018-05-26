<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderApi extends Model
{
    protected $table = 'orders_api';
    protected $fillable = ['user_id', 'product_id', 'count'];
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
