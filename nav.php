<!--HEADER-->
<header>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="btncerrar" onclick="closeNav()">&times;</a>
            <a href="index.php">Inicio</a>
            <a href="Carrito.php">Carrito</a>
            <a href="perfil.php">Cuenta</a>
          </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-success ">
            <button class="btn btn-success" type="submit"><img class="icono1" src="img/menu.png" alt="" onclick="openNav()"></button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categoria
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item " href="#">Misterio</a>
                    <a class="dropdown-item " href="#">Accion</a>
                    <a class="dropdown-item " href="#">Comedia</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                    <input class="form-control " type="search" placeholder="Busqueda" aria-label="Busqueda">
                </li>
                <li class="nav-item dropdown">
                    <button class="btn btn-success my-2 my-sm-0" type="button"><img class="icono2" src="img/lupa.png" alt=""></button>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <button id="btnLogin"  class="btn btn-success my-2 my-sm-0 " type="button">Ingresar</button>
                <button id="btnRegistro"  class="btn btn-outline-info my-2 my-sm-0 border text-white" type="button">Registrase</button>
              </form>
            </div>
          </nav>
    </header>