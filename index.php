<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <?php
        include "nav.php";
        require_once "DAOS/LibroDao.php";
        $dao=new LibroDao();
    ?> 
    
  <div id="cuerpo">
  <?php
  if (isset($_POST["Busqueda"])) {
    $lista = $dao->Buscar($_POST["Busqueda"]);
  }else{
    $lista = $dao->obtenerTodos();
  }
  
  if($lista != null){
    foreach ($lista as $valor) {

 ?> 
    <br>
    <div class="row justify-content-md-center">
          <div class="col-md-4">
            <div class="card rounded" style="width: 18rem;">
                <img class="card-img-top rounded" src="<?=$valor->Foto?>" alt="imagen">
                <div class="card-body bg-success rounded">
                  <h5 class="card-title text-white"><?= $valor->Titulo?></h5>
                  <p class="card-text "><?= $valor->Descripcion?></p>
                  <button onclick="Mostrar()" class="btn btn-info text-white rounded">Mostrar</button>

            </div>
          </div>
      </div>
      </div>
    <?php
      }
    }
  ?>
</div>
</body>


    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <?php
        include "js/jsnav.php";
    ?>
</html>