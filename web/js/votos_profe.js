    $(document).ready(function () {
        var numeroMaximoVotos = 5;
        $(".voto").click(function(evt){
            var i = 0;
            $('button[status="selected"]').each(function() {
                i++;
            });
            if ((i === numeroMaximoVotos) && $(this).attr('status') === 'unselected'){
                // Si supera numero de votos y pulsamos otro boton no seleccionado
                $('#myModal').modal('toggle')
            } else {
                var profe = $(this).attr('id');
                if ($(this).attr('status') === 'unselected'){
                    $(this).removeClass('btn-danger');
                    $(this).addClass('btn-success');
                    $(this).attr('status', 'selected');
                    $(this).html('Si');
                    $('#profe-'+profe+'').attr('value', '1');
                } else {
                    $(this).removeClass('btn-success');
                    $(this).addClass('btn-danger');
                    $(this).attr('status', 'unselected');
                    $(this).html('No');
                    $('#profe-'+profe+'').attr('value', '0');
                }
            }
        });

        // $("#botonPedido").click(function(evt){
        //     $('#myModal').modal('toggle')
        // });
    });
