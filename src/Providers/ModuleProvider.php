<?php

namespace TypiCMS\Modules\Users\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Shells\Observers\FileObserver;
use TypiCMS\Modules\Users\Shells\Models\User;
use TypiCMS\Modules\Users\Shells\Repositories\EloquentUser;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['users' => []], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'users');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'users');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/users'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Users',
            'TypiCMS\Modules\Users\Shells\Facades\Facade'
        );
        if (config()->get('auth.social_users')) {
            AliasLoader::getInstance()->alias(
                'Socialite',
                \Laravel\Socialite\Facades\Socialite::class
            );            
        }

        // Observers
        User::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.users'
        );
        
        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Users\Shells\Providers\RouteServiceProvider');

        if (config()->get('auth.social_users')) {
            $app->register(\Laravel\Socialite\SocialiteServiceProvider::class);
        }

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Users\Shells\Composers\SidebarViewComposer');

        $app->bind('TypiCMS\Modules\Users\Shells\Repositories\UserInterface', function (Application $app) {
            return new EloquentUser(new User());
        });
    }
}
