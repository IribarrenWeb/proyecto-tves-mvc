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
require_once $append . 'models/Equipos.php';
require_once $append . 'models/modificaciones.php';

class EquipoController
{
	public static function index()
	{

		$equipos = Equipo::All();

		require_once 'views/equipos/index.php';
	}

	public static function agregar()
	{
		Utils::isAuthorize();
		require_once 'views/equipos/agregar.php';
	}

	public static function detalle()
	{
		$equipo = Equipo::Find((int) $_GET['pc']);

		if(Utils::isAdmin(true)){
			$registros = Modificacion::All($_GET['pc']);
			$registros = array_map(array('Modificacion','mapping'),$registros);
		}

		if (!$equipo) {
			return ErrorController::render();
		}

		require_once 'views/equipos/detalle.php';
	}

	public static function save()
	{
		Utils::isAuthorize();

		$marca = (int) Utils::issetPost($_POST['marca'], 'number');
		$departamento = (int) Utils::issetPost($_POST['departamento'], 'number');
		$num_bien = Utils::issetPost($_POST['num_bien']);
		$modelo = (int) Utils::issetPost($_POST['modelo'], 'number');
		$return = []; // Variable para devolver un alerta

		$validacion = Utils::verifyExist($num_bien, 'equipos', 'num_bien', true);

		// no aprobado
		if ($validacion) {
			$return = [
				'status' => false,
				'message' => 'El numero de bien del equipo ya existe!'
			];

			echo json_encode($return);
			return;
		}

		if ($marca && $departamento && $num_bien && $modelo) {


			$equipo = new Equipo;

			$equipo->setMarca($marca);
			$equipo->setDepartamento($departamento);
			$equipo->setNumBien($num_bien);
			$equipo->setModelo($modelo);

			$result = $equipo->save();

			if ($result === true) {

				$return = [
					'status' => true,
					'message' => 'Se ha guardado el registro correctamente'
				];

			} else {
				$return = [
					'status' => false,
					'message' => 'Ha ocurrico un error al guardar el equipo.'
				];
			}
		} else {
			$return = [
				'status' => false,
				'message' => 'Los datos ingresados no son validos, o no ha rellenado todos los campos.'
			];
		};

		echo json_encode($return);
		return;

	}

	public static function editar()
	{

		$id = Utils::issetPost($_POST['id'], 'number');
		$password = Utils::issetPost($_POST['password']);
		$type = Utils::issetPost($_POST['type']);
		$valor = Utils::issetPost($_POST['valor'], 'number');
		date_default_timezone_set('America/Caracas'); 
		$fecha = date('Y-m-d h:i:s a', time());
		$return = [];

		// var_dump($fecha);
		// die();

		if(!Utils::passwordVerify($password)){
			$return = [
				'status' => false,
				'message' => 'La clave es invalida, no esta autorizado para esta accion'
			];
			
			echo json_encode($return);
			return;
		}

		$equipoAfter = Equipo::Find($id);
		
		if($id && $type && $valor !== false)
		{
			$valor = (int) $valor;

			switch ($type) {
				case 'departamento':

					if($equipoAfter['d_id'] == $valor){
						echo json_encode([
							'status' => false,
							'message' => 'No se puede cambiar un departamento ya seleccionado.'
						]);
						return;
					}
					
					$descripcion = "Se le asigno un nuevo <strong>departamento</strong> al equipo. Anterior departamento: <strong>{$equipoAfter['departamento']}</strong>";

					$equipoBefore = new Equipo;
					$equipoBefore->setId($id);
					$equipoBefore->setDepartamento($valor);
					$result = $equipoBefore->update('departamento');

					if($result)
					{
						$modificacion = new Modificacion;
						$modificacion->setUsuarioId($_SESSION['usuario']['id']);
						$modificacion->setEquipoId($id);
						$modificacion->setDescripcion($descripcion);
						$modificacion->setFecha($fecha);

						$resultMod = $modificacion->save();

						if($resultMod)
						{
							$return = [
								'status' => true,
								'message' => 'Se ha modificado el registro correctamente'
							];
						}
						else
						{
							$return = [
								'status' => false,
								'message' => 'Ha ocurrido un error al guardar la modificacion2.'
							];
						}
					}

					break;
				case 'estatus':
					
					if($equipoAfter['estatus'] == $valor){
						echo json_encode([
							'status' => false,
							'message' => 'No se puede cambiar un estatus ya seleccionado.'
						]);
						return;
					}

					$valor = $valor == 1 ? 'true' : 'false';

					$estatus = $equipoAfter['estatus'] == 1 ? 'Activo' : 'Inactivo'; 
					$descripcion = "Se le asigno un nuevo <strong>estatus</strong> al equipo. Anterior estatus: <strong>{$estatus}</strong>";
					
					// Actualizar cambios
					$equipoBefore = new Equipo;
					$equipoBefore->setId($id);
					$equipoBefore->setEstatus($valor);
					$result = $equipoBefore->update('estatus');

					if($result)
					{
						// Creacion de la instancia de modificacion.
						$modificacion = new Modificacion;
						$modificacion->setUsuarioId($_SESSION['usuario']['id']);
						$modificacion->setEquipoId($id);
						$modificacion->setDescripcion($descripcion);
						$modificacion->setFecha($fecha);

						$resultMod = $modificacion->save();

						if($resultMod)
						{
							$return = [
								'status' => true,
								'message' => 'Se ha modificado el registro correctamente'
							];
						}
						else
						{
							$return = [
								'status' => false,
								'message' => 'Ha ocurrido un error al guardar la modificacion.'
							];
						}

					}else{
						$return = [
							'status' => false,
							'message' => 'Ha ocurrido un error al guardar los cambios.'
						];
					}
					break;
	
				default:
					$return = [
						'status' => false,
						'message' => 'Error en los datos enviados.'
					];
					break;
			}
		} 
		else 
		{
			// var_dump($id, $type, $valor);
			$return = [
				'status' => false,
				'message' => 'Problema con los datos'
			];
		}

		// Retornar los datos al fontend
		echo json_encode($return);
		return;

	}

	public static function delete()
	{

		Utils::isAdmin();

		$id = Utils::issetPost($_POST['id'], 'number');

		if (!$id) {
			$returnData = [
				'status' => false,
				'message' => 'Problema con el dato enviado.'
			];

			echo json_encode($returnData);
			return;
		}

		$equipo = Equipo::Find($id);

		if($equipo && is_array($equipo) && !$equipo['estatus']){

			$result = Equipo::delete($id);
	
			if (!$result) {
				$returnData['message'] = 'Fallo al eliminar el equipo';
			}else{
				$returnData = [
					'status' => true,
					'message' => 'Equipo eliminado.'
				];
			}
		}else{
			$returnData['message'] = 'El equipo que quiere eliminar no tiene estatus inactivo';
		}

		echo json_encode($returnData);
		return;

	}

	public static function reporte()
	{
		Utils::isAuthorize();
		if($_POST){

			$tipo = Utils::issetPost($_POST['tipo']);
			$id = Utils::issetPost($_POST['id']);

			$equipo = Equipo::Find($id);

			if($tipo && (is_array($equipo) && COUNT($equipo) > 1) && ($tipo == 'month' || $tipo == 'year')){

				date_default_timezone_set('America/Caracas'); 
				$fecha = date('Y-m-d', time());
				$query_fecha = date('Y-m-d',strtotime($fecha . '- 1 '. $tipo));

				$modificaciones = new Modificacion;
				$modificaciones->setFecha($query_fecha);
				$modificaciones->setEquipoId($id);
				$result = $modificaciones->reporte();

				if(is_array($result[1]) && $result[0])
				{
					$modificaciones = $result[1];
					require_once 'views/equipos/print.php';
				}
				else
				{
					ErrorController::render('Error en el servidor. Intente mas tarde.');
				}

			}else{
				// var_dump($equipo, $id, $tipo);
				ErrorController::render("El reporte no se puede emitir por error en los datos");
			}

		}else {
			ErrorController::render("No esta autorizado para acceder a esta pagina",'401','PAGINA NO AUTORIZADA');
		}
	}

}

if (isset($_POST['option'])) {

	$method = $_POST['option'];

	EquipoController::$method();
}
