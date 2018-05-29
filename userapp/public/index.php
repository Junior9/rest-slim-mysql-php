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


#Get all users
$app->get('/user/all', function (Request $request, Response $response, array $args) {
    $sql = "SELECT * FROM usuario";

    try{
    	$db = new db(); 
    	$db = $db->connect();
    	$stmt = $db->query($sql);
    	$users = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$db = null;
    	echo json_encode($users);


    }catch(PDOEception $erro){
    	echo '{"erro" : {"text": '.$erro->getMessage().'}';
    }
});

#Get the singer user
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    
	$id = $request->getAttribute('id');

    $sql = "SELECT * FROM usuario WHERE id = $id" ;

    try{
    	$db = new db(); 
    	$db = $db->connect();
    	$stmt = $db->query($sql);
    	$user = $stmt->fetchAll(PDO::FETCH_OBJ);
    	$db = null;
    	echo json_encode($user);


    }catch(PDOEception $erro){
    	echo '{"erro" : {"text": '.$erro->getMessage().'}';
    }
});


#Delete the user
$app->delete('/user/delete/{id}', function (Request $request, Response $response, array $args) {
    
	$id = $request->getAttribute('id');

    $sql = "DELETE FROM usuario WHERE id = $id";

    try{
    	$db = new db(); 
    	$db = $db->connect();
    	$stmt = $db->prepare($sql);
    	$stmt->execute();
    	$db = null;
    	echo '{"notice" : {"text" : "User deleted"}';

    }catch(PDOEception $erro){
    	echo '{"erro" : {"text": '.$erro->getMessage().'}';
    }
});


#Insert the singer user
$app->post('/user/add', function (Request $request, Response $response, array $args) {
    
	$name = $request->getParam('name');
	$date = $request->getParam('date');
	$andress = $request->getParam('andress');

    $sql = "INSERT INTO usuarios (name,date,andress) VALUES (:name,:date,:andress)";

    try{
    	$db = new db(); 
    	$db = $db->connect();
    	$stmt = $db->prepare($sql);
    	$stmt->bindParam(':name',$name);
    	$stmt->bindParam(':date',$date);
    	$stmt->bindParam(':andress',$andress); 
    	$stmt->execute();

    	echo '{"notice" : {"text" : "User added"}';

    }catch(PDOEception $erro){
    	echo '{"erro" : {"text": '.$erro->getMessage().'}';
    }
});


#Update the singer user
$app->put('/user/update/{id}', function (Request $request, Response $response, array $args) {
    
	$id = $request->getAttribute('id');

	$name = $request->getParam('name');
	$date = $request->getParam('date');
	$andress = $request->getParam('andress');

    $sql = "UPDATE usuarios SET name = :name,	 date = :date,andress = :andress
    	 	WHERE id = $id";

    try{
    	$db = new db(); 
    	$db = $db->connect();
    	$stmt = $db->prepare($sql);
    	$stmt->bindParam(':name',$name);
    	$stmt->bindParam(':date',$date);
    	$stmt->bindParam(':andress',$andress); 
    	$stmt->execute();

    	echo '{"notice" : {"text" : "User updated"}';

    }catch(PDOEception $erro){
    	echo '{"erro" : {"text": '.$erro->getMessage().'}';
    }
});




$app->run();