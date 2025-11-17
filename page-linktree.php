<?php
//get_header(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" class="no-js">
    <head>
        <title> <?php wp_title(' | ',TRUE,'right'); bloginfo('name'); ?> </title>
        <meta charset="utf-8">
        <meta name="description" content="<?php bloginfo('description', 'display'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <?php wp_head(); ?>

        <!--[if lt IE 9]>
            <script src="<?php bloginfo("template_directory"); ?>/assets/ie/js/html5shiv.js" type="text/javascript"></script>
            <script src="<?php bloginfo("template_directory"); ?>/assets/ie/js/respond.js" type="text/javascript"></script>
            <link rel='stylesheet' href='<?php bloginfo("template_directory"); ?>/assets/ie/css/ie.css' type='text/css' media='all' />
        <![endif]-->

        <?php
        echo get_post_meta( get_the_ID() , 'javascript' , 'true' );
        echo get_post_meta( get_the_ID() , 'css' , 'true' );
        ?>
  <link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/linktree-style.css" type="text/css" media="all">
    </head>
    <!--[if lt IE 9]> <body <?php body_class('lt-ie9'); ?>> <![endif]-->
    <!--[if gt IE 8]><!-->
    <body <?php body_class(); ?> >
    <!--<![endif]-->

    <div id="uw-container">

    <div id="uw-container-inner">

<div class="container uw-body linktree">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <div class="uw-body-copy">      

      <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', 'linktree' );

          endwhile;
        ?>
        

      </div>

    </div>
    <!--<div class="col-md-4 uw-sidebar">
    <?php 
    /*
        echo sprintf( '<nav id="desktop-relative" aria-label="mobile menu that is not visible in the desktop version" class="uwaa-hidden-xs-up">%s</nav>', uw_list_pages() );;
        // echo '<nav id="desktop-relative" role="navigation" aria-label="relative">';
        // uwaa_list_pages();
        // echo '</nav>';
        dynamic_sidebar( 'about_sidebar' ); 
        */
    ?>
    </div> -->

  </div>

</div>

<?php wp_footer(); ?>
