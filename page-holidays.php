<?php 

if ( !is_user_logged_in() ) {
          wp_redirect( '/alumni' );
          exit;
        }
        
get_header('clean');




?>

<div class="container uw-body">

  <div class="row">    

      <div class="mantle col-md-12"></div>
    
  </div>

    <div class="row">

      <div class="fireplace-video col-md-12">
        <video loop muted autoplay>
            <!-- <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/flagVideo.webm" type="video/webm" > -->
            <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/2020_Holiday-Card-Square_CROP.mp4" type="video/mp4" >
        </video>
      </div>

    </div>
     
  </div>



<?php get_footer(); ?>
