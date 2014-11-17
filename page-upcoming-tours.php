<?php get_header(); 

wp_enqueue_script('isotopeInit');
?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div class="uw-body-copy">
        <div id="isotope-canvas">
        <?php \UWAA\View\Isotope::buildSortingToolbar('destinations'); ?>
            <div class="isotope tile">
            <?php get_template_part( 'partials/thumbnail-browser' ); ?>
            </div>
        </div>

      </div>

    </div>
    <div class="col-md-4 uw-sidebar">
    <?php 
        
        uw_sidebar_menu();
        dynamic_sidebar( 'travel_sidebar' ); 
    ?>
    </div>

  </div>

</div>

<?php get_footer(); ?>
