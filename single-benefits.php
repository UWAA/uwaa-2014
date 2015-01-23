<?php 
$UWAA->Memberchecker->getSession();
get_header(); 



  // Start the Loop.
  while ( have_posts() ) : the_post();
  
  
?>

<div class="uwaa-benefit-header">
<?php get_template_part('partials/benefit-header') ?>
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

      <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>


      <div class="uw-body-copy">
            <?php
                // // Start the Loop.
                // while ( have_posts() ) : the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'content-benefits' );
                    include(locate_template( 'partials/benefit-promo.php' ));

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                
            ?>
      
      <!-- For Debuggins -->
      <div id="output"></div>  

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">
    <?php new \UWAA\View\Pagination('benefits', get_the_ID()); ?>
    <?php include(locate_template( 'partials/login-form.php' )); ?>
    
    
    <?php 
         
        endwhile;        
    ?>
    </div>


  </div>

</div>

<?php get_footer(); ?>
