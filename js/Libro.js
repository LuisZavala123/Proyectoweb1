var actual = JSON.parse(localStorage.getItem("Actual"));
$(document).ready(function(){

    let id = localStorage.getItem('Libro');
    localStorage.removeItem('Libro');

    let Libro = obtenerLibro(id);

    $("#item-display").attr("src", Libro.foto[0]);
    $("#item-1").attr("src", Libro.foto[1]);
    $("#item-2").attr("src", Libro.foto[2]);
    $("#item-3").attr("src", Libro.foto[3]);

    $("#titulo").append(Libro.titulo);
    $("#desc").append(Libro.descripcion);

    $("#precio").append(Libro.precio);
    $("#stock").append(Libro.stock);

    $("#btnAgregar").click(function(){
        agregar(Libro);
    });

    $("#btnDeseados").click(function(){
        Deseados(Libro);
    });

    $("btnComentario").click(function(){
        let comentario = $("#txtComentario").val();
        $("#frmCaptura").data('bootstrapValidator').validate();
            if($("#frmCaptura").data('bootstrapValidator').isValid()){
                comentar(comentarrio);
        }

    });

    $('#frmCaptura').bootstrapValidator({
        fields: {
            txtComentario:{
                validators:{
                    notEmpty: {
                        message: 'Comentario no valido'
                    },stringLength: {
                        message: 'El texto del comentario debe tenr una lonjitud de entre 1 a 400 caracteres',
                        min:1,
                        max:400
                    }
                }
            }
        }
    });

});

function obtenerUsuario(){
    let lista=[];
    let resultado="";
    if(localStorage.getItem("Usuarios")!=null){
        lista=JSON.parse(localStorage.getItem("Usuarios"));
    }
    for (let index = 0; index < lista.length; index++) {
        if (actual==lista[index].id) {
            resultado =lista[index];
        }
        
    }

    return resultado;
}

function agregar(Libro){

    let carrito = obtenerCarrito();
    let obj={};

    obj.id=Libro.id;
    obj.producto=Libro.titulo;
    obj.precio=Libro.precio;
    obj.cantidad=1;

    carrito.push(obj);

    localStorage.setItem("Carrito",JSON.stringify(carrito));
}
function comentar(comentario){

    let usuario = obtenerUsuario();
    let comentarios = obtenerComentarios();
    let obj ={};

    obj.usuario= usuario.nombre;
    obj.comentario=comentario;

    comentarios.push(obj);

    localStorage.setItem("Comentarios",JSON.stringify(comentarios));
}

function Deseados(Libro){

    let deseados = obtenerDeseados();
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

function obtenerComentarios(){
    let lista=[];
    if(localStorage.getItem("Comentarios")!=null){
        lista=JSON.parse(localStorage.getItem("Comentarios"));
    }
    return lista;
}

function llenarTabla(){
    let lista=[];
    lista=obtenerComentarios();
    let idTabla='#tblComentarios';
    $('#tblComentarios').DataTable({
        data: lista,
        columns:[
            {title:"", data:"usuario"},
            {title:"", data:"comentario"}
        ],
        "fnInitComplete": function (oSettings, json) {
            var fila = $(this).children("thead").children("tr").clone();
            var pie = $("<tfoot/>").append(fila).css("display", "table-header-group");
            $(this).children("thead").after(pie);
            $(fila).children().each(function () {
                $(this).prop("class", null);
            });

            $(fila).children("th").each(function () {
                var title = $(this).text().toLowerCase();
                $(this).html('<input type="text" class="filtro form-control input-sm" style="width:90%;" placeholder="Buscar ' + title + '" />');
            });
            
            let tabla = this;
            tabla.api().columns().eq(0).each(function (colIdx) {
                $(idTabla + ' tfoot th:eq(' + colIdx + ') input').on('keyup change', function () {
                    tabla.api().column(colIdx).search(this.value).draw();
                });

                $('input', tabla.api().column(colIdx).footer()).on('click', function (e) {
                    e.stopPropagation();
                });
            });
        },
        'order': [[1, 'asc'],[0, 'asc']],
        'language': {'url':'http://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'}
    });
}