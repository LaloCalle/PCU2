$(function() {
    // Progressbar de complete
	var porcentaje = $( ".progress-label" ).text();
	$( "#progressbar-complete" ).progressbar({
    	value: porcentaje,
    });
	$( ".ui-progressbar-value" ).css( "width",porcentaje );
	$( ".ui-progressbar-value" ).css( "display","block" );

    // Función para tener ciudades dependiendo del país seleccionado
    $( "#edit-country" ).change(function(event){
        $.get(direction+"/cities/"+event.target.value+"",function(response, state){
            $( "#edit-city" ).empty();
            $( "#edit-city" ).append("<option>Ciudad</option>");
            for(i=0; i<response.length; i++){
                $( "#edit-city" ).append("<option value='"+ response[i].code +"'>"+ response[i].name +"</option>");
            }
        });
    });

    // Función para cambiar el formulario a seleccion de CP existentes si es México
    var country_selected = $( "#edit-country" ).val();
    if(country_selected == "MX"){
        $("#postal_codes_mx").css('display','block');
        $("#postal_codes_other").css('display','none');

        var code = $( "#edit-postal_code_mx" ).val();
        $.get(direction+"/postal-code-colonies/"+code+"",function(response, postalcodes){
            $( "#edit-colony_mx" ).empty();
            $( "#edit-colony_mx" ).append("<option>Colonia</option>");

            for(i=0; i<response.length; i++){
                colonias = response[i].colony.split(';');
                for(j=0; j<colonias.length; j++){
                    $( "#edit-colony_mx" ).append("<option value='"+ colonias[j] +"'>"+ colonias[j] +"</option>");
                }
            }

            $( "#edit-colony_mx" ).val($( "#edit-colony" ).val());
        });

        $.get(direction+"/postal-code-state/"+code+"",function(response, state){
            $( "#edit-state_mx" ).val("");

            for(i=0; i<response.length; i++){
                $( "#edit-state_mx" ).val(response[i].state);
            }
        });
    }

    // Función para cambiar el formulario dependiendo del país seleccionado
    $( "#edit-country" ).change(function(event){
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
    $( "#edit-postal_code_mx" ).keyup(function() {
        var code = $( "#edit-postal_code_mx" ).val();

        $.get(direction+"/postal-code-colonies/"+code+"",function(response, postalcodes){
            $( "#edit-colony_mx" ).empty();
            $( "#edit-colony_mx" ).append("<option>Colonia</option>");

            for(i=0; i<response.length; i++){
                colonias = response[i].colony.split(';');
                for(j=0; j<colonias.length; j++){
                    $( "#edit-colony_mx" ).append("<option value='"+ colonias[j] +"'>"+ colonias[j] +"</option>");
                }
            }
        });

        $.get(direction+"/postal-code-state/"+code+"",function(response, state){
            $( "#edit-state_mx" ).val("");

            for(i=0; i<response.length; i++){
                $( "#edit-state_mx" ).val(response[i].state);
            }
        });
    });
});

$(function() {
    $( "#edit-update" ).click(function(){
        // Variables para validación
        var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var cadena = /^([a-zA-Z]+)|([A-Za-z]+)/i;
        var telefono = /^[0-9]*$/;
        
        // Campos de compañía
        var social_reason = $( "#edit-social_reason" ).val();
        var rfc = $( "#edit-rfc" ).val();

        // Campos de sucursal
        var id_unique_customer = $( "#edit-id_unique_customer" ).val();
        var branch_description = $( "#edit-branch_description" ).val();
        var country = $( "#edit-country" ).val();
        var city = $( "#edit-city" ).val();
        if(country == "MX"){
            var postal_code = $( "#edit-postal_code_mx" ).val();
            var colony = $( "#edit-colony_mx" ).val();
            var state = $( "#edit-state_mx" ).val();
        }else{
            var postal_code = $( "#edit-postal_code" ).val();
            var colony = $( "#edit-colony" ).val();
            var state = $( "#edit-state" ).val();
        }
        var street = $( "#edit-street" ).val();
        var no_ext = $( "#edit-no_ext" ).val();
        var no_int = $( "#edit-no_int" ).val();

        // Campos de contactos
        var email = $( "#edit-email" ).val();
        var phone = $( "#edit-phone" ).val();
        var mobile = $( "#edit-mobile" ).val();
        var other = $( "#edit-other" ).val();

        var id_master = $( "#id_master" ).val();
        var id_branch = $( "#id_branch" ).val();
        var token = $( "#token" ).val();
        var url = $( "#url" ).val();

        var route = direction+'/'+url+'/'+id_master;

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                id_master: id_master,
                social_reason: social_reason,
                rfc: rfc,

                id_branch: id_branch,
                id_unique_customer: id_unique_customer,
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
                document.location.href=direction+'/'+url+'/'+id_branch+'/edit/';
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
                if(valores["id_unique_customer"])
                    atributos += "<li>"+valores["id_unique_customer"]+"</li>";
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