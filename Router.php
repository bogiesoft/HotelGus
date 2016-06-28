<?php
	require_once 'Route.php';

	class Router {
		private $routes = array();

		public function __construct() {
			$this->routes['search'] = new Route('HotelGus', 'SearchView', 'SearchViewController');
			$this->routes['results'] = new Route('HotelGus', 'ResultPageView', 'ResultPageViewController');
			$this->routes['booked'] = new Route('HotelGus', 'BookedView', 'BookedViewController');
		}

		public function getRoute($route) {
			$route = strtolower($route);
			return $this->routes[$route];
		}
	}

?>