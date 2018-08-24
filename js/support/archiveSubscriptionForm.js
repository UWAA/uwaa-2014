console.log('loaded');

$('.filter-button').filter('[data-filter=".lecture"]').on('click', function(e){
    if($(e.currentTarget).hasClass('is-checked')) {
        console.log('already checked, chill');
        return;
    } else {
        $("#lecture-signup-wrapper").toggleClass('iframe-opened');
        console.log('do the thing with the iframe');
    }    
})

