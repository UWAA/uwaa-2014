<?php get_header(); 

use \UWAA\View\ThumbnailBrowser\Thumbnail\Chapters;  
  // Start the Loop.
  while ( have_posts() ) : the_post();
  

?>

<div class="uwaa-chapter-header">
<?php get_template_part('partials/chapter-header') ?>
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

    

      

       <div class="row uwaa-home-branding-row">
    <div class="col-sm-6">
      <?php
        $UWAA->UI->Breadcrumbs->UWAABreadcrumbs();
       ?>
    </div>
    <div class="col-sm-6 uwaa-home-branding">
      <!-- <div class="logo hidden-xs hidden-sm"> -->
        <?php //get_template_part('assets/uwaa', 'logo.svg');?>
      <!-- </div> -->
      <em>Produced by the Alumni Association for all UW Alumni</em>
    </div> 
  </div>

      <div class="row">
       <?php
      

      $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

      $thumbnailRow->makeThumbnails(new Chapters(basename(get_permalink() ) ) );



      ?>

    </div>
      
      <div class="uw-body-copy">
            <?php
                // // Start the Loop.
                // while ( have_posts() ) : the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'content-chapters' );                    

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template('/comments.php');
                    }

                
            ?>

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">
    <?php 
        
        uw_sidebar_menu();
        echo "fix UW's Menu for Them";
        
        endwhile;

        $chapterSidebar = $UWAA->UI->buildChapterSidebar();

        $chapterSidebar->renderLeaderWidget();

        $chapterSidebar->renderSocialWidget();
    ?>

      
    </div>


  </div>

</div>

<?php get_footer(); ?>
