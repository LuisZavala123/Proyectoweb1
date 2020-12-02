<script>
$(document).ready(function(){
    
    

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