<?php

class Equipo extends DataBase
{

	private $id;
	private $departamento_id;
	private $marca_id;
	private $modelo_id;
	private $num_bien;
	private $estatus;
	private $fecha_incorporacion;

	/**
	 * Getters and Setters
	 *
	 * @return void
	 */
	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getDepartamento()
	{
		return $this->departamento_id;
	}

	public function setDepartamento($departamento_id)
	{
		$this->departamento_id = $departamento_id;
	}

	public function getMarca()
	{
		return $this->marca_id;
	}

	public function setMarca($marca_id)
	{
		$this->marca_id = $marca_id;
	}

	public function getModelo()
	{
		return $this->modelo_id;
	}

	public function setModelo($modelo_id)
	{
		$this->modelo_id = $modelo_id;
	}

	public function getNumBien()
	{
		return $this->num_bien;
	}

	public function setNumBien($num_bien)
	{
		$this->num_bien = $num_bien;
	}

	public function getEstatus()
	{
		return $this->estatus;
	}

	public function setEstatus($estatus)
	{
		$this->estatus = $estatus;
	}

	public function getFechaIncorporacion()
	{
		return $this->fecha_incorporacion;
	}

	public function setFechaIncorporacion($fecha_incorporacion)
	{
		$this->fecha_incorporacion = $fecha_incorporacion;
	}


	/**
	 * Methods
	 * * * * * * * * * * * * * 
	 *
	 * @return void
	 */
	public function save()
	{

		// Realizar funcion

		$db = self::connect();

		$sql = "INSERT INTO public.equipos(
			marca_id, num_bien, departamento_id, modelo_id)
			VALUES ({$this->getMarca()}, '{$this->getNumBien()}', {$this->getDepartamento()}, {$this->getModelo()})";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;
		}

		return $db->errorInfo();
	}

	public function Find($id)
	{
		$sql = "SELECT e.id, e.num_bien, e.estatus, e.fecha_incorporacion, d.id as d_id, d.nombre as departamento, 
				d.descripcion as descripcion,mc.nombre as marca, m.nombre as modelo, m.ram, m.cpu
				FROM equipos e, departamentos d, marcas mc, modelos m 
				WHERE e.departamento_id = d.id AND e.marca_id = mc.id AND e.modelo_id = m.id AND e.id = {$id} ORDER BY e.fecha_incorporacion DESC";

		$db = self::connect();

		$query = $db->query($sql);

		$equipo = false;

		if ($query && $query->rowCount() >= 1) {
			$equipo = $query->fetch();
		}

		return $equipo;
	}

	public function All()
	{

		$sql = 'SELECT e.id, e.num_bien, e.estatus, e.fecha_incorporacion, d.id as d_id, d.nombre as departamento, 
				mc.nombre as marca, m.nombre as modelo, m.ram, m.cpu
				FROM equipos e, departamentos d, marcas mc, modelos m 
				WHERE e.departamento_id = d.id AND e.marca_id = mc.id AND e.modelo_id = m.id ORDER BY e.id DESC';

		$db = self::connect();

		$query = $db->query($sql);

		$equipos = $query->fetchAll();

		return $equipos;
	}

	public function delete()
	{

		$db = self::connect();

		$sql = "UPDATE public.equipos
				SET estatus = false
				WHERE id = {$this->id}";

		$query = $db->exec($sql);


		if ($query > 0) {

			return true;
		}

		return false;
	}

	public static function getRand($limit)
	{

		$sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";

		$db = self::connect();

		$query = $db->query($sql);

		$equipos = $query->fetchAll();

		return $equipos;
	}

	public function update($option)
	{

		$db = self::connect();

		$sql = "UPDATE equipos SET ";

		switch ($option) {
			case 'departamento':
				$sql .= "departamento_id = {$this->departamento_id}";
				break;

			case 'estatus':
				$sql .= "estatus = {$this->getEstatus()}";
				break;

			default:

				break;
		}

		$sql .= " WHERE id = {$this->id}";

		$query = $db->exec($sql);

		// return $sql;

		if ($query > 0) {

			return true;
		}

		return false;
	}

	public function byDepartamento()
	{

		$db = self::connect();

		$ifExist = Utils::verifyExist($this->categoria_id, $db, 'categorias', 'id');

		if (!$ifExist) {

			return false;
		}

		$sql = "SELECT p.*, c.nombre as categoria FROM productos as p " .
			"INNER JOIN categorias as c WHERE p.categoria_id = {$this->categoria_id} AND c.id = p.categoria_id";

		$query = $db->query($sql);

		return $query->fetchAll();
	}

	
}
