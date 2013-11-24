<?php namespace Boyhagemann\User;

use Illuminate\Support\ServiceProvider;
use Route;

class UserServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('user', 'user');
        
        $this->app->register('Cartalyst\Sentry\SentryServiceProvider');
	}

	/**
	 *
	 * @return void
	 */
	public function boot()
	{
        Route::get('login', array(
            'uses' => 'Boyhagemann\User\Controller\AuthController@login',
            'as' => 'user.login',
        ));
        
        Route::post('auth', array(
            'uses' => 'Boyhagemann\User\Controller\AuthController@auth',
            'as' => 'user.auth',
        ));
        
        Route::get('logout', array(
            'uses' => 'Boyhagemann\User\Controller\AuthController@logout',
            'as' => 'user.logout',
        ));
        
        Route::get('admin/permissions', array(
            'uses' => 'Boyhagemann\User\Controller\PermissionController@index',
            'as' => 'user.permissions',
        ));
        
        Route::post('admin/permissions', array(
            'uses' => 'Boyhagemann\User\Controller\PermissionController@save',
            'as' => 'user.permissions.save',
        ));
	}
    
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('user');
	}

}