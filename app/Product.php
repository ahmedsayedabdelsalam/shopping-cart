<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;

    protected $fillable = ['imagePath', 'title', 'description', 'price'];

    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
