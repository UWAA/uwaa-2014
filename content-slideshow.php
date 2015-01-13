<div class="uw-homepage-slider-container">

<!-- Move this logic to the calling page,  -->
  <?php foreach ( $superhero->get_latest_slideshow() as $slide ) :
  // if ( class_exists('\UWAA\Slideshow') ) :  
    ?>

  <div class="uw-hero-image uw-homepage-slider slide-<?php echo $slide->id .' ' .$slide->header_text_color ?>" data-id="<?php echo $slide->id; ?>" style="background:url(<?php echo $slide->image; ?>) no-repeat center; background-size:cover;">

  <?php if ( isset( $slide->mobileimage ) ) : ?>
    <div style="background-image:url('<?php echo $slide->mobileimage; ?>')" class="mobile-image"></div>
  <?php endif; ?>

    <div class="container hero-container vertical-center">

      <div class="row">
        <div class="col-md-8">

          <h2><?php $subtitle = $slide->subtitle ? $slide->subtitle : ''; echo $subtitle ?></h2>
          <h1 class="title" id="<?php echo $slide->id; ?>-title"><?php echo $slide->title; ?></h1>
          <h2 class="date"><?php $date = $slide->date ? $slide->date : ''; echo $date ?></h2>

          

          <?php // echo apply_filters( 'the_content', $slide->text ); ?> 

          
          <a class="uw-btn btn-sm btn-none" href="<?php echo $slide->alternateLink ? $slide->alternateLink : $slide->link; ?>" aria-describedby="<?php echo $slide->id; ?>-title">Learn more </a>

        </div>

      </div>

    </div>

  </div>

  <?php endforeach;?>

      <div class="slideshow-controls">
          <p class="next-headline"></p>
      </div>

</div>