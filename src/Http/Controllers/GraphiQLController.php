<?php

namespace DreamFactory\Core\GraphiQL\Http\Controllers;

use Illuminate\Http\Request;

class GraphiQLController extends Controller
{
    public function __construct(Request $request)
    {
        $route = $request->route();
        $defaultSchema = config('graphql.schema', 'default');
        if (is_array($route)) {
            $schema = array_get($route, '2.graphql_schema', $defaultSchema);
        } elseif (is_object($route)) {
            $schema = $route->parameter('graphql_schema', $defaultSchema);
        } else {
            $schema = $defaultSchema;
        }

        $middleware = config('graphiql.middleware_schema.' . $schema, null);

        if ($middleware) {
            $this->middleware($middleware);
        }
    }

    public function graphiql(Request $request, $schema = null)
    {
        $view = config('graphiql.view', 'graphiql::graphiql');

        return view($view, [
            'schema' => $schema,
        ]);
    }
}
