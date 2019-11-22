<?php 

$superheroURL = wp_get_attachment_url(get_post_thumbnail_id($post->ID))

?>

<div class="uw-homepage-slider-container uwaa-superhero">

  <div class="uw-hero-image uw-homepage-slider" style="background:url('<?php echo $superheroURL; ?>') no-repeat center; background-size:cover;">

  
    <div style="background-image:url('<?php echo $superheroURL; ?>')" class="mobile-image"></div>
  

    <div class="container hero-container vertical-center">

      <div class="row">
        <div class="col-md-8">

          <h2 class="title"><?php the_title(); ?></h2>          

          

          <div class="membership-superhero-excerpt">
          <?php ?> 
          </div>          
          

        </div>

      </div>

    </div>

  </div>  

</div>