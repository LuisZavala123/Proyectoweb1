<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libros</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    
    <?php
        include "nav.php";
        require_once "DAOS/LibroDao.php";
        $libro=null;
        $fichero_subido=null;
        $bandera=false;
        if(empty($_FILES)){
            // echo 'Envio del listado ';
        }else if(!empty($_FILES['flFoto'])){
            //submit
            if($_FILES['flFoto']['size']>0){
                $dir_subida = 'Archivos/';
                $fichero_subido = $dir_subida . basename($_FILES['flFoto']['name']);
                if (move_uploaded_file($_FILES['flFoto']['tmp_name'], $fichero_subido)) {
                    //echo "El fichero es válido y se subió con éxito.\n";
                    $bandera=true;
                }
            }
        }
        //Indicar ubicacion de la foto
    //Asegura que los datos requeridos cumplan con las mismas
	//validaciones que en el cliente para asegurar que vienen correctos
	function validar(){
		$textoValidacion="";
		if (!isset($_POST["txtTitulo"]) || strlen(trim($_POST["txtTitulo"]))<2 ||
			strlen(trim($_POST["txtTitulo"]))>40)
            $textoValidacion .="<li>El titulo del libro debe tener entre 5 y 50 caracteres</li>";
        if (!isset($_POST["txtPrecio"]) || !is_numeric($_POST["txtPrecio"]) ||
            $_POST["txtPrecio"]<=0)
			$textoValidacion.="<li>El precio debe ser un valor numérico mayor a 0</li>";
		if (!isset($_POST["txtStock"]) || !is_numeric($_POST["txtStock"]) ||
        $_POST["txtStock"]<0)
			$textoValidacion.="<li>La existencia debe ser un valor numérico positivo</li>";
		if ($textoValidacion){
			return "<ul>".$textoValidacion."</ul>";
        }
		return "";
	}
    //La función empty nos ayuda a verificar si una variable esta
	//vacía (sin elementos o sin datos)
	if (!empty($_POST)) { //Se recibieron datos por post
        require_once "DAOS/LibroDao.php";
        $dao=new LibroDao();
        if(count($_POST)==1 && isset($_POST["clave"])){ // Cargar para editar
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
        }else{ //Guardar
            //Se verifica si la variable POST no está vacía (implica que se dió 
	        //click a guardar y se recibieron los datos de las cajas de texto
            $validacion=validar();
            $libro = new ModeloLibro();
            if(isset($_POST['txtClave']) || isset($_POST['clave']))
                $libro->ID=isset($_POST['txtClave'])?$_POST['txtClave']:$_POST['clave'];
                $libro->Titulo=$_POST['txtTitulo'];
                $libro->Descripcion=$_POST['txtDescripcion'];
                $libro->Precio=$_POST['txtPrecio'];
                $libro->Stock=$_POST['txtStock'];
                //$libro->Foto=$fichero_subido;
                isset($fichero_subido)?$libro->Foto=$fichero_subido:$libro->Foto=$dao->obtenerUno($_POST["clave"])->Foto;
            
            if($validacion==""){
                //Datos correctos
                if(isset($_POST["txtClave"])){ //Editar
                    if($dao->editar($libro)){
                        session_start();
                        $_SESSION["msg"]="Libro editado con éxito";
                        $_SESSION["tipoMsg"]=1; //Mensaje de éxito
                        header("Location: lista_Libros.php");
                        $msgCorrecto="Se edito correctamente el libro";
                        exit;
                    }else{
                        $msgError="No se ha podido editar, intenta más tarde";
                    }
                }else{ //Agregar
                    if($dao->agregar($libro)){
                        session_start();
                        $_SESSION["msg"]="Libro almacenado con éxito";
                        $_SESSION["tipoMsg"]=1; //Mensaje de éxito
                        header("Location: lista_Libros.php");
                        $msgCorrecto="Se agregpo correctamente el libro";
                        exit;
                    }else{
                        $msgError="No se ha podido guardar, intenta más tarde";
                    }
                }
            }else{
                $msgError="Los datos no son válidos: <br> $validacion";
            }
        }
    }else{
        // Solo cargar para comenzar a capturar
    }
    ?> 
      <!--BODY-->
    <div class="container">
        <br>
        <!--Formulario para dar de alta un libro-->
        <div class="card">
            <div class="card-header text-center">
                Agregar Libros
            </div>
            <div class="card-body justify-content-md-center">
                <form id="frmCapturaLibro" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row-md-6">  
                                <?php
                                if(isset($libro) && !empty($libro->ID)){
                                ?>
                                    <div class="form-group">
                                    <label for="txtClave">Clave:</label>
                                    <input type="text" class="form-control-plaintext text-center" name="txtClave" id="txtClave" value="<?=$libro->ID?>" readonly>
                                    </div>
                                <?php
                                    }else{
                                ?> 
                                    <div class="form-group">
                                        <label for="txtClave">Clave</label>
                                        <input type="text" class="form-control text-center" id="txtClave"  value="<?php $dao=new LibroDao();print($dao->obtenerUtltimoID()+1);?>" readonly>
                                    </div>
                                <?php
                                    }
                                ?> 
                            </div>
                            <div class="row-md-6">  
                                <div class="form-group">
                                    <label for="txtTitulo">Titulo</label>
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" value="<?= isset($libro)?$libro->Titulo:''; ?>"
                                    placeholder="Ingrese el titulo del libro" requiered>
                                </div>
                            </div>
                            <div class="row-md-6">  
                                <div class="form-group">
                                    <label for="txtDescripcion">Descripcion</label>
                                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="9" 
                                    placeholder="Ingrese una breve descripcion del libro" ><?= isset($libro)?$libro->Descripcion:''; ?></textarea>
                                </div>
                            </div>
                            <div class="row-md-6">  
                                <div class="form-group">
                                    <label for="txtPrecio">Precio</label><br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" class="form-control" name="txtPrecio" id="txtPrecio" value="<?= isset($libro)?$libro->Precio:''; ?>"
                                        aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div><br>
                            <div class="row-md-6">  
                                <div class="form-group">
                                    <label for="txtStock">Cantidad de libros en Stock</label><br>
                                    <input type="number" class="form-control" name="txtStock" id="txtStock" value="<?= isset($libro)?$libro->Stock:''; ?>" requiered>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-md-center"> 
                                <br>
                                <div class="card" style="width: 100%">
                                    <br>
                                    <?php
                                    if($bandera){
                                    ?>
                                        <img id="img" src="<?= $fichero_subido ?>" style="width: 60%" class="card-img mx-auto" alt="imagen">
                                    <?php
                                        }else{    
                                    ?> 
                                        <img id="img" src="<?= isset($libro)?$libro->Foto:'Archivos/prueba/1.png' ?>" style="width: 60%" class="card-img mx-auto" alt="imagen">
                                    <?php
                                        }
                                    ?> 
                                    <div class="card-body ">       
                                        <div class="row-md-6">  
                                            <div class="form-group">
                                                <label for="flFoto">Seleccionar imagen de portada</label><br>
                                                <?php
                                                if($bandera){
                                                ?>
                                                    <input type="file" class="form-control" accept="image/*" name="flFoto" id="flFoto">
                                                <?php
                                                    }else{    
                                                ?> 
                                                    <input type="file" class="form-control" accept="image/*" name="flFoto" id="flFoto">
                                                <?php
                                                    }
                                                ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php 
                            if(isset($msgCorrecto)){
                                echo "<div class=\"alert alert-success\">$msgCorrecto</div>";
                            }
                        ?>
                    </div>
                    <div class="row">
                        <?php 
                            if(isset($msgError)){
                                echo "<div class=\"alert alert-danger\">$msgError</div>";
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="lista_Libros.php" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
                            <button type="submit" id="btnGuardar"  class="btn btn-success"><i class="fas fa-save"></i> Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="js/bootstrapValidator.js"></script>
    <script src="js/reg_Libros_script.js"></script>
    <script src="js/navs.js"></script>
</body>
    
</html>