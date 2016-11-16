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
    $( "#search-id-unique-customer" ).keyup(function() {
        searchFilter();
    });
    $( "#search-branch-description" ).keyup(function() {
        searchFilter();
    });
    $( "#search-contact" ).keyup(function() {
        searchFilter();
    });
    $( "#search-country" ).keyup(function() {
        searchFilter();
    });
    $( "#search-city" ).keyup(function() {
        searchFilter();
    });
    $( "#search-state" ).keyup(function() {
        searchFilter();
    });
    $( "#search-postal-code" ).keyup(function() {
        searchFilter();
    });
    $( "#search-colony" ).keyup(function() {
        searchFilter();
    });
    $( "#search-street" ).keyup(function() {
        searchFilter();
    });
    $( "#search-no-ext" ).keyup(function() {
        searchFilter();
    });
    $( "#search-no-int" ).keyup(function() {
        searchFilter();
    });
});

function searchFilter(){
	var name = $( "#search-name" ).val();
	var rfc = $( "#search-rfc" ).val();
    var iduniquecustomer = $( "#search-id-unique-customer" ).val();
    var branchdescription = $( "#search-branch-description" ).val();
    var contact = $( "#search-contact" ).val();
    var country = $( "#search-country" ).val();
    var city = $( "#search-city" ).val();
    var state = $( "#search-state" ).val();
    var postalcode = $( "#search-postal-code" ).val();
    var colony = $( "#search-colony" ).val();
    var street = $( "#search-street" ).val();
    var noext = $( "#search-no-ext" ).val();
    var noint = $( "#search-no-int" ).val();

    var route = direction+'/customer-search?name='+name+'&rfc='+rfc+'&iduniquecustomer='+iduniquecustomer+'&branchdescription='+branchdescription+'&contact='+contact+'&country='+country+'&city='+city+'&state='+state+'&postalcode='+postalcode+'&colony='+colony+'&street='+street+'&noext='+noext+'&noint='+noint;
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