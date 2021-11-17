<?php 
get_header(); 
wp_enqueue_script(array('starsAwardsSearch'));
?>


<div class="uw-hero-image star-awards">
  <h2 class="star-site-title">Spring 2020 Advancement Star Awards</h2>

</div>

<div class="container-fluid uw-body">

  
  <div class="row">
    
    
    <div class="col-md-12 uw-content" role='main'>
      
      

      <div class="uw-body-copy">
      
      
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
        <!-- Modernize This -->

        <a href="<?php echo get_site_url('', '/star-awards')?>">See the current Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/spring-2020-star-awards')?>">See the Spring 2020 Star Awards</a></br>
        <a href="<?php echo get_site_url('', '/fall-2020-star-awards')?>">See the Fall 2020 Star Awards</a>
        

        <h2>Awardees</h2>

        <div id="winner-cards">
          <div class="grid">
            <?php $UWAA->UI->makeStarAwardWinnerCards('spring2021'); ?>
          </div>
        </div>

        <h2>Nominees</h2>

    <input id="search" type=text placeholder="Find an Advancement star">

    <div id="cards">
        <div class ="grid">
      
            <?php $UWAA->UI->makeStarAwardCards('spring2021'); ?>
       
        
        </div>  
    </div>

    </div>
    </div>
    
  </div>
</div>


<?php get_footer(); ?>
