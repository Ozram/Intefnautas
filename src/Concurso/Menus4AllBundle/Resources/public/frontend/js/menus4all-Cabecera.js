$(document).ready(function(){
    
  window.menuModel = Backbone.Model.extend({
        urlRoot: "app_dev.php/menus"
    });
    
    window.menuCollection = Backbone.Collection.extend({
        model: window.menuModel,
        url: "app_dev.php/menus"
    });
    
    window.navOpcionesIzqView = Backbone.View.extend({
              
        initialize: function(){
        },
        
        el: $('#navOpcionesIzq'),  
        
        events: {
            "click #menus4allRecetas"  : "seccionRecetas" 
        },                         

//        templateList: _.template($('#plantillaMenuList').html()),
//
//        templateForm: _.template($('#plantillaMenuForms').html()),
//        
//        templateMensajes: _.template($('#plantillaMensajes').html()),

//        nuevoMenu: function() {
//            console.log('menuView:nuevoMenu');
//            this.data = {
//                'menu': '' , 
//                'idAccion': 'crearMenu'
//            };
//            that = this;
//            $('#listaMenusBusqueda').html(this.templateForm({
//                data: that.data
//            }));
//        },
//         
//        editarMenu: function(e) {
//            console.log('menuView:editarMenu');
//            this.idMenu = e.currentTarget.attributes['val'].nodeValue;
//            this.menu = that.collection.get(this.idMenu);
//            console.log(this.idMenu);
//            console.log(this.menu);
//            this.data = {
//                'menu': this.menu.attributes , 
//                'idAccion': 'actualizarMenu'
//            };
//            that = this;
//            $('#listaMenusBusqueda').html(this.templateForm({
//                data: that.data
//            }));
//            
//        },
//        
//        crearMenu: function() {
//            console.log('menuView:crearMenu');
//            $('#crearMenu').addClass('disabled');
//            menu = new window.menuModel();
//            that = this;
//           
//            menu.save({
//                nombre: this.$el.find('.menu_nombre').val(),
//                descripcion: this.$el.find('.menu_descripcion').val(),
//                n_personas: Number(this.$el.find('.menu_n_personas').val())
//            },{
//                success:function(model, response){
//                    console.log('menu.save.success');
//                    that.collection.unshift(menu);
//                    $('#crearMenu').removeClass('disabled');
//                    $('#seccionMensajes').html(that.templateMensajes({
//                        mensajes: {
//                            'success': 'Menu creada correctamente'
//                        }
//                    }));
//                    $('#seccionMensajes').show().delay(5000).hide('slow');
//                },
//                error: function(model, response){
//                    console.log('menu.save.error');
//                    console.log(response.responseText);
//                    $('#seccionMensajes').html(that.templateMensajes({
//                        mensajes: jQuery.parseJSON(response.responseText)
//                    }));
//                    $('#seccionMensajes').show().delay(5000).hide('slow');
//                    $('#crearMenu').removeClass('disabled');
//                }
//            });
//        },
        seccionRecetas: function(){
            this.recetaCollection = new window.recetaCollection();

            this.recetaView = new window.recetaView({
                collection:  this.recetaCollection
            });
            
            this.recetaView.actualizarColeccion();
        }
        

    });
    
});
