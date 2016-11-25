<?php

namespace TypiCMS\Modules\Users\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Users\Shells\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            $router->group(['middleware' => 'web'], function (Router $router) {
                foreach (config('translatable.locales') as $lang) {
                    $uri = trim(TypiCMS::homeUri($lang), '/');
                    $router->get($uri . '/login', 'AuthController@getLogin')->name($lang . '.login');
                    $router->post($uri . '/login', 'AuthController@postLogin');
                }
            });

            /*
             * Front office routes
             */
            $router->group(['prefix' => 'auth', 'middleware' => 'web'], function (Router $router) {

                // Registration
                $router->get('register', 'RegistrationController@getRegister')->name('register');
                $router->post('register', 'RegistrationController@postRegister');
                $router->get('activate/{token}', 'RegistrationController@confirmEmail')->name('activate');

                // Login
                $router->get('login', 'AuthController@getLogin')->name('login');
                $router->post('login', 'AuthController@postLogin');

                // Logout
                $router->get('logout', 'AuthController@getLogout')->name('logout');

                // Request new password
                $router->get('resetpassword', 'PasswordController@getEmail')->name('resetpassword');
                $router->post('resetpassword', 'PasswordController@postEmail');

                // Set new password
                $router->get('changepassword/{token}', 'PasswordController@getReset')->name('changepassword');
                $router->post('changepassword/{token}', 'PasswordController@postReset');
            });

            /*
             * Admin routes
             */
            $router->get('admin/users', 'AdminController@index')->name('admin::index-users');
            $router->get('admin/users/create', 'AdminController@create')->name('admin::create-user');
            $router->get('admin/users/{user}/edit', 'AdminController@edit')->name('admin::edit-user');
            $router->post('admin/users', 'AdminController@store')->name('admin::store-user');
            $router->put('admin/users/{user}', 'AdminController@update')->name('admin::update-user');
            $router->post('admin/users/current/updatepreferences', 'AdminController@postUpdatePreferences')->name('admin::update-preferences');

            /*
             * API routes
             */
            $router->get('api/users', 'ApiController@index')->name('api::index-users');
            $router->put('api/users/{user}', 'ApiController@update')->name('api::update-user');
            $router->delete('api/users/{user}', 'ApiController@destroy')->name('api::destroy-user');

            /*
             * Social routes
             */
            if (config()->get('auth.social_users')) {
                $router->get('/social/redirect/{provider}', 'SocialController@getSocialRedirect')->name('social.redirect');
                $router->get('/social/handle/{provider}', 'SocialController@getSocialHandle')->name('social.handle');                
            }

        });
    }
}
