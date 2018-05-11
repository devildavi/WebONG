<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $data = file_get_contents("php://input");
	$datos = json_decode($data);
	$tabla = $datos->tabla;

    $resulta = array();

    try{
        $bd = new C_BaseDatos("has_ong","root","abc123.");
        $conexion = $bd->abrirConexion();
            
        $sen = $conexion->query("SELECT * FROM $tabla");

        while($fila = $sen->fetch(PDO::FETCH_OBJ)) {
           $resulta[] = $fila;
        }

        echo json_encode($resulta);

        $bd->cerrarConexion();
            
    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }
