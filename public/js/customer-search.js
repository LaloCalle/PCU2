$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
$(function() {
	// Función para los filtros
    $( "#search-name" ).keyup(function() {
    	searchFilter();
	});
    $( "#search-rfc" ).keyup(function() {
    	searchFilter();
	});
    $( "#search-address" ).keyup(function() {
        searchFilter();
    });
    $( "#search-contact" ).keyup(function() {
        searchFilter();
    });
});

function searchFilter(){
	var name = $( "#search-name" ).val();
	var rfc = $( "#search-rfc" ).val();
    var address = $( "#search-address" ).val();
    var contact = $( "#search-contact" ).val();
    var route = direction+'/?name='+name+'&rfc='+rfc+'&address='+address+'&contact='+contact;
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
}