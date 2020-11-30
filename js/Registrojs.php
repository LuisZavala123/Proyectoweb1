<script>
$(document).ready(function(){
<?php
    
    require_once "DAOS/UsuarioDao.php";
        $dao=new UsuarioDao();
    
    ?>

    $('#btnRegistro').click(function(){
        
        usuarios= <?php echo json_encode($dao->obtenerTodos()); ?>;

        Us = $('#txtUser').val();
        nom = $('#txtNombre').val();
        ap = $('#txtApellido').val();
        dir = $('#txtDir').val();
        Pass = $('#txtPass').val();
        Pass2 = $('#txtPass2').val();
        EsEmpleado =0;
        if ($('#cboxEmpleado').checked) {
            EsEmpleado =1;
        }

        let cus=0;

        $("#frmCaptura").data('bootstrapValidator').validate();
            if($("#frmCaptura").data('bootstrapValidator').isValid()){
                
                for (let index = 0; index < usuarios.length; index++) {
                    if(usuarios[index].Usuario==Us){
                        cus++;
                    }
            }
            if (cus<1&&Pass==Pass2) {
                let obj={};
                obj.Usuario=Us;
                obj.Nombre=nom+" "+ap;
                obj.Direccion=dir;
                obj.Password=Pass;
                obj.EsEmpleado =EsEmpleado;

               window.location.href = window.location.href + "?w1=" + JSON.stringify(obj);

            }
        }

    });

    $('#frmCaptura').bootstrapValidator({
        fields: {
            txtDir:{
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
            },txtUser: {
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

</script>