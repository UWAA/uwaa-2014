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

          <!-- <h3>Fall Membership Drive</h3> -->
          <!-- <h5>Right now is the best time to join! Become a member by October 31, 2015 and get a free gift -- a UW alumni license plate frame!</h5> -->

          <?php

          
          get_template_part('partials/membership', 'store');

          echo "<a name=\"pricing\"></a>";

          the_content();
            


          endwhile;        



        ?>

      </div>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
