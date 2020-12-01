<?php
class ModeloDeseado{
    public $ID;
    public $IDUsuario;
    public $IDLibro;
    public $Libro;

    function __construct(){}
    function __construct1($ID,$IDUsuario,$IDLibro,
                            $Libro,$Precio){
        $this->$ID=$ID;
        $this->$IDUsuario=$IDUsuario;
        $this->$IDLibro=$IDLibro;
        $this->$Libro=$Libro;
    }
    function __construct2($IDUsuario,$IDLibro,
                            $Libro,$Precio){
        $this->$IDUsuario=$IDUsuario;
        $this->$IDLibro=$IDLibro;
        $this->$Libro=$Libro;
    }
}
?>