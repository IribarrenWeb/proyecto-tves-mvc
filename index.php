<?php
ob_start();
// Init sessions if isn't set
if (!isset($_SESSION)) {
	session_start();
}

// Autoload require
require_once 'config/autoload.php';

// Autoload composer
require 'vendor/autoload.php';

// Parameters require
require_once 'config/parameters.php';

// Db include
require_once 'config/db.php';

// Require utils
require_once 'helpers/utils.php';

// Require header
require_once './views/layouts/head.phtml';

if(!empty($_SESSION['usuario'])){

	Utils::isActive();
	Utils::isChangePass();

	if (isset($_GET['c']) && isset($_GET['m'])) {
		$controller = ucfirst($_GET['c']) . 'Controller';
		$method = $_GET['m'];
		
		if (!class_exists($controller,true) || !method_exists($controller, $method)) {
			ErrorController::render();
		} else {
			$controller::$method();
		}
		
	} else {
		$controller = controller_default;
		$method = method_default;
		$controller::$method();
	}

}else{
	// Redirigir al login
	ErrorController::login();
}

// Require footer
require_once './views/layouts/footer.phtml';
ob_end_flush();
// ob_end_clean();