$(document).ready(function(){
    window.appRouter = Backbone.Router.extend({
        
        initialize: function(){
            console.log('window.app.initialize');
            this.recetasRouter = new window.recetaRouter();
        }
    });

    app = new window.appRouter;
    Backbone.history.start();
});