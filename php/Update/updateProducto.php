<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $data = file_get_contents("php://input");
    $datos = json_decode($data);
    
    $id = $datos->id;
    $nombre = $datos->nombre;
    $descripcion = $datos->descripcion;
    $precio = $datos->precio;
    $categoria = $datos->categoria;
    $fechafin = $datos->fechafin;

    /*
    $imagen = $datos->imagen;
    $idtienda = $datos->idtienda;
    $stock = $datos->stock;
    $estado = $datos->estado;*/
    
    $bd = new C_BaseDatos("has_ong","root","abc123.");
    $conexion = $bd->abrirConexion();
    $producto = new C_Producto ($id,$nombre,$descripcion,$precio,$categoria,date($fechafin));
    //Mediante métodos dentro de C_Producto, asignar

    try{
        $bandera = true;
        $conexion->beginTransaction();
       
        $sen = $conexion->prepare("UPDATE producto 
            SET nombre = :nombre, descripcion = :descripcion, 
            precio = :precio, categoria = :categoria, fecha_fin_campana = :fechafin 
            WHERE id=:id");
        
        $params = array(
                ':nombre' => $producto->nombre,
                ':descripcion' => $producto->descripcion,
                ':precio' => $producto->precio,
                ':categoria' => $producto->categoria,
                ':fechafin' => $producto->fechafin,
                ':id' => $producto->id); 
        
        if($sen->execute($params)==0){
            
            echo "<br>Algo va mal en update producto";
            $bandeira = false;    
        }
     
        if($bandera){
            echo "<br>Transacción realizada";
            $conexion->commit();
        }else{
            echo "<br>Algo va mal en la transaccion";
            $conexion->rollback();
        }

        $bd->cerrarConexion();

    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }
    
