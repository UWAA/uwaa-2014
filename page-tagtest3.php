<?php 
get_header(); 
?>


<div class="uw-hero-image">
  <h2 class="star-site-title">Tagboard Demo</h2>

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
            // get_template_part( 'content', 'page' );

            ?>
            
            <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>

        

        <p>Example 3 - Tagboard embed code directly injected into WordPress code. Sourced from Tagboard admin dashboards.</p>

        <div class="tagboard-embed" tgb-embed-id="5211"></div><script src="https://static.tagboard.com/embed/assets/js/embed.js"></script> 


        

    </div>
    </div>
    
  </div>
</div>


<?php get_footer(); ?>
