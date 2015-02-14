<?php 
get_header(); 
?>



<div class="uw-hero-image services"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

    <h2 class="uw-site-title">Alumni Services</h2>

  <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

      <div class="uw-body-copy">
      

        <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', 'page' );

            $headers = "?reference=UWAA&hideComments=yes&personOrOrg=P";
            
            ?>
            <div class="text-center">
              <iframe id="givingFrame" width="520" scrolling="no" height="1725" frameborder="0" src="https://online.gifts.washington.edu/bioupdate<?php echo $headers;?>"> … </iframe>
            </div>
            
            <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>
         
        

         

      </div>

    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php         
        uw_sidebar_menu();
        dynamic_sidebar( 'services_sidebar' ); 
    ?>   
    </div>

  </div>

</div>

<!-- Handlebars Templates -->

<!-- Index View  -->
<script id="membershipIndexTile" type="text/x-handlebars-template">
    {{#each []}}
    <div class="membership-option-tile">
       <h2>{{this.title}}</h2>
       <h2>Membership</h2>
    <div>
    {{/each}}
</script>



<!-- Tile View  -->
<script id="membershipTile" type="text/x-handlebars-template">
    {{#each []}}
    <div class="membership-option-tile">
       <h2>{{this.title}}</h2>
       <h2>Membership</h2>
    <div>
    {{/each}}
</script>

<!-- Thumbnails -->
<script id="membershipThumbnails" type="text/x-handlebars-template">
    <div class="membership-option-tile">
       <span class"thumbnail"> You have Chosen: </span>
    <div>
</script>



<?php get_footer(); ?>
