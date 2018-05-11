<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $data = file_get_contents("php://input");
    $datos = json_decode($data);

    $NIF = $datos->NIF;
    $nombre = $datos->nombre;
    $apellido1 = $datos->apellido1;
    $apellido2 = $datos->apellido2;
    $email = $datos->email;
    $telefono = $datos->telefono;
    $direccion = $datos->direccion;
    $localidad = $datos->localidad;
    $provincia = $datos->provincia;
    $password = $datos->password;
    $tipo = $datos->tipo;
    $fecha_sesion = $datos->fecha_sesion;
    
    $bd = new C_BaseDatos("has_ong","root","abc123.");
    $conexion = $bd->abrirConexion();
    $usuario = new C_Usuario (" ",$NIF,$nombre,$apellido1,$apellido2,$email,$telefono,$direccion,$localidad,$provincia,$password,$tipo,$fecha_sesion);

    try{
        $sen = $conexion->prepare("INSERT INTO usuario (NIF,nombre,apellido1,apellido2,"
                . "telefono,email,direccion,localidad,provincia,password,tipo,fecha_sesion)"
                . "VALUES (:nif,:nombre,:apellido1,:apellido2,"
                . ":telefono,:email,:direccion,:localidad,:provincia,:password,:tipo,:fecha_sesion);");

        $params = array(
                    ':nif' => $usuario->NIF,
                    ':nombre' => $usuario->nombre,
                    ':apellido1' => $usuario->apellido1,
                    ':apellido2' => $usuario->apellido2,
                    ':telefono' => $usuario->telefono,
                    ':email' => $usuario->email,
                    ':direccion' => $usuario->direccion,
                    ':localidad' => $usuario->localidad,
                    ':provincia' => $usuario->provincia,
                    ':password' => $usuario->password,
                    ':tipo' => $usuario->tipo,
                    ':fecha_sesion' => $usuario->fecha_sesion); 
        echo "<BR>";
        echo var_dump($params);
        $sen->execute($params); 
        echo $params; 
    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }
    $bd->cerrarConexion();
