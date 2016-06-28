<?php
	require_once 'Router.php';
	require_once 'models/HotelGus.php';
	require_once 'controllers/SearchViewController.php';
	require_once 'controllers/ResultPageViewController.php';
	require_once 'controllers/BookedViewController.php';
	require_once 'views/SearchView.php';
	require_once 'views/ResultPageView.php';
	require_once 'views/BookedView.php';


	// Creates correct route and dispatches to corresponding controller action
	class FrontController {

		public function __construct ($router, $routeName, $action) {
			$route = $router->getRoute($routeName);

			$modelName = $route->model;
			$viewName = $route->view;
			$controllerName = $route->controller;

			$model = new $modelName();
			$controller = new $controllerName($model);
			$view = new $viewName($model);

			// Call correct controller's given action
			if (!empty($action)) {
				$controller->{$action}();
			}

			// Call view's output
			$view->output();
		}

	}

?>