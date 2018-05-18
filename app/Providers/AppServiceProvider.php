<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $categories = \App\Category::all();
            $cats = [];
            foreach($categories as $categorie) {
                $cats[] = [
                    'text' => $categorie->title,
                    'url' => 'admin/categories/' . $categorie->id,
                    'icon' => 'tag',
                ];
            }
            $event->menu->add([
                'text' => 'Categories',
                'icon' => 'tag',
                'submenu' => [
                    [
                        'text' => 'All Categories',
                        'icon' => 'tag',
                        'submenu' => $cats,
                    ],
                    [
                        'text' => 'Add Category',
                        'url' => 'admin/categories/create',
                    ],
                ],
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
