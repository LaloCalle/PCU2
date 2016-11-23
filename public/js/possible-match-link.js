$(function() {
    // Función para tener ciudades dependiendo del país seleccionado
    $( "#link-country" ).change(function(event){
        $.get(direction+"/cities/"+event.target.value+"",function(response, state){
            $( "#link-city" ).empty();
            $( "#link-city" ).append("<option>Ciudad</option>");
            for(i=0; i<response.length; i++){
                $( "#link-city" ).append("<option value='"+ response[i].code +"'>"+ response[i].name +"</option>");
            }
        });
    });

    // Función para cambiar el formulario dependiendo del país seleccionado
    $( "#link-country" ).change(function(event){
        var country = event.target.value;
        if(country == "MX"){
            $("#postal_codes_mx").css('display','block');
            $("#postal_codes_other").css('display','none');
        }else{
            $("#postal_codes_mx").css('display','none');
            $("#postal_codes_other").css('display','block');
        }
    });

    // Función para el codigo postal de México
    $( "#link-postal_code_mx" ).keyup(function() {
        var code = $( "#link-postal_code_mx" ).val();

        $.get(direction+"/postal-code-colonies/"+code+"",function(response, postalcodes){
            $( "#link-colony_mx" ).empty();
            $( "#link-colony_mx" ).append("<option>Colonia</option>");

            for(i=0; i<response.length; i++){
                colonias = response[i].colony.split(';');
                for(j=0; j<colonias.length; j++){
                    $( "#link-colony_mx" ).append("<option value='"+ colonias[j] +"'>"+ colonias[j] +"</option>");
                }
            }
        });

        $.get(direction+"/postal-code-state/"+code+"",function(response, state){
            $( "#link-state_mx" ).val("");

            for(i=0; i<response.length; i++){
                $( "#link-state_mx" ).val(response[i].state);
            }
        });
    });

    $( "#link-add-branch" ).click(function(){
        // Variables para validación
        var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var cadena = /^([a-zA-Z]+)|([A-Za-z]+)/i;
        var telefono = /^[0-9]*$/;
        
        var branch_description = $( "#link-branch_description" ).val();
        var country = $( "#link-country" ).val();
        var city = $( "#link-city" ).val();
        if(country == "MX"){
            var postal_code = $( "#link-postal_code_mx" ).val();
            var colony = $( "#link-colony_mx" ).val();
            var state = $( "#link-state_mx" ).val();
        }else{
            var postal_code = $( "#link-postal_code" ).val();
            var colony = $( "#link-colony" ).val();
            var state = $( "#link-state" ).val();
        }
        var street = $( "#link-street" ).val();
        var no_ext = $( "#link-no_ext" ).val();
        var no_int = $( "#link-no_int" ).val();

        // Campos de contactos
        var email = $( "#link-email" ).val();
        var phone = $( "#link-phone" ).val();
        var mobile = $( "#link-mobile" ).val();
        var other = $( "#link-other" ).val();

        var id_master = $( "#id_master" ).val();
        var social_reason = $( "#social_reason" ).val();
        var id_branch = $( "#id_branch" ).val();
        var token = $( "#token" ).val();

        var route = direction+'/possible-match/';

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {
                id_master: id_master,
                social_reason: social_reason,

                id_branch: id_branch,
                branch_description: branch_description,
                country: country,
                city: city,
                postal_code: postal_code,
                colony: colony,
                state: state,
                street: street,
                no_ext: no_ext,
                no_int: no_int,

                email: email,
                phone: phone,
                mobile: mobile,
                other: other,
            },
            success: function(e){
                if(e['mensaje'] == "Match"){
                    estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                    var atributos = "<li>"+ e['alerta'] +"</li>";

                    $('body,html').animate({scrollTop : 0}, 0);
                    $('#errors-json').children().remove();
                    $('#errors-json').append(estructura);
                    $('#errors-json ul').children('li').remove();
                    $('#errors-json ul').append(atributos);
                    $('#errors-json').fadeIn();
                }else{
                    if(e['mensajechamp'] == "Error1"){
                        estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                        var atributos = "<li>Web Service no disponible.</li>";

                        $('body,html').animate({scrollTop : 0}, 0);
                        $('#errors-json').children().remove();
                        $('#errors-json').append(estructura);
                        $('#errors-json ul').children('li').remove();
                        $('#errors-json ul').append(atributos);
                        $('#errors-json').fadeIn();
                    }else if(e['mensajechamp'] == "Error2"){
                        estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                        var atributos = "<li>Usuario existente en Champ.</li>";

                        $('body,html').animate({scrollTop : 0}, 0);
                        $('#errors-json').children().remove();
                        $('#errors-json').append(estructura);
                        $('#errors-json ul').children('li').remove();
                        $('#errors-json ul').append(atributos);
                        $('#errors-json').fadeIn();
                    }else{
                        document.location.href=direction+'/possible-match/'+id_master+'/link/';
                    }
                }
            },
            error: function(e){
                console.log(e);

                var cadena = e["responseText"];
                var valores = JSON.parse(cadena);

                estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                var atributos = "";
                if(valores["branch_description"])
                    atributos += "<li>"+valores["branch_description"]+"</li>";
                if(valores["country"])
                    atributos += "<li>"+valores["country"]+"</li>";
                if(valores["city"])
                    atributos += "<li>"+valores["city"]+"</li>";
                if(valores["postal_code"])
                    atributos += "<li>"+valores["postal_code"]+"</li>";
                if(valores["colony"])
                    atributos += "<li>"+valores["colony"]+"</li>";
                if(valores["state"])
                    atributos += "<li>"+valores["state"]+"</li>";
                if(valores["street"])
                    atributos += "<li>"+valores["street"]+"</li>";
                if(valores["no_ext"])
                    atributos += "<li>"+valores["no_ext"]+"</li>";
                if(valores["no_int"])
                    atributos += "<li>"+valores["no_int"]+"</li>";
                if(valores["email"])
                    atributos += "<li>"+valores["email"]+"</li>";
                if(valores["phone"])
                    atributos += "<li>"+valores["phone"]+"</li>";
                if(valores["mobile"])
                    atributos += "<li>"+valores["mobile"]+"</li>";
                if(valores["other"])
                    atributos += "<li>"+valores["other"]+"</li>";

                $('body,html').animate({scrollTop : 0}, 0);
                $('#errors-modal').children().remove();
                $('#errors-modal').append(estructura);
                $('#errors-modal ul').children('li').remove();
                $('#errors-modal ul').append(atributos);
                $('#errors-modal').fadeIn();
            }
        });
    });
});