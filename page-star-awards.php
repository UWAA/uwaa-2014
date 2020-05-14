<?php 
get_header(); 
wp_enqueue_script(array('starsAwardsSearch')); 
?>



<div class="uw-hero-image star-awards"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>
    

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
            get_template_part( 'content', 'star-awards' ); 

            ?>
            
            <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>

    <input id="search" type=text placeholder="Search">

    <div id="cards">
    <div class ="grid">    
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>John Doe</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
      <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>John A</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>John Smith</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>Name Name</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>First Last</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>Blah Blah</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h1>Another Name</h1>
                </div>
                <div class="flip-card-back">
                    <p>Some amazing quote</p>
                </div>
            </div>
        </div>
        </div>  
    </div>

    </div>
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
