$(document).ready(function(){
    
    window.appRouter = Backbone.Router.extend({
        
        initialize: function(){
            console.log('window.app.initialize');
            this.recetaRouter = new window.recetaRouter();
            this.navbar = new window.navbar();
        }
   
    });

    menus4all = new window.appRouter;
    Backbone.history.start();
    
});
