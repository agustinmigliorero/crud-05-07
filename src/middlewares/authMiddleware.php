<?php 

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

$validar = function ($request, $handler) use ($app) {
    session_start();
    if (isset($_SESSION["login"])) {
        return $handler->handle($request);
    }

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write('NO ESTAS CONECTADO, LOGEATE ANTES');
    
    return $response->withStatus(401);
};