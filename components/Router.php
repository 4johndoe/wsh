<?php 
class Router
{

	private $routes;

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	/*
	*	Return request string
	*/
	private function getUri()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		// get query string
		$uri = $this->getUri();

		// check routes.php
		foreach ($this->routes as $uriPattern => $path) {

		// if exist -> get controller/action
			if (preg_match("~^$uriPattern$~", $uri)) {
				
				// resolve which controller and action
				$segments = explode('/', $path);

				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				
				// include controller file
				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}

				// create object, call method(action)
				$controllerObject = new $controllerName;
				$result = $controllerObject->$actionName();
				if ($result != null) {
					break;
				}
			}
		}
	}
}

// Yii, Symfony