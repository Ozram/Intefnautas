$(document).ready(function(){
    
    window.appRouter = Backbone.Router.extend({
   
        initialize: function(){
       
            console.log('window.app.initialize');
                
            this.recetaCollection = new window.recetaCollection();

            this.recetaView = new window.recetaView({
                collection:  this.recetaCollection
            });
            
            this.recetaView.actualizarColeccion();
        }
   
    });
    
    var menus4all = new window.appRouter;
    
});
