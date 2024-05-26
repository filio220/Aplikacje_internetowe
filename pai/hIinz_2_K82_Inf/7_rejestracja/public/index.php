<?php
	define('BASE_PATH', realpath(dirname(__FILE__) . '/..'));
	require_once BASE_PATH . '/app/controllers/UserController.php';

	$userController = new UserController();
	
	if ($_SERVER['REQUEST_URI'] == '/git/register') {
		$userController->register();
	}