<?php 
get_header(); 
?>



<div class="uw-hero-image membership"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>
    

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

            ?>
            
            <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>
        <div class="text-center">
            <h1></h1> <!--space between video and text -->
            <script src="https://fast.wistia.com/embed/medias/onbjt5vurx.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
            <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
            <div class="wistia_embed wistia_async_onbjt5vurx seo=false videoFoam=true autoPlay=true" style="height:100%;width:100%">&nbsp;</div></div></div>
            <!-- NOTE: popover=true popoverAnimateThumbnail=true makes autoplay not work -->
            <h1></h1> <!--space between video and text -->
            <span style="font-size:20px">Wishing you and your Husky family a holiday season filled with warmth and good cheer.</span>
        </div>
      </div>
    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php         
        echo sprintf( '<nav id="desktop-relative" aria-label="mobile menu that is not visible in the desktop version" class="uwaa-hidden-xs-up">%s</nav>', uw_list_pages() );;
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
