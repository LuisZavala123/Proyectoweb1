<?php
class ModeloPago{
    public $ID;
    public $IDUsuario;
    public $IDCarrito;
    public $Metodo;
    public $Monto;
    public $Fecha;

    function __construct(){}
    function __construct1($ID,$IDUsuario,$IDCarrito,
                            $Metodo,$Monto,$Fecha){
        $this->$ID=$ID;
        $this->$IDUsuario=$IDUsuario;
        $this->$IDCarrito=$IDCarrito;
        $this->$Metodo=$Metodo;
        $this->$Monto=$Monto;
        $this->$Cantidad=$Cantidad;
        $this->$Fecha=$Fecha;
    }
    function __construct2($IDUsuario,$IDCarrito,
                            $Metodo,$Monto,$Fecha){
        $this->$IDUsuario=$IDUsuario;
        $this->$IDCarrito=$IDCarrito;
        $this->$Metodo=$Metodo;
        $this->$Monto=$Monto;
        $this->$Cantidad=$Cantidad;
        $this->$Fecha=$Fecha;
    }
}
?>