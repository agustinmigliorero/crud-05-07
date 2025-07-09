<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

require_once __DIR__ . "/../services/gamesServices.php";
require_once __DIR__ . "/../services/typesServices.php";

class GamesControllers {
    public function getAll($request, $response, $args) {
        try {
            $obj = new GamesServices();
            $games = $obj->getAll();

            $view = Twig::fromRequest($request);

            $message = NULL;

            if (isset($_SESSION["message"])) {
                $message = $_SESSION["message"];
                unset($_SESSION["message"]);
            }
    
            return $view->render($response, 'index.twig', [
                'games' => $games, "message" => $message
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create($request, $response, $args) {
        try {
            $datos = $request->getParsedBody();
            $obj = new GamesServices();
            $game = $obj->create($datos);

            return $response->withHeader('Location', '/')
            ->withStatus(302);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($request, $response, $args) {
        try {
            $datos = $request->getParsedBody();
            $id = $args["id"];
            $obj = new GamesServices();
            $game = $obj->update($datos, $id);

            return $response->withHeader('Location', '/')
            ->withStatus(302);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function delete($request, $response, $args) {
        try {
            $id = $args["id"];

            $obj = new GamesServices();
            $obj->delete($id);

            return $response->withHeader('Location', '/')
            ->withStatus(302);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function showForm($request, $response, $args) {
        try {
            $view = Twig::fromRequest($request);
            $objTypes = new TypesServices();
            $types = $objTypes->getAll();

            if (isset($args["id"])) {
                $id = $args["id"];

                $obj = new GamesServices();
                $game = $obj->getById($id);

                return $view->render($response, 'form.twig', [
                    'game' => $game, 'types' => $types
                ]);
            } else {
                return $view->render($response, 'form.twig', ['types' => $types]);
            }
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}