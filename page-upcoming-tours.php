<?php get_header(); 

wp_register_script('isotopeTours', get_bloginfo('stylesheet_directory').'/js/isotopeTours.js', array(), null, true);
wp_enqueue_script('isotopeTours');
?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div class="uw-body-copy">
        <?php \UWAA\View\Isotope::buildSortingToolbar('destinations'); ?>
            <div class="isotope">
            <?php get_template_part( 'thumbnail-browser' ); ?>
            </div>

      </div>

    </div>
    <h3>---tours browser---</h3>
    <?php get_sidebar() ?>

  </div>

</div>

<?php get_footer(); ?>
