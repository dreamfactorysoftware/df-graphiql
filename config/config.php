<?php


return [

        'routes' => '/graphiql/{graphql_schema?}',
        'controller' => \DreamFactory\Core\GraphiQL\GraphiQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',

    /*
     * The name of the default schema used when no arguments are provided
     * to GraphQL::schema() or when the route is used without the graphql_schema
     * parameter
     */
    'schema' => 'default',
];
