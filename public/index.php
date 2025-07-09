<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$twig = Twig::create(__DIR__ . '/../views', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));
require_once __DIR__ . "/../src/middlewares/authMiddleware.php";
$app->add($session);

require_once __DIR__ . "/../src/routes/gamesRoutes.php";
require_once __DIR__ . "/../src/routes/usersRoutes.php";

$app->run();