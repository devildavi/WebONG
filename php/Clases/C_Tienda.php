<?php

    spl_autoload_register(function($clase){
        include $clase.".php";
    });

    class C_Tienda {
        private $id,$nombre,$direccion,$ciudad,$codigopostal,$telefono,$email,$fax;
        
        function __construct($id,$nombre,$direccion,$ciudad,$codigopostal,$telefono,$email,$fax) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->ciudad = $ciudad;
            $this->codigopostal = $codigopostal;
            $this->telefono = $telefono;
            $this->email = $email;
            $this->fax = $fax;
        }
        
        public function __get($atributo) {
            if (property_exists(__CLASS__, $atributo)) {
                return $this->$atributo;
            }
                return NULL;
        }
        
        public function __set($atributo, $valor) {
            if (property_exists(__CLASS__, $atributo)) {
                $this->$atributo = $valor;
            } else {
                echo "No existe el atributo $atributo en la clase ".__CLASS__."";
            }
        }  
    }