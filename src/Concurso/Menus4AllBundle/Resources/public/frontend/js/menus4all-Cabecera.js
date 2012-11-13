$(document).ready(function(){
    
    window.navbar = Backbone.View.extend({
              
        initialize: function(){
        },
        
        el: $('#cabecera'),  
        
        events: {
            "click #menus4allRecetas"  : "seccionRecetas",
            "click #menus4allMenus" : "seccionMenus",
            "click #menus4allDietas" : "seccionDietas"
        },                         

        seccionRecetas: function(){
            this.desactivar();
            $('#menus4allRecetas').addClass('active');
            menus4all.navigate("recetas/lista", {
                trigger: true
            });
        },
        
        seccionMenus: function(){
            this.desactivar();
            $('#menus4allMenus').addClass('active');
            
            this.menuCollection = new window.menuCollection();

            this.menuView = new window.menuView({
                collection:  this.menuCollection
            });
            
            this.menuView.actualizarColeccion();
        },
        
        seccionDietas: function(){
            this.desactivar();
            $('#menus4allDietas').addClass('active');
        },
        
        
        desactivar: function(){
            $('#menus4allRecetas').removeClass('active');
            $('#menus4allMenus').removeClass('active');
            $('#menus4allDietas').removeClass('active');
        } 
                       
    });
    
});
