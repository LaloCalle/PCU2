$(document).ready(function() {
    // Código para poner en movimiento el progressbar
    $( "#progressbar" ).progressbar({
        value: false
    });
});
$(function() {
    //Acción al presionar el botón Aceptar
    $("#extract-button").click(function(){
    	var route = direction+'/extract-process';
        $.ajax({
        	url: route,
        	type: 'GET',
        	dataType: 'json',
			success: function(e){
				// Proceso correcto.
                $('#total-registros').append('<p>Se realizo un extract de '+e['totalRegistros']+' registros.</p>');

                var registros = parseInt(e['totalRegistros']);
                route = direction+'/match-process';
                var token = $('#token').val();
                
                for(var i = 1; i <= registros; i++){
                    porcentaje = (i*100)/registros;
                    porcentaje = Math.floor(porcentaje);
                    $.ajax({
                        async:false,
                        url: route,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            indice: i,
                        },
                        success: function(e){
                            console.log(e['resultado']);
                            $('#total-match p').remove();
                            $('#total-match').append('<p>'+ i +' registros procesados de '+ registros +'.</p>');
                            $( "#progressbar" ).progressbar({
                                value: porcentaje,
                                change: function() {
                                    $( ".progress-label" ).text( $( "#progressbar" ).progressbar( "value" ) + "%" );
                                },
                                complete: function() {
                                    $( ".progress-label" ).text("");
                                }
                            });
                        },
                        error: function(e){
                            console.log(e);
                        }
                    });
                }
                document.location.href=direction+'/';
			},
        	error: function(e){
        		console.log(e);
        	}
        });
    });
});