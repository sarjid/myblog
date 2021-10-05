<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

            //view composer for partials sidebar
        View::composer('frontend.layouts.partials.sidebar',function($view){
            $categories = Category::orderBy('name','ASC')->take(10)->get();
            $recentPosts = Post::latest()->take(3)->get();
            $recentTags = Tag::all();
            return $view->with(['categories' => $categories,'recentPosts' => $recentPosts,'recentTags' => $recentTags]);
        });

        //view composer for partials sidebar
        View::composer('frontend.layouts.partials.footer',function($view){
            $recentPosts = Post::latest()->take(4)->get();
            return $view->with(['recentPosts' => $recentPosts]);
        });
    }
}
