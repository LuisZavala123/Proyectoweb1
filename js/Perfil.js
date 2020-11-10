var actual = JSON.parse(localStorage.getItem("Actual"));
var user ={};
$(document).ready(function(){
    
    usuarios =obtenerUsuarios();

    for (let index = 0; index < usuarios.length; index++) {
        if (usuarios[index].id==actual)  {
            user=usuarios[index];
        }
    }

    llenarTabla();

    $("#txtNombre").val(user.nombre);
    $("#txtUsuario").val(user.usuario);
    $("#txtEmail").val(user.email);
    $("#txtDir").val(user.direccion);


    $('#btnActualisarP').click(function(){
        usuarios = obtenerUsuarios();


        
        Us = $('#txtUsuario').val();
        nom = $('#txtNombre').val();
        email = $('#txtEmail').val();
        dir = $('#txtDir').val();


        $("#frmDatos").data('bootstrapValidator').validate();
            if($("#frmDatos").data('bootstrapValidator').isValid()){
                for (let index = 0; index < usuarios.length; index++) {
                    if (usuarios[index].id==actual)  {
                        usuarios[index].nombre=nom;
                        usuarios[index].usuario=Us;
                        usuarios[index].email=email;
                        usuarios[index].direccion=dir;
                    }
                }
                localStorage.setItem("Usuarios",JSON.stringify(usuarios));

        }

    });

    $('#btnActualisarC').click(function(){
        usuarios = obtenerUsuarios();


        
        Passold = $('#passOld').val();
        Pass1 = $('#pass1').val();
        Pass2 = $('#pass2').val();


        $("#frmCon").data('bootstrapValidator').validate();
            if($("#frmCon").data('bootstrapValidator').isValid()){
                let pos =0;
                for (let index = 0; index < usuarios.length; index++) {
                    if (usuarios[index].id==actual)  {
                        pos = index;
                    }
                }

                if (usuarios[pos].pass==Passold&&Passold!=Pass1&&Pass1==Pass2) {
                    usuarios[pos].pass=Pass1;
                    localStorage.setItem("Usuarios",JSON.stringify(usuarios));
                } else if(Passold==Pass1){
                    
                }else if(Pass2!=Pass1){
                    
                }else{

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

function obtenerUsuarios(){
    let lista=[];
    if(localStorage.getItem("Usuarios")!=null){
        lista=JSON.parse(localStorage.getItem("Usuarios"));
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
    lista=obtenerPagos();

    let idTabla='#tblPagos';
    $('#tblPagos').DataTable({
        data: lista,
        columns:[
            
            {title:"Metodo", data:"metodo"},
            {title:"Monto", data:"Monto"},
            {title:"Cantidad", data:"cantidad"},
            {title:"Fecha", data:"fecha"}
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