<?php
class ModeloLibro{
    public $ID;
    public $Titulo;
    public $Descripcion;
    public $Precio;
    public $Stock;

    function __construct(){}
    function __construct1($ID,$Titulo,
                        $Descripcion,$Precio,$Stock){
        $this->$ID=$ID;
        $this->$Titulo=$Titulo;
        $this->$Descripcion=$Descripcion;
        $this->$Precio=$Precio;
        $this->$Stock=$Stock;
    }
    function __construct2($Titulo,
                        $Descripcion,$Precio,$Stock){
        $this->$Titulo=$Titulo;
        $this->$Descripcion=$Descripcion;
        $this->$Precio=$Precio;
        $this->$Stock=$Stock;
    }
}
?>