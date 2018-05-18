<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    protected $fillable = ['imagePath', 'title', 'description', 'price'];
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
