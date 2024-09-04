<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../config/bootstrap.php';

use Core\Router;


$router = new Router();

require_once __DIR__ . '/../routes/web.php';


$router->handleRequest($_SERVER['REQUEST_URI']);
