/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   
    window.recetaModel = Backbone.Model.extend({
        urlRoot: urlRootDefault + "recetas"
    });
   
    window.recetaCollection = Backbone.Collection.extend({
        model: window.recetaModel,
        url: urlRootDefault + "recetas"
    });
   
   
    window.recetaView = Backbone.View.extend({
        initialize: function(){
            console.log('view.inicializado');
        },
       
        events: {
            
        },
        templateList: _.template($('#plantillaListRecetasMovil').html()),
       
        el: $('#seccionPrincipal'),
        
        listarRecetas: function(){
            console.log('view.listarRecteas');
            that=this;
            this.collection.fetch({
                success: function(collection, response){
                    console.log('xxxxxxxxdfz');
                    that.$el.html(that.templateList({
                        recetas: that.collection.toJSON()
                    }));
                },
                error: function(collection, response){
                    console.log('view.peta');
                    
                }
            })
        }
        
    });
    
    window.recetaRouter = Backbone.Router.extend({
        

        
        routes: {
            "recetas/listarRecetas" : "listarRecetas"
        },
        
        initialize: function(){
            this.recetaCollection = new window.recetaCollection();
            this.vistaListaRecetas = new window.recetaView({
                collection: this.recetaCollection
            });
        },
        
        listarRecetas: function(){
            console.log('router.listarRecteas');
            this.vistaListaRecetas.listarRecetas();  
        }
        
    });
   
   
});

