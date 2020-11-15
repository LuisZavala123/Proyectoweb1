$(document).ready(function(){

    llenar();
});

function llenar(){
    let libros = obtenerLibros();
    let contenido=" ";


    for (let index = 0; index <libros.length; index++) {
       contenido=' <div class="row">'+
        '<div class="col-sm-3">'+
        '<div class="card rounded" style="width: 18rem;">'+
            '<img class="card-img-top rounded" src="'+libros[index].foto[0]+'" alt="imagen">'+
            '<div class="card-body bg-success rounded">'+
              '<h5 class="card-title text-white">'+libros[index].titulo+'</h5>'+
              '<p class="card-text ">'+libros[index].descipcion+'</p>'+
              '<button onclicK="Mostrar('+libros[index].id+')" class="btn btn-info text-white rounded">Mostrar</button>'+
            '</div>'+
          '</div>'+
    '</div>' ;     
    $("#cuerpo").append(contenido);
    }
}

function obtenerLibros(){
    let lista=[];
    if(localStorage.getItem("Libros")!=null){
        lista=JSON.parse(localStorage.getItem("Libros"));
    }
    return lista;
}

function Mostrar(id){
    localStorage.setItem('Libro',JSON.stringify(id))
    window.location.href='Libro.php';
}