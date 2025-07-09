<?php 

require_once __DIR__ . "/../services/usersServices.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


class UsersControllers {
    public function getAll($request, $response, $args) {
        try {
            $obj = new UsersServices();
            $usuarios = $obj->getAll();

             $view = Twig::fromRequest($request);
    
            return $view->render($response, 'verUsuarios.twig', [
                'usuarios' => $usuarios,
            ]);
        }catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create($request, $response, $args) {
        try {
            $datos = $request->getParsedBody();
            $datos["password"] = password_hash($datos["password"], PASSWORD_DEFAULT);
            $obj = new UsersServices();
            $usuario = $obj->create($datos);

            $response->getBody()->write($usuario);
            return $response;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function form($request, $response, $args) {
        try {
             $view = Twig::fromRequest($request);
    
            return $view->render($response, 'formUsuarios.twig');
        }catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login($request, $response, $args) {
        try {
            $datos = $request->getParsedBody();
            $obj = new UsersServices();
            $usuario = $obj->getByEmail($datos["email"]);

            if (password_verify($datos["password"], $usuario["password"])) {
 
                $_SESSION["login"] = $datos["email"];

                $response->getBody()->write("ESCRIBISTE BIEN LA CLAVE, ESTA TODO BIEN");
                return $response;
            } else {
                $response->getBody()->write("LAS CLAVES NO COINCIDEN");
                return $response;
            }
        } catch(Exception $e) {
            throw new Exception("ERROR");
        }
    }

    public function logout($request, $response, $args) {

        session_destroy();
        $response->getBody()->write("TE DESLOGEASTE");
        return $response;
    }

        public function formLogin($request, $response, $args) {
        try {
             $view = Twig::fromRequest($request);
    
            return $view->render($response, 'formLogin.twig');
        }catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}