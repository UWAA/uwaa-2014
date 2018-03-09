<div class="chapter-image-column" style="background-image:url('<?php \UWAA\View\UI::getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'chapterBrandingImage')?>');"></div>
            <div class="chapter-logo">
                <?php                

                    $regionalTags = $UWAA->RegionalTags->getRegionalTags();                    
                    $communitySlug = new \UWAA\View\GetCommunitySlug($post, $regionalTags);
                    $finalSlug = $communitySlug->isCommunitiesContent();
                    $logo = new \UWAA\View\ChapterHeaderLogo($finalSlug); 
                    // $logo = new \UWAA\View\ChapterHeaderLogo(); 
                    // $logo->determineSlug($post);
                    $logo->retriveSVG();
                ?>
                
            </div>
        

