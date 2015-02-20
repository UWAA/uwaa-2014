<?php
    $benefitLogo = get_post_meta(get_the_ID(), 'mb_benefit_provider_logo', true);
?>
<h6 class="intro-head">Member Benefit</h6>


        <h1><?php the_title() ?></h1>




<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>