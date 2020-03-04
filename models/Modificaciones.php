<?php

/**
 * Model for users
 */
class Modificacion extends DataBase {

	private $id;
	private $usuarioId;
	private $equipoId;
	private $descripcion;
	private $fecha;

	// ID Getter and Setter
	function getId() {
		return $this->id;
	}

	function setId($id) {
		$this->id = $id;
		return $this;
	}

	// Nombre Getter y Setter
	function getUsuarioId() {
		return $this->usuarioId;
	}

	function setUsuarioId($usuarioId) {
		$this->usuarioId = $usuarioId;
		return $this;
	}

	// Nombre Getter y Setter
	function getEquipoId() {
		return $this->equipoId;
	}

	function setEquipoId($equipoId) {
		$this->equipoId = $equipoId;
		return $this;
	}

	// usuario_id Getter y Setter
	function getDescripcion() {
		return $this->descripcion;
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
		return $this;
	}

	// usuario_id Getter y Setter
	function getFecha() {
		return $this->fecha;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
		return $this;
	}

	public static function All($id) {

		$sql = "SELECT * FROM modificaciones WHERE equipo_id = {$id} ORDER BY id DESC";

		$db = self::connect();

		$query = $db->query($sql);

		$modificaciones = $query->fetchAll();

		return $modificaciones;

	}

	public static function mapping($registro){
		$registro['usuario'] = Utils::Where('usuarios',$registro['usuario_id'],false,'nombre, apellido, id')->fetch();
		return $registro;
	}

	public function save() {

		$db = self::connect();

		$sql = "INSERT INTO modificaciones (usuario_id,equipo_id,descripcion,fecha) 
				VALUES({$this->usuarioId},{$this->equipoId},'{$this->descripcion}','{$this->getFecha()}')";

		$query = $db->exec($sql);

		
		if ($query > 0) {

			return true;

		}

		return false;

	}

	public function reporte()
	{
		$sql = "SELECT  m.id, u.nombre, u.apellido, u.documento, m.descripcion, m.fecha FROM modificaciones
		m INNER JOIN usuarios u ON  u.id = m.usuario_id AND m.equipo_id = {$this->equipoId} AND fecha >= '{$this->fecha}'";

		$db = self::connect();

		$resultSet = $db->query($sql);

		if(is_array($resultSet) || $resultSet){
			return [true,$resultSet->fetchAll()];
		}

		return [false, $sql];
	}

}