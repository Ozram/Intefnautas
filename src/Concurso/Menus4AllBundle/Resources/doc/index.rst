        var thing = {nombre: 'jquery', descripcion: 'cocinemos con jquery', n_personas: '3'};
        var encoded = $.toJSON( thing );
        jQuery.ajax({
            type:'POST',
            dataType:'json',
            data:{
                json: encoded
            },
            success:function(data, textStatus){
                data = jQuery.parseJSON(data);
                jQuery('#pruebajson').html(data.success.message);
            },
            error: function(jqXHR, textStatus, errorThrown){            
                data = jQuery.parseJSON(jqXHR.responseText);
                jQuery('#pruebajson').html(data.error.message);
            },
            url: '{{ url('cm4all_recetas_post') }}'
        });

    $('#crearReceta').click(function(){
        jQuery.ajax({
            type:'POST',
            dataType:'json',
            data: $("#miformulario").serializeArray(),
            success:function(data, textStatus){
                $('#exitosReceta').show();
            },
            error: function(jqXHR, textStatus, errorThrown){
                var coleccionErrores = jQuery.parseJSON(jqXHR.responseText);
                listErrors = recorreNotificaciones(coleccionErrores.error.messages);
                $('#listErrorsNueva').html(listErrors);
                $('#erroresReceta').show();
            },
            url: '{{ url('cm4all_recetas_post') }}'
        });
    });
        $('#anadirReceta').click(function(){
            jQuery.ajax({
                type:'POST',
                dataType:'html',
                data:{
                },
                success:function(data, textStatus){
                    jQuery('#pruebajson').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown){          
                },
                url: '{{ url('cm4all_recetas_formNueva') }}'
            });
        });