<?php

/**
 * Class for show errors
 */
class ErrorController {
	public static function render($mensaje = 'ESTAS TRATANDO DE INGRESAR A UNA PAGINA QUE NO EXISTE.',$code = '404',$titulo='Pagina no encontrada!') {
		require_once './views/errors/errorRender.php';
	}

	public static function login() {

		require_once './views/errors/loginRender.php';

	}

	public static function changePass(){
		require_once './views/errors/passRender.php';
	}
}