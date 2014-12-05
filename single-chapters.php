<?php get_header(); 
  // Start the Loop.
  while ( have_posts() ) : the_post();
  
  
?>

<div class="uwaa-hero-image" style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

      

       <?php
      // TODO Fix these breadcrumbs and have them default to the section front as opposed to the archive page for "tours"
      // get_template_part( 'breadcrumbs' );
      echo 'TODO- Custom Post Breadcrumbs';
      ?>

      <div class="uw-body-copy">
            <?php
                // // Start the Loop.
                // while ( have_posts() ) : the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'content-chapters' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                
            ?>

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">
    <?php 
        
        endwhile;
    ?>
    </div>


  </div>

</div>

<?php get_footer(); ?>
