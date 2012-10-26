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
            "click #buscarRecetas"  : "actualizarColeccion"

        },                         

        templateList: _.template($('#plantillaRecetaList').html()),

        templateForm: _.template($('#plantillaRecetaForms').html()),
        
        templateMensajes: _.template($('#plantillaMensajes').html()),

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
        },
         
        editarReceta: function(e) {
            console.log('recetaView:editarReceta');
            this.idReceta = e.currentTarget.attributes['val'].nodeValue;
            this.receta = that.collection.get(this.idReceta);
            console.log(this.idReceta);
            console.log(this.receta);
            this.data = {
                'success': '',
                'errores': '',
                'receta': this.receta.attributes , 
                'idAccion': 'actualizarReceta'
            };
            that = this;
            $('#listaRecetasBusqueda').html(this.templateForm({
                data: that.data
            }));
            
        },
        
        crearReceta: function() {
            console.log('recetaView:crearReceta');
            $('#crearReceta').addClass('disabled');
            receta = new window.recetaModel();
            that = this;
           
            receta.save({
                nombre: this.$el.find('.receta_nombre').val(),
                descripcion: this.$el.find('.receta_descripcion').val(),
                n_personas: Number(this.$el.find('.receta_n_personas').val())
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
                    console.log(response.responseText);
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
            recetaaux = this.receta;
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
                    console.log(response.responseText);
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: jQuery.parseJSON(response.responseText)
                    }));
                    that.receta = recetaaux;
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

        }
             
    });
    
});
