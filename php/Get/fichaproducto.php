<?php

	spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

	$data = file_get_contents("php://input");
	$datos = json_decode($data);
	$id = $datos->id;

    $resulta = array();
    $imagenes = array();
    $tiendas = array();

    try{
        $bd = new C_BaseDatos("has_ong","root","abc123.");
        $conexion = $bd->abrirConexion();
            
        $sen = $conexion->query("SELECT * FROM producto WHERE id = $id");

       	$producto = $sen->fetch(PDO::FETCH_OBJ);

        $sen2 = $conexion->query("SELECT ruta FROM imagenes_prod WHERE id_prod = $producto->id"); 
        while($imagen = $sen2->fetch(PDO::FETCH_OBJ)){ 
            $imagenes[] = $imagen;
        }

        $producto->imagenes = $imagenes;

        $sen3 = $conexion->query("SELECT pt.stock, t.nombre, t.direccion, t.ciudad 
                                  FROM producto_tienda as pt 
                                  INNER JOIN tienda as t ON pt.id_tienda = t.id
                                  WHERE id_prod = $producto->id");

        while($tienda= $sen3->fetch(PDO::FETCH_OBJ)){ 
            $tiendas[] = $tienda;
        }
        $producto->tiendas = $tiendas;

        $resulta[] = $producto; 

        echo json_encode($producto);

        $bd->cerrarConexion();
            
    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }