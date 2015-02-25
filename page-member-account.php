<?php



get_header(); 
$UWAA->Memberchecker->getSession();
?>

<div class="uw-hero-image membership"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">UWAA Membership</h2>

      <div class="row uwaa-home-branding-row">
    
    <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

    </div>

      <div class="uw-body-copy">      

      <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

          ?>
          <h1><?php the_title() ?></h1>
          <?php

          
          include(locate_template( 'partials/account-login.php' ));

          the_content();
            

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template('/comments.php');
            }

          endwhile;        



        ?>

      </div>
      <!-- <hr>
      <h3>Debug</h3>
      <div id="canvas"></div> -->

    </div>
    <div class="col-md-4 uw-sidebar">
    <?php 
        uw_sidebar_menu();
        dynamic_sidebar( 'membership_sidebar' ); 
    ?>
    </div>

  </div>

</div>

<?php get_footer(); ?>
