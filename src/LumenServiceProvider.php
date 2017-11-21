<?php

namespace DreamFactory\Core\GraphiQL;

class LumenServiceProvider extends ServiceProvider
{
    /**
     * Get the active router.
     *
     * @return Router
     */
    protected function getRouter()
    {
        return property_exists($this->app, 'router') ? $this->app->router : $this->app;
    }

    /**
     * Bootstrap publishes
     *
     * @return void
     */
    protected function bootPublishes()
    {
        $configPath = __DIR__ . '/../config';
        $viewsPath = __DIR__.'/../resources/views';
        $this->mergeConfigFrom($configPath . '/config.php', 'graphiql');
        $this->loadViewsFrom($viewsPath, 'graphiql');
    }

    /**
     * Bootstrap router
     *
     * @return void
     */
    protected function bootRouter()
    {
        if ($this->app['config']->get('graphiql.routes')) {
            $router = $this->getRouter();
            include __DIR__.'/../routes/routes.php';
        }
    }
}
