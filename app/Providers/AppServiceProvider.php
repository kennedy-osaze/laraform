<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('min_words', function ($attribute, $value, $parameters, $validator) {
            $value = preg_replace('/<.*?>/', '', $value);
            $length = $parameters[0];
            return count(preg_split('/\s+/u', $value, null, PREG_SPLIT_NO_EMPTY)) >= $length;
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
