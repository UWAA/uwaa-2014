<div class="chapter-image-column" style="background-image:url('<?php \UWAA\View\UI::getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>
            <div class="chapter-logo">
                <?php new \UWAA\View\ChapterHeaderLogo($post->post_name); ?>
                <?php 
                // get_template_part('assets/regionLogo', 'nyc.svg'); 
                ?>
            </div>
        

