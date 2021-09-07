<?php namespace App\Libraries;

class Conexion{
    public function conectar($dbnombre){
            $db = \Config\Database::connect();
            $db->setDatabase($dbnombre);
            return $db;
    }
}

/*
public function conectar(){
   
    $this->model=$this->setModel(new clientemodel($db));
}


public function __construct()
{
    $this->conectar();
}*/