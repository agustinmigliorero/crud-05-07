<?php

require_once __DIR__ . "/../controllers/gamesControllers.php";
require_once __DIR__ . "/../middlewares/authMiddleware.php";

$app->get("/", [GamesControllers::class, "getAll"]);
$app->post("/create", [GamesControllers::class, "create"]);
$app->post("/update/{id}", [GamesControllers::class, "update"]);
$app->post("/delete/{id}", [GamesControllers::class, "delete"]);
$app->get("/form[/{id}]", [GamesControllers::class, "showForm"])->add($validar);
