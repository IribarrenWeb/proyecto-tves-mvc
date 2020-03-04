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
require_once $append . 'models/pedidos.php';
require_once 'CarritoController.php';

class PedidosController extends CarritoController {

	public static function addP() {

		$validation = Utils::isClient();

		$user_id = Utils::issetPost($_SESSION['usuario'][0], 'number');
		$direccion = Utils::issetPost($_POST['direccion']);
		$localidad = Utils::issetPost($_POST['localidad']);
		$estado = Utils::issetPost($_POST['estado']);
		$provincia = Utils::issetPost($_POST['provincia']);
		$costo = Utils::issetPost($_POST['costo'], 'number');

		if ($validation && $user_id && $direccion && $localidad && $estado && $provincia && $costo) {

			$pedido = new Pedido;
			$pedido->setUsuario_id($user_id);
			$pedido->setDireccion($direccion);
			$pedido->setLocalidad($localidad);
			$pedido->setEstado($estado);
			$pedido->setProvincia($provincia);
			$pedido->setCoste($costo);

			$result = $pedido->save();

			// var_dump($result);
			// die();

			if ($result) {
				echo 'true';
			} else {
				echo 'fallo mano';
			}

		} else {

			var_dump($user_id);
			var_dump($direccion);
			var_dump($localidad);
			var_dump($estado);
			var_dump($provincia);
			var_dump($_POST['costo']);

			echo 'false';
		}

	}

	public static function form() {

		$validation = Utils::isClient();

		if ($validation) {

			require_once 'views/pedidos/pedido-form.php';

		}

	}

	public static function confirm() {

		$validation = Utils::isClient();

		if ($validation) {

			$typeUser = false;

			if ($_SESSION['usuario']['rol'] == 1) {
				$typeUser = true;
			}

			if (isset($_GET['ref'])) {

				$pedido_id = $_GET['ref'];
				$op = true;

			} else {

				$pedido_id = $_SESSION['pedido']['id'][0];
				// $pedido_id = $pedido_ref[0]

			}

			$pedidoConfirm = new Pedido;
			$pedidoConfirm->setId($pedido_id);
			$pedido = $pedidoConfirm->getPedido();

			// $pedido_confirm = Utils::getDataById($pedido_id, 'pedidos', '*');
			// $pedido = $pedido_confirm->fetch();

			$sql = "SELECT pr.*, lp.unidades FROM productos pr " .
				"INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id WHERE lp.pedido_id = $pedido_id";

			$productosByPedidos = Utils::simpleQuery($sql);

			$productos = $productosByPedidos->fetchAll();

			require_once 'views/pedidos/pedido-confirm.php';

		}

	}

	public static function userlist() {

		Utils::isClient();

		$pedidos = new Pedido;

		$pedidos->setUsuario_id($_SESSION['usuario']['id']);

		$all_pedidos = $pedidos->list(true);

		require_once 'views/pedidos/pedido-user-list.php';

	}

	public static function listad() {

		Utils::isAdmin();

		self::deleteAll();

		$pedidos = new Pedido;

		$all_pedidos = $pedidos->list();

		require_once 'views/pedidos/pedido-admin-list.php';
	}

	public static function status() {

		Utils::isAdmin();

		$status = Utils::issetPost($_POST['status'], 'text');
		$pedidoId = Utils::issetPost($_POST['id'], 'number');

		if ($status && $pedidoId) {

			$pedido = new Pedido;

			$pedido->setStatus($status);

			$pedido->setId($pedidoId);

			$resultQuery = $pedido->changeStatus();

			// var_dump($resultQuery);
			// die();

			if ($resultQuery) {

				echo 'true';

			} else {
				echo 'fallo el query';
			}

		} else {

			echo 'ERROR en variables';

		}

	}

}

if (isset($_POST['option'])) {

	$method = $_POST['option'];

	PedidosController::$method();

}