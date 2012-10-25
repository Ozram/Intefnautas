$(document).ready(function(){
    window.recetaModel = Backbone.Model.extend({
        urlRoot : '/Intefnautas/web/app_dev.php/recetas'
    });
    window.formNuevaReceta = Backbone.View.extend({

        el: $('#formNuevaReceta'),               

        events: {                        
            "click #crearReceta"  : "crearReceta"                
        },                


        crearReceta: function(e) {
            console.log('formNuevaReceta:crearReceta');

            receta = new window.recetaModel();
            
            receta.save({
                nombre: $('#receta_nombre').val(),
                descripcion: $('#receta_descripcion').val(),
                n_personas: Number($('#receta_n_personas').val())
            },{
                success:function(data, textStatus){
                    console.log(receta.id);
                    $('#formNuevaReceta').hide();
                },
                error: function(jqXHR, textStatus, errorThrown){     
                }
            });
        }
    });
    
    window.formEditarReceta = Backbone.View.extend({

        el: $('#formEditarReceta'),               

        events: {                        
            "click #actualizarReceta"  : "actualizarReceta"                
        },                


        actualizarReceta: function(e) {
            console.log('formEditarReceta:actualizarReceta');

            receta = new window.recetaModel();
            
            receta.save({
                nombre: $('#receta_nombre').val(),
                descripcion: $('#receta_descripcion').val(),
                n_personas: Number($('#receta_n_personas').val())
            },{
                success:function(data, textStatus){
                    console.log(receta.id);
                    $('#formNuevaReceta').hide();
                },
                error: function(jqXHR, textStatus, errorThrown){     
                }
            });
        }
    });
    
    
    
    formNuevaReceta = new window.formNuevaReceta();
});