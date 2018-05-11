<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $data = file_get_contents("php://input");
    $datos = json_decode($data);
    
    $nombre = $datos->nombre;
    $direccion = $datos->direccion;
    $ciudad = $datos->ciudad;
    $codigopostal = $datos->codigopostal;
    $telefono = $datos->telefono;
    $email = $datos->email;
    $fax = $datos->fax;
    
    $bd = new C_BaseDatos("has_ong","root","abc123.");
    $conexion = $bd->abrirConexion();
    $tienda = new C_Tienda (" ",$nombre,$direccion,$ciudad,$codigopostal,$telefono,$email,$fax);
    //Mediante métodos dentro de C_Producto, asignar

    try{
        $sen = $conexion->prepare("INSERT INTO tienda (nombre,direccion,ciudad,codigo_postal,telefono,email,fax) "
                . "VALUES (:nombre,:direccion,:ciudad,:codigopostal,:telefono,:email,:fax);");

        $params = array(
                    ':nombre' => $tienda->nombre,
                    ':direccion' => $tienda->direccion,
                    ':ciudad' => $tienda->ciudad,
                    ':codigopostal' => $tienda->codigopostal,
                    ':telefono' => $tienda->telefono,
                    ':email' => $tienda->email,
                    ':fax' => $tienda->fax); 
        echo "<BR>";
        echo var_dump($params);
        $sen->execute($params); 
        echo $params; 
    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }
    $bd->cerrarConexion();