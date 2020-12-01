<script>
total=0;
Cantidad=0;
$(document).ready(function(){

    <?php
        require_once "DAOS/UsuarioDao.php";
        $daou=new UsuarioDao();
        
    ?> 


    llenarTabla();

    $("#btnComprar").click(function(){
            
        let f = new Date();
        let obj={};

        obj.IDUsuario=<?= $_SESSION["ID"];?>;
        obj.monto=$("#txtTotal").val();
        obj.total=total;
        obj.fecha=f.getFullYear( + "-" + (f.getMonth() +1) + "-" + f.getDate());

        window.location.href = window.location.href+ "?w1="+ JSON.stringify(obj);
    });
});

function Eliminar(id){
    window.location.href = window.location.href+ "?w2="+ id;
}



function llenarTabla(){
    
    let lista=<?= $daou->obtenerCarrito($_SESSION["ID"]);?>;
    
    for(i=0;i<lista.length;i++){
        total+=lista[i].Precio;
    }
    Cantidad=lista.length;
    $("#txtTotal").val(total);
    let con =0;
    let idTabla='#tblCompra';
    $('#tblCompra').DataTable({
        data: lista,
        columns:[
            {title:"Libro", data:"Libro"},
            {title:"Precio", data:"Precio"},
            {title:"", data:null,render: function (data, type, row){
                return '<button type="button" onclick="Eliminar('+data.ID+')" class="btn btn-danger">Eliminar</button>';
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
</script>
