/* <![CDATA[ */
var callMemberCheckerAJAX = {"ajaxurl":"\/alumni\/api\/memberValidator"};
/* ]]> */

jQuery(document).ready(function($){
    $("input#memberCheckerLogout").on("click", function(){
        $("form#memberloginForm").submit();
    });

    $("form#memberloginForm").on("submit", function(e){

        var $formMessage = $("#form-message"),
            $errorMessage = $("#error-message"),
            $form = $(this);

        $.ajax({
            type: $form.attr("method"),
            url: callMemberCheckerAJAX.ajaxurl + "/login",
            data: $form.serialize(),
            success: function(response){
                if(!response.error) location.reload();
                $formMessage.html(response.message);
                $errorMessage.html(response.errorMessage);
            },
            error: function(xhr){
                $formMessage.html(xhr.error);
                console.log(xhr.error);
            }
        });
        e.preventDefault();
    });

    $("#memberCheckerLogout").on("click", function(){
        $("form#memberlogout").submit();
    });

    $("form#memberlogout").on("submit", function(e){
        var $output = $("#output"),
            $form = $(this);

        $.ajax({
            type: $form.attr("method"),
            url: callMemberCheckerAJAX.ajaxurl + "/logout",
            data: $form.serialize(),
            success: function(response){
                console.log("success");
                location.reload();
            },
            error: function(xhr){
                console.log("error");
                $output.html(xhr);
            }
        });
        e.preventDefault();
    });
});