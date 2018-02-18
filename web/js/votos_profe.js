    $(document).ready(function () {
        var numeroMaximoVotos = 8;
        var numeroMaximoVotosMuestra = 8;
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

        $(".voto-muestra").click(function(evt){
            var i = 0;
            $('button[status="selected"]').each(function() {
                i++;
            });
            if ((i === numeroMaximoVotosMuestra) && $(this).attr('status') === 'unselected'){
                // Si supera numero de votos y pulsamos otro boton no seleccionado
                $('#myModal').modal('toggle')
            } else {
                var m = $(this).attr('id');
                if ($(this).attr('status') === 'unselected'){
                    $(this).removeClass('btn-danger');
                    $(this).addClass('btn-success');
                    $(this).attr('status', 'selected');
                    $(this).html('Si');
                    $('#muestra-'+m+'').attr('value', '1');
                } else {
                    $(this).removeClass('btn-success');
                    $(this).addClass('btn-danger');
                    $(this).attr('status', 'unselected');
                    $(this).html('No');
                    $('#muestra-'+m+'').attr('value', '0');
                }
            }
        });

        $(".muestra").click(function(evt){
            $('#modalImage').empty();
            $('#modalImageFooter').empty();
            var imagen = $(this).attr("src");
            var id = $(this).attr("id");
            var estado = $("button[id='"+id+"']").attr('status');

            if (estado=="selected"){
                $('#modalImageFooter').append('<p class="text-center"><strong>Votar: </strong></p> <button id="modalImageButton" type="button" class="btn btn-success center-block" style="width: 60px;">Si</button>');
            } else {
                $('#modalImageFooter').append('<p class="text-center"><strong>Votar: </strong></p> <button id="modalImageButton" type="button" class="btn btn-danger center-block" style="width: 60px;">No</button>');
            }

            $('#modalImageButton').click(function(evt){
                if (estado=="selected"){
                    estado = "unselected";
                    $(this).attr('class', 'btn btn-danger center-block');
                    $(this).html('No');

                    $("button[id='"+id+"']").removeClass('btn-success');
                    $("button[id='"+id+"']").addClass('btn-danger');
                    $("button[id='"+id+"']").attr('status', 'unselected');
                    $("button[id='"+id+"']").html('No');
                    $('#muestra-'+id+'').attr('value', '0');
                } else if(estado=="unselected"){
                    estado = "selected";
                    $(this).attr('class', 'btn btn-success center-block');
                    $(this).html('Si');

                    $("button[id='"+id+"']").removeClass('btn-danger');
                    $("button[id='"+id+"']").addClass('btn-success');
                    $("button[id='"+id+"']").attr('status', 'selected');
                    $("button[id='"+id+"']").html('Si');
                    $('#muestra-'+id+'').attr('value', '1');
                }
            });
            $('#modalImage').append("<img class='img-responsive' src='" + imagen + "'>");
            $('#muestraModal').modal('toggle');
        });
    });
