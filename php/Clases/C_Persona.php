<?php
    abstract class C_Persona {
        
        protected $id,$NIF,$nombre,$apellido1,$apellido2,$email,$telefono,$direccion,$localidad,$provincia;
        
        function __construct($id,$NIF,$nombre,$apellido1,$apellido2,$email,$telefono,$direccion,$localidad,$provincia) {
            $this->id = $id;
            $this->NIF = $NIF;
            $this->nombre = $nombre;
            $this->apellido1 = $apellido1;
            $this->apellido2 = $apellido2;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->localidad = $localidad;
            $this->provincia = $provincia;
        }
        
        public function __set($atributo, $valor) {
            if (property_exists(__CLASS__, $atributo)) {
                $this->$atributo = $valor;
            } else {
                echo "No existe el atributo $atributo en la clase ".__CLASS__."";
            }
        }      
        
    }

