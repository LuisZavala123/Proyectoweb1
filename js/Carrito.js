var actual = JSON.parse(localStorage.getItem("Actual"));
$(document).ready(function(){
    llenarTabla();

    $("#btnComprar").click(function(){
            
        pagos=obtenerPagos();

        let obj={};

        obj.monto=$("#txtTotal").val();
        obj.metodo="";
        obj.total=3;
        obj.fecha="";

        pagos.push(obj);

        localStorage.removeItem('Carrito');

        localStorage.setItem("Pagos",JSON.stringify(pagos));
        $('#tblCompra').DataTable().clear().rows.add(obtenerCarrito()).draw();
    });
});

function Eliminar(id){
  let carrito = obtenerCarrito();
        for (let index = 0; index < carrito.length; index++) {
            if (carrito[index].id==id) {
                carrito.splice(index,index);
            }
        }
        localStorage.setItem("Carrito",JSON.stringify(carrito));
        $('#tblCompra').DataTable().clear().rows.add(obtenerCarrito()).draw();
}

function obtenerCarrito(){
    let lista=[];
    if(localStorage.getItem("Carrito")!=null){
        lista=JSON.parse(localStorage.getItem("Carrito"));
    }
    return lista;
}

function obtenerPagos(){
    let lista=[];
    let listam=[];
    if(localStorage.getItem("Pagos")!=null){
        listam=JSON.parse(localStorage.getItem("Pagos"));
    }
    for (let index = 0; index < listam.length; index++) {
        if (listam[index].id==actual) {
            lista.push(listam[index]);
        }
        
    }
    return lista;
}

function llenarTabla(){
    let lista=[];
    lista=obtenerCarrito();
    let con =0;
    let idTabla='#tblCompra';
    $('#tblCompra').DataTable({
        data: lista,
        columns:[
            {title:"Producto", data:"producto"},
            {title:"Cantidad", data:null,render: function (data, type, row){
                return '<input type="text" id="txtCantidad'+data.cantidad+'" name="txtCantidad'+data.cantidad+'" value='+data.cantidad+'>';
            }
            },
            {title:"Precio", data:"Precio"},
            {title:"", data:null,render: function (data, type, row){
                return '<button type="button" onclick="Eliminar('+data.id+')" class="btn btn-danger">Eliminar</button>';
            }
        }
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
