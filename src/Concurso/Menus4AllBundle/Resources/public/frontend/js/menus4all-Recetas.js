$(document).ready(function(){
    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }
    window.recetaModel = Backbone.Model.extend({
        urlRoot:  urlRootDefault+"recetas"
    });
    
    window.recetaCollection = Backbone.Collection.extend({
        model: window.recetaModel,
        url:  urlRootDefault+"recetas"
    });
    
    window.recetaView = Backbone.View.extend({
              
        initialize: function(){
            this.collection.bind('reset destroy add', this.renderList, this);
        },
        
        el: $('#seccionCentral'),  
        
        events: {
            "click #nuevaReceta"  : "nuevaReceta" ,
            "click .editarReceta"  : "editarReceta",
            "click #crearReceta"  : "crearReceta" ,
            "click #actualizarReceta"  : "actualizarReceta",
            "click #buscarRecetas"  : "actualizarColeccion",
            "click #anadirIngrediente": "anadirIngrediente",
            "click #cancelarReceta"  : "actualizarColeccion"

        },                         

        templateList: _.template($('#plantillaRecetaList').html()),

        templateForm: _.template($('#plantillaRecetaForms').html()),
        
        templateOpciones: _.template($('#plantillaRecetaOpciones').html()),
        
        templateMensajes: _.template($('#plantillaMensajes').html()),
        
        templateIngredientes: _.template($('#plantillaIngredientes').html()),
        
        
        nuevaReceta: function() {
            console.log('recetaView:nuevaReceta');
            this.data = {
                'nombreForm': 'Nueva Receta',
                'receta': '' , 
                'idAccion': 'crearReceta'
            };
            that = this;
            $('#seccionPrincipal').html(this.templateForm({
                data: that.data
            }));
            this.n_ingredientes = 0;
            menus4all.navigate("recetas/nueva", {
                trigger: false
            });
        },
         
        editarReceta: function(e) {
            console.log('recetaView:editarReceta');
            if(isNumber(e)){
                this.idReceta = e;
            }else{
                this.idReceta = e.currentTarget.attributes['val'].nodeValue;
            }
            this.receta = this.collection.get(this.idReceta);
            this.data = {
                'nombreForm': 'Editar Receta: '+this.receta.attributes.nombre,
                'receta': this.receta.attributes , 
                'idAccion': 'actualizarReceta'
            };
            that = this;
            $('#seccionPrincipal').html(this.templateForm({
                data: that.data
            }));
            this.n_ingredientes = 0;
            _.each(this.receta.attributes.ingredientes ,function(ingrediente, index) { 
                $('#ingredientes').append('<br/>'+that.templateIngredientes({
                    id: that.n_ingredientes
                })+'<br/>');
                that.$el.find('#ingrediente_'+that.n_ingredientes).val(that.receta.attributes.ingredientes[index].nombre);
                that.$el.find('#cantidad_'+that.n_ingredientes).val(that.receta.attributes.ingredientes[index].cantidad);
                that.n_ingredientes += 1;
            }); 
            menus4all.navigate("recetas/editar/"+this.idReceta, {
                trigger: false
            });
        },
        
        crearReceta: function() {
            console.log('recetaView:crearReceta');
            $('#crearReceta').addClass('disabled');
            receta = new window.recetaModel();
            for(i=0;i<this.n_ingredientes;i++) { 
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
            console.log('recetaView:actualizarReceta');
            $('#actualizarReceta').addClass('disabled');
            for(i=0;i<this.n_ingredientes;i++) { 
                ingredientes[i] = {
                    nombre: this.$el.find('#ingrediente_'+i).val(),
                    cantidad: this.$el.find('#cantidad_'+i).val()
                }
            }
            nuevaReceta
            that = this;
            this.receta.save({
                nombre: this.$el.find('.receta_nombre').val(),
                descripcion: this.$el.find('.receta_descripcion').val(),
                n_personas: Number(this.$el.find('.receta_n_personas').val()),
                ingredientes: ingredientes
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
            $('#seccionPrincipal').html(this.templateList({
                recetas: this.collection.toJSON()
            }));
            $('#seccionOpciones').html(this.templateOpciones());
            menus4all.navigate("recetas/lista", {
                trigger: false
            });
        },
        
        anadirIngrediente: function(){
            console.log('recetaView.anadirIngrediente');
            that = this; 
            $('#ingredientes').append('<br/>'+this.templateIngredientes({
                id: that.n_ingredientes
            })+'<br/>');
            this.n_ingredientes += 1;
        }
             
    });
    
    window.recetaRouter = Backbone.Router.extend({

        
        routes: {
            "recetas/nueva"         : "nuevaReceta", 
            "recetas/lista"         : "renderList",
            "recetas/editar/:id"    : "editarReceta"
        },                         

        templateList: _.template($('#plantillaRecetaList').html()),

        templateForm: _.template($('#plantillaRecetaForms').html()),
        
        templateOpciones: _.template($('#plantillaRecetaOpciones').html()),
        
        initialize: function(){
            this.recetaCollection = new window.recetaCollection();
            this.recetaView = new window.recetaView({
                collection:  this.recetaCollection
            });
        },
        
        nuevaReceta: function() {
            this.recetaView.nuevaReceta();
        },
            
        renderList: function(){
            this.recetaView.actualizarColeccion();  
        },
        
        editarReceta: function(id){
            this.recetaView.editarReceta(id);  
        }


    });
    
});
