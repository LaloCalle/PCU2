$(function() {
    // Función para tener ciudades dependiendo del país seleccionado
    $( "#create-country" ).change(function(event){
        $.get(direction+"/cities/"+event.target.value+"",function(response, state){
            $( "#create-city" ).empty();
            $( "#create-city" ).append("<option>Ciudad</option>");
            for(i=0; i<response.length; i++){
                $( "#create-city" ).append("<option value='"+ response[i].code +"'>"+ response[i].name +"</option>");
            }
        });
    });

    // Función para cambiar el formulario dependiendo del país seleccionado
    $( "#create-country" ).change(function(event){
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
    $( "#create-postal_code_mx" ).keyup(function() {
        var code = $( "#create-postal_code_mx" ).val();

        $.get(direction+"/postal-code-colonies/"+code+"",function(response, postalcodes){
            $( "#create-colony_mx" ).empty();
            $( "#create-colony_mx" ).append("<option>Colonia</option>");

            for(i=0; i<response.length; i++){
                colonias = response[i].colony.split(';');
                for(j=0; j<colonias.length; j++){
                    $( "#create-colony_mx" ).append("<option value='"+ colonias[j] +"'>"+ colonias[j] +"</option>");
                }
            }
        });

        $.get(direction+"/postal-code-state/"+code+"",function(response, state){
            $( "#create-state_mx" ).val("");

            for(i=0; i<response.length; i++){
                $( "#create-state_mx" ).val(response[i].state);
            }
        });
    });
});

$(function() {
    $( "#master-create" ).click(function(){
        // Variables para validación
        var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var cadena = /^([a-zA-Z]+)|([A-Za-z]+)/i;
        var telefono = /^[0-9]*$/;
        
        // Campos de compañía
        var social_reason = $( "#create-social_reason" ).val();
        var rfc = $( "#create-rfc" ).val();

        // Campos de sucursal
        var branch_description = $( "#create-branch_description" ).val();
        var country = $( "#create-country" ).val();
        var city = $( "#create-city" ).val();
        if(country == "MX"){
            var postal_code = $( "#create-postal_code_mx" ).val();
            var colony = $( "#create-colony_mx" ).val();
            var state = $( "#create-state_mx" ).val();
        }else{
            var postal_code = $( "#create-postal_code" ).val();
            var colony = $( "#create-colony" ).val();
            var state = $( "#create-state" ).val();
        }
        var street = $( "#create-street" ).val();
        var no_ext = $( "#create-no_ext" ).val();
        var no_int = $( "#create-no_int" ).val();

        // Campos de contactos
        var email = $( "#create-email" ).val();
        var phone = $( "#create-phone" ).val();
        var mobile = $( "#create-mobile" ).val();
        var other = $( "#create-other" ).val();

        var token = $( "#token" ).val();
        var route = direction+'/master-record/store-customer';

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {
                social_reason: social_reason,
                rfc: rfc,

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
                        document.location.href=direction+'/';
                    }
                }
            },
            error: function(e){
                console.log(e);

                var cadena = e["responseText"];
                var valores = JSON.parse(cadena);

                estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

                var atributos = "";
                if(valores["social_reason"])
                    atributos += "<li>"+valores["social_reason"]+"</li>";
                if(valores["rfc"])
                    atributos += "<li>"+valores["rfc"]+"</li>";
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
                $('#errors-json').children().remove();
                $('#errors-json').append(estructura);
                $('#errors-json ul').children('li').remove();
                $('#errors-json ul').append(atributos);
                $('#errors-json').fadeIn();
            }
        });
    });
});