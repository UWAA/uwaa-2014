<?php 
get_header('clean');
wp_enqueue_style(array('holiday', 'flickity') );
wp_enqueue_script(array('bootstrap-modal', 'flickity-fade'));


?>

<script>
  // $('#uw-body').imagesLoaded()
  // .done( function( instance ) {
  //   $('.loader').fadeOut();
  // })
  // .progress( function( instance, image ) {
  //   var result = image.isLoaded ? 'loaded' : 'broken';
  //   console.log( 'image is ' + result + ' for ' + image.img.src );
  // });
  $(window).load(function () {
    $('.loader').fadeOut("slow");
  })
</script>

<div class="container uw-body">
  <div class="loader"></div>

  <div class="row">    

      <div class="mantle col-md-12">
        <label for="snowglobe">
          <div id="snowglobe" class="hit-area" data-toggle="modal" data-target="#snowglobemodal"></div>
        </label>
        <label for="denny">
          <div id="denny" class="hit-area" data-toggle="modal" data-target="#dennymodal"></div>
        </label>
        <label for="boys36">
          <div id="boys36" class="hit-area" data-toggle="modal" data-target="#boysvideomodal"></div>
        </label>

      </div>
    
  </div>

  <div class="row">

      <div class="fireplace-video col-md-12">
      <div class="shadow"></div>
      <video controls loop="true" muted autoplay="autoplay">
              <!-- <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/flagVideo.webm" type="video/webm" > -->
              <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/2020_Holiday-Card_1920x1920.mp4" type="video/mp4" >
              <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/2020_Holiday-Card_1920x1920.webm" type="video/webm" >
          </video>  
      
      </div>

  </div>

  <div class="row">
    <div class="uw-body-copy">

           <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
          

          the_content();

           

          endwhile;
          
        ?>

    </div>
  </div>
     
</div>

  <div class="modal fade" id="boysvideomodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Relive the “Swing”</h4>
      </div>
      <div class="modal-body">
        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/SufEe-d4DN4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p>What better way to close out 2020 than to revel again in the glory of the Washington rowers at the 1936 Olympics in Berlin. Their epic quest is captured in the PBS documentary “American Experience: The Boys of ’36,” inspired by Daniel James Brown’s critically acclaimed book, “The Boys in the Boat.” </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


 <div class="modal fade" id="dennymodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Denny Hall Insignia</h4>
      </div>
      <div class="modal-body">
        <div class="carousel" data-flickity='{ "imagesLoaded": true, "percentPosition": false, "fade": true , "setGallerySize": false, "pageDots": false }'>
        <img src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2020/12/18143422/DennyHall_Old.jpg" alt="Historical Image of Denny Hall" />
        <img src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2020/12/18143425/DennyHall_Current.jpg" alt="Modern Image of Denny Hall" />
        </div>
        
        
          <p>
            <img class="img-thumbnail pull-left modal-square-image" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2020/12/18143049/Denny-Hall-Logo.jpg" alt="Image of Denny Hall W Relief">
            The “UW”  on the mantle clock is inspired by the 1895 insignia featured on the face of Denny Hall, the first building erected on what is now UW’s Seattle campus. The building also houses the “Varsity Bell,” produced in 1862. <a href="https://www.washington.edu/news/2004/11/04/denny-bell-to-ring-again"/>Learn more about the Varsity Bell</a>,  from the UW Magazine archive. The bell is still rung each year on Homecoming Weekend and on Veteran’s Day.
            <div class="clearfix"></div>
          <h4>
            Hear the Denny Bells          
          </h4>
          <audio controls>
            <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/audio/Denny-Bell.wav" type="audio/mpeg">
            <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/audio/Denny-Bell.mp3" type="audio/ogg">
            <p>Your browser doesn't support HTML5 audio. Here is a <a href="myAudio.mp4">link to the audio</a> instead.</p>
          </audio>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="snowglobemodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Aroooo!</h4>
      </div>
      <div class="modal-body">
          <script src="https://fast.wistia.com/embed/medias/14akaqs7io.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_14akaqs7io videoFoam=true" style="height:100%;position:relative;width:100%">&nbsp;</div></div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<?php get_footer(); ?>
