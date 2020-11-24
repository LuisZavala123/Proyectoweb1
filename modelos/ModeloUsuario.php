<?php
class ModeloUsuario{
    public $ID;
    public $Usuario;
    public $Nombre;
    public $Password;
    public $Direccion;

    function __construct(){}
    function __construct1($ID,$Usuario,$Nombre
                        $Password,$Descripcion){
        $this->$ID=$ID;
        $this->$Usuario=$Usuario;
        $this->$Nombre=$Nombre;
        $this->$Password=$Password;
        $this->$Direccion=$Direccion;
    }
    function __construct2($Usuario,$Nombre
                        $Password,$Descripcion){
        $this->$Usuario=$Usuario;
        $this->$Nombre=$Nombre;
        $this->$Password=$Password;
        $this->$Direccion=$Direccion;
    }
}
?>