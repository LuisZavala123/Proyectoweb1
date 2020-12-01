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
    <div class="container">	
			<div class="col-md-12">
				<div class="card mb-3 w-100" >
					<div class="card-header h2 text-right">
						Acerca de <?=$valor->Titulo?>
            </div>
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?=$valor->Foto?>" class="card-img  px-3 py-3 rounded-pill" alt="Portada del libro"><!--Cargar portada del libro-->
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <label for="txtTitulo" class="h2" >Titulo: </label> <br>
                    <input type="text" id="txtTitulo" name="txtTitulo" value="<?=$valor->Titulo?>" 
                      class="form-control-plaintext font-weight-normal" placeholder="<?=$valor->Titulo?>"><!--Cargar titulo del libro-->
                    <label for="txtDescripcion" class="h3" >Descripcion: </label> <br>
                    <p class="card-text display-5" id="txtDescripcion"><!--Cargar la Descripcion del libro-->	
                      <?=$valor->Descripcion?> 
                    </p>
                    <input type="text" name="IdUsuario" value="<?=1?>" class="form-control d-none"><!--Cargar el ID del usuario-->
                      <div class="row ">
                        <div class="col lign-self-end">
                          <form action="Libro.php" method="POST">
                            <button type="submit" name="clave" value="<?=$valor->ID?>" class="btn btn-primary">Mostrar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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