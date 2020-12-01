<?php
class ModeloPago{
    public $ID;
    public $IDUsuario;
    public $Monto;
    public $Total;
    public $Fecha;

    function __construct(){}
    function __construct1($ID,$IDUsuario,
                            $Monto,$Total,$Fecha){
        $this->$ID=$ID;
        $this->$IDUsuario=$IDUsuario;
        $this->$Total=$Total;
        $this->$Monto=$Monto;
        $this->$Fecha=$Fecha;
    }
    function __construct2($IDUsuario,
                            $Monto,$Total,$Fecha){
        $this->$IDUsuario=$IDUsuario;
        $this->$Total=$Total;
        $this->$Monto=$Monto;
        $this->$Fecha=$Fecha;
    }
}
?>