<h1><?php the_title() ?></h1>

<?php

$communitiesSidebarMenu = $UWAA->UI->buildCommunitySidebar();

$communitiesSidebarMenu->renderMobileCommunitiesChapterMenu(); 
 ?>

<?php the_content(); ?>
