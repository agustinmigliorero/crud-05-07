<?php 

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

$validar = function ($request, $handler) use ($app) {
    if (isset($_SESSION["login"])) {
        return $handler->handle($request);
    }

    $response = $app->getResponseFactory()->createResponse();
    $_SESSION['message'] = "Debes iniciar sesion primero";
    return $response->withHeader('Location', '/')
            ->withStatus(301);
};

$session = function ($request, $handler) use ($app) {
    session_start();
    return $handler->handle($request);
};