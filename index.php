<?php 

	// front controller

	// 1 общия настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

	// 2 подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

	// 3. db connect

	// 4. call router
$router = new Router();
$router->run();