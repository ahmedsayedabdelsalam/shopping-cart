<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Family;

class Product extends Model
{
    use HasSlug;

    protected $fillable = ['imagePath', 'title', 'description', 'price', 'title_ar', 'description_ar', 'price_ar'];

    
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

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
    
}
