(function($) {

    $(document).ready(function() {

        $("#mb_marker_position").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+ request.term +" .json?access_token=pk.eyJ1IjoiYnBlcmljayIsImEiOiJIanhpaU1nIn0.S3h6SSQIZYpC2GDwYMDCYA&types=region,country,district&language=en&limit=6",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        var resultsArray = [];

                        data.features.forEach(function(feature){                         
                           
                            featureJSON = Object.create(null);
                            featureJSON.id = feature.id;
                            featureJSON.label = feature.place_name;
                            featureJSON.value = feature.place_name;
                            featureJSON.latLong = feature.center;

                            resultsArray.push(featureJSON);

                            
                        });                        
                        response(resultsArray);
                    }
                });
            },
            minLength: 4,
            delay: 600,
            select: function (event, ui) {
                $("input[name='mb_lat_long']").val(ui.item.latLong.reverse().toString() );                
            }
        });


        
    });

})(jQuery);