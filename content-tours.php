<h1><?php the_title() ?></h1>
<h2 class="date"><?php echo get_post_meta($post->ID, 'mb_cosmetic_date', true); ?></h2>
<p class="operator">Tour Operator: <?php echo get_post_meta($post->ID, 'mb_operator', true); ?></p>
<!-- <p class="price"><?php // echo get_post_meta($post->ID, 'mb_price', true); ?> -->




<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>


 <p>Please consider purchasing travel insurance to protect your trip.  <a href="http://www.washington.edu/cms/alumni/travel/travel-insurance/" class="read-more-link">Learn more.</a></p>

