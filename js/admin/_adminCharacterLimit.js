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