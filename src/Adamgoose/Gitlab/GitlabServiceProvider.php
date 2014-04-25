<?php namespace Adamgoose\Gitlab;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class GitlabServiceProvider extends ServiceProvider {

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
		//
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
	  $this->package('adamgoose/gitlab');

	  $aliases = $this->app['config']->get('gitlab::aliases');

	  foreach($aliases as $alias => $target)
		  AliasLoader::getInstance()->alias($alias, $target);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
