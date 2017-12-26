<?php 
$chapterSidebar = $UWAA->UI->buildCommunitySidebar();
  // Start the Loop.
  while ( have_posts() ) : the_post();
  
$isMajorMarket = get_post_meta($post->ID, 'mb_isMajorMarket', true);

if ($isMajorMarket == 'notMajorMarket') {
  $url = apply_filters('remove_cms', get_site_url() . '/communities/all-communities/?chapter=' . $post->post_name);
  $UWAA->Utilities->Redirect($url, true);
}

get_header();

?>

<div class="uwaa-chapter-header">
<?php include(locate_template('partials/chapter-header.php')) ?>
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

          <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>


         

     
      
      <div class="uw-body-copy">

      
          <?php


                    include(locate_template( 'content-chapters.php' ));                    


          ?>

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">    
        <?php
        endwhile;



        $chapterSidebar->renderCommunitiesChapterMenu();

        $chapterSidebar->renderLeaderWidget();

        $chapterSidebar->renderSocialWidget();        

        if(get_the_title() == "Eastern Washington") {
        ?>
        <div class="widget no-frame-margin">
            <h2 class="widgettitle">Sign up for the 509 eNews</h2>

            <?php
            the_widget("UWAA\Widgets\SubPrefSignupForm", "subscriptionID=997&fromName=UW+Alumni+Association&fromEmail=uwalumni@uw.edu");
            ?>

        </div>
            <?php
        } else {

                    $chapterSidebar->renderChapterContactForm();
            }
        ?>

        
      
    </div>


  </div>

</div>

<?php get_footer(); ?>
