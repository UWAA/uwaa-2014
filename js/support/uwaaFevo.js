  jQuery(document).ready(function($) {

     Fevo.init({
        publisherKey: uwaaFevoProperties.fevoPublisherKey,
        env:'prod'
    });
Fevo.purchase('.fevo-button');
     
 });


