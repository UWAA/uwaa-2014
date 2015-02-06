<h1><?php the_title() ?></h1>

<?php if (!is_front_page()) {$communitiesSidebarMenu->renderMobileCommunitiesChapterMenu();  }?>


<?php the_content(); ?>
