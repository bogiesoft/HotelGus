<?php
	require_once 'controllers/FrontController.php';
	include_once 'ui/header.html';

	$route = isset($_GET['route']) ? $_GET['route'] : 'search';
	$action = isset($_GET['action']) ? $_GET['action'] : NULL;

	$frontController = new FrontController(new Router(), $route, $action);

?>