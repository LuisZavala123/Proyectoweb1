<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/perfil.css">
</head>
<body>
<?php
        include "nav.php";
        require_once "DAOS/UsuarioDao.php";
            $daou=new UsuarioDao();
            $usuario;
            if (isset($_SESSION["ID"]) {
              $usuario= obtenerUno($_SESSION["ID"]);
            }

            if (isset($_GET["w1"])) {
       
                $us =json_decode($_GET["w1"]);
    
                  $obj = new ModeloUsuario();
                  $obj->ID = $_SESSION["ID"];
                  $obj->Usuario = $us->Usuario;
                  $obj->Nombre = $us->Nombre;
                  $obj->Password = $usuario->Password;
                  $obj->Direccion = $us->Direccion;
                  $obj->EsEmpleado= $usuario->EsEmpleado;
    
    
                  
                if ($dao->editar($obj)!=0) {
                  
                  $usuario= obtenerUno($_SESSION["ID"]);
                }
              }
                if (isset($_GET["w2"])) {
       
                  $us =json_decode($_GET["w2"]);
      
                    $obj = new ModeloUsuario();
                    $obj->ID = $_SESSION["ID"];
                    $obj->Usuario = $usuario->Usuario;
                    $obj->Nombre = $usuario->Nombre;
                    $obj->Password = $us->Password;
                    $obj->Direccion = $$usuario->Direccion;
                    $obj->EsEmpleado= $usuario->EsEmpleado;
      
      
                    
                  if ($dao->editar($obj)!=0) {
                    
                    $usuario= obtenerUno($_SESSION["ID"]);
                  }
                }
                  
                         
            


    ?>

    <!--BODY-->
    <div class="container">
        <div class="row gutters-sm">
          <div class="col-md-4 d-none d-md-block">
            <div class="card">
              <div class="card-body">
                <nav class="nav flex-column nav-pills nav-gap-y-1">
                  <a href="#perfil" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                    <img src="img/user.png" width="24" height="24" alt=""> Informacion de Perfil
                  </a>
                  
                  <a href="#Contraseña" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                    <img src="img/escudo.png" width="24" height="24" alt=""> Contraseña 
                  </a>
                  <a href="#pago" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                    <img src="img/targeta.png" width="24" height="24" alt="">Informacion de Pago  
                  </a>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header border-bottom mb-3 d-flex d-md-none">
                <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                  <li class="nav-item">
                    <a href="#perfil" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="#Contraseña" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#pago" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                </ul>
              </div>
              <div class="card-body tab-content">
                <div class="tab-pane active" id="perfil">
                  <h6>Informacion De Perfil</h6>
                  <hr>
                  <form id="frmDatos">
                    <div class="form-group">
                      <label for="txtNombre">Nombre</label>
                      <input type="text" class="form-control" id="txtNombre" name="txtNombre"  placeholder="Ingresa tu nombre completo" value="<?=$usuario->Nombre;?>">             
                    </div>
                    <div class="form-group">
                      <label for="txtUsuario">Nombre de usuario</label>
                      <input type="text" class="form-control" id="txtUsuario" name="txtUsuario"  placeholder="Ingresa un nombre de usuario" value="<?=$usuario->Usuario;?>">             
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="txtDir">Direccion</label>
                      <input type="text" id="txtDir" name="txtDir" class="form-control" id="Direccion" placeholder="Ingresa tu direccion" value="<?=$usuario->Direccion;?>">
                    </div>
                    
                    <button type="button" id="btnActualisarP" class="btn btn-success">Actualizar perfil</button>
                  </form>
                </div>
                
                <div class="tab-pane" id="Contraseña">
                  <h6>Configurar contraseña</h6>
                  <hr>
                  <form id="frmCon">
                    <div class="form-group">
                      <label class="d-block">Cambiar Contraseña</label>
                      <input type="password" id="passOld" name="passOld" class="form-control" placeholder="Antigua Contraseña" value="<?=$usuario->Password;?>">
                      <input type="password" id="pass1" name="pass1" class="form-control mt-1" placeholder="Nueva Contraseña">
                      <input type="password" id="pass2" name="pass2" class="form-control mt-1" placeholder="Confirmar Contraseña">
                    </div>
                  </form>
                  <hr>
                  <form>
                    <div class="form-group">
                      <button id="btnActualisarC" class="btn btn-success" type="button">Cambiar contraseña</button>
                    </div>
                  </form>
                  
                </div>
                
                <div class="tab-pane" id="pago">
                  <h6>Informacion de Pago</h6>
                  <hr>
                  <form>
                    <div class="form-group mb-0">
                      <label class="d-block">Historial</label>
                      <div class="border border-gray-500 bg-gray-200 p-3 text-center font-size-sm">
                        <table id="tblPagos" class="table table-bordered table-striped">
                        </table> 
                      </div>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
<script src="js/Perfil.js"></script>
<script src="js/navs.js"></script>
</html>