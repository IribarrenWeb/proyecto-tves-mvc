<?php

/**
 * Model for users
 */
class Marca extends DataBase {

	private $id;
	private $nombre;

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
		return strtoupper($this->nombre);
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
		return $this;
	}

	public static function All() {

		$sql = 'SELECT mc.*, COUNT(m.id) AS modelos FROM marcas mc, modelos m WHERE mc.id = m.marca_id GROUP BY mc.id ORDER BY mc.id DESC';

		$db = self::connect();

		$query = $db->query($sql);

		$categorias = $query->fetchAll();

		return $categorias;

	}

	public function save() {

		$db = DataBase::connect();

		$sql = "INSERT INTO marcas (nombre) VALUES('{$this->getNombre()}')";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

	public function edit() {

		$db = DataBase::connect();

		$sql = "UPDATE marcas SET nombre = '{$this->name}' WHERE id = {$this->id}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

	public function delete() {

		$db = DataBase::connect();

		$sql = "DELETE FROM marcas WHERE id = {$this->id}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

}