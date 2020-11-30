$(document).ready(function(){
    $('#frmCapturaLibro').bootstrapValidator({
        fields: {
            txtTitulo:{
                validators:{
                    notEmpty: {
                        message: 'El titulo del libro es un valor necesario'
                    },stringLength: {
                        message: 'El titulo del libro debe tener entre 4 y 50 caracteres',
                        min:4,
                        max:50
                    }
                }
            },
            txtStock: {
                validators: {
                    notEmpty: {
                        message: 'La cantidad en stock del libro es un valor necesario'
                    },between: {
                        message: 'La cantidad de libros debe ser mayor a 0 y menor que 16777215 unidades',
                        min:1,
                        max:16777215
                    }
                }
            },
            flFoto: {
                validators: {
                    notEmpty: {
                        message: 'La foto del libro es un valor necesario'
                    }
                }
            }
        }
    });
});

