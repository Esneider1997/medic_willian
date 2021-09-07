<?php

namespace App\Controllers;

use App\Models\clientemodel;

class Home extends BaseController
{
	public function index()
	{
		
		$db = \Config\Database::connect();
		$db->setDatabase('medic_empresas');
		$db->reconnect();
		$tabla = new clientemodel($db);
		$datos = $tabla->findAll();
		var_dump( $datos);
	
		return view('welcome_message');
	}
	public function crear_bd(){

		$forge = \Config\Database::forge();
		$forge->createDatabase('my_db', TRUE);
		$db = \Config\Database::connect();
		$db->setDatabase('my_db');
		$db->reconnect();
	

		
	}
	
}
