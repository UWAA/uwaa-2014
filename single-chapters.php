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
  <!-- FPO for Demo Only @TODO Remove -->
    <nav id="desktop-relative" role="navigation" aria-label="relative"><ul style="margin-top: -80px;" class="uw-sidebar-menu first-level"><li class="pagenav"><a href="https://cms.alumni.washington.edu/alumni" title="Home" class="homelink">Home</a><ul><li class="page_item page-item-595 page_item_has_children current_page_ancestor current_page_parent"><a href="https://cms.alumni.washington.edu/alumni/communities/u-s-huskies/">U.S. Huskies</a>
        <ul class="children">
          <li class="page_item page-item-932 current_page_item"><span>New York Huskies</span></li>   
        </ul>
      </li>
    </ul>
  </li>
</ul>
</nav>
<!-- FPO for Demo Only @TODO Remove -->
<?php 
        
        // uw_sidebar_menu();
        // echo "fix UW's Menu for Them";
        
        endwhile;



        $chapterSidebar = $UWAA->UI->buildChapterSidebar();

        $chapterSidebar->renderLeaderWidget();

        $chapterSidebar->renderSocialWidget();
    ?>

      
    </div>


  </div>

</div>

<?php get_footer(); ?>
