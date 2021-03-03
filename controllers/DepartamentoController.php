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
		Utils::isAuthorize();
		$departamentos = Departamento::All();

		require_once 'views/departamentos/index.php';
	}

	public static function agregar(){
		Utils::isAuthorize();

		require_once 'views/departamentos/agregar.php';
	}

	public static function save() {
		Utils::isAuthorize();

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

	public static function update(){
		
		Utils::isAuthorize();

		$id = Utils::issetPost($_POST['id'], 'number');
		$nombre = Utils::issetPost($_POST['nombre'], 'text');
		$descripcion = Utils::issetPost($_POST['descripcion'], 'text');
		
		$validate = Departamento::find($id);

		if (is_array($validate) && $validate) {
			$departamento = new Departamento;
			$departamento->setNombre($nombre);
			$departamento->setId($id);
			$departamento->setDescripcion($descripcion);
			$result = $departamento->update();

			if($result){
				$return = [
					'status' => true,
					'message' => 'Departamento actualizado correctamente.'
				];
			}else{
				$return = [
					'status' => false,
					'message' => 'Ocurrio un problea al actualizar el departamento'
				];
			}
		}else{
			$return = [
				'status' => false,
				'message' => 'Ocurrio un problema con los datos'
			];
		}

		echo json_encode($return);
		return;
	}

	public static function get() {
		$id = Utils::issetPost($_POST['id'], 'number');
		$departamento = Departamento::find($id);
		$return = [];
		if ($id && count($departamento) >= 1) {
			$return = [
				'status' => true,
				'departamento' => $departamento
			];
		}else{
			$return = [
				'status' => false,
				'message' => 'Problema con los datos'
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
