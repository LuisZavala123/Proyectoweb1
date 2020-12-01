<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/Libro.css">
</head>
<body>
<?php
	include "nav.php";
	require_once "DAOS/LibroDao.php";
	$libro=null;
	$deseado=null;
	$carrito=null;
	//La función empty nos ayuda a verificar si una variable esta
	//vacía (sin elementos o sin datos)
	if (!empty($_POST)) { //Se recibieron datos por post
        require_once "DAOS/LibroDao.php";
        $dao=new LibroDao();
        if(count($_POST)==1 && isset($_POST["clave"])){ // Cargar para mostrar libro en card
            //Verificar clave
            if(is_numeric($_POST["clave"])){
                $libro=$dao->obtenerUno($_POST["clave"]);
            }else{
                session_start();
                $_SESSION["msg"]="Los datos recibidos no son válidos, no se ha podido realizar la operación";
                $_SESSION["tipoMsg"]=0; //Mensaje de error
                header("Location: reg_Libros.php");
                exit;
            }
        }else{ // Agregar a deseado o al carrito
            //Se verifica si la variable POST no está vacía (implica que se dió 
			//click a guardar y se recibieron los datos de las cajas de texto
			require_once "DAOS/DeseadoDao.php";
			require_once "modelos/ModeloDeseado.php";
		    $dao=new DeseadoDao();
            $deseado = new ModeloDeseado();
            if(isset($_POST['txtTitulo']) || isset($_POST['clave']))
                $deseado->IDLibro=$_POST['clave'];
				$deseado->IDUsuario=$_POST['IdUsuario'];
				$deseado->Libro=$_POST['txtTitulo'];
			
			if(isset($_POST["IdUsuario"]) && isset($_POST["txtTitulo"]) && !isset($_POST["precio"])){ //Agregar a deseados
                if($dao->agregarADeseados($deseado)){
                    session_start();
                    $_SESSION["msg"]="Se agrego el libro a deseados";
                    $_SESSION["tipoMsg"]=1; //Mensaje de éxito
					header("Location: index.php");
                    exit;
                }else{
					$msgError="No se ha podido agregar a deseados, intenta más tarde";
                }
			}else{ //Agregar a carrito
				require_once "modelos/ModeloCarrito.php";
				require_once "DAOS/CarritoDao.php";
				$dao=new CarritoDao();
				$carrito=new ModeloCarrito();
				$carrito->IDUsuario=1;
				$carrito->IDLibro=$_POST['clave'];
				$carrito->Libro=$_POST['txtTitulo'];
				$carrito->Precio=$_POST['precio'];
				var_dump($carrito);
                if($dao->agregarACarrito($carrito)){
                    session_start();
                    $_SESSION["msg"]="Libro almacenado con éxito";
                    $_SESSION["tipoMsg"]=1; //Mensaje de éxito
                    header("Location: index.php");
                    exit;
                }else{
                        $msgError="No se ha podido agregar al carrito, intenta más tarde";
                    }
            }
		}	
	}else{
        $msgError="Los datos no son válidos: <br> $validacion";
	}
    ?>
    <!--BODY-->
	<br>
  <div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
				<form action="Libro.php" method="POST">
					<div class="col-md-12">
					<div class="card mb-3 w-100" >
					<div class="card-header h2 text-center">
						Informacion del libro seleccionado
					</div>
						<div class="row no-gutters">
							<div class="col-md-4">
								<img src="<?=$libro->Foto?>" class="card-img  px-3 py-3 rounded-pill" alt="Portada del libro"><!--Cargar portada del libro-->
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<label for="txtTitulo" class="h2" >Titulo: </label> <br>
									<input type="text" id="txtTitulo" name="txtTitulo" value="<?=$libro->Titulo?>" 
										class="form-control-plaintext display-2" placeholder="<?=$libro->Titulo?>"><!--Cargar titulo del libro-->
									<label for="txtDescripcion" class="h3" >Descripcion: </label> <br>
									<p class="card-text display-5" id="txtDescripcion"><!--Cargar la Descripcion del libro-->	
										<?=$libro->Descripcion?> 
									</p>
										<div class="container">
											<div class="row">
												<div class="col-6">
													<label for="txtPrecio" >Precio: </label> <br>
													<div class="input-group mb-2">
														<div class="input-group-prepend">
														<div class="input-group-text"> $</div>
														</div>
														<input type="text" class="form-control" id="txtPrecio" 
														placeholder="<?=$libro->Precio?>" readonly><!--Cargar el precio del libro-->
													</div>
												</div>
												<div class="col-6">
													<label for="txtPrecio" >En Stock: </label> <br>
													<div class="input-group mb-2">
														<div class="input-group-prepend">
														<div class="input-group-text"> Unidades:</div>
														</div>
														<input type="text" class="form-control" id="txtStock" 
														placeholder="<?=$libro->Stock?>"readonly><!--Cargar el stock del libro-->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<input type="text" name="IdUsuario" value="<?=1?>" class="form-control d-none"><!--Cargar el ID del usuario-->
					<input type="text" name="clave" value="<?=$libro->ID?>" class="form-control d-none"><!--Cargar la clave del libro-->
					<div class="col-md-7">
						<a href="index.php" class="btn bg-secondary text-white"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
						<div class="btn-group cart">
							<button name="precio" value="<?=$libro->Precio?>" type="submit" id="btnAgregar" class="btn btn-success">
								<i class="fas fa-cart-plus"></i>
								Agregar al carrito 
							</button>
						</div>
						<div class="btn-group wishlist">
							<button  type="submit" id="btnDeseados" class="btn btn-danger">
								<i class="fas fa-cart-arrow-down"></i>
								Agregar a deseados
							</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
		<!--Aqui va la seccion de comentarios-->
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
<script src="js/navs.js"></script>
</html>