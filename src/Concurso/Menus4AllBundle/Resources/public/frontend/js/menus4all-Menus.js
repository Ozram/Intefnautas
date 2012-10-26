$(document).ready(function(){
    
    window.menuModel = Backbone.Model.extend({
        urlRoot : urlRootDefault+'/menus'
    });
    
    window.menuCollection = Backbone.Collection.extend({
        model: window.menuModel,
        url: urlRootDefault+'/menus'
    });
    
    window.menuView = Backbone.View.extend({

    });
    
});
