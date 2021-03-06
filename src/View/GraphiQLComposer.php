<?php

namespace DreamFactory\Core\GraphiQL\View;

use InvalidArgumentException;
use Illuminate\View\View;

class GraphiQLComposer
{
    public function compose(View $view)
    {
        try {
            $hasRoute = route('graphql.query');
        } catch (InvalidArgumentException $e) {
            $hasRoute = false;
        }

        $view->graphqlPath = $hasRoute ? route('graphql.query') : url('/graphql');
    }
}
