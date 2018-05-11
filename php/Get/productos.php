<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $resulta = array();
    $imagenes = array();

    try{
        $bd = new C_BaseDatos("has_ong","root","abc123.");
        $conexion = $bd->abrirConexion();
            
        $sen = $conexion->query("SELECT * FROM producto");

        /* Mostrar solo productos con stock

        $sen = $conexion->query("SELECT *,pt.stock FROM producto 
                                INNER JOIN producto_tienda as pt 
                                ON producto.id = pt.id_prod 
                                WHERE pt.stock > 0");*/

        while($producto = $sen->fetch(PDO::FETCH_OBJ)) {

            $imagenes = array();
           
            $sen2 = $conexion->query("SELECT ruta FROM imagenes_prod WHERE id_prod=$producto->id"); 

            while($imagen = $sen2->fetch(PDO::FETCH_OBJ)){ 
                $imagenes[] = $imagen;
            }

           $producto->imagenes = $imagenes;
           $resulta[] = $producto;
        }

        echo json_encode($resulta);

        $bd->cerrarConexion();
            
    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }
