<?php
  // Start the Loop.
  while ( have_posts() ) : the_post(); 

$isPartnerEvent = get_post_meta($post->ID, 'mb_isPartnerEvent', true);

if ($isPartnerEvent) {
  $url = apply_filters('remove_cms', get_post_meta($post->ID, 'mb_alternate_link', true));
  $UWAA->Utilities->Redirect($url, true);
}


   get_header(); 
 ?>
<a name="pagination-top"></a>
 



 <?php
$regionalTagList = $UWAA->RegionalTags->getRegionalTags();
$communitySlug = new \UWAA\View\GetCommunitySlug($post, $regionalTagList);
$featureImage = $UWAA->UI->returnPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original');
$finalSlug = $communitySlug->isCommunitiesContent();
$noRegionalBranding = has_category('No Regional Branding');

 // if you have a featured image, put it in
 // 
if (has_category('Veterans Week')) {
    $vetsHome = get_site_url("/veterans/");
    wp_enqueue_style('google-font-cinzel');  
    include(locate_template('partials/vets-single-header.php'));
  }
 elseif ($finalSlug && $featureImage && !$noRegionalBranding) {
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
 }elseif ($finalSlug && !$featureImage) {
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

  } elseif ($finalSlug && $noRegionalBranding) {
  ?>
    <div class="uwaa-hero-image <?php echo get_post_meta(get_the_id(), 'mb_header_text_color', true); ?> " style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>
    <?php
  } 
  else {
    $defaultHeader = TRUE;
     get_template_part( 'header', 'image' ); 
   }




?>





<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

    <?php if ($defaultHeader) { uw_site_title(); }; ?>

      <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>


      <div class="uw-body-copy">
            <?php

              new \UWAA\View\Pagination('events', get_the_ID());
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

               if (has_category('Veterans Week')) {
                echo do_shortcode('[uwaa-button url="/veterans?filter=veterans-stories" color="purple" type="slant-right"]More Vet Stories[/uwaa-button]');
                echo do_shortcode('[uwaa-button url="/veterans?filter=veterans-events" color="gold" type="slant-left"]More Vet Events[/uwaa-button]');
              }

            
            ?>
      
      </div>

    </div>

    <div class="col-md-4 uw-sidebar">
    <?php 
        new \UWAA\View\Pagination('events', get_the_ID());        
        the_widget("UWAA\Widgets\SidebarPullQuote");        
        the_widget("UWAA\Widgets\SocialSidebar");
        the_widget("UWAA\Widgets\SidebarFeaturedPost");
        endwhile;
    ?>
    </div>

  </div>

  <?php
    if (has_category('Veterans Week')) {
    ?>
      <div class="star-line"></div>
    <?php
    } 
    ?>


</div>

<?php get_footer(); ?>
