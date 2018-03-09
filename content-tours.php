<h1><?php the_title() ?></h1>
<h2 class="date"><?php echo get_post_meta($post->ID, 'mb_cosmetic_date', true); ?></h2>
<p class="operator">Tour Operator: <?php echo get_post_meta($post->ID, 'mb_operator', true); ?></p>
<!-- <p class="price"><?php // echo get_post_meta($post->ID, 'mb_price', true); ?> -->


<!-- Modal -->
<div id="activity-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" aria-label="close" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $themeDirectory = get_stylesheet_directory_uri();
            $activityIcon = "<img src='".$themeDirectory."/assets/Tours_ActivityLevel_Icon.svg'>";

            ?>

            <div class="modal-body">

                <?php echo str_repeat($activityIcon, 1); ?>
                <p>
                    <strong>Easy: </strong>Minimal walking is required. Typically, involves cruising by ship. Suitable for travelers with limited mobility. Optional excursions may require a higher activity level.
                </p>
            </div>

            <div class="modal-body">
                <?php echo str_repeat($activityIcon, 2); ?>
                <p>
                    <strong>Moderate: </strong>Moderate amount of walking required. Typically, two to three miles a day, often uphill, on uneven terrain and/or with multiple stairs. Requires the ability to board a ship and motor coach without assistance.
                </p>
            </div>

            <div class="modal-body">
                <?php echo str_repeat($activityIcon, 3); ?>
                <p>
                    <strong>Active: </strong>Extensive walking required. Typically, three or more miles a day, often uphill, on uneven terrain, and/or with multiple stairs. May include optional activities such as biking, kayaking, or hiking and included destinations with high altitudes. Excellent health is required to take full advantage of the tour's inclusions.
                </p>
            </div>

            <div class="modal-body">
                <?php echo str_repeat($activityIcon, 4); ?>
                <p>
                    <strong>Highly Active: </strong>Extensive walking and intense daily physical activity required. Appropriate for people who lead very active lives. Trip activities will be at a higher intensity and a more vigorous pace and may include activities such as biking, hiking at high altitudes and for long distances, white water rafting, and kayaking. A pre-trip physical training program is highly recommended and strongly encouraged.
                </p>
            </div>

            <div class="modal-footer">
                <p>To fully enjoy your tour experience, it is important to be in good health regardless of the tour's activity level. Please use your best discretion when deciding which group tour is right for you as your ability will have an impact on other participants. If you have any questions, please do not hesitate to contact the UW Alumni Tours office.</p>
            </div>
        </div>

    </div>
</div>

<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>


 <p>Please consider purchasing travel insurance to protect your trip.  <a href="http://www.washington.edu/cms/alumni/travel/travel-insurance/" class="read-more-link">Learn more.</a></p>

