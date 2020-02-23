<?php

use App\Core\Request;

$router->get("/login", "Auth\LoginController@index");

$router->post("/login", "Auth\LoginController@login");

$router->get("/register", "Auth\RegisterController@index");

$router->post("/register", "Auth\RegisterController@register");

$router->get("/", "ProfileController@index", "auth");