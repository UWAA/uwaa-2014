(function($) {

    $(document).ready(function() {
        var max_character_count = 80;

        $('#text-area-limit').html(max_character_count + ' characters remaining');

        $("textarea[name='mb_80_character_excerpt']").keyup(function() {

            var text_length = $("textarea[name='mb_80_character_excerpt']").val().length;
            var text_remaining = max_character_count - text_length;

            $('#text-area-limit').html(text_remaining + ' characters remaining');       

            
            if (text_remaining === 0) {
                $('#text-area-limit').css({
                    color: 'green'                    
                });
                $('#text-area-limit').html('Victory is yours.  80 characters reached. Just right.');       
            }


            if (text_remaining < 0) {
                $('#text-area-limit').css({
                    color: 'red'                    
                });
            };

            if (text_remaining > 0) {
                $('#text-area-limit').css({
                    color: 'green'                    
                });
            };

            if (text_remaining < 10 && text_remaining > 0) {
                $('#text-area-limit').css({
                    color: 'green'                    
                });
                $('#text-area-limit').html(text_remaining + ' characters remaining.' + ' Careful there... Getting pretty close.'); 
            }


            if (text_remaining < -10) {
                $('#text-area-limit').html(text_remaining + ' characters remaining.' + '  Are you serious?  COME ON!'); 
            }
        });
        
        $("#copy-to-excerpt").click(function() {
            var $currentExcerpt = $("textarea[name='mb_80_character_excerpt']").val()
            $("#excerpt").val($currentExcerpt);            
            return false;

        });

    });

})(jQuery);
(function($) {

    $(document).ready(function() {

        $("#mb_marker_position").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+ request.term +" .json?access_token=pk.eyJ1IjoiYnBlcmljayIsImEiOiJIanhpaU1nIn0.S3h6SSQIZYpC2GDwYMDCYA&types=place&limit=6",
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