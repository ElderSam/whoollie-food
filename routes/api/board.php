<?php

use \WHOOLLIEFOOD\MODEL\Board;
use \WHOOLLIEFOOD\MODEL\User;

$app->post('/api/board/delete/{id}', function($request, $response, $args) {
	
	User::verifyLogin();

	$board = new Board();
	$board->setIsDeleted(1);  
	$board->deleteBoard($args['id']);
	
});

$app->post('/api/board/update/{id}', function($request, $response, $args) {
	
	User::verifyLogin();

	$input = $request->getParsedBody();

	$board = new Board();

	$board->setIdBoard($input['idBoard']);
	$board->setIsActive($input['isActive']);
	$board->setIdQtdPlaces($input['idQtdPlaces']);

	$board->editBoard($args['id']);
	
});




$app->post('/api/boards', function($request, $response, $args) {

	User::verifyLogin();
	$input = $request->getParsedBody();

	$board = new Board();

	$board->setIdBoard($input['idBoard']);
	$board->setIsActive($input['isActive']);
	$board->setQtdPlaces($input['qtdPlaces']);

	$board->createBoard();
	
});

$app->get('/api/boards', function($request, $response, $args) {

	User::verifyLogin();

	$board = new Board();

	echo $board->listAll();
	
});

?>