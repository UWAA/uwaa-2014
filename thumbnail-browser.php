<div class="col-md-2" data-category="<?php uwaa_get_tour_taxonomy_categories(); ?>">

<h1><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h1>

<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>

 </div>