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

        

        <p>Example 2 - Tagboard embed code directly injected into WordPress code</p>

        <div class="embed-header" style="padding: 30px; padding-bottom: 130px; background: #2E2253; clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 100px));">
  <h1 style="font-family: 'Lucida Grande', sans-serif; font-size: 30px; font-weight: 500; line-height: 1.2; margin: 0; margin-bottom: 15px; color: #AE9E74;">SNAP A PIC, SUPPORT A STUDENT</h1>
  <p style="font-family: 'Open Sans', sans-serif; font-size: 14px; font-weight: 500; line-height: 1.5; margin: 0; color: #FFFFFE;">UWAA is joining with AT&T to assist students in need. Now through April 18, share a Dawg Dash photo on Facebook, Instagram or Twitter with <strong>#DawgDashCares</strong> and AT&T will donate $100 to the UW Food Pantry. Tag AT&T in your photo and the donation doubles. Learn more about this partnership and other ways to support students in need.</p>
</div>
<div class="tagboard-embed" tgb-embed-id="5211"></div>
<script src="https://static.tagboard.com/embed/assets/js/embed.js"></script>


        

    </div>
    </div>
    
  </div>
</div>


<?php get_footer(); ?>
