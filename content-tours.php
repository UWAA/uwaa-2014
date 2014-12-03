<h4>---Single tour page---</h4>

<h1><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h1>
<h3><?php echo get_post_meta($post->ID, 'mb_cosmetic_date', true); ?></h3>
<p>Tour Operator: <?php echo get_post_meta($post->ID, 'mb_operator', true); ?>
<p>Price: $<?php echo get_post_meta($post->ID, 'mb_price', true); ?>


<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>