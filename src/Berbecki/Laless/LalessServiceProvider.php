<?php namespace Berbecki\Laless;

use Illuminate\Support\ServiceProvider;

define('LALESS_VERSION', '1.0.0');

class LalessServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		/**
		 * Laless will NOT run in production environment
		 */
		if( $this->app->__get('env') != 'production'  || $this->app['config']->get('laless::force_compile') )
		{
			$this->package('berbecki/laless');
			$laless = new Laless($this->app);

			// Compiles less file if manual_compile_only is not enabled
			if (! $this->app['config']->get('laless::manual_compile_only'))
			{
				$laless->compileLessFiles();
			}
		}
	}

	/**
	 * Register the commands.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('laless', function($app)
		{
		    return new Laless($app);
		});

		$this->app['config']->package('berbecki/laless', __DIR__.'/../../config');

		$this->app['command.laless.compile'] = $this->app->share(function($app)
		{
			return new LalessCommand($app);
		});

		$this->commands('command.laless.compile');
	}

}
