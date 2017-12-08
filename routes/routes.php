<?php

$schemaParameterPattern = '/\{\s*graphql\_schema\s*\?\s*\}/';

$graphiQLRoute = config('graphiql.routes', 'graphiql');
$controller = '\DreamFactory\Core\GraphiQL\Http\Controllers\GraphiQLController@graphiql';
if (!$router instanceof \Illuminate\Routing\Router &&
    preg_match($schemaParameterPattern, $graphiQLRoute)
) {
    $router->get(preg_replace($schemaParameterPattern, '', $graphiQLRoute), [
        'as'         => 'graphiql.graphiql',
        'middleware' => config('graphiql.middleware', []),
        'uses'       => $controller
    ]);
    $router->get(preg_replace($schemaParameterPattern, '{graphql_schema}', $graphiQLRoute), [
        'as'         => 'graphiql.graphiql.with_schema',
        'middleware' => config('graphiql.middleware', []),
        'uses'       => $controller
    ]);
} else {
    $router->get($graphiQLRoute, [
        'as'         => 'graphiql.graphiql',
        'middleware' => config('graphiql.middleware', []),
        'uses'       => $controller
    ]);
}
