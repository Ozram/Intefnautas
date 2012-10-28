$(document).ready(function(){
    
    window.appRouter = Backbone.Router.extend({
   
        initialize: function(){
       
            console.log('window.app.initialize');
    
            this.navbar = new window.navbar();
        }
   
    });
    
    var menus4all = new window.appRouter;
    
});
