<script>
$(document).ready(function(){
    <?php
    require_once "DAOS/UsuarioDao.php";
        $dao=new UsuarioDao();
    ?>
    $('#btnAceptar').click(function(){
        
        usuarios = <?php echo json_encode($dao->obtenerTodos()); ?>;
        let cor=0;
        let num=0;
        us = $('#txtUser').val();
        Pass = $('#txtPass').val();
        $("#frmCaptura").data('bootstrapValidator').validate();
            if($("#frmCaptura").data('bootstrapValidator').isValid()){
                
                for (let index = 0; index < usuarios.length; index++) {
                    if(usuarios[index].Usuario==us&&usuarios[index].Password==Pass){
                        cor++;
                        num=index;
                }
            }
            if (cor==1) {
                debugger;
                <?php
                $_SESSION["Correcto"]="si";
                ?>
                window.location.href = window.location.href + "?w1=" + usuarios[num].Nombre + "&w2=" + usuarios[num].EsEmpleado;
                
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
                        message: 'La contraseña debe tener entre 2 y 100 caracteres',
                        min:2,
                        max:100
                    }
                }
            }
        }

    });

});


</script>