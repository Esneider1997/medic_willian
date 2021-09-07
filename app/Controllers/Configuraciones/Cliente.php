<?php

namespace App\Controllers\Configuraciones;

use App\Models\clientemodel;
use App\Models\ServiciosInterdiciplinario;
use CodeIgniter\RESTful\ResourceController;

class Cliente extends ResourceController
{
	public function conectar()
	{
		$dbconect = $this->request->getPost('db');
		$db = \Config\Database::connect();
		$db->setDatabase($dbconect);
		$db->reconnect();
		$clientes = $this->model->findAll();
		$db->close();
		return $this->respond($clientes);
	}
	public function __construct()
	{
		$this->model = $this->setModel(new clientemodel($db));
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{	
		
		
		$clientes = $this->model->findAll();
		
		return $this->respond($clientes);
	}
	public function listar_servijson()
	{	
		$dbnombre='api';
		$db = \Config\Database::connect();
		$db->setDatabase($dbnombre);
		$db->reconnect();
		$this->setModel(new ServiciosInterdiciplinario($db));
		$servi = $this->model->findAll();
		var_dump($servi[0]["servicios"]);
		//var_dump();
		//return $this->respond($servi);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = null)
	{
		//
	}

	/**
	 * Return a new resource object, with default properties
	 *
	 * @return mixed
	 */
	public function new()
	{
		//
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		try {
			$cliente = $this->request->getJSON();
			if ($this->model->save($cliente)):
				$cliente->id = $this->model->insertID();
				$cliente->act = 1;
				return $this->respondCreated($cliente);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError($e);
		}
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		try {
			if ($id == null)
				return $this->failValidationErrors("No se paso un id");
			$cliente = $this->model->find($id);
			if ($cliente == null)
				return $this->failValidationErrors("No existe cliente con id");
			return $this->respond($cliente);
		} catch (\Exception $e) {
			return $this->failServerError('ha ocurrido un error en el servidor');
		}
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function updated()
	{
		try {
			$cliente = $this->request->getJSON();
			//echo  json_encode($cliente);
			var_dump($cliente);
			if ($this->model->save($cliente)) :
				$cliente->act = 2;
				return $this->respondUpdated($cliente);
			else :
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError($e);
		}
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		try {
			$this->model->delete($id);
			$data = [
				'act' => 3,
				'id' => $id
			];
			return $this->respondDeleted($data);
		}catch (\Exception $e) {
			return $this->failServerError($e);
		}
	}
}
