<?php
class ModeloLibro{
    public $ID;
    public $Titulo;
    public $Descripcion;
    public $Precio;
    public $Stock;
    public $Foto;

    function __construct(){}
    function __construct1($ID, $Titulo,
                        $Descripcion,$Precio,$Stock,$Foto){
        $this->$ID=$ID;
        $this->$Titulo=$Titulo;
        $this->$Descripcion=$Descripcion;
        $this->$Precio=$Precio;
        $this->$Stock=$Stock;
        $this->$Foto=$Foto;
    }
}
?>