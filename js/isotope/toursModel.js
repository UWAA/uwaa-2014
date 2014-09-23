var Tour = Backbone.Model.extend({



});

var Tours = Backbone.Collection.extend({
    model: Tour,
    url: "http://dev.alumni.washington.edu/wordpress/cms-test/feed/?post_type=tours",

    fetch: function (options) {
        options = options || {};
        options.dataType = "xml";
        options.success = console.log('Received');
        return Backbone.Collection.prototype.fetch.call(this, options);
    }, 

    // parse: function(response) {
    //     return response.channel;
    // } ,

});

var tours = new Tours();
    tours.fetch();
    console.log('hi');