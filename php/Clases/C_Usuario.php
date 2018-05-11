<?php
    
    spl_autoload_register(function($clase){
        include $clase.".php";
    });

    class C_Usuario extends C_Persona{
        protected $password,$tipo,$fecha_sesion;
        
        function __construct($id, $NIF, $nombre, $apellido1, $apellido2, $email, $telefono, $direccion, $localidad, $provincia,$password,$tipo,$fecha_sesion) {
            parent::__construct($id, $NIF, $nombre, $apellido1, $apellido2, $email, $telefono, $direccion, $localidad, $provincia);
            $this->password = self::crearPassword($password);
            $this->tipo = $tipo;
            $this->fecha_sesion = $fecha_sesion;
        }
        
        private function crearPassword($password){
            return $hash = password_hash($password, PASSWORD_DEFAULT);
        }
        
        function __set($atributo, $valor) {
            parent::__set($atributo, $valor);
        }
        
        public function __get($atributo) {
            if (property_exists(__CLASS__, $atributo)) {
                return $this->$atributo;
            }
                return NULL;
        }
    }


