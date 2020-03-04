<?php

if(!empty($_POST['method'])){
	require_once '../config/db.php';

	$method = $_POST['method'];
}

class Utils extends DataBase {
	
	/**
	 * Utilities
	 * * * * * * * * * *
	 */

	public static function isAdmin($op = false,$msj = null) {
		$sql = "SELECT nombre_rol FROM role WHERE id = {$_SESSION['usuario']['role_id']}";
		$db = self::connect();
		$query = $db->query($sql);
		$nameRol = $query->fetch();

		if (isset($_SESSION['usuario']) && $nameRol[0] == 'ROLE_ADMIN') {

			return true;

		} elseif($op){

			return false;

		}else{

			ErrorController::render($msj);

		}

	}

	public static function passwordVerify($password,$message = false){

		$is_password = false;
		
		if(password_verify($password,$_SESSION['usuario']['password'])){
			$is_password = true;
		}

		if($message){
			echo 'La contraseña ingresada no es correcta.';
			die();
		}

		return $is_password;
	}

	public static function isAuth($op = false) {

		if (isset($_SESSION['usuario'])) {

			return true;

		} elseif($op) {

			return false;

		}else{

			ErrorController::login();

			die();

		}

	}

	public static function isActive(){
		if(isset($_SESSION['usuario'])){
			if($_SESSION['last_time'] <= time() - $_SESSION['timeout']){
				session_destroy();
				session_unset();
				self::reload();
			}else{
				$_SESSION['last_time'] = time();
			}
		}
	}

	public static function isChangePass(){
		if(!$_SESSION['usuario']['change_pass']){
			ErrorController::changePass();
		}
	}

	public static function cleanParams($param) {

		$param = trim($param);

		$param = stripcslashes($param);
		$param = strip_tags($param);
		// $param_cleaned = mysqli_real_escape_string($param_cleaned);

		return $param;
	}

	public static function issetPost($param, $op = null) {

		$param = self::cleanParams($param);

		$paramIsset = (!empty($param) || $param == 0) ? $param : false;

		if ($op == 'text') {
			if (is_numeric($paramIsset) || preg_match('/[0-9]/', $paramIsset)) {
				$paramIsset = false;
			}
		} elseif ($op == 'email') {
			if (!filter_var($paramIsset, FILTER_VALIDATE_EMAIL)) {
				$paramIsset = false;
			}
		} elseif ($op == 'number') {
			if (!is_numeric($paramIsset)) {
				$paramIsset = false;
			}
		} elseif ($op == 'file') {
			if (!is_array($paramIsset)) {
				$paramIsset = false;
			}
		} elseif ($op == 'documento') {
			if (!is_numeric($paramIsset) || strlen($paramIsset) <= 6 || strlen($paramIsset) >= 9) {
				$paramIsset = false;
			}
		}
		

		return $paramIsset;
	}

	public static function verifyExist($value, $table, $param, $op = false) {
		$conex = self::connect();
		$sql = "SELECT * FROM public.$table WHERE $param = '$value'";
		$query = $conex->prepare($sql);

		$result = $query->execute();

		if ($query->rowCount() == 0 || !$result) {

			// $reQuery = $query->errorInfo();
			$reQuery = false;

		} elseif($op){
		
			$reQuery = true;
		
		}else{

			$reQuery = $query->fetch();

		}

		return $reQuery;
	}

	public static function getDataByLimit($table, $limit = false) {

		$sql = "SELECT * FROM $table ORDER BY id DESC";

		if (is_int($limit)) {
			$sql .= " LIMIT $limit";
		}

		$db = self::connect();

		$query = $db->query($sql);

		$categorias = $query->fetchAll();

		return $categorias;

	}

	public static function simpleQuery($sql) {

		$db = self::connect();

		$query = $db->query($sql);

		return $query;

	}

	public static function Where($table = '', $value = '', $condition = false, $colums = '*') {

		if(!empty($_POST['method'])){
			$table = $_POST['table'];
			$value = $_POST['value'];
		}

		$sql = "SELECT $colums FROM $table WHERE ";

		if ($condition) {
			$sql .= $condition . $value;
		} else {
			$sql .= "id = $value";
		}

		$db = self::connect();

		$query = $db->query($sql);
		
		if(!empty($_POST['method'])){
			echo json_encode($query->fetch());
			return;
		}

		return $query;

	}

	public function get($resultSet){
		return $resultSet->fetch();
	}

	public static function All($table) {

		$sql = "SELECT * FROM $table";

		$db = self::connect();

		$data = $db->query($sql);

		return $data;

	}

	public static function reload($url=false){
		if(!$url){
			echo 
				"<script>
					window.location.reload()
				</script>";
		}else{
			echo 
				"<script>
					window.location.assign(${url})
				</script>";
		}

	}

	public static function formatRoles($data, $op = false){
		switch ($data['rolname'][0]) {
			case 'ROLE_ADMIN':
				if($op){
					$data['role_color'] = 'info';
				}
				$data['rolname']['name'] = 'ADMINISTRADOR';
				break;

			case 'ROLE_USER_TECNOLOGIA':
				if($op){
					$data['role_color'] = 'success';
				}
				$data['rolname']['name'] = 'SOPORTE';
				break;

			case 'ROLE_USER_BIEN_NACIONAL':
				if($op){
					$data['role_color'] = 'warning';
				}
				$data['rolname']['name'] = 'BIEN NACIONAL';
				break;

			default:
				$data['role_color'] = 'testing';
				break;
		}

		return $data;
	} 
}

if(!empty($_POST['method'])){
	Utils::$method();
}