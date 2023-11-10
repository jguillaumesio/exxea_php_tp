<?php
require_once 'vendor/autoload.php'; // Include Composer autoload
require_once './src/Router.php';

$routes = require './src/config/routes.php';

Router::handle($routes);
