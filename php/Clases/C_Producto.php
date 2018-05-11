<?php

    spl_autoload_register(function($clase){
        include $clase.".php";
    });

    class C_Producto{
        public $id,$nombre,$descripcion,$precio,$categoria,$fecha_fin_campana;
        
        function __construct($id,$nombre,$descripcion,$precio,$categoria,$fecha_fin_campana) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->categoria = $categoria;
            $this->fecha_fin_campana = $fecha_fin_campana;
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