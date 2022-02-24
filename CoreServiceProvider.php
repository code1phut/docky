<?php

namespace Ducky\Core;
 
use Illuminate\Support\ServiceProvider;
 
 
class CoreServiceProvider extends ServiceProvider{
    
    protected $repositories = [
        'ApiTagRepository',
        'ApiCategoryRepository',
        'ApiUserRepository',
    ];
 
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }
    /**
     * 
     */
    private function registerRepositories() {
        foreach ($this->repositories as $repository) {
            $this->app->bindIf(
                'App\\Repositories\\Interfaces\\I'.$repository,
                'App\\Repositories\\Eloquents\\'.$repository,
            );
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}