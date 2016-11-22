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
		var routepreguide = "http://webservices.champ.aero/CHAMPTT_WS/indexGET.php?inpRTCL=&inpORIG=&inpDEST=&inpTPCS=1&inpAWGT=1&inpDESC=&inpSHC1=&inpSHC2=&inpSHC3=&inpSHC4=&inpSHC5=&inpSHC6=&inpSHC7=&inpSHC8=&inpSHC9=&inpAGNM="+ id +"&inpAGAN=&inpCOMM=&inpDECV=&inpREMK=&inpSHNM=&inpSHAD=&inpSHCO=&inpSHST=&inpSHTL=&inpSHCI=&inpSHCN=&inpSHZP=&inpSHEM=&inpSHRF=&inpCNNM=&inpCNAD=&inpCNCO=&inpCNST=&inpCNTL=&inpCNCI=&inpCNCN=&inpCNZP=&inpQOTN=&inpCHCD=&inpUNWT=&inpCHGW=0&inpCURR=&inpMCC1=&inpMCA1=&inpMCC2=&inpMCA2=&inpMCC3=&inpMCA3=&inpMCC4=&inpMCA4=&inpMCC5=&inpMCA5=&frmSubm=submit";
	}else{
		var route = direction+"/document/setpreguide";
		var routepreguide = "http://webservices.champ.aero/CHAMPTT_WS/indexGET.php?inpRTCL=&inpORIG=&inpDEST=&inpTPCS=&inpAWGT=&inpDESC=&inpSHC1=&inpSHC2=&inpSHC3=&inpSHC4=&inpSHC5=&inpSHC6=&inpSHC7=&inpSHC8=&inpSHC9=&inpAGNM="+ id +"&inpAGAN=&inpCOMM=&inpDECV=&inpREMK=&inpSHNM=&inpSHAD=&inpSHCO=&inpSHST=&inpSHTL=&inpSHCI=&inpSHCN=&inpSHZP=&inpSHEM=&inpSHRF=&inpCNNM=&inpCNAD=&inpCNCO=&inpCNST=&inpCNTL=&inpCNCI=&inpCNCN=&inpCNZP=&inpQOTN="+ preguide +"&inpCHCD=&inpUNWT=&inpCHGW=0&inpCURR=&inpMCC1=&inpMCA1=&inpMCC2=&inpMCA2=&inpMCC3=&inpMCA3=&inpMCC4=&inpMCA4=&inpMCC5=&inpMCA5=&frmSubm=submit";
	}

    $.ajax({
        url: routepreguide,
        type: 'GET',
        dataType: 'json',
        success: function(e){
        	console.log(e);
        	/*
        	if(preguide == "" || preguide == null){
        		preguide = e["preguide"];
        	}
        	*/
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
		        	// Mensaje de pregúia creada y asignada al cliente.
		        },
		        error: function(e){
		        	console.log(e);
		        },
		    });
        },
        error: function(e){
        	console.log(e);
        },
    });
}