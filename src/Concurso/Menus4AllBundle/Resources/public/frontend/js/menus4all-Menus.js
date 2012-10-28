$(document).ready(function(){
    
    window.menuModel = Backbone.Model.extend({
        urlRoot: "menus"
    });
    
    window.menuCollection = Backbone.Collection.extend({
        model: window.menuModel,
        url: "menus"
    });
    
    window.menuView = Backbone.View.extend({
              
        initialize: function(){
            this.collection.bind('reset destroy add', this.renderList, this);
        },
        
        el: $('#seccionCentral'),  
        
        events: {
            "click #nuevoMenu"  : "nuevoMenu" ,
            "click .editarMenu"  : "editarMenu",
            "click #crearMenu" : "crearMenu",
            "click #actualizarMenu" : "actualizarMenu", 
            "click #buscarMenus"  : "actualizarColeccion",
            "click #anadirRecetas": "anadirRecetas",
            "click #cancelar"  : "actualizarColeccion"
        },                         

        templateList: _.template($('#plantillaMenuList').html()),
        
        templateForm: _.template($('#plantillaMenuForms').html()),
        
        templateMensajes: _.template($('#plantillaMensajes').html()),
        
        templateOpciones: _.template($('#plantillaMenuOpciones').html()),
        
        nuevoMenu: function(){
            console.log('menuView:nuevoMenu');
            this.data = {
                'menu': '' , 
                'idAccion': 'crearMenu'
            };
            that = this;
            this.recetaCollection = new window.recetaCollection();

            this.recetaCollection.fetch({
                success: function(collection, response){
                    console.log(collection);  
                    $('#seccionPrincipal').html(that.templateForm({
                        data: that.data,
                        recetas: collection.toJSON()
                    }));
                },
                error: function(collection, response){
                    console.log('recetas.fetch.error');
                }
            });
        },
        
        editarMenu: function(e) {
            console.log('menuView:editarMenu');
            this.idMenu = e.currentTarget.attributes['val'].nodeValue;
            this.menu = this.collection.get(this.idMenu);
            this.data = {
                'menu': this.menu.attributes , 
                'idAccion': 'actualizarMenu'
            };
            this.recetaCollection = new window.recetaCollection();
            this.recetaCollection.fetch({
                success: function(collection, response){
                    $('#seccionPrincipal').html(that.templateForm({
                        data: that.data,
                        recetas: collection.toJSON()
                    }));
                    $('#recetas').html('');
                    _.each(that.recetaCollection.models, function(receta, index){
                         
                         _.each(that.menu.attributes.recetas, function(idRec){
                             if(that.$el.find('#receta_'+index).val() == idRec){
                                 that.$el.find('#receta_'+index).attr('checked','');
                                 $('#recetas').append('<br/><span class="label label-info">' + that.recetaCollection.get(that.$el.find('#receta_'+index).val()).attributes.nombre+'</span><br/>');
                             }
                        });
                    });
                },
                error: function(collection, response){
                    console.log('recetas.fetch.error');
                }
            });
            this.listaRecetas = [];
            
        },
        
        crearMenu: function() {
            console.log('menuView:crearMenu');
            $('#crearMenu').addClass('disabled');
            menu = new window.menuModel();
            that = this;
            this.listaRecetas = [];
            for (i=0;i<this.recetaCollection.length;i++) { 
                if(this.$el.find('#receta_'+i).attr('checked')){
                    this.listaRecetas.push(this.$el.find('#receta_'+i).val());
                };
            };
           
            menu.save({
                nombre: this.$el.find('.menu_nombre').val(),
                descripcion: this.$el.find('.menu_descripcion').val(),
                tipo: this.$el.find('.menu_tipo').val(),
                recetas: this.listaRecetas
            },{
                success:function(model, response){
                    console.log('menu.save.success');
                    that.collection.unshift(menu);
                    $('#crearMenu').removeClass('disabled');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: {
                            'success': 'Menu creada correctamente'
                        }
                    }));
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                },
                error: function(model, response){
                    console.log('menu.save.error');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: jQuery.parseJSON(response.responseText)
                    }));
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                    $('#crearMenu').removeClass('disabled');
                }
            });
        },
        
        actualizarMenu: function() {
            console.log('menuView:crearMenu');
            $('#actualizarMenu').addClass('disabled');
            that = this;
            
            this.listaRecetas = [];
            for (i=0;i<this.recetaCollection.length;i++) { 
                if(this.$el.find('#receta_'+i).attr('checked')){
                    this.listaRecetas.push(this.$el.find('#receta_'+i).val());
                };
            };
            this.menu.save({
                nombre: this.$el.find('.menu_nombre').val(),
                descripcion: this.$el.find('.menu_descripcion').val(),
                tipo: this.$el.find('.menu_tipo').val(),
                recetas: this.listaRecetas
            },{
                success:function(model, response){
                    console.log('menu.save.success');
                    $('#actualizarMenu').removeClass('disabled');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: {
                            'success': 'Menu actualizada correctamente'
                        }
                    }));
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                    that.renderList();
                },
                error: function(model, response){
                    console.log('menu.save.error');
                    $('#seccionMensajes').html(that.templateMensajes({
                        mensajes: jQuery.parseJSON(response.responseText)
                    }));
                    that.menu = model;
                    $('#seccionMensajes').show().delay(5000).hide('slow');
                    $('#actualizarMenu').removeClass('disabled');
                }
            }); 
        },
        
        actualizarColeccion: function() {
            console.log('menuView:actualizarColeccion');
            that = this;
            this.collection.fetch({
                success: function(collection, response){
                    console.log('menus.fetch.success');     
                },
                error: function(collection, response){
                    console.log('menus.fetch.error');
                }
            });    
        },
        
        anadirRecetas: function(){
            console.log('menuView:anadirRecetas');
            $('#recetas').html('');
            for (i=0;i<this.recetaCollection.length;i++) { 
                if(this.$el.find('#receta_'+i).attr('checked')){
                    $('#recetas').append('<br/><span class="label label-info">' + this.recetaCollection.get(this.$el.find('#receta_'+i).val()).attributes.nombre+'</span><br/>');
                };
            };
        },
        
        renderList: function(){
            console.log('menuView.renderList');
            $('#seccionPrincipal').html(this.templateList({
                menus: this.collection.toJSON()
            }));
            $('#seccionOpciones').html(this.templateOpciones());
        }
             
    });
    
});
