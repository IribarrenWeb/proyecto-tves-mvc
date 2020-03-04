<?php

/**
 * Model for users
 */
class Departamento extends DataBase {

	private $id;
	private $nombre;
	private $descripcion;

	// ID Getter and Setter
	function getId() {
		return $this->id;
	}

	function setId($id) {
		$this->id = $id;
		return $this;
	}

	// Nombre Getter y Setter
	function getNombre() {
		return $this->nombre;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
		return $this;
	}

	// nombre Getter y Setter
	function getDescripcion() {
		return $this->descripcion;
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
		return $this;
	}

	public static function All() {

		$sql = 'SELECT * FROM departamentos ORDER BY id DESC';

		$db = self::connect();

		$query = $db->query($sql);

		$departamentos = $query->fetchAll();

		return $departamentos;

	}

	public function save() {

		$db = DataBase::connect();

		$sql = "INSERT INTO departamentos (nombre,descripcion) VALUES('{$this->getNombre()}','{$this->getDescripcion()}')";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

	public function edit() {

		$db = DataBase::connect();

		$sql = "UPDATE departamentos SET nombre = '{$this->name}', descripcion = '{$this->descripcion}' WHERE id = {$this->id}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

	public function delete() {

		$db = DataBase::connect();

		$sql = "DELETE FROM departamentos WHERE id = {$this->id}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

}