var Tour = Backbone.Model.extend({
    defaults: {
        title: '',
        link: ''

    }



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

    parse: function(data) {
        
        var parsed = [];

        $(data).find('item').each(function (index){
            postTitle= $(this).find('title').text();
            postLink= $(this).find('link').text();

            parsed.push({
                title : postTitle,
                link : postLink
            });

        });

        return parsed;
    },

});

