<?php

namespace App\Controllers\Admision;

use App\Models\MaestroPaciente;
use CodeIgniter\RESTful\ResourceController;

class Paciente extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new MaestroPaciente($db));
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	
	{
		$pacientes = $this->model->findAll();
		return $this->respond($pacientes);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($documento = null)
	{
		$pacientes = $this->model->where('documento In( '.$documento.' ) and id_tipo_documento= 4 ')->findAll();
		return $this->respond($pacientes);
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
			$paciente = $this->request->getJSON();
			if ($this->model->save($paciente)):
				$paciente->id = $this->model->insertID();
				$paciente->act = 1;
				return $this->respondCreated($paciente);
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
		//
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

	/**
	 * updated  the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function updated()
	{
		try {
			$paciente = $this->request->getJSON();
			if ($this->model->save($paciente)) :
				$paciente->act = 2;
				return $this->respondUpdated($paciente);
			else :
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError($e);
		}
	}
	public function formulariodecreacionpac(){
		
	}
}
