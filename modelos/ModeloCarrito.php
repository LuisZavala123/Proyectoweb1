<?php
class ModeloCarrito{
    public $ID;
    public $IDUsuario;
    public $IDLibro;
    public $Libro;
    public $Precio;

    function __construct(){}
    function __construct1($ID,$IDUsuario,$IDLibro,
                            $Libro,$Precio){
        $this->$ID=$ID;
        $this->$IDUsuario=$IDUsuario;
        $this->$IDLibro=$IDLibro;
        $this->$Libro=$Libro;
        $this->$Precio=$Precio;
    }
    function __construct2($IDUsuario,$IDLibro,
                            $Libro,$Precio){
        $this->$IDUsuario=$IDUsuario;
        $this->$IDLibro=$IDLibro;
        $this->$Libro=$Libro;
        $this->$Precio=$Precio;
    }
}
?>