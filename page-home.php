<?php 
get_header(); 


?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php get_template_part( 'breadcrumbs' ); ?>


      
      
      

      <div class="uw-body-copy">

  <div class="row">
       <?php
      $args = array (
      'post_type' => array(
        'tours',
        'events',
        'benefits',
        'post'
        ),
      'orderby' => 'rand',
      // 'tag' => 'Home'
      
      'tax_query' => array(
        // 'relation' => 'AND',
        // array(
        //   'taxonomy' => 'destinations',
        //   'field'    => 'name',
        //   'terms'    => array( 'asia')
        // ),
        array(
          'taxonomy' => 'uwaa_content_promotion',
          'field'    => 'name',
          'terms'    => array( 'Home')

          )
      ) //End tax query    
      );

      $thumbnailRow = new \UWAA\View\ThumbnailBrowser;

      $thumbnailRow->makeThumbnailRow($args);

      ?>

</div>


        <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            the_content();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>
      </div>

    </div>
    
    

  </div>

</div>

<?php get_footer(); ?>
