<?php

class C_BaseDatos {
    private $nombreBD,$usuario,$password,$conexion;
      
    function __construct($nombreBD,$usuario,$password) {
        $this->nombreBD = $nombreBD;
        $this->usuario = $usuario;
        $this->password = $password;
    }
    
    function abrirConexion(){
        
        try{
            $conexion = new PDO('mysql:host=localhost;dbname=has_ong','root','');
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //echo "<br>Conexión establecida con éxito con la BD: ".$this->nombreBD."<br>";
            return $this->conexion = $conexion;
               
        }catch(PDOException $e){ 
            die($e->getMessage()); 
        }
    }
    
    function cerrarConexion(){ 
        if($this->conexion !== null){
            $this->conexion = null;
            //echo "<br>Conexión cerrada con la BD: ".$this->nombreBD."<br>";
        }else{
            //echo "<br>Todavía no se ha abierto la conexión con la BD: ".$this->nombreBD."<br>";
        }
    }
}

