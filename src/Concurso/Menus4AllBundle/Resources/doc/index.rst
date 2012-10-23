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