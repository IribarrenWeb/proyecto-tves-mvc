<?php

// Iniciar session si aun no esta iniciada.
if (!isset($_SESSION)) {
	session_start();
}

$append = '';

// En caso de peticiones por AJAX cambiar la ruta de los archivos.
if (isset($_POST['option'])) {
	$append = '../';
}

// Importacion de los archivos requeridos
require_once $append . 'config/db.php';
require_once $append . 'helpers/utils.php';
require_once $append . 'models/Usuarios.php';
require_once $append . 'models/Equipos.php';

class UserController
{

	/**
	 * Funcion que retorna la vista con una tabla 
	 * de todos los usuarios del sistema.
	 *
	 * @return view
	 */
	public static function index()
	{

		$usuarios = User::All();
		$usuarios = array_map(array('user', 'configRole'), $usuarios);
		require_once './views/usuarios/index.php';
	}

	/**
	 * Funcion que retorna una vista con un formulario
	 * para agregar un nuevo usuario al sistema.
	 *
	 * @return view
	 */
	public static function agregar()
	{
		Utils::isAdmin();
		$roles = Utils::All('role')->fetchAll();

		$roles = array_map(function ($item) {
			$item['rolname'] = Utils::Where('role', $item['id'], false, 'nombre_rol')->fetch();
			return Utils::formatRoles($item);
		}, $roles);

		require_once 'views/usuarios/agregar.php';
	}

	/**
	 * Funcion que retorna una vista con el 
	 * dashboard del usuario identificado.
	 *
	 * @return view
	 */
	public static function dashboard()
	{
		$equipos = count(Equipo::All());
		$usuarios = count(User::All());
		require_once './views/usuarios/dashboard.php';
	}

	/**
	 * Funcion que retorna una vista con un formulario
	 * para editar al usuario identificado.
	 *
	 * @return void
	 */
	public static function editar()
	{
		Utils::isAdmin();
		$usuario = $_SESSION['usuario'];

		require_once './views/usuarios/editar.php';
	}

	/**
	 * Funcion para registrar a un usuario en el sistema
	 *
	 * @return json
	 */
	public static function registro()
	{
		Utils::isAdmin();
		if (isset($_POST['option'])) {

			// Assing the post params to variables
			$nombre = Utils::issetPost($_POST['nombre'], 'text');
			$apellido = Utils::issetPost($_POST['apellido'], 'text');
			$documento = Utils::issetPost($_POST['documento'], 'documento');
			$rol = (int) Utils::issetPost($_POST['rol'], 'number');
			// $password = '';
			$result = false;

			$validate = Utils::verifyExist($documento, 'usuarios', 'documento', true);

			if ($nombre && $apellido && $documento && $rol && !$validate) {

				$user = new User();

				$user->setNombre(Utils::cleanParams($nombre));
				$user->setApellido(Utils::cleanParams($apellido));
				$user->setDocumento(Utils::cleanParams($documento));
				$user->setRole(Utils::cleanParams($rol));
				$user->setPassword(Utils::cleanParams($documento));

				$result = $user->save();

				if ($result === true) {

					// Retornar la respuesta de exito en formato json
					$response = [
						'status' => true,
						'message' => 'Usuario creado exitosamente'
					];
				} else {

					// Retornar la respuesta de exito en formato json
					$response = [
						'status' => false,
						'message' => 'Ups! Hubo un error al registrarte, intentalo mas tarde.'
					];
				}
			} else {

				// Retornar la respuesta de exito en formato json
				$response = [
					'status' => false,
					'message' => 'Los campos no son validos. Reviselos he intentelo de nuevo.'
				];

				if ($validate == true) {
					// Cambiar mensaje si el documento ya existe
					$response['message'] = 'El campo documento ya existe. Reviselos he intentelo de nuevo.';
				} elseif (!$documento) {
					$response['message'] = 'El documento no es valido, tiene que tener al menos 7 digitos.';
				}
			}

			echo json_encode($response);
			return;
		}
	}

	/**
	 * Funcion para loggear al usuario
	 *
	 * @return json
	 */
	public static function login()
	{

		if (isset($_POST['option'])) {

			// Asignacion de las variables recibidas por POST
			$documento = Utils::issetPost($_POST['documento']);
			$password = Utils::issetPost($_POST['password']);

			// Validacion de las variables asignadas
			if ($documento && $password) {

				// Creacion de la nueva instancia de la entidad Usuario
				$user = new User;

				// Asigancion de los datos a la entidad Usuario
				$user->setDocumento($documento);

				// Ejecutar funcion del Login y asignar la respuesta a la variable $uLogin
				$uLogin = $user->login($password);

				// Validacion de los datos recibidos
				if (is_array($uLogin)) {
					// Creacion de la session usuario y las variables de tiempo
					$_SESSION['usuario'] = $uLogin;
					$_SESSION['rolname'] = $uLogin['rolname'];
					$_SESSION['last_time'] = time();
					$_SESSION['timeout'] = 60 * 60;

					// Asignar la respuesta de exito en formato json
					$response = [
						'status' => true,
						'message' => 'Estas loggeado',
						'usuario' => [
							'nombre' => $uLogin['nombre'],
							'apellido' => $uLogin['apellido'],
							'documento' => $uLogin['documento']
						]
					];
				} else {
					// Asignar la respuesta de error de datos en formato json
					$response = [
						'status' => false,
						'message' => 'Los datos ingresados no coinciden.'
					];
				}
			} else {
				// Asignar la respuesta de error de datos invalidos o vacios en formato json
				$response = [
					'status' => false,
					'message' => 'Los datos no son validos o estan vacios.'
				];
			}

			// Retornar respuesta en formato json
			echo json_encode($response);
			return;
		}
	}

	/**
	 * Funcion de actualizacion del usuario
	 * identificado.
	 *   
	 * @return json
	 */
	public static function update()
	{
		Utils::isAdmin();
		// Recoger el parametro option y validarlo
		$option = Utils::issetPost($_POST['update_op'], 'text');

		// Proceso en caso de que el option sea igual a 'pass'
		// para actualizar la contrasena del usuario identificado
		if ($option && $option == 'pass') {

			// Recepcion y verificacion de los parametros recibidos por POST
			$password = Utils::issetPost($_POST['password']);
			$password_1 = Utils::issetPost($_POST['password1']);
			$password_2 = Utils::issetPost($_POST['password2']);

			$verifyPass = Utils::passwordVerify($password);
			$repassword = Utils::passwordVerify($password_1);

			if ($verifyPass && $password_1 === $password_2 && $password_1 && !$repassword) {

				$usuario = new User;
				$usuario->setPassword($password_1);
				$usuario->setId($_SESSION['usuario']['id']);
				$result = $usuario->update('password');

				if ($result === true) {
					$_SESSION['usuario']['password'] = $usuario->getPassword();

					$response = [
						'status' => true,
						'message' => 'Se ha cambiado la contraseña con exito. CONTRASENA: ' . $password_1
					];
				} else {
					$response = [
						'status' => false,
						'message' => 'Problema al guardar los cambios..'
					];
				}
			} else {
				$response = [
					'status' => false,
					'message' => 'Problema con los datos, verifique.'
				];
			}

		//   Proceso en caso de que el option sea igual a 'data' para actualizar
		//  los datos del usuario
		} else if ($option && $option == 'datos') {

			// Recibir los parametros y verificarlos.
			$nombre = Utils::issetPost($_POST['nombre'], 'text');
			$apellido = Utils::issetPost($_POST['apellido'], 'text');
			$documento = Utils::issetPost($_POST['documento'], 'documento');

			$verifyDoc = Utils::verifyExist($documento,'usuarios','documento',true);

			$verifyDoc = $verifyDoc === true && $documento == $_SESSION['usuario']['documento'] ? false : true;

			if($nombre && $apellido && $documento && !$verifyDoc){

				$usuario = new User();
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setDocumento($documento);
				$usuario->setId($_SESSION['usuario']['id']);
				
				$result = $usuario->update('datos');

				if($result === true){
					$response = [
						'status' => true,
						'message' => 'Se ha actualizado el usuaroio correctamente.'
					];

					$_SESSION['usuario']['nombre'] = $usuario->getNombre();
					$_SESSION['usuario']['apellido'] = $usuario->getApellido();
					$_SESSION['usuario']['documento'] = $usuario->getDocument();
				}else{
					$response = [
						'status' => false,
						'message' => 'Ha ocurrido un problema al intentar actualizar los datos.',
						'error' => $result
					];
				}
			}else{
				$response = [
					'status' => false,
					'message' => 'Los datos enviados no son validos, revise he intente de nuevo.'
				];

				if($verifyDoc){
					$response['message'] = 'El documento ingresado, ya existe en la base de datos.';
				}
			}
		}else{ // En caso de no coincidencia con el parametro 'update_op' esperado se retorna un error.
			$response = [
				'status' => false,
				'message' => 'La opcion seleccionada no es correcta, revise he intente de nuevo. ' . $option
			];
		}

		// Retorno de datos en formato JSON
		echo json_encode($response);
		return;
	}

	/**
	 * Funcion de desloggeo del usuario identificado
	 *
	 * @return json
	 */
	public static function logout()
	{

		if (!isset($_SESSION['usuario'])) {
			Utils::reload();
		} else {
			// Destruccion de todas las sesiones en el servidor
			session_destroy();
			session_unset();

			// Respuesta de exito al front.
			$response = [
				'status' => true,
				'message' => 'Desloggeado correctamente'
			];

			// Retorno de datos en formato JSON
			echo json_encode($response);
			return;
		}
	}

	/**
	 * Function para mostrar el detalle de un usuario
	 * 
	 * @return $user, @view
	 */
	public static function detalle()
	{
		// Verificacion del rol de usuario 'ADMINISTRADOR' para poder 
		// realizar la accion solicitada.
		Utils::isAdmin();

		// Verificar parametro recibido por GET
		if (!empty($_GET['u_id'])) {

			$u_id = Utils::issetPost($_GET['u_id'], 'number');

			// Busqueda de usuario en la base de datos, y
			// en caso de no coincidencia retornar vista de error.
			$usuario = Utils::Where('usuarios', $u_id)->fetch();

			if (!$usuario) {
				ErrorController::render('EL USUARIO QUE ESTAS BUSCANDO NO EXISTE!');
			} else {

				// Metodo para configurar el rol del usuario
				// para mostrarlo en el front de forma adecuada. 
				$usuario = User::configRole($usuario);
			}

			// Retorno de la vista de detalle del usuario.
			require_once './views/usuarios/detalle.php';
		}
	}

	/**
	 * Funcion para cambiar el password en el primer inicion
	 * de sesion de un usuario creado recientemente.
	 *
	 * @return void
	 */
	public static function changePass()
	{
		Utils::isAdmin();
		// Recepcion de los parametros enviados por POST
		// y comprobacion de la igualdad de los passwords
		// recibidos.
		$password = Utils::issetPost($_POST['password']);
		$conf_password = Utils::issetPost($_POST['conf_password']);
		$validate = ($password === $conf_password) ? true : false;

		if ($password && $conf_password && $validate) {
			$usuario = new User;
			$usuario->setPassword($password);
			$response = $usuario->changePass();

			if ($response !== true) {
				$return = [
					'status' => false,
					'message' => 'Hubo un problema al intentar guardar los cambios. Intente mas tarde.',
					'ERROR' => $response
				];
			} else {
				$return = [
					'status' => true,
					'message' => 'Cambios guardados exitosamente.'
				];

				// En caso de cambiar exitosamente el password,
				// actualizar en la session actual el parametro
				// 'change_pass' a 'true'.
				$_SESSION['usuario']['change_pass'] = true;
			}
		} else {
			$return = [
				'status' => false,
				'message' => 'Hay un problema con los datos enviados.'
			];

			// En caso de que la verificacion de las contrasenas 
			// recibidas de 'false', formatear el mensaje de
			// respuesta.
			if (!$validate) {
				$return['message'] = 'Las contraseñas no son iguales.';
			}
		}

		// Retornar los datos en JSON al front
		echo json_encode($return);
		return;
	}
	
	public static function resetPassword()
	{
		if(Utils::isAdmin(true)){

			$user_id = Utils::issetPost($_POST['u_id'],'number');
			$data_u = Utils::verifyExist($user_id,'usuarios','id');
			
			if($user_id && is_array($data_u)){

				$user = new User;
				$user->setId($user_id);
				$user->setPassword($data_u['documento']);
				$user = $user->resetPassword();

				if($user === true){
					$response = [
						'status' => true,
						'message' => 'Se ha reseteado con exito la contrasena del usuario' 
					];
				}else{
					$response = [
						'status' => false,
						'message' => 'No se ha podido resetear la contrasena!',
						'error' => $user[1]
					];
				}

			}else{
				$response = [
					'status' => false,
					'message' => 'Error en el sistema. Intente mas tarde.',
				];
			}

			echo json_encode($response);
			return;
		}

		ErrorController::render('NO ESTA AUTORIZADO PARA ESTA PAGINA');
		
	}
}

/**
 * Condicional para ejecutar la instancia en caso 
 * de recibir los datos por una peticion AJAX.
 */
if (isset($_POST['option'])) {

	$method = $_POST['option'];

	UserController::$method();
}
