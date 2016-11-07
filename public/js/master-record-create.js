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

        //Comienzan validaciónes
        var atributos = "";
        var num_errors = 0;

        
        if( social_reason == "" ){
            atributos += "<li>Ingresa un Nombre o Razón Social válido.</li>";
            num_errors += 1;
        }
        if( rfc == "" ){
            atributos += "<li>Ingresa RFC válido.</li>";
            num_errors += 1;
        }

        if( branch_description == "" ){
            atributos += "<li>Ingresa una Descripción de sucursal válida.</li>";
            num_errors += 1;
        }
        if( country == "" || country == "País" ){
            atributos += "<li>Selecciona un País válido.</li>";
            num_errors += 1;
        }
        if( city == "" || city == "Ciudad" ){
            atributos += "<li>Selecciona una Ciudad válida.</li>";
            num_errors += 1;
        }
        if( postal_code == "" || !telefono.test(postal_code) ){
            atributos += "<li>Ingresa un Código Postal válido.</li>";
            num_errors += 1;
        }
        if( colony == "" || colony == "Colonia" ){
            atributos += "<li>Ingresa una Colonia válida.</li>";
            num_errors += 1;
        }
        if( state == "" ){
            atributos += "<li>Ingresa un Estado válido.</li>";
            num_errors += 1;
        }
        if( street == "" ){
            atributos += "<li>Ingresa una Calle válida.</li>";
            num_errors += 1;
        }
        if( no_ext == "" ){
            atributos += "<li>Ingresa un Número Exterior válido.</li>";
            num_errors += 1;
        }

        if( email == "" || !emailreg.test(email) ){
            atributos += "<li>Ingresa un E-mail válido.</li>";
            num_errors += 1;
        }
        if( phone == "" || !telefono.test(phone) ){
            atributos += "<li>Ingresa un Teléfono válido.</li>";
            num_errors += 1;
        }
        if( mobile != "" && !telefono.test(mobile) ){
            atributos += "<li>Ingresa un Móvil válido.</li>";
            num_errors += 1;
        }

        if(num_errors > 0){
            estructura = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><ul></ul></div>";

            $('body,html').animate({scrollTop : 0}, 0);
            $('#errors-json').children().remove();
            $('#errors-json').append(estructura);
            $('#errors-json ul').children('li').remove();
            $('#errors-json ul').append(atributos);
            $('#errors-json').fadeIn();
        }else{
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
                    document.location.href=direction+'/';
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
});