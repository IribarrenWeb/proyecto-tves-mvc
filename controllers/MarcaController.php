<?php

if (!isset($_SESSION)) {
	session_start();
}

$append = '';

if (isset($_POST['option'])) {
	$append = '../';
}

require_once $append . 'config/db.php';
require_once $append . 'helpers/utils.php';
require_once $append . 'models/Marcas.php';

class MarcaController {

	public static function index() {

		$marcas = Marca::All();

		require_once 'views/marcas/index.php';
	}

	public static function agregar(){
		require_once 'views/marcas/agregar.php';
	}

	public static function save() {

		$nombre = Utils::issetPost($_POST['nombre'], 'text');

		if ($nombre) {

			$instancia = new Marca;
			$instancia->setNombre($nombre);

			$result = $instancia->save();

			if ($result) {

				$return = [
					'status' => true,
					'message' => 'Marca agregada.'
				];

			} else {

				$return = [
					'status' => false,
					'message' => 'Algo ha fallado.'
				];
			}

		} else {

			$return = [
				'status' => true,
				'message' => 'Los datos no son validos.'
			];
		}

		echo json_encode($return);
		return;

	}


	// public static function edit() {

	// 	Utils::isAdmin();

	// 	$id = Utils::issetPost($_POST['id'], 'number');
	// 	$name = Utils::issetPost($_POST['name'], 'text');

	// 	if (!$name || !$id) {
	// 		echo 'Los datos ingresados no son validos.';
	// 		die();
	// 	}

	// 	$categoria = new Marca;

	// 	$categoria->setId($id);
	// 	$categoria->setName($name);

	// 	$queryResult = $categoria->edit();

	// 	if (!$queryResult) {

	// 		echo 'Fallo al editar la categoria';
	// 		exit();

	// 	}

	// 	echo 'true';

	// }

	// public static function delete() {

	// 	Utils::isAdmin();

	// 	$id = Utils::issetPost($_POST['id'], 'number');

	// 	if (!$id) {

	// 		echo 'El identificador es incorrecto o no existe.';
	// 		exit();

	// 	}

	// 	$categoria = new Marca;

	// 	$categoria->setId($id);

	// 	$queryResult = $categoria->delete();

	// 	if (!$queryResult) {

	// 		echo 'Fallo al eliminar la categoria';
	// 		exit();

	// 	}

	// 	echo 'true';

	// }
}

if (isset($_POST['option'])) {

	$method = $_POST['option'];

	MarcaController::$method();

}
