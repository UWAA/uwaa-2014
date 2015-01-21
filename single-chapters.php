<?php get_header(); 
$chapterSidebar = $UWAA->UI->buildCommunitySidebar();


  // Start the Loop.
  while ( have_posts() ) : the_post();
  

?>

<div class="uwaa-chapter-header">
<?php get_template_part('partials/chapter-header') ?>
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

          <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>


         

     
      
      <div class="uw-body-copy">

      
            <?php
        

                    include(locate_template( 'content-chapters.php' ));                    

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template('/comments.php');
                    }

                
            ?>

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">    
    <?php        
        endwhile;

        

        $chapterSidebar->renderCommunitiesChapterMenu();        

        $chapterSidebar->renderLeaderWidget();

        $chapterSidebar->renderSocialWidget();

        $chapterSidebar->renderChapterContactForm();
    ?>

      
    </div>


  </div>

</div>

<?php get_footer(); ?>
