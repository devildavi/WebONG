<?php

    class C_Producto_Tienda {
        private $id,$id_prod,$id_tienda,$stock,$estado;
        
        function __construct($id,$id_prod,$id_tienda,$stock,$estado) {
            $this->id = $id;
            $this->id_prod = $id_prod;
            $this->id_tienda = $id_tienda;
            $this->stock = $stock;
            $this->estado = $estado;
        }    
    }

