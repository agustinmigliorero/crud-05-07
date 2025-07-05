<?php 

require_once __DIR__ . "/../controllers/usersControllers.php";


$app->get("/usuarios", [UsersControllers::class, "getAll"]);
$app->post("/usuarios/create", [UsersControllers::class, "create"]);
$app->get("/usuarios/create", [UsersControllers::class, "form"]);
$app->post("/usuarios/login", [UsersControllers::class, "login"]);
$app->get("/usuarios/login", [UsersControllers::class, "formLogin"]);
$app->get("/usuarios/logout", [UsersControllers::class, "logout"]);