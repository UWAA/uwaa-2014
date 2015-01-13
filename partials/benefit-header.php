<?php 

$benefitLogo = get_post_meta(get_the_ID(), 'mb_benefit_provider_logo', true);
$title = get_the_title();

$benefitWithLogo = <<<WITHLOGO

<div class="benefit-logo" style="background-image:url('$benefitLogo')"></div>
WITHLOGO;

$benefitWithoutLogo = <<<NOLOGO

<div class="benefit-logo">
<h1>$title</h1>
</div>
NOLOGO;

?>

<div class="benefit-image" style="background-image:url('<?php \UWAA\View\UI::getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>



<?php

if ($benefitLogo) {
    echo $benefitWithLogo;
} else {
    echo $benefitWithoutLogo;
}

?>



        

