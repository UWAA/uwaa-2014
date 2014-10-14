<?php get_header(); 


?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div class="uw-body-copy">
        <h3>---travel home---</h3>
         
            <?php get_template_part( 'partials/map' ); ?>

         

      </div>

    </div>
    
    <?php get_sidebar() ?>

  </div>

</div>

<?php get_footer(); ?>
