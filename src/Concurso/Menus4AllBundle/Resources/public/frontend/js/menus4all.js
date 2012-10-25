$(document).ready(function(){
    
    window.recetaModel = Backbone.Model.extend({
        urlRoot : urlRootDefault+'/recetas'
    });
    
    window.recetaCollection = Backbone.Collection.extend({
        model: window.recetaModel,
        url: urlRootDefault+'/recetas'
    });
    
    window.formNuevaReceta = Backbone.View.extend({

        el: $('#formNuevaReceta'),               

        events: {                        
            "click #crearReceta"  : "crearReceta"            
        },                

        template: _.template($('#plantillaRecetaFormNueva').html()),
        
        crearReceta: function(e) {
            console.log('formNuevaReceta:crearReceta');

            receta = new window.recetaModel();
            that = this;
            receta.save({
                nombre: this.$el.find('.receta_nombre').val(),
                descripcion: this.$el.find('.receta_descripcion').val(),
                n_personas: Number($('.receta_n_personas').val())
            },{
                success:function(data, textStatus){
                    console.log(receta.id);
                    that.collection.add(receta);

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
        
        template: _.template($('#plantillaRecetaFormNueva').html()),
        
        actualizarReceta: function(e) {
            console.log('formEditarReceta:actualizarReceta');
            that = this;
            this.collection.fetch({
                success: function(collection, response){
                    console.log('recetas.fetch.success');
                    var receta = that.collection.get('3');           
                    $('#receta_nombre').val(receta.get('nombre'));
                    $('#receta_descripcion').val(receta.get('descripcion'));
                    $('#receta_n_personas').val(receta.get('n_personas'));
                    $('#listaRecetasBusqueda').html(that.template({
                        recetas: that.collection.toJSON()
                    }));
                },
                error: function(collection, response){
                    
                    console.log('recetas.fetch.error');

                }
            });    
        }
    });
    
    window.listarRecRel = Backbone.View.extend({

        el: $('#opcionesRecetas'),               

        events: {                        
            "click #buscarRecetas"  : "buscarRecetasRel"
        },                

        template: _.template($('#plantillaRecetaFormNueva').html()),

        buscarRecetasRel: function(e) {
            console.log('formEditarReceta:actualizarReceta');
            that = this;
            this.collection.fetch({
                success: function(collection, response){
                    console.log('recetas.fetch.success');
                    var receta = that.collection.get('3');           
                    $('#receta_nombre').val(receta.get('nombre'));
                    $('#receta_descripcion').val(receta.get('descripcion'));
                    $('#receta_n_personas').val(receta.get('n_personas'));
                    $('#listaRecetasBusqueda').html(that.template({
                        recetas: that.collection.toJSON()
                    }));
                },
                error: function(collection, response){
                    
                    console.log('recetas.fetch.error');

                }
            });    
        }
    });
    
    window.appRouter = Backbone.Router.extend({
   
        template: _.template($('#plantillaRecetaFormNueva').html()),
        initialize: function(){
       
            console.log('window.app.initialize');
                
            this.recetaCollection = new window.recetaCollection();
            that = this;
            this.recetaCollection.fetch({
                success: function(collection, response){
                    console.log('recetas.fetch.success');
                    $('#listaRecetasBusqueda').html(that.template({
                        recetas: that.recetaCollection.toJSON()
                    }));
                },
                error: function(collection, response){
                    
                    console.log('recetas.fetch.error');

                }
            }); 
            this.formNuevaReceta = new window.formNuevaReceta({
                collection:  this.recetaCollection
            });
            this.formEditarReceta = new window.formEditarReceta({
                collection:  this.recetaCollection
            });
            this.listarRecRel = new window.listarRecRel({
                collection:  this.recetaCollection
            });
            
        }
   
    });
    
    var menus4all = new window.appRouter;
    
});
