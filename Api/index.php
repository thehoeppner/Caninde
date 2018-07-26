<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'utilities/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
       
    $response->getBody()->write("Hello");
    
    return $response;
});

#Offers

$app->get('/api/offer/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];

    $result;
    try
    {
        $db = getDB();
        if ($db) {
            
            $stmt = $db->prepare(
                "SELECT * FROM offer
                 WHERE offer_id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $offer = $stmt->fetch(PDO::FETCH_OBJ);

            if($offer){
                $app->response->setStatus(200);
                $app->response()->headers->set('Content-Type', 'application/json');
                $result =  json_encode($student);
                $db = null;
            }else {
                throw new PDOException('No records found.');
            }

        }else{
            throw new PDOException('Internal Server Error.');
        }
    }
    catch(PDOException $e) {
        $app->response()->setStatus(404);
        $result = '{"error":{"text":'. $e->getMessage() .'}}';
    }

    $response->getBody()->write($result);

    return $response;
});

$app->run();