<?php

$graphiQLRoute = config('graphiql.routes', 'graphiql');
$controller = 'DreamFactory\Core\GraphiQL\Http\Controllers\GraphiQLController';
Route::get($graphiQLRoute, ['as' => 'graphiql.graphiql', 'uses' => $controller.'@graphiql']);
