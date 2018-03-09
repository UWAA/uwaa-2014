<?php 


//TODO abstract this to Taxonomy utils 

$args = array (
    'post_type' => 'tours',
    'orderby' => 'rand',
);


$toursQuery = new WP_Query( $args );

// The Loop
if ( $toursQuery->have_posts() ) {
    while ( $toursQuery->have_posts() ) {
        $toursQuery->the_post();
        ?>

<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
<div class="isotope-slide <?php \UWAA\Taxonomies\Utilities::echoListOfTerms('destinations'); ?>">

<h2><?php the_title() ?></h2>

</div>
</a>

<?php

    }
wp_reset_query();

} else {
    echo "<h3>No Tours Found</h3>";
    wp_reset_query();
}
