<?php

namespace App\Providers;

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
        // ローカル環境でない場合はリンクをhttpsで出力する
        if (!app()->islocal()) {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }
}
