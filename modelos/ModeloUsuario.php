<?php
class ModeloUsuario{
    public $ID;
    public $Usuario;
    public $Nombre;
    public $Password;
    public $Direccion;
    public $EsEmpleado;

    function __construct(){}
    function __construct1($ID,$Usuario,$Nombre,
                        $Password,$Descripcion,$EsEmpleado){
        $this->$ID=$ID;
        $this->$Usuario=$Usuario;
        $this->$Nombre=$Nombre;
        $this->$Password=$Password;
        $this->$Direccion=$Direccion;
        $this->$EsEmpleado=$EsEmpleado;
    }
    function __construct2($Usuario,$Nombre,
                        $Password,$Descripcion,$EsEmpleado){
        $this->$Usuario=$Usuario;
        $this->$Nombre=$Nombre;
        $this->$Password=$Password;
        $this->$Direccion=$Direccion;
        $this->$EsEmpleado=$EsEmpleado;
    }
}
?>