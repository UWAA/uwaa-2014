<?php

/**
 * Wordpress Page Template for Common Ground Project.
 *
 *
 *
 * @version 1.0
 * @author bperick
 */

get_header();
use \UWAA\View\ThumbnailBrowser\Thumbnail\CommonGroundEvent;  //event archetype
use \UWAA\View\ThumbnailBrowser\Thumbnail\CommonGroundStatewideImpact;  //story archetype
use \UWAA\View\ThumbnailBrowser\Thumbnail\CommonGroundProspective; //story archetype
?>

<div id="spacer"></div>
<?php uw_mobile_front_page_menu(); ?>



<div class="uw-hero-image common-ground"></div>


<div class="container uw-body">

    <div class="row">

        <div class="col-md-8 uw-content" role='main'>

            <h2 class="uw-site-title">Common Ground</h2>

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

            
            <h3>Perspectives</h3>
            <div class="row">
                
                <?php


                $thumbnailRowTwo = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                $thumbnailRowTwo->makeThumbnails(new CommonGroundProspective);

                ?>

            </div>

            <h3>Statewide Impact</h3>
            <div class="row">
                
                <?php


                $thumbnailRowThree = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                $thumbnailRowThree->makeThumbnails(new CommonGroundStatewideImpact);

                ?>

            </div>

            <h3>Events</h3>
            <div class="row">
              
                <?php


                $thumbnailRowOne = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                $thumbnailRowOne->makeThumbnails(new CommonGroundEvent);

                ?>

            </div>



        </div>

        <div class="col-md-4 uw-sidebar">
            <?php

        uw_sidebar_menu();



            ?>



        </div>


    </div>

    

</div>

<?php get_footer(); ?>
