<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function($request, $response, $args){
	$usuario = new Usuario($this->db);
	$args['lista'] = $usuario->getUsuario();
	return $this->renderer->render($response, 'usuarios.phtml', $args);
});

$app->get('/del/{Id}', function($request, $response, $args){
	$usuario = new Usuario($this->db);
	$usuario->delUsuario($Id);
	return $response->withStatus(302)->withHeader("Location", "/API_REST_Slim/API_REST/API_REST/public/");
});

$app->get('/add-user', function($request, $response, $args){
    $usuario = new Usuario($this->db);
	$args['lista'] = $usuario->getTipoUser();
    return $this->renderer->render($response, 'cadastro_usuario.phtml', $args);
});

$app->post('/add-user', function($request, $response, $args){
	$dados = $request->getParsedBody();
	$usuario = new Usuario($this->db);
	$usuario->addUser($dados);

	return $response->withStatus(302)->withHeader("Location", "/API_REST_Slim/API_REST/API_REST/public/");
});
$app->post('/save-user', function($request, $response, $args){
	$dados = $request->getParsedBody();
	$usuario = new Usuario($this->db);
	$usuario->updateUser($dados);

	return $response->withStatus(302)->withHeader("Location", "/API_REST_Slim/API_REST/API_REST/public/");
});

$app->post('/', function($request, $response, $args){
	$dados = $request->getParsedBody();
	$usuario = new Usuario($this->db);
	$args['lista'] = $usuario->searchUser($dados);
	return $this->renderer->render($response, 'usuarios.phtml', $args);
});

$app->get('/edt/{id}', function($request, $response, $args){
    $usuario = new Usuario($this->db);
	$args['info'] = $usuario->findUserById($args['id']);

    return $this->renderer->render($response, 'editar_usuario.phtml', $args);
});

$app->post('/edt/{id}', function($request, $response, $args){
    $dados = $request->getParsedBody();
	$usuario = new Usuario($this->db);
	$usuario->updateUser($dados);

	return $response->withStatus(302)->withHeader("Location", "/API_REST_Slim/API_REST/API_REST/public/");
});