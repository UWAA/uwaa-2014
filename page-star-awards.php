<?php 
get_header(); 
wp_enqueue_script(array('starsAwardsSearch'));
?>


<div class="uw-hero-image star-awards">
  <h2 class="star-site-title">UW Advancement Star Awards</h2>

</div>

<div class="container-fluid uw-body">

  
  <div class="row">
    
    
    <div class="col-md-12 uw-content" role='main'>
      
      

      <div class="uw-body-copy star-awards">
      
      
        <?php

        
        
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */             
            // get_template_part( 'content', 'star-awards' ); 

            ?>
            
            <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>

        <a href="<?php echo get_site_url('', '/spring-2020-star-awards')?>">See the Spring 2020 Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/fall-2020-star-awards')?>">See the Fall 2020 Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/spring-2021-star-awards')?>">See the Spring 2021 Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/fall-2021-star-awards')?>">See the Fall 2021 Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/spring-2022-star-awards')?>">See the Spring 2022 Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/fall-2022-star-awards')?>">See the Fall 2022 Star Awards</a>

        <?php

        $exp_date = new DateTime("2023-11-29 14:00:00", new DateTimeZone("America/Los_Angeles"));
        $today = new DateTime();

        if($today < $exp_date) {

          ?>

          <h2>Star Awards will be live at 2 PM Today!</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/starWait.jpg" alt="Mount Rainier with stars" class="aligncenter" width="600">

          <?php
        } else {

        ?>

        <h2>Awardees</h2>
        

        <div id="winner-cards">
          <div class="grid">
            <?php   $UWAA->UI->makeStarAwardWinnerCards('fall2023'); ?>
          </div>
        </div>

        <h2>Nominees</h2>
        

    <input id="search" type=text placeholder="Find an Advancement star">

    <div id="cards">
        <div class ="grid">
      
            <?php $UWAA->UI->makeStarAwardCards('fall2023'); ?>
       
        
        </div>  
    </div>

    </div>
    </div>
    
  </div>
</div>


<?php }get_footer(); ?>