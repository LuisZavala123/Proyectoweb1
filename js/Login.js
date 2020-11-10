$(document).ready(function(){
    
    $('#btnAceptar').click(function(){
        usuarios = obtenerUsuarios();
        let cor=0;
        let num=0;
        Us = $('#txtUser').val();
        Pass = $('#txtPass').val();
        $("#frmCaptura").data('bootstrapValidator').validate();
            if($("#frmCaptura").data('bootstrapValidator').isValid()){
                debugger;
                for (let index = 0; index < usuarios.length; index++) {
                    if(usuarios[index].usuario==us&&usuarios[index].pass==Pass){
                        cor++;
                        num=index;
                }
            }
            if (cor==1) {
                localStorage.setItem("Actual",JSON.stringify(usuarios[num].id));
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
                        message: 'El Nombre debe tener entre 5 y 100 caracteres',
                        min:5,
                        max:100
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