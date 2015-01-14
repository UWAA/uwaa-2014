<h1><?php the_title() ?></h1>
<h2 class="date">
    <?php echo "".get_post_meta($post->ID, 'mb_cosmetic_date', true)."  ".get_post_meta($post->ID, 'mb_event_time', true)." " ?>
</h2>
<p><?php echo get_post_meta($post->ID, 'mb_event_location', true); ?>





<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>