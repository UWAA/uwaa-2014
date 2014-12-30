// MemberStoreInit.js



var Membership = Backbone.Model.extend({
   // type: function() { return 'c' + gallery._currentsub; }
   type: function() { return 'c' + gallery._currenttype; }
});



/**
 * MembershipCollection: A collection of Membership items used in index, subalbum and photo views
 * @type Backbone.Collection
 */
var MembershipCollection = Backbone.Collection.extend({
    model: Membership,
    comparator: function(item) {
        return item.get('pid');
    }
});

function removeFallbacks(){
  var query = $('.jstest,.gallery');
        if(query.length){
          query.remove();
        }
}


/**
 * IndexView: The default view seen when opening up the application for the first time. This 
 * contains the first level of images in the JSON store (the level-one albums). Prior to rendering 
 * our jQuery templates here we remove any messages or elements displayed in the version where 
 * JavaScript is disabled.
 * @type Backbone.View
 */
var IndexView = Backbone.View.extend({
    el: $('#storeApp'),
    // indexTemplate: $("#membershipIndexTile").template(),

    initialize: function() {
        var source = $("#membershipIndexTile").html();
        var template = Handlebars.compile(source);
        var html = template(this.model.toJSON());

    },

    render: function() {
        removeFallbacks();
        var sg = this;
        
        this.el.fadeOut('fast', function() {
        sg.el.empty();
        // $.tmpl(sg.indexTemplate, sg.model.toArray()).appendTo(sg.el);
        this.$el.html(html);        
        sg.el.fadeIn('fast');
        });
        return this;
    }

});


// /**
//  * SubalbumView: The view reached when clicking on a level-one album or browsing to a subalbum bookmark. 
//  * This contains the images found in the 'subalbum' section of an album entry. Clicking on any of the 
//  * images shown in a subalbum takes you to the MembershipView of that specific image
//  * @type Backbone.View
//  */
// var SubalbumView = Backbone.View.extend({
//     el: $('#main'),
//     indexTemplate: $("#subindexTmpl").template(),
    
//     initialize: function(options){

//     },

//     render: function() {
//         var sg = this;
//         removeFallbacks();
//         this.el.fadeOut('fast', function() {
//             sg.el.empty();
//             $.tmpl(sg.indexTemplate, sg.model.toArray()).appendTo(sg.el);
//             sg.el.fadeIn('fast');
//         });
//         return this;
//     }

// });


/**
 * MembershipView: The single-photo view for a single image on the third-level of the application.
 * This is reached either by clicking on an image at the second/subalbum level or 
 * browsing to a bookmarked photo in a subalbum.
 * @type Backbone.View
 */
// var MembershipView = Backbone.View.extend({
//     el: $('#main'),
//     itemTemplate: $("#itemTmpl").template(),


//     initialize: function(options) {
//         this.album = options.album;
       
//     },
    
//     render: function() {
//         var sg = this;
//         removeFallbacks();     
//         this.el.fadeOut('fast', function() {
//             sg.el.empty();
//             $.tmpl(sg.itemTemplate, sg.model).appendTo(sg.el);
//             sg.el.fadeIn('fast');
//         });
//         return this;
//     }
// });




/**
 * Gallery: The controller that defines our main application 'gallery'. Here we handle how 
 * routes should be interpreted, the basic initialization of the application with data through 
 * an $.ajax call to fetch our JSON store and the creation of collections and views based on the 
 * models defined previously.
 * @type Backbone.Controller
 */
var Gallery = Backbone.Router.extend({
    _index: null,
    _memberships: null,    
    _types:null,    
    _data:null,    
    _currentsub:null,

    routes: {
        "": "index",
        "type/:id": "hashsub",
        "type/:id/" : "directphoto",
        "type/:id/:num" : "hashphoto"
    },

    initialize: function(options) {
    
        var ws = this;
       
        if (this._index === null){
            $.ajax({
                url: '/wp-content/themes/uwaa-2014/js/memberstore/memberships.json',
                dataType: 'json',
                data: {},
                success: function(data) {
                    ws._data = data;
                    ws._memberships = new MembershipCollection(data);
                    ws._index = new IndexView({model: ws._memberships}); 
                    Backbone.history.loadUrl();                    
                }
            });
            return this;
        }
        return this;
    },


    /**
     * Handle rendering the initial view for the application
     * @type function
    */
    index: function() {
        this._index.render();
    },
    

    /**
     * Gallery -> hashsub: Handle URL routing for subalbums. As subalbums aren't traversed 
     * in the default initialization of the app, here we create a new MembershipCollection for a 
     * particular subalbum based on indices passed through the UI. We then create a new SubalbumView 
     * instance, render the subalbums and set the current subphotos array to contain our subalbum Membership 
     * items. All of this is cached using the CacheProvider we defined earlier
     * @type function
     * @param {String} id An ID specific to a particular subalbum based on CIDs
     */
    hashsub:function(id){
        
       var properindex = id.replace('c','');    
       this._currentsub = properindex;
       this._subphotos = cache.get('pc' + properindex) || cache.set('pc' + properindex, new MembershipCollection(this._data[properindex].subalbum));
       this._subalbums = cache.get('sv' + properindex) || cache.set('sv' + properindex, new SubalbumView({model: this._subphotos}));
       this._subalbums.render();

        
    },
    
    directphoto: function(id){

    },

    /**
     * Gallery -> hashphoto: Handle routing for access to specific images within subalbums. This method 
     * checks to see if an existing subphotos object exists (ie. if we've already visited the 
     * subalbum before). If it doesn't, we generate a new MembershipCollection and finally create 
     * a new MembershipView to display the image that was being queried for. As per hashsub, variable/data 
     * caching is employed here too
     * @type function
     * @param {String} num An ID specific to a particular image being accessed
     * @param {Integer} id An ID specific to a particular subalbum being accessed
     */
      hashphoto: function(num, id){
        this._currentsub = num;
        
        num = num.replace('c','');
        
        if(this._subphotos == undefined){
           this._subphotos = cache.get('pc' + num) || cache.set('pc' + num, new MembershipCollection(this._data[num].subalbum));
         }  
        this._subphotos.at(id)._view = new MembershipView({model: this._subphotos.at(id)});
        this._subphotos.at(id)._view.render();
        
      }
});


gallery = new Gallery();
Backbone.history.start();
