<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function(Request $request, Response $response, array $args){
	$lista = new Usuario($this->db);
	$args['lista'] = $lista->getUsuario();
	return $this->renderer->render($response, 'usuarios.phtml', $args);
});

