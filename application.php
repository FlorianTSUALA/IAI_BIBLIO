<?php

//Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config/config.php');
require_once('core/App.php');
require_once('core/Router.php');


$router = new Router();

$page = str_replace( strtolower(App::base_url()) , "", strtolower(App::full_url()) );
var_dump(App::base_url(), "", App::full_url());

var_dump($page);

$router->call($page);
