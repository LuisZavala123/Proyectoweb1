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
    ?>
    <!--BODY-->
  <div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
				<div class="col-md-12">
					<div class="product col-md-3 service-image-left ">
                    
						
							<img id="item-display"alt=""></img>
						
					</div>
					
					<div class="container service1-items ">
						
							<a id="item-1" class="service1-item">
								
							</a>
							<a id="item-2" class="service1-item">
								
							</a>
							<a id="item-3" class="service1-item">
								
							</a>
						
					</div>
				</div>
					
				<div class="col-md-7">
					<div id="titulo" class="product-title"></div>
					<div id="desc" class="product-desc"></div>
					
					<hr>
					<div id="precio" class="product-price"></div>
					<div id="stock" class="product-stock"></div>
					<hr>
					<div class="btn-group cart">
						<button type="button" id="btnAgregar" class="btn btn-success">
							Agregar al carrito 
						</button>
					</div>
					<div class="btn-group wishlist">
						<button type="button" id="btnDeseados" class="btn btn-danger">
							Agregar a la lista de deseados
						</button>
					</div>
				</div>
			</div> 
		</div>
		<div class="container-fluid">		
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav">
						
						<li class="nav-item bg-secondary rounded-top"><a class="nav-link text-white" href="#servicio-uno" data-toggle="tab"> DESCRIPCION </a></li>
						
						<li class="nav-item bg-secondary rounded-top"><a class="nav-link text-white" href="#servicio-dos" data-toggle="tab"> REVIEWS </a></li>
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="servicio-uno">
							<section class="container product-info">

							</section>
										  
						</div>
					<div class="tab-pane fade" id="servicio-dos">
					<form id="frmCaptura">
						<input class="form-control" id="txtComentario" type="text" placeholder="Por favor deja tu comentario">
						<button type="button" id="btnComentario" class="btn btn-success">
							Comentar
						</button>
					</form>
						<table id="tblComentarios" class="table table-hover">
						</table>
					</div>
				</div>
				<hr>
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
<script src="js/navs.js"></script>
</html>