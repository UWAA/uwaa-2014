<?php 
get_header();

use \UWAA\View\ThumbnailBrowser\Thumbnail\Reunions;
?>

<div id="spacer"></div>
<?php uw_mobile_front_page_menu(); ?>



<div class="uw-hero-image reunions"></div>


<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

    <h2 class="uw-site-title">Reunions</h2>

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

           

          endwhile;
          
        ?>
         
        

         

      </div>

    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php    
        
        echo sprintf( '<nav id="desktop-relative" aria-label="mobile menu that is not visible in the desktop version" class="uwaa-hidden-xs-up">%s</nav>', uw_list_pages() );;
        
        

    ?>   

      

    </div>
     

  </div>

   <div class="row 5-column">
       <?php
      

      $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

      $thumbnailRow->makeThumbnails(new Reunions);

      ?>

  </div>

</div>

<?php get_footer(); ?>
