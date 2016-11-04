$(function() {
    $( "#link-add-branch" ).click(function(){
        // Variables para validación
        var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var cadena = /^([a-zA-Z]+)|([A-Za-z]+)/i;
        var telefono = /^[0-9]*$/;
        
        var branch_description = $( "#link-branch_description" ).val();
        var country = $( "#link-country" ).val();
        var city = $( "#link-city" ).val();
        var postal_code = $( "#link-postal_code" ).val();
        var colony = $( "#link-colony" ).val();
        var state = $( "#link-state" ).val();
        var street = $( "#link-street" ).val();
        var no_ext = $( "#link-no_ext" ).val();
        var no_int = $( "#link-no_int" ).val();

        // Campos de contactos
        var email = $( "#link-email" ).val();
        var phone = $( "#link-phone" ).val();
        var mobile = $( "#link-mobile" ).val();
        var other = $( "#link-other" ).val();

        //Comienzan validaciónes
        var atributos = "";
        var num_errors = 0;

        if( branch_description == "" || !cadena.test(branch_description) ){
            atributos += "<li>Ingresa una Descripción de sucursal válida.</li>";
            num_errors += 1;
        }
        if( country == "" || !cadena.test(country) ){
            atributos += "<li>Selecciona un País válido.</li>";
            num_errors += 1;
        }
        if( city == "" || !cadena.test(city) ){
            atributos += "<li>Selecciona una Ciudad válida.</li>";
            num_errors += 1;
        }
        if( postal_code == "" || !telefono.test(postal_code) ){
            atributos += "<li>Ingresa un Código Postal válido.</li>";
            num_errors += 1;
        }
        if( colony == "" || !cadena.test(colony) ){
            atributos += "<li>Ingresa una Colonia válida.</li>";
            num_errors += 1;
        }
        if( state == "" || !cadena.test(state) ){
            atributos += "<li>Ingresa un Estado válido.</li>";
            num_errors += 1;
        }
        if( street == "" || !cadena.test(street) ){
            atributos += "<li>Ingresa una Calle válida.</li>";
            num_errors += 1;
        }
        if( no_ext == "" || !telefono.test(no_ext) ){
            atributos += "<li>Ingresa un Número Exterior válido.</li>";
            num_errors += 1;
        }
        if( no_int != "" && !telefono.test(no_int) ){
            atributos += "<li>Ingresa un Número Interior válido.</li>";
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
            $('#errors-modal').children().remove();
            $('#errors-modal').append(estructura);
            $('#errors-modal ul').children('li').remove();
            $('#errors-modal ul').append(atributos);
            $('#errors-modal').fadeIn();
        }else{
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
                    document.location.href=direction+'/possible-match/'+id_master+'/link/';
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
});