<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $data = file_get_contents("php://input");
    $datos = json_decode($data);
    
    $nombre = $datos->nombre;
    $descripcion = $datos->descripcion;
    $ruta = $datos->ruta_imagen;
    $idlugar = $datos->lugar;
    $aforo = $datos->aforo;
    $entrada = $datos->precioEntrada;
    //$partipantes = $datos->participantes;
        
    $bd = new C_BaseDatos("has_ong","root","abc123.");
    $conexion = $bd->abrirConexion();
    $evento = new C_Evento (" ",$nombre,$descripcion,$ruta);
    //Mediante métodos dentro de C_Producto, asignar

    try{
        $bandera = true;
        $conexion->beginTransaction();

        $sen = $conexion->prepare("INSERT INTO evento (nombre,descripcion,ruta_imagen) "
                . "VALUES (:nombre,:descripcion,:ruta_imagen);");

        $params = array(
                    ':nombre' => $evento->nombre,
                    ':descripcion' => $evento->descripcion,
                    ':ruta_imagen' => $evento->ruta_imagen); 

        if($sen->execute($params)==0){
            
            echo "<br>Algo va mal en evento";
            $bandeira = false;    
        }

        $idevento = $conexion->lastInsertId();

        $sen2 = $conexion->prepare("INSERT INTO evento_lugar (id_evento,id_lugar,fecha,aforo,precio_entrada,entradas_disponibles) VALUES (:id_evento,:id_lugar,:fecha,:aforo,:entrada,:entradasDis);");

        $sen2->bindValue(':id_evento',$idevento);
        $sen2->bindValue(':id_lugar',$idlugar);
        $sen2->bindValue(':fecha',$fecha);
        $sen2->bindValue(':aforo',$aforo);
        $sen2->bindValue(':entrada',$entrada);
        $sen2->bindValue(':entradasDis',$aforo);

        if($sen2->execute()==0){
            echo "<br>Algo va mal en evento_lugar";
            $bandeira = false;
        }

        /*
        $sen3 = $conexion->prepare("INSERT INTO evento_participante (id_evento,id_participante) VALUES (:id_evento,:id_participante);");

        $sen3->bindValue(':id_evento',$idevento);
        $sen3->bindValue(':id_participante',$idparticipante);

        if($sen3->execute()==0){
            echo "<br>Algo va mal en evento_participante";
            $bandeira = false;
        }*/

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