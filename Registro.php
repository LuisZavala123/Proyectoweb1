<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <?php
        include "nav.php";

        if (isset($_GET["w1"])) {
       
          require_once "DAOS/UsuarioDao.php";
            $dao=new UsuarioDao();
            $us =json_decode($_GET["w1"]);

              $obj = new ModeloUsuario();
	            $obj->Usuario = $us->Usuario;
	            $obj->Nombre = $us->Nombre;
	            $obj->Password = $us->Password;
				      $obj->Direccion = $us->Direccion;
				      $obj->EsEmpleado= $us->EsEmpleado;


              
            if ($dao->agregar($obj)!=0) {
              
              header('Location: index.php');
                die();
            }
                
              
                     
        }

    ?>

    <!--BODY-->
    <div class="row Centrar">
        <div class="col-sm-3">
            <div class="card rounded" style="width: 18rem;">
                <img class="card-img-top rounded userimg" src="img/plus.png" alt="imagen">
                <div id="frmCaptura" class="card-body bg-success rounded">
                  <h5 class="card-title text-white">Registro</h5>
                  <form id="frmCaptura" class="border my-4 p-4">
                    <div class="row">
                      <div class="form-group col-12">
                          <input id="txtUser" name="txtUser" type="Email" placeholder="Usuario (correo)" class="form-control rounded">  
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12">
                          <input id="txtNombre" name="txtNombre" type="text" placeholder="Nombre(s)" class="form-control rounded">  
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12">
                          <input id="txtApellido" name="txtApellido" type="text" placeholder="Apellido(s)" class="form-control rounded">  
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12">
                          <input id="txtDir" name="txtDir" type="text" placeholder="Direccion" class="form-control rounded">  
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-12">
                      <input id="txtPass" name="txtPass" type="password" placeholder="Contraseña" class="form-control rounded">  
                  </div>
                  <div class="form-group col-12">
                    <input id="txtPass2" name="txtPass2" type="password" placeholder="Repetir Contraseña" class="form-control rounded">  
                </div>
                <div class="form-group col-12">
                <input type="checkbox" class="custom-control-input" id="cboxEmpleado" value="">
                <label class="custom-control-label" for="cboxEmpleado">Es Empleado?</label>  
                </div>
                </div>
                <button id="btnRegistrar" class="btn btn-info text-white rounded" type="button">Registrarse</button>
                </form>                  
                </div>
              </div>
        </div>
        
</body>
<script src="js/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="js/bootstrapValidator.js"></script>
<script src="js/navs.js"></script>
<?php
        include "js/Registrojs.php";
        
    ?>
</html>