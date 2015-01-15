<?php get_header(); 
  // Start the Loop.
  while ( have_posts() ) : the_post(); 
 ?>

 



 <?php


$communitySlug = new \UWAA\View\GetCommunitySlug($post);
$featureImage = $UWAA->UI->returnPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original');
$finalSlug = $communitySlug->isCommunitiesContent();
 // if you have a featured image, put it in
 // 
 // 
 if ($finalSlug && $featureImage) {
  ?>
  <div class="uwaa-chapter-header">
    <div class="chapter-image-column" style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'chapterBrandingImage')?>');"></div>        
     <div class="chapter-logo">
       <?php
       $logo = new \UWAA\View\ChapterHeaderLogo($finalSlug); 
        $logo->retriveSVG();
        ?>
     </div>
    </div>
<?php
 }else if ($finalSlug && !$featureImage) {
    ?>
    <div class="uwaa-chapter-header">
    <div class="chapter-image-column" style="background-image:url('<?php $communitySlug->getCommunityBrandingImage($finalSlug);?>');"></div>
    
      <?php    ?>
     <div class="chapter-logo">
       <?php
       $logo = new \UWAA\View\ChapterHeaderLogo($finalSlug); 
        $logo->retriveSVG();
        ?>
     </div>
    </div>
  
    <?php    
  } elseif (!$finalSlug  && $featureImage) {
    ?>
    <div class="uwaa-hero-image <?php echo get_post_meta(get_the_id(), 'mb_header_text_color', true); ?> " style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>
    <?php
  } else {
     get_template_part( 'header', 'image' ); 
   }




?>





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
                    get_template_part( 'content-events' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template('/comments.php');
                    }

                
            ?>

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">
    <?php 
        dynamic_sidebar( 'events' );
        the_widget("UWAA\Widgets\SidebarPullQuote");
        the_widget("UWAA\Widgets\SocialSidebar"); 
        endwhile;
    ?>
    </div>


  </div>

</div>

<?php get_footer(); ?>
