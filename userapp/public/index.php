<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/db.php';


$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});


$app->get('/user/all', function (Request $request, Response $response, array $args) {
    $sql = "SELECT * FROM usuario";

    try{

    	//Get db Object
    	$db = new db(); 
    	//Get the connection

    	$db = $db->connect();
    	$stmt = $db->query($sql);
    	$users = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$db = null;
    	echo json_encode($users);


    }catch(PDOEception $erro){
    	echo '{"erro" : {"text": '.$erro->getMessage().'}';
    }

});

$app->run();