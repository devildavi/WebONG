<?php

    spl_autoload_register(function($clase){
        include $clase.".php";
    });

    class C_Participante extends C_Persona{
        
        function __construct($id, $NIF, $nombre, $apellido1, $apellido2, $email, $telefono, $direccion, $localidad, $provincia) {
            parent::__construct($id, $NIF, $nombre, $apellido1, $apellido2, $email, $telefono, $direccion, $localidad, $provincia);
        }
    }