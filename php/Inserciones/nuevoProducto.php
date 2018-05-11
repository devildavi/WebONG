<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $data = file_get_contents("php://input");
    $datos = json_decode($data);
    
    $nombre = $datos->nombre;
    $descripcion = $datos->descripcion;
    $precio = $datos->precio;
    $categoria = $datos->categoria;
    $fechafin = $datos->fechafin;
    $imagen = $datos->imagen;
    $idtienda = $datos->idtienda;
    $stock = $datos->stock;
    $estado = $datos->estado;
    
    $bd = new C_BaseDatos("has_ong","root","abc123.");
    $conexion = $bd->abrirConexion();
    $producto = new C_Producto (" ",$nombre,$descripcion,$precio,$categoria,date($fechafin));
    //Mediante métodos dentro de C_Producto, asignar

    try{
        $bandera = true;
        $conexion->beginTransaction();

        
        $sen = $conexion->prepare("INSERT INTO producto (nombre,descripcion,precio,categoria,fecha_fin_campana) "
                . "VALUES (:nombre,:descripcion,:precio,:categoria,:fechafin);");
        
        $params = array(
                ':nombre' => $producto->nombre,
                ':descripcion' => $producto->descripcion,
                ':precio' => $producto->precio,
                ':categoria' => $producto->categoria,
                ':fechafin' => $producto->fechafin); 
        
        if($sen->execute($params)==0){
            
            echo "<br>Algo va mal en producto";
            $bandeira = false;    
        }

        echo "<br>".var_dump($params);
        $idprod = $conexion->lastInsertId();

        $sen2 = $conexion->prepare("INSERT INTO imagenes_prod (id_prod,ruta) VALUES (:id_prod,:imagen);");

        $sen2->bindValue(':id_prod',$idprod);
        $sen2->bindValue(':imagen',$imagen);

        if($sen2->execute()==0){
            echo "<br>Algo va mal en imagenes";
            $bandeira = false;
        }

        $sen3 = $conexion->prepare("INSERT INTO producto_tienda (id_prod,id_tienda,stock,estado) VALUES (:id_prod,:id_tienda,:stock,:estado);");

        $params2 = array(
                ':id_prod' => $idprod,
                ':id_tienda' => $idtienda,
                ':stock' => $stock,
                ':estado' => $estado); 
        
        if($sen3->execute($params2)==0){
            
            echo "<br>Algo va mal en producto-tienda";
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
    
