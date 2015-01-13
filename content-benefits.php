<?php
    $benefitLogo = get_post_meta(get_the_ID(), 'mb_benefit_provider_logo', true);
?>
<h6 class="intro-head">Member Benefit</h6>

<?php if($benefitLogo) { ?>    
        <h1><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h1>
<?php } ?>



<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>