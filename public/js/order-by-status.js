$(function() {
	// Función para el ordenar por
    $( "#orderbystatus" ).change(function() {
    	var order = $( "#orderbystatus" ).val();
        var route = direction+'/possible-match?orderbystatus='+order;
	    $.ajax({
            type: 'GET',
            url: route,
            dataType: 'json',
            success: function (data) {
                $('#principalPanel').empty().append($(data)); 
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
	});
});