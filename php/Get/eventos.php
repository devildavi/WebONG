<?php

    spl_autoload_register(function($clase){
        include "../Clases/".$clase.".php";
    });

    $resulta = array();

    try{
        $bd = new C_BaseDatos("has_ong","root","abc123.");
        $conexion = $bd->abrirConexion();
            
        $sen = $conexion->query("SELECT * FROM evento");

        while($evento = $sen->fetch(PDO::FETCH_OBJ)) {
                     
            $sen2 = $conexion->query("SELECT el.fecha,el.aforo,el.precio_entrada,
                el.entradas_disponibles, l.espacio, l.ciudad, l.provincia
                FROM evento_lugar as el INNER JOIN lugar as l
                ON el.id_lugar = l.id
                WHERE id_evento=$evento->id"); 

            $lugar = $sen2->fetch(PDO::FETCH_OBJ);

            $evento->lugar = $lugar;
            $resulta[] = $evento;
        }

        echo json_encode($resulta);

        $bd->cerrarConexion();
            
    }catch(PDOException $ex){
        die("<br><strong>ERROR:</strong> ".$ex->getMessage()."<BR><strong>LINEA:</strong> ".$ex->getLine());
    }
