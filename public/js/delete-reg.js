function Mostrar(id, name){
    $(function() {
        $('#name').text(name);
        $('#eliminar').val(id);
        $('#id').val(id);
    });
}

function EliminarUsuario(btn){
    var route = direction+"/users/"+btn.value+"";
    var token = $('#token').val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(){
            document.location.href=direction+'/users';
        }
    });
}