<?php

/**
 * Model for users
 */
class User extends DataBase
{
	private $id;
	private $nombre;
	private $apellido;
	private $documento;
	private $password;
	private $created;
	private $updated;
	private $role;
	private $db;

	public function __construct()
	{
		$this->db = $this->connect();;
	}

	// ID Getter and Setter
	function getId()
	{
		return $this->id;
	}

	function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	// nombre Getter and Setter
	function getNombre()
	{
		return $this->nombre;
	}

	function setNombre($nombre)
	{
		$this->nombre = $nombre;
		return $this;
	}

	// apellido Getter and Setter
	function getApellido()
	{
		return $this->apellido;
	}

	function setApellido($apellido)
	{
		$this->apellido = $apellido;
		return $this;
	}

	// Usernombre Getter and Setter
	function getDocument()
	{
		return $this->documento;
	}

	function setDocumento($documento)
	{
		$this->documento = $documento;
		return $this;
	}

	// Password Getter and Setter
	function getPassword()
	{
		return $this->password;
	}

	function setPassword($password)
	{
		$this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
		return $this;
	}

	// Date Getter and Setter
	function getCreatedAt()
	{
		return $this->created;
	}

	function setCreatedAt($created)
	{
		$this->created = $created;
		return $this;
	}

	// Date Getter and Setter
	function getUpdatedAt()
	{
		return $this->updated;
	}

	function setUpdatedAt($updated)
	{
		$this->updated = $updated;
		return $this;
	}

	// Privilegio Getter and Setter
	function getRole()
	{
		return $this->role;
	}

	function setRole($role)
	{
		$this->role = $role;
		return $this;
	}

	public function All()
	{

		$sql = "SELECT id, nombre, apellido, documento, role_id, fecha_creacion, fecha_actualizacion FROM usuarios WHERE id != {$_SESSION['usuario']['id']} ORDER BY fecha_creacion DESC";

		$db = self::connect();

		$query = $db->query($sql);

		$usuarios = $query->fetchAll();

		return $usuarios;
	}

	public function save()
	{

		$conex = $this->db;

		$sql = 'INSERT INTO public.usuarios(nombre,apellido,documento,password,role_id) VALUES(?,?,?,?,?)';

		$query = $conex->prepare($sql);

		$query->bindParam(1, $this->nombre);
		$query->bindParam(2, $this->apellido);
		$query->bindParam(3, $this->documento);
		$query->bindParam(4, $this->password);
		$query->bindParam(5, $this->role);

		$result = $query->execute();

		if (!$result) {
			return $query->errorInfo();
		}

		return $result;
	}

	public function login($password)
	{

		$verifyExist = Utils::verifyExist($this->documento, 'usuarios', 'documento');

		// return $this->configRole($verifyExist);

		if (is_array($verifyExist) && password_verify($password, $verifyExist['password'])) {
			return $this->configRole($verifyExist);
		}

		return false;
	}

	public function update($option)
	{

		$db = $this->db;

		$sql = "UPDATE usuarios SET ";

		switch ($option) {
			case 'password':
				$sql .= "password = '{$this->getPassword()}'";
				break;

			case 'datos':
				$sql .= "nombre = '{$this->getNombre()}', apellido = '{$this->getApellido()}', documento = {$this->getDocument()}";
				break;

			default:

				break;
		}

		$sql .= " WHERE id = {$this->getId()}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;
		}

		return [$sql, $db->errorInfo()];
	}

	public static function configRole($usuario)
	{
		$usuario['rolname'] = Utils::Where('role', $usuario['role_id'], false, 'nombre_rol')->fetch();

		return Utils::formatRoles($usuario, true);
	}

	public function changePass()
	{
		$sql = "UPDATE usuarios SET password = ?, change_pass = true WHERE id = ?";
		$db = self::connect();
		$query = $db->prepare($sql);
		$query->bindParam(1,$this->password);
		$query->bindParam(2,$_SESSION['usuario']['id'],PDO::PARAM_INT);
		$verify = $query->execute();

		if(!$verify){
			return $query->errorInfo();
		}

		return $verify;
	}

	public function resetPassword()
	{
		$sql = "UPDATE usuarios SET change_pass = false, password = '{$this->password}'  WHERE id = {$this->id}";
		$db = self::connect();

		if($db->exec($sql) >=1){
			return true;
		}else{
			return [false,$db->errorInfo()];
		}
	}
}
