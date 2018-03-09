<?php 
use \UWAA\View\ThumbnailBrowser\Thumbnail\Chapters;
$communitiesSidebarMenu = $UWAA->UI->buildCommunitySidebar();

?>

<h1><?php the_title() ?></h1>

<div class="mobile-menu-row">    
   <?php 
   
   $communitiesSidebarMenu->renderMobileCommunitiesChapterMenu();  
   ?>
</div>

<div class="row">
       <?php
      

      $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

      $thumbnailRow->makeThumbnails(new Chapters(basename(get_permalink() ) ) );



      ?>

    </div>

<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>