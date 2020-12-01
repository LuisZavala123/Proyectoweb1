<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    
    <?php
        include "nav.php";
        

        if(isset($_GET["w1"])){
            require_once "DAOS/PagoDao.php";
            $daop=new PagoDao();
            $us =json_decode($_GET["w1"]);

              $obj = new ModeloPago();
	            $obj->IDUsuario = $us->IDUsuario;
	            $obj->Total = $us->Total;
	            $obj->Monto = $us->Monto;
				$obj->Fecha = $us->Fecha;


              
            if ($daop->agregar($obj)!=0) {
                require_once "DAOS/UsuarioDao.php";
                $daou=new UsuarioDao();
                $daou->eliminardelCarrito($obj->IDUsuario);
              header('Location: index.php');
                die();
            }
        }

        if(isset($_GET["w2"])){
            require_once "DAOS/UsuarioDao.php";
            $daou=new UsuarioDao();
            $daou->eliminardelCarrito(($_GET["w2"]);
            
        }
    ?> 
  
      <!--BODY-->
      <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="w-25 p-3">
                    <label for="txtNombre">Total:</label>
                    <input type="text" id="txtTotal" name="txtTotal" class="" disabled="true">  
                    <button id="btnComprar" class="btn btn-success my-2 my-sm-0 " type="button">Compar</button>
                    </div>
                    
                <table id="tblCompra" class="table table-hover">
                </table>
            </div>
        </div>
    </div>
</body>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="js/bootstrapValidator.js"></script>
    <script src="js/Carrito.js"></script>
    <?php
        include "js/Carritojs.php";
    ?> 
    <script src="js/navs.js"></script>
</html>