$(document).ready(function(){
    
    window.menuModel = Backbone.Model.extend({
        urlRoot: "app_dev.php/menus"
    });
    
    window.menuCollection = Backbone.Collection.extend({
        model: window.menuModel,
        url: "app_dev.php/menus"
    });
    
    window.menuView = Backbone.View.extend({
              
        initialize: function(){
            this.collection.bind('reset destroy add', this.renderList, this);
        },
        
        el: $('#seccionMenus'),  
        
        events: {
            "click #nuevoMenu"  : "nuevoMenu" ,
            "click .editarMenu"  : "editarMenu",
            "click #crearMenu"  : "crearMenu" ,
            "click #actualizarMenu"  : "actualizarMenu",
            "click #buscarMenus"  : "actualizarColeccion"

        },                         

        templateList: _.template($('#plantillaMenuList').html()),

        templateForm: _.template($('#plantillaMenuForms').html()),
        
        templateMensajes: _.template($('#plantillaMensajes').html()),

        nuevoMenu: function() {
            console.log('menuView:nuevoMenu');
            this.data = {
                'menu': '' , 
                'idAccion': 'crearMenu'
            };
            that = this;
            $('#listaMenusBusqueda').html(this.templateForm({
                data: that.data
            }));
        },
         
        editarMenu: function(e) {
            console.log('menuView:editarMenu');
            this.idMenu = e.currentTarget.attributes['val'].nodeValue;
            this.menu = that.collection.get(this.idMenu);
            console.log(this.idMenu);
            console.log(this.menu);
            this.data = {
                'menu': this.menu.attributes , 
                'idAccion': 'actualizarMenu'
            };
            that = this;
            $('#listaMenusBusqueda').html(this.templateForm({
                data: that.data
            }));
            
        },
        
        crearMenu: function() {
            console.log('menuView:crearMenu');
            $('#crearMenu').addClass('disabled');
            menu = new window.menuModel();
            that = this;
           
            menu.save({
                nombre: this.$el.find('.menu_nombre').val(),
                descripcion: this.$el.find('.menu_descripcion').val(),
                n_personas: Number(this.$el.find('.menu_n_personas').val())
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
                    console.log(response.responseText);
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
            this.menu.save({
                nombre: this.$el.find('.menu_nombre').val(),
                descripcion: this.$el.find('.menu_descripcion').val(),
                n_personas: Number(this.$el.find('.menu_n_personas').val())
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
        buscarMenusRel: function() {
            console.log('menuView:buscarMenusRel');
        },
        
        renderList: function(){
            console.log('menuView.renderList');
            $('#listaMenusBusqueda').html(this.templateList({
                menus: this.collection.toJSON()
            }));

        }
             
    });
    
});
