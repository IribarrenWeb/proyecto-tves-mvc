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
require_once $append . 'models/Modelos.php';

class ModeloController extends DataBase {

	public static function index(){
		$modelos = Modelo::All();

		require_once 'views/modelo/index.php';
	}

	public static function agregar(){
		require_once 'views/modelo/agregar.php';
	}

	public static function save(){
		
		$marca_id = (int) Utils::issetPost($_POST['marca_id'],'number');
		$nombre = Utils::issetPost($_POST['nombre']);
		$ram = Utils::issetPost($_POST['ram'],'number');
		$tipo = Utils::issetPost($_POST['tipo'],'text');
		$cpu = Utils::issetPost($_POST['cpu']);

		if($marca_id && $nombre && $ram && $tipo && $cpu){
			
			$modelos = new Modelo;
			$modelos->setMarca($marca_id);
			$modelos->setNombre($nombre);
			$modelos->setRam($ram . $tipo);
			$modelos->setCpu($cpu);
			
			$result = $modelos->save();
			
			if ($result === true) {
				$return = [
					'status' => true,
					'message' => 'Se ha agregado el modelo correctamente.'
				];
			} else {
				$return = [
					'status' => false,
					'message' => 'Algo ha fallado.'
				];
			}
			
		}else{
			$return = [
				'status' => false,
				'message' => 'Los datos ingresados son incorrectos'
			];
		}

		echo json_encode($return);
		return;
	
	}

	public static function byMarca(){

		$marca_id = Utils::issetPost($_POST['marca_id'],'numeric');

		if($marca_id){
			$modelos = new Modelo;
			$modelos->setMarca($marca_id);
			$modelos = $modelos->byMarca();
			
			if(is_array($modelos)){
				echo json_encode($modelos);
			}else{
				echo 'false';
			}
			
		}	

	}

}

if (isset($_POST['option'])) {

	$method = $_POST['option'];

	ModeloController::$method();

}