$(document).ready(function(){


    $('#btnRegistro').click(function(){
        usuarios = obtenerUsuarios();

        Us = $('#txtUser').val();
        nom = $('#txtNombre').val();
        ap = $('#txtApellido').val();
        email = $('#txtEmail').val();
        Pass = $('#txtPass').val();
        Pass2 = $('#txtPass2').val();

        let cus=0;
        let cem=0;

        $("#frmCaptura").data('bootstrapValidator').validate();
            if($("#frmCaptura").data('bootstrapValidator').isValid()){
                debugger;
                for (let index = 0; index < usuarios.length; index++) {
                    if(usuarios[index].usuario==us){
                        cus++;
                    }
                    if(usuarios[index].email==email){
                        cem++;
                    }
            }
            if (cus<1&&cem<1&&Pass==Pass2) {
                let obj={};
                obj.id=usuarios.length+1;
                obj.usuario=us;
                obj.nombre=nom+" "+ap;
                obj.email=email;
                obj.pass=Pass;
                obj.direccion="";

                usuarios.push(obj);

                localStorage.setItem("Actual",JSON.stringify(obj.id));

                localStorage.setItem("Usuarios",JSON.stringify(usuarios));
            }else if(cus>0){

            }else if(cem>0){
                
            }else{
                
            }
        }

    });

    $('#frmCaptura').bootstrapValidator({
        fields: {
            txtUser:{
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
            },txtApellido:{
                validators:{
                    notEmpty: {
                        message: 'El Apellido es un valor necesario'
                    },stringLength: {
                        message: 'El Apellido debe tener entre 5 y 100 caracteres',
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
              },
            txtPass: {
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
            txtPass2: {
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