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

        },                         

        templateList: _.template($('#plantillaMenuList').html()),
        
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
        
        renderList: function(){
            console.log('menuView.renderList');
            $('#listaMenusBusqueda').html(this.templateList({
                menus: this.collection.toJSON()
            }));

        }
             
    });
    
});
