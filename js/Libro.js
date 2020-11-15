
$(document).ready(function(){

    let id = localStorage.getItem('Libro');
    localStorage.removeItem('Libro');

    let Libro = obtenerLibro();

    $("#item-display").attr("src", Libro.foto[0]);
    $("#item-1").attr("src", Libro.foto[1]);
    $("#item-2").attr("src", Libro.foto[2]);
    $("#item-3").attr("src", Libro.foto[3]);

    $("#titulo").append(Libro.titulo);
    $("#desc").append(Libro.descripcion);

    $("#precio").append(Libro.precio);
    $("#stock").append(Libro.stock);


});

function agregar(Libro){

    carrito = obtenerCarrito();
    let obj={};

    obj.id=Libro.id;
    obj.producto=Libro.titulo;
    obj.precio=Libro.precio;
    obj.cantidad=1;

    carrito.push(obj);

    localStorage.setItem("Carrito",JSON.stringify(carrito));
}

function Deseados(Libro){

    deseados = obtenerDeseados();
    let obj={};

    obj.id=Libro.id;
    obj.producto=Libro.titulo;
    obj.precio=Libro.precio;
    obj.cantidad=1;

    deseados.push(obj);

    localStorage.setItem("Deseados",JSON.stringify(deseados));
}

function obtenerCarrito(){
    let lista=[];
    if(localStorage.getItem("Carrito")!=null){
        lista=JSON.parse(localStorage.getItem("Carrito"));
    }
    return lista;
}

function obtenerDeseados(){
    let lista=[];
    if(localStorage.getItem("Deseados")!=null){
        lista=JSON.parse(localStorage.getItem("Deseados"));
    }
    return lista;
}

function obtenerLibro(id){
    let lista=[];
    let resultado="0";
    if(localStorage.getItem("Carrito")!=null){
        lista=JSON.parse(localStorage.getItem("Carrito"));
    }
    for (let index = 0; index < lista.length; index++) {
        if (id==lista[index].id) {
            resultado =lista[index];
        }
        
    }

    return resultado;
}