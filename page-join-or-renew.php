<?php

$UWAA->Memberchecker->getSession();

// @TODO Make booleans for store state (join vs. renew)

get_header(); 

?>

<div class="uw-hero-image membership"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">UWAA Membership</h2>

      <div class="row uwaa-home-branding-row">
    
     <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>

    </div>

      <div class="uw-body-copy">      

      <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

          ?>
          <h1><?php the_title() ?></h1>
                    

          <?php

          the_content();            


          endwhile;     

        ?>

      </div>

      <?php 
      if (isset($_GET['join'])) {
        $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?join"  ;
      } elseif (isset($_GET['renew'])) {
         $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?renew"  ;
      } elseif (isset($_GET['newgrad'])) {
         $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?newgrad"  ;
      } else {
         $frameURL = "https://secure.gifts.washington.edu/membership/uwaa"  ;
      }

      ?>
  
      <iframe src="<?php echo $frameURL; ?>" width="100%" frameborder="0" height="3150px" scrolling="no"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
