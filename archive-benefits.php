<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\BenefitsIsotope;
wp_enqueue_script('isotopeInit');
?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php // TODO Fix these breadcrumbs and have them default to the section front as opposed to the archive page for "tours"
      // get_template_part( 'breadcrumbs' );
      echo 'TODO- Custom Post Breadcrumbs'; ?>

      <h1><?php the_title() ?></h1>

      <div class="uw-body-copy">
        <div id="isotope-canvas">
        <?php
          $benefitsGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          
          $benefitsGrid->renderSearchBox('Benefits');
          $benefitsGrid->renderToolbar('Benefits');
          // $benefitsGrid->buildSortingToolbar('destinations'); 
        ?>
            <div class="isotope tile">
            <?php
            

            $benefitsGrid->makeThumbnails(new BenefitsIsotope);
            ?>
            </div>
        </div>

      </div>

    </div>   

  </div>

</div>

<?php get_footer(); ?>
