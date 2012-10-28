$(document).ready(function(){
    
    window.recetaModel = Backbone.Model.extend({
        urlRoot: "app_dev.php/recetas"
    });
    
    window.recetaCollection = Backbone.Collection.extend({
        model: window.recetaModel,
        url: "app_dev.php/recetas"
    });
    
    window.recetaView = Backbone.View.extend({
              
        initialize: function(){
            this.collection.bind('reset destroy add', this.renderList, this);
        },
        
        el: $('#seccionRecetas'),  
        
        events: {
            "click #nuevaReceta"  : "nuevaReceta" ,
            "click .editarReceta"  : "editarReceta",
            "click #crearReceta"  : "crearReceta" ,
            "click #actualizarReceta"  : "actualizarReceta",
            "click #buscarRecetas"  : "actualizarColeccion",
            "click #anadirIngrediente": "anadirIngrediente"

        },                         

        templateList: _.template($('#plantillaRecetaList').html()),

        templateForm: _.template($('#plantillaRecetaForms').html()),
        
        templateOpciones: _.template($('#plantillaRecetaOpciones').html()),
        
        templateMensajes: _.template($('#plantillaMensajes').html()),
        
        templateIngredientes: _.template($('#plantillaIngredientes').html()),
        
        
        nuevaReceta: function() {
            console.log('recetaView:nuevaReceta');
            this.data = {
                'receta': '' , 
                'idAccion': 'crearReceta'
            };
            that = this;
            $('#listaRecetasBusqueda').html(this.templateForm({
                data: that.data
            }));
            this.n_ingredientes = 0;
            console.log(this.n_ingredientes);
        },
         
        editarReceta: function(e) {
            console.log('recetaView:editarReceta');
            this.idReceta = e.currentTarget.attributes['val'].nodeValue;
            this.receta = this.collection.get(this.idReceta);
            this.data = {
                'receta': this.receta.attributes , 
                'idAccion': 'actualizarReceta'
            };
            that = this;
            $('#listaRecetasBusqueda').html(this.templateForm({
                data: that.data
            }));
            
            this.n_ingredientes = 0;
            $.each(this.receta.attributes.ingredientes ,function(ingrediente) {
                 that.n_ingredientes += 1;
                 $('#ingredientes').append('<br/>'+that.templateIngredientes({id: that.n_ingredientes})+'<br/>');
                 console.log(ingrediente);
                 that.$el.find('#ingrediente_'+that.n_ingredientes).val(that.receta.attributes.ingredientes[ingrediente].nombre);
                 that.$el.find('#cantidad_'+that.n_ingredientes).val(that.receta.attributes.ingredientes[ingrediente].cantidad);
            });
          
        },
        
        crearReceta: function() {
            console.log('recetaView:crearReceta');
            $('#crearReceta').addClass('disabled');
            receta = new window.recetaModel();
            for (i=1;i<=this.n_ingredientes;i++) { 
                ingredientes[i] = {
                    nombre: this.$el.find('#ingrediente_'+i).val(),
                    cantidad: this.$el.find('#cantidad_'+i).val()
                }
            }
            that = this;
           
            receta.save({
                nombre: this.$el.find('.receta_nombre').val(),
                descripcion: this.$el.find('.receta_descripcion').val(),
                n_personas: Number(this.$el.find('.receta_n_personas').val()),
                ingredientes: ingredientes
            },{
                success:function(model, response){
                    console.log('receta.save.success');
                    that.collection.unshift(receta);
                    $('#crearReceta').removeClass('disabled');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: {
                            'success': 'Receta creada correctamente'
                        }
                    }));
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                },
                error: function(model, response){
                    console.log('receta.save.error');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: jQuery.parseJSON(response.responseText)
                    }));
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                    $('#crearReceta').removeClass('disabled');
                }
            });
        },
        
        actualizarReceta: function() {
            console.log('recetaView:crearReceta');
            $('#actualizarReceta').addClass('disabled');
            that = this;
            this.receta.save({
                nombre: this.$el.find('.receta_nombre').val(),
                descripcion: this.$el.find('.receta_descripcion').val(),
                n_personas: Number(this.$el.find('.receta_n_personas').val())
            },{
                success:function(model, response){
                    console.log('receta.save.success');
                    $('#actualizarReceta').removeClass('disabled');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: {
                            'success': 'Receta actualizada correctamente'
                        }
                    }));
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                    that.renderList();
                },
                error: function(model, response){
                    console.log('receta.save.error');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: jQuery.parseJSON(response.responseText)
                    }));
                    that.receta = model;
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                    $('#actualizarReceta').removeClass('disabled');
                }
            }); 
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
            $('#opcionesRecetas').html(this.templateOpciones());
        },
        
        anadirIngrediente: function(){
            console.log('recetaView.renderList');
            that = this;
            this.n_ingredientes += 1;
            $('#ingredientes').append('<br/>'+this.templateIngredientes({id: that.n_ingredientes})+'<br/>');
            console.log(this.n_ingredientes);
        }
             
    });
    
});
