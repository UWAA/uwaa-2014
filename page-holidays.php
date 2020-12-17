<?php 

if ( !is_user_logged_in() ) {
          wp_redirect( '/alumni' );
          exit;
        }
        
get_header('clean');
wp_enqueue_script(array('bootstrap-modal', 'imagesLoaded'));


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
        <h4 class="modal-title">Boys in the Boat</h4>
      </div>
      <div class="modal-body">
        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/SufEe-d4DN4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
        <h4 class="modal-title">Denny Hall and the "W"</h4>
      </div>
      <div class="modal-body">
        <img class="center-block" src="https://www.fillmurray.com/1920/1080" alt="Bill Murray">
          <p>
            <img class="img-thumbnail pull-left modal-square-image" src="https://www.fillmurray.com/600/600" alt="Bill Murray Square">
            Veniam qui fugiat et culpa quis occaecat est sit officia ad. Elit proident et sit cupidatat nostrud ea. Sit officia labore id excepteur et ullamco nulla sint eiusmod tempor nulla irure proident. Culpa minim consectetur fugiat irure dolor laborum deserunt duis minim ipsum amet excepteur. Labore aute ad tempor aute culpa eu Lorem culpa. Elit esse ex qui do eu cupidatat veniam aliqua do eiusmod.</p>          
          <p>
            Hear the Denny Bells          
          </p>
          <audio controls src="<?php bloginfo("stylesheet_directory"); ?>/assets/audio/bells.wav"></audio>
          
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
