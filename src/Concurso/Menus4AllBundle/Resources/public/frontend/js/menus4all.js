$(document).ready(function(){
    window.recetaModel = Backbone.Model.extend({
        urlRoot : '/intefnautas/web/app_dev.php/recetas'
    });
    
    window.proyectoDocumentacionCollection = Backbone.Collection.extend({
        model: window.recetaModel,
        url: '/intefnautas/web/app_dev.php/recetas'
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
    

    
    window.listarRecRel = Backbone.View.extend({

        el: $('#opcionesRecetas'),               

        events: {                        
            "click #buscarRecetas"  : "buscarRecetasRel"                
        },                


        buscarRecetasRel: function(e) {
            console.log('listarRecRel:buscarRecetasRel');

            receta = new window.recetaModel();
            
        }
    });
    
    formNuevaReceta = new window.formNuevaReceta();
    
    listarRecRel = new window.listarRecRel();

    
    
});
