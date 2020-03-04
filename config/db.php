<?php


class DataBase {
	protected static $conex;

	protected static function connect() {
		try{
		
			self::$conex = new PDO('pgsql:dbname=inventario_tves;host=localhost;port=5432', 'postgres', '828iribarren');
		
		}catch(PDOException $e){

			printf($e->getMessage());
			die();
		
		}
		
		self::$conex->query("SET NAMES 'utf8'");
		
		return self::$conex;
	}

	protected static function die(){
		self::$conex = null;
	}
}