<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;

class AuthFilter implements FilterInterface
{   use ResponseTrait;
    public function before(RequestInterface $request, $arguments = null)
    {       
        $key =services::getSecretKey();
            $authHeader = $request->getServer('HTTP_AUTHORIZATION');
        try {
            
            /*if($authHeader == null)
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'No se envio lo requerido');
            $arr=explode(' ', $authHeader);
            $jwt=$arr[1];*/
            JWT::decode($authHeader,$key,['HS256']);
         } catch (\Throwable $th) {
            return Services::response()
				->setJSON(['mensaje' => 'Token caducado']);
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
