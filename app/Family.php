<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Family extends Model
{
    use HasSlug;
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
