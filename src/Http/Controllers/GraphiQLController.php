<?php

namespace DreamFactory\Core\GraphiQL\Http\Controllers;

use Illuminate\Http\Request;

class GraphiQLController extends Controller
{
    public function graphiql(Request $request)
    {
        $view = config('graphiql.view', 'graphiql::graphiql');

        return view($view);
    }
}
