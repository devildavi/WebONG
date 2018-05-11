<?php

 spl_autoload_register(function($clase){
        include $clase.".php";
    });

    class C_Evento {
        private $id,$nombre,$descripcion,$ruta_imagen;
        
        function __construct($id,$nombre,$descripcion,$ruta_imagen) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->ruta_imagen = $ruta_imagen;
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
