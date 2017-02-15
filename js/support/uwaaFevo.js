  jQuery(document).ready(function($) {

     Fevo.init({
        publisherKey: uwaaFevoProperties.fevoPublisherKey,
        env:'sandbox'
    });
Fevo.purchase('.fevo-button');
     
 });


