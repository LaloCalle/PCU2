$('input[name="p_all"]').on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true){
        $('input[name="p_superadmin"]').bootstrapSwitch('state', true, true);
        $('input[name="p_admin"]').bootstrapSwitch('state', true, true);
        $('input[name="p_document"]').bootstrapSwitch('state', true, true);
    }else{
        $('input[name="p_superadmin"]').bootstrapSwitch('state', false, false);
        $('input[name="p_admin"]').bootstrapSwitch('state', false, false);
        $('input[name="p_document"]').bootstrapSwitch('state', false, false);
    }
});