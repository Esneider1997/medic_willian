<?php

namespace App\Controllers\Configuraciones;


use App\Models\ConfSexo;
use CodeIgniter\RESTful\ResourceController;

class Sexos extends ResourceController
{

	public function __construct()
	{
		$this->setModel(new ConfSexo($db));
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{	
		$sexo = $this->model->findAll();
		return $this->respond($sexo);
	}
	
	public function Listar_sexo()
	{	
		$sexo = $this->model->findAll();
		return $this->respond($sexo);
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
			$sexo = $this->request->getJSON();
			if ($this->model->save($sexo)):
				$sexo->id = $this->model->insertID();
				$sexo->act = 1;
				return $this->respondCreated($sexo);
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
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		try {
			$sexo = $this->request->getJSON();
			if ($this->model->save($sexo)) :
				$sexo->act = 2;
				return $this->respondUpdated($sexo);
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
