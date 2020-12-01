<script>
$(document).ready(function(){

    llenarTabla();

    $('#btnActualisarP').click(function(){
        


        
        Us = $('#txtUsuario').val();
        nom = $('#txtNombre').val();
        dir = $('#txtDir').val();


        $("#frmDatos").data('bootstrapValidator').validate();
            if($("#frmDatos").data('bootstrapValidator').isValid()){
                let obj={};

                obj.Usuario=Us;
                obj.Nombre=nom;
                obj.Direccion=dir;

                window.location.href = window.location.href+ "?w1="+ JSON.stringify(obj);

        }

    });

    $('#btnActualisarC').click(function(){


        
        Passold = $('#passOld').val();
        Pass1 = $('#pass1').val();
        Pass2 = $('#pass2').val();


        $("#frmCon").data('bootstrapValidator').validate();
            if($("#frmCon").data('bootstrapValidator').isValid()){
                

                if (Passold!=Pass1&&Pass1==Pass2) {
                    let obj={};
                obj.Password=Pass1;
                    window.location.href = window.location.href+ "?w2="+ JSON.stringify(obj);
                }
                

        }

    });

    $('#frmDatos').bootstrapValidator({
        fields: {
            txtUsuario:{
                validators:{
                    notEmpty: {
                        message: 'El nombre de Usuario es un valor necesario'
                    },stringLength: {
                        message: 'El Nombre de usuario debe tener entre 5 y 100 caracteres',
                        min:5,
                        max:100
                    }
                }
            },txtNombre:{
                validators:{
                    notEmpty: {
                        message: 'El nombre  es un valor necesario'
                    },stringLength: {
                        message: 'El Nombre debe tener entre 5 y 100 caracteres',
                        min:5,
                        max:100
                    }
                }
            },txtEmail: {
                validators: {
                  notEmpty: {
                    message: 'El correo electronico es requerido'
                  },
                  regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'El correo no es valido'
                  }
                }
              },txtDir:{
                validators:{
                    notEmpty: {
                        message: 'La direccion es un valor necesario'
                    },stringLength: {
                        message: 'La direccion debe tener entre 25 y 200 caracteres',
                        min:25,
                        max:200
                    }
                }
            }
        }

    });
    $('#frmCon').bootstrapValidator({
        fields: {
              passOld: {
                  validators: {
                      notEmpty: {
                          message: 'La contraseña es un valor necesario'
                      },stringLength: {
                          message: 'La contraseña debe tener entre 5 y 100 caracteres',
                          min:5,
                          max:100
                      }
                  }
              },
            pass1: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es un valor necesario'
                    },stringLength: {
                        message: 'La contraseña debe tener entre 5 y 100 caracteres',
                        min:5,
                        max:100
                    }
                }
            },
            pass2: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es un valor necesario'
                    },stringLength: {
                        message: 'La contraseña debe tener entre 5 y 100 caracteres',
                        min:5,
                        max:100
                    }
                }
            }
        }

    });
});





function llenarTabla(){
    <?php 
    require_once "DAOS/PagoDao.php";
    $daop=new PagoDao();
    ?>
    let lista= <?= json_encode($daop->obtenerPorUSuario($_SESSION["ID"]));?>;

    let idTabla='#tblPagos';
    $('#tblPagos').DataTable({
        data: lista,
        columns:[
            {title:"Monto", data:"Monto"},
            {title:"Total", data:"Total"},
            {title:"Fecha", data:"Fecha"}
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