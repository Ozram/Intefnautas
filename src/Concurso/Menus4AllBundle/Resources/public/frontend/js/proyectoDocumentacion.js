$(document).ready(function() {

    window.recetaModel = Backbone.Model.extend({
        urlRoot : '/intefnautas/web/app_web.php/recetas'
    });    
    
    window.proyectoDocumentacionCollection = Backbone.Collection.extend({
        
        model: proyectoDocumentacionModel,
        url: conf_url_servicio_proyectos,
                
                       
        comparator: function(proyecto){
            return proyecto.get('Nombre');
        },
                       
        busca: function(termino){       
            
            if(termino == ''){
                this.url = conf_url_servicio_proyectos;
            }else{
                app.navigate('busca/'+termino);
                this.url = conf_url_servicio_proyectos + '/'+termino;
            }
            
            
            console.log('proyectoDocumentacionCollection:busca:'+termino+':'+this.url);
            this.fetch();
        }
    });
    
    window.mensajeAdvertenciaView = Backbone.View.extend({
        
        className: "span12",
        
        template: _.template($('#t_mensaje_advertencia').html()),                  
    
        render: function(){
        
            this.$el.html(this.template(this.model));
        
            return this;
        }
    }
    );
    
    window.proyectoView = Backbone.View.extend({                               
        
        tagName: 'li',
        
        template: _.template($('#t_proyecto').html()),                  
    
        render: function(){
        
            this.$el.html(this.template(this.model.toJSON()));
        
            return this;
        }
    });

    window.listView = Backbone.View.extend({
        
        el: $('#listado_proyectos'),                            
          
        initialize: function(){            
            this.collection.bind('reset', this.render,this);
        },              
                            
        render: function(){
            
            that = this;
            this.$el.empty();            
           
            if(this.collection.length == 0){
                              
                this.$el.html(new window.mensajeAdvertenciaView({
                    model: {
                        mensaje: "No se han encontrado proyectos. Para mostrar todos \n\
los proyectos realiza una búsqueda con el campo vacío",
                        tipo: ''
                    }
                }).render().el);
            }else
            {
                // this.$el.append('<div class="span12 alert alert-success">Se han encontrado '+that.collection.length+' proyectos</div>');
                this.$el.html(new window.mensajeAdvertenciaView({
                    model: {
                        mensaje: 'Se han encontrado '+that.collection.length+' proyectos',
                        tipo: 'alert-success'
                    }
                }).render().el);
                this.collection.each(function(proyecto){
                    
                    that.$el.append(new window.proyectoView({
                        model: proyecto
                    }).render().el);  
                });
            }            
                      
            return this;
        }                                                  
    });  
    
    window.formNuevaReceta = Backbone.View.extend({
        
        el: $('#formNuevaReceta'),               
        
        events: {                        
            "click #crearReceta"  : "crearReceta"                
        },                
                
        
        crearReceta: function(e) {
            console.log('formNuevaReceta:crearReceta');
            
            receta = new window.recetaModel;
            receta.set({
                nombre: $('#receta_nombre'),
                descripcion: $('#receta_descripcion'),
                n_personas: $('#receta_n_ndescripcion')
            });
            receta.save();
        }
    });
    window.botoneraView = Backbone.View.extend({
        
        el: $('#botonera'),               
        
        events: {                        
            "keypress #txt_termino_busqueda"  : "busca"                
        },                
                
        
        busca: function(e) {
            console.log('botoneraView:busca');
            if (e.keyCode == 13){
                termino = $('#txt_termino_busqueda').val();
                console.log("botoneraView:busca:"+termino)                
                this.collection.busca(termino)
            };
        }
        
    });
            
    window.appRouter = Backbone.Router.extend({
                  
        initialize: function(){
            console.log("appRouter:initialize");
            
            this.proyectos = new proyectoDocumentacionCollection;
            
            this.listProyectosView = new window.listView({
                collection: this.proyectos
            });       
            
            this.botonesView = new window.botoneraView({
                collection: this.proyectos
            });
                        
        },
        
        routes: {     
            ""                       : "busca",            
            "busca/:termino"         : "busca" 
                
        },
                
        
        busca: function(termino){
            console.log("appRouter:busca");  
            if(termino == undefined)
                termino = '';
                
            this.proyectos.busca(termino);
        }
                                           
    });
            
    var app = new window.appRouter();
    
    Backbone.history.start();
    
    console.log(app.proyectos);


})
