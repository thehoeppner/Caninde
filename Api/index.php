<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'utilities/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];

    $state = "Not Connected";
    $db = getDB();
    if ($db) {
        $state = "Connected";
    }

    $response->getBody()->write($state);

    return $response;
});
$app->run();