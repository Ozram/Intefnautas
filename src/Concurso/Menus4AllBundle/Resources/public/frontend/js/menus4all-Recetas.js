$(document).ready(function(){
    
    window.recetaModel = Backbone.Model.extend({
        urlRoot : urlRootDefault+'/recetas'
    });
    
    window.recetaCollection = Backbone.Collection.extend({
        model: window.recetaModel,
        url: urlRootDefault+'/recetas'
    });
    
    window.recetaView = Backbone.View.extend({
              
        initialize: function(){
            this.collection.bind('reset destroy add', this.renderList, this);
        },
        
        el: $('#opcionesRecetas'),  
        
        events: {                        
            "click #crearReceta"  : "crearReceta" ,
            "click #actualizarReceta"  : "actualizarReceta",
            "click #buscarRecetas"  : "actualizarColeccion"
        },                         

        templateList: _.template($('#plantillaRecetaList').html()),

        templateForm: _.template($('#plantillaRecetaForms').html()),

             
              
        crearReceta: function() {
            console.log('recetaView:crearReceta');
            receta = new window.recetaModel();
            that = this;
            
            receta.save({
                nombre: this.$el.find('.receta_nombre').val(),
                descripcion: this.$el.find('.receta_descripcion').val(),
                n_personas: Number($('.receta_n_personas').val())
            },{
                success:function(data, textStatus){
                    console.log(receta.id);
                    that.collection.unshift(receta);
                    $('#formNuevaReceta').hide();
                },
                error: function(jqXHR, textStatus, errorThrown){     
                }
            });
        },
        
        actualizarReceta: function() {
            console.log('recetaView:actualizarReceta');
            var receta = that.collection.get('3');           
            $('#receta_nombre').val(receta.get('nombre'));
            $('#receta_descripcion').val(receta.get('descripcion'));
            $('#receta_n_personas').val(receta.get('n_personas'));   
        },
        
        actualizarColeccion: function() {
            console.log('recetaView:actualizarColeccion');
            that = this;
            this.collection.fetch({
                success: function(collection, response){
                    console.log('recetas.fetch.success');         
                },
                error: function(collection, response){
                    console.log('recetas.fetch.error');
                }
            });    
        },
        buscarRecetasRel: function() {
            console.log('recetaView:buscarRecetasRel');
        },
        
        renderList: function(){
            console.log('recetaView.renderList');
            $('#listaRecetasBusqueda').html(this.templateList({
                recetas: this.collection.toJSON()
            }));
        }
    });
    
});
