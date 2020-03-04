<?php

/**
 * Model for users
 */
class Modelo extends DataBase {

	private $id;
	private $marca;
	private $nombre;
	private $ram;
	private $cpu;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getMarca(){
		return $this->marca;
	}

	public function setMarca($marca){
		$this->marca = $marca;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getRam(){
		return $this->ram;
	}

	public function setRam($ram){
		$this->ram = $ram;
	}

	public function getCpu(){
		return $this->cpu;
	}

	public function setCpu($cpu){
		$this->cpu = $cpu;
	}


    /**
     * Methods
     * * * * * * * * * * * * *
     *
     * @return void
     */
	public function All() {

		$sql = 'SELECT m.id, m.nombre, m.ram, m.cpu, mc.nombre as marca FROM modelos m, marcas mc WHERE m.marca_id = mc.id ORDER BY id DESC';

		$db = self::connect();

		$query = $db->query($sql);

		$modificacion = $query->fetchAll();

		return $modificacion;

    }
    
    public function byMarca() {

		$sql = "SELECT * FROM modelos WHERE marca_id = {$this->getMarca()} ORDER BY id DESC";

		$db = self::connect();

		$data = $db->query($sql);

		return $data->fetchAll();

	}

	public function save() {

		$db = self::connect();

		$sql = "INSERT INTO public.modelos(marca_id, nombre, ram, cpu) 
				VALUES({$this->getMarca()},'{$this->getNombre()}','{$this->getRam()}','{$this->getCpu()}')";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return $db->errorInfo()[2];

	}

	public function edit() {

		$db = DataBase::connect();

		$sql = "UPDATE modificaciones SET nombre = '{$this->name}', descripcion = '{$this->descripcion}' WHERE id = {$this->id}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

	public function delete() {

		$db = DataBase::connect();

		$sql = "DELETE FROM modificaciones WHERE id = {$this->id}";

		$query = $db->exec($sql);

		if ($query > 0) {

			return true;

		}

		return false;

	}

}