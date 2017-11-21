<?php

namespace DreamFactory\Core\GraphiQL;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected function getRouter()
    {
        return $this->app['router'];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootPublishes();

        $this->bootRouter();

        $this->bootViews();
    }

    /**
     * Bootstrap router
     *
     * @return void
     */
    protected function bootRouter()
    {
        if ($this->app['config']->get('graphiql.routes') && !$this->app->routesAreCached()) {
            $router = $this->getRouter();
            include __DIR__.'/../routes/routes.php';
        }
    }

    /**
     * Bootstrap publishes
     *
     * @return void
     */
    protected function bootPublishes()
    {
        $configPath = __DIR__.'/../config';
        $viewsPath = __DIR__.'/../resources/views';

        $this->mergeConfigFrom($configPath.'/config.php', 'graphiql');

        $this->loadViewsFrom($viewsPath, 'graphiql');

        $this->publishes([
            $configPath.'/config.php' => config_path('graphiql.php'),
        ], 'config');

        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/graphiql'),
        ], 'views');
    }

    /**
     * Bootstrap Views
     *
     * @return void
     */
    protected function bootViews()
    {
        $config = $this->app['config'];

            $view = $config->get('graphiql.graphiql.view', 'graphiql::graphiql');
            $this->app['view']->composer($view, View\GraphiQLComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['graphiql'];
    }
}
