<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
	use ResponseTrait;
	public function __construct()
	{
		helper('secure_password');
	}
	public function login()
	{

		try {
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			var_dump(hashPassword($password));
			$usuarioModel = new UsuarioModel();
			//$where = ['username' => $username, 'password' => $password];

			$validateUsuario = ($usuarioModel->where('username', $username)->first());

			if ($validateUsuario == null) {
				return $this->failNotFound('usuario no encontrado');
			} else if (verifyPassword($password, $validateUsuario["password"])) {
				$jwt = $this->generateJWT($validateUsuario);
				return $this->respond($jwt);
			} else {
				return $this->respond('Contraseña invalida');
			}
		} catch (\Exception $e) {
			return $this->failServerError($e . ' Error de Servidor');
		}
	}

	protected function generateJWT($usuario)
	{
		$key = Services::getSecretKey();
		$time = time();
		$payload = [
			'aud' => base_url(),
			'iat' => $time,
			'exp' => $time + 60,
			'data' => [
				'nombre' => $usuario['nombre'],
				'username' => $usuario['username'],
				'rol' => $usuario['rol_id']
			]
		];
		$jwt = JWT::encode($payload, $key);
		return $jwt;
	}
}
