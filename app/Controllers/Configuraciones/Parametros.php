<?php

namespace App\Controllers\Configuraciones;

use App\Models\ConfDiscapacidades;
use App\Models\ConfEstadocivil;
use App\Models\ConfGruposCulturale;
use App\Models\ConfMaestroDepartamento;
use App\Models\ConfProvincia;
use App\Models\ConfServicios;
use App\Models\ConfSexo;
use App\Models\ConfTipoDocumento;
use CodeIgniter\RESTful\ResourceController;

class Parametros extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{	
	
	}
	public function Listar_tiopodocumento()
	{	
		$this->setModel(new ConfTipoDocumento($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
		//return $this->respond($discapacidades);
	}
	public function Listar_discapacidades()
	{	
		$this->setModel(new ConfDiscapacidades($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
	}
	public function Listar_provicias($id = null)
	{	
		$this->setModel(new ConfProvincia($db));
		if ($id != "none"){
			$discapacidades = $this->model->where('iddepartamento', $id)->findAll();
			return $this->respond($discapacidades);
		}else {
			$discapacidades = $this->model->findAll();
			return $this->respond($discapacidades);
		}
		
		
	}
	public function Listar_est_civil()
	{	
		$this->setModel(new ConfEstadocivil($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
	}
	public function Listar_servicios()
	{	
		$this->setModel(new ConfServicios($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
	}
	public function Listar_delista_servicios()
	{	
		$this->setModel(new ConfServicios($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
	}
	public function Listar_sexo()
	{	
		$this->setModel(new ConfSexo($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
	}
	public function Listar_grupocultural()
	{	
		$this->setModel(new ConfGruposCulturale($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
	}
	public function Listar_departamento()
	{	
		$this->setModel(new ConfMaestroDepartamento($db));
		$discapacidades = $this->model->findAll();
		return $this->respond($discapacidades);
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
		//
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
		//
	}
}
