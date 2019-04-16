<?php

use \WHOOLLIEFOOD\MODEL\User;
use \WHOOLLIEFOOD\MODEL\Board;

$app->post('/api/boards', function($request, $response, $args) {

    User::verifyLogin();
    
    $input = $request->getParsedBody();
	
    $boards = new Board();
    
    $boards->setDesName($input["desName"]);
	$boards->setDesLogin($input["desLogin"]);
	$boards->setDesPassword($input["desPassword"]);

    $boards->createBoard();
	
});


$app->get('/api/boardss', function($request, $response, $args) {

    User::verifyLogin();

    echo $boards->listAllBoards();
	
});

?>