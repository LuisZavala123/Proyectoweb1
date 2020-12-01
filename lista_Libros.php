<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Libros</title>
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
        $dao=new LibroDao();
        if(isset($_POST["clave"])){ //Eliminar
            session_start();
            if($dao->eliminar($_POST["clave"])){
                //Si eliminó
                $_SESSION["msg"]="Producto eliminado correctamente";
                $_SESSION["tipoMsg"]=1; //Mensaje de éxito
            }else{
                $_SESSION["msg"]="Error al eliminar, revisa que este producto no se haya vendido con anterioridad";
                $_SESSION["tipoMsg"]=0; //Mensaje de error
            }
            
            header("Location: lista_Libros.php");
            exit;
        }else{ //Cargar los productos
            
            //declarar y obtener los productos
            $lista=$dao->obtenerTodos();
        }
    ?>
    <div class="container my-5 p-5">
    <div id="mdlConfirmar" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el libro con el titulo <strong id="titulo"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="" method="POST">
                    <button type="submit" name="clave" value="" class="btn btn-danger" id="btnAceptar">Aceptar</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <h1 class="my-3">Libros almacenaddos en la base de datos</h1>
        <a class="btn btn-success mb-3" href="reg_Libros.php"><i class="fas fa-plus-circle"></i> Agregar</a>
        <?php
            //session_start();
            if(isset($_SESSION["msg"])){                
        ?>
            <div class="alert alert-<?= isset($_SESSION["tipoMsg"]) && $_SESSION["tipoMsg"]==0? "danger":"success"  ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION["msg"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
                unset($_SESSION["msg"]);
                unset($_SESSION["tipoMsg"]);
            }
        ?>
        <table id="tblLibros" class="table table-sm table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descripcion</td>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(isset($lista)){
                    foreach($lista as $ModeloLibro) {
            ?>
                        <tr>
                        <td><?php echo $ModeloLibro->ID; ?></td>
                        <td><?php echo $ModeloLibro->Titulo; ?></td>
                        <td><?php echo $ModeloLibro->Descripcion; ?></td>
                        <td><?=$ModeloLibro->Precio?></td>
                        <td><?=$ModeloLibro->Stock?></td>
                        <td>
                            <form action="reg_Libros.php" method="POST">
                                <button name="clave" value="<?=$ModeloLibro->ID?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Editar</button>
                            </form>
                        <button onclick="eliminar(<?=$ModeloLibro->ID?>,'<?=$ModeloLibro->Titulo?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                        </td>
                        </tr>
            <?php
                        /*echo "<tr><td>$producto->nombre</td>
                        <td>$producto->precio</td>
                        <td>$producto->existencia</td>
                        <td>$producto->inactivo</td>
                        <td>
                        <button id=\"btnEditar\" onclick=\"actualizar($producto->clave)\" class=\"btn btn-primary\"><i class=\"fas fa-pencil\"></i> Editar</button>
                        <button id=\"btnEliminar\" onclick=\"eliminar($producto->clave,'$producto->nombre')\" class=\"btn btn-danger\"><i class=\"fas fa-calcel\"></i>Eliminar</button>;
                        </td>
                        </tr>";*/
                    }
                }
            ?>
            
            </tbody>
        </table>
    </div>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
    <?php
        include "js/jsnav.php";
    ?>
    <script src="js/lista_Libros.js"></script>
  </body>
</html>