function DocumentarOpen(social_reason,rfc,branch,id){
    $(function() {
        $('#id').val(id);
        $('#id_customer').text(id);
        $('#social_reason').text(social_reason);
        $('#rfc').text(rfc);
        $('#branch').text(branch);
        $('#id_unique_customer').val(id);
    });
}

function Documentar(){
	var preguide = $('#preguide').val();
    var token = $('#token').val();

    var id = $('#id').val();

	if(preguide == "" || preguide == null){
		var route = direction+"/document/getpreguide";
	}else{
		var route = direction+"/document/setpreguide";
	}

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            preguide: preguide,
        },
        success: function(e){
            if(e["mensaje"] == "SETG"){
                if(e['mensajechamp'] == "Error1"){
                    estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>Web Service no disponible.</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-modal').children().remove();
                    $('#errors-modal').append(estructura);
                    $('#errors-modal ul').children('li').remove();
                    $('#errors-modal ul').append(atributos);
                    $('#errors-modal').fadeIn();
                }else if(e['mensajechamp'] == "Error2"){
                    estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>Usuario existente en Champ.</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-modal').children().remove();
                    $('#errors-modal').append(estructura);
                    $('#errors-modal ul').children('li').remove();
                    $('#errors-modal ul').append(atributos);
                    $('#errors-modal').fadeIn();
                }else{
                    estructura = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>Se asigno la preguía "+ e["numerochamp"] +" al cliente con ID "+ id +".</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-modal').children().remove();
                    $('#errors-modal').append(estructura);
                    $('#errors-modal ul').children('li').remove();
                    $('#errors-modal ul').append(atributos);
                    $('#errors-modal').fadeIn();
                }
            }else{
                if(e['mensajechamp'] == "Error1"){
                    estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>Web Service no disponible.</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-modal').children().remove();
                    $('#errors-modal').append(estructura);
                    $('#errors-modal ul').children('li').remove();
                    $('#errors-modal ul').append(atributos);
                    $('#errors-modal').fadeIn();
                }else if(e['mensajechamp'] == "Error2"){
                    estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>Usuario existente en Champ.</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-modal').children().remove();
                    $('#errors-modal').append(estructura);
                    $('#errors-modal ul').children('li').remove();
                    $('#errors-modal ul').append(atributos);
                    $('#errors-modal').fadeIn();
                }else{
                    estructura = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>Se asigno la preguía "+ e["numerochamp"] +" al cliente con ID "+ id +".</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-modal').children().remove();
                    $('#errors-modal').append(estructura);
                    $('#errors-modal ul').children('li').remove();
                    $('#errors-modal ul').append(atributos);
                    $('#errors-modal').fadeIn();
                }
            }
        },
        error: function(e){
        	console.log(e);
        },
    });
}