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
require_once $append . 'models/Departamentos.php';

class DepartamentoController {

	public static function index() {

		$departamentos = Departamento::All();

		require_once 'views/departamentos/index.php';
	}

	public static function agregar(){
		require_once 'views/departamentos/agregar.php';
	}

	public static function save() {

		$nombre = Utils::issetPost($_POST['nombre'], 'text');
		$descripcion = Utils::issetPost($_POST['descripcion'], 'text');

		if ($nombre && $descripcion) {

			$instancia = new Departamento;
			$instancia->setNombre($nombre);
			$instancia->setDescripcion($descripcion);

			$result = $instancia->save();

			if ($result) {

				$return = [
					'status' => true,
					'message' => 'Departamento agregado.'
				];

			} else {

				$return = [
					'status' => true,
					'message' => 'Algo ha fallado'
				];
			}

		} else {
			$return = [
				'status' => true,
				'message' => 'Los datos no son validos'
			];
		}

		echo json_encode($return);
		return;

	}

	// public static function delete() {

	// 	Utils::isAdmin();

	// 	$id = Utils::issetPost($_POST['id'], 'number');

	// 	if (!$id) {

	// 		echo 'El identificador es incorrecto o no existe.';
	// 		exit();

	// 	}

	// 	$categoria = new Departamento;

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

	DepartamentoController::$method();

}
