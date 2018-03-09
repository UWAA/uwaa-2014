<h6 class="intro-head"> <?php echo get_post_meta($post->ID, 'mb_thumbnail_subtitle', true) ?></h6>
<h1><?php the_title() ?></h1>
<h2 class="date">
    <?php echo "" . get_post_meta($post->ID, 'mb_cosmetic_date', true)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".get_post_meta($post->ID, 'mb_event_time', true)." " ?>
</h2>
<p class="location"><?php echo get_post_meta($post->ID, 'mb_event_location', true); ?>





<?php
  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>