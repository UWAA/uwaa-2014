<?php
// Jump-in Single-Page Template

get_header(); 



?>

<!-- Header - ACF field for side image, ACF field for header text content -->

<div class="dawgdash-container">
<div class="dawgdash-header no-gutters">
    <div class="image">
      <?php 

      $headerImage = get_field('header_image');
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
                      if( $headerImage ) {
                        echo wp_get_attachment_image( $headerImage, $size );
                    }
      
      ?>
    </div>
    <div class="text">
      <h1><?php html_entity_decode(the_field('header_title') ) ?></h1>
      <p><?php html_entity_decode(the_field('header_copy') ) ?></p>
    </div>
</div>


<div class="container-fluid yellow-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="register-row yellow-background">            
            <div class="register-row-content">              
              <p><?php the_field('register_bands_text') ?>              
                </p>
                <a href="<?php echo get_field('getmeregistered_link') ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button"><?php the_field('register_bands_button_text') ?></a>
                
         </div>
            
        </div>

          </div>

    </div>
  </div>

<div class="container-fluid black-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="details-row black-background">            
            <div class="copy">
                <h2><?php html_entity_decode(the_field('registration_details_title') ) ?></h2>
                <p><?php html_entity_decode(the_field('registration_details_copy') ) ?></p>
                <ul>
                    <li><?php html_entity_decode(the_field('general_public_title') ) ?><span class="price"><?php html_entity_decode(the_field('general_public_price') ) ?></span></li>
                    <li><?php html_entity_decode(the_field('member_title') ) ?><span class="price"><?php html_entity_decode(the_field('member_price') ) ?></span></li>
                    <li><?php html_entity_decode(the_field('student_title') ) ?><span class="price"><?php html_entity_decode(the_field('student_price') ) ?></span></li>
                </ul>

            </div>
            <div class="image">
      <?php 

      $detailsImage = get_field('registration_details_image');
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
                      if( $detailsImage ) {
                        echo wp_get_attachment_image( $detailsImage, $size );
                    }
      
      ?>
    </div>

                
         </div>
            
        </div>

          </div>

    </div>
  </div>

  <div class="container-fluid light-purple-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="membership-special-row light-purple-background">            
            <div class="subtitle"><?php html_entity_decode(the_field('membership_band_subtitle') ) ?></div>
            <div class="price">$<?php html_entity_decode(the_field('member_special_price') ) ?></div>
            <div class="copy"><?php html_entity_decode(the_field('membership_band_copy') ) ?></div>
            
        </div>

          </div>

    </div>
  </div>

  <div class="container-fluid black-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="registration-item-row black-background">
        <div class="registration-item pups">
            <h2>Title</h2>
            <p class="subhead">Sub</p>
            <p class="copy">Some Copy</p>
            <p class="price">$15</p>
        </div>
        <div class="registration-item dogs">
            <h2>Title</h2>
            <p class="subhead">Sub</p>
            <p class="copy">Some Copy</p>
            <p class="price">$15</p>
        </div>
        <div class="registration-item virtual">
            <h2>Title</h2>
            <p class="subhead">Sub</p>
            <p class="copy">Some Copy</p>
            <p class="price">$15</p>
        </div>

    </div>
                
         </div>
            
    </div>

          </div>

    </div>
  </div>

<div class="container-fluid yellow-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="register-row yellow-background">            
            <div class="register-row-content">              
              <p><?php the_field('register_bands_text') ?>              
                </p>
                <a href="<?php echo get_field('getmeregistered_link') ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button"><?php the_field('register_bands_button_text') ?></a>
                
         </div>
            
        </div>

          </div>

    </div>
  </div>
  

<div class="overlay-container container-fluid">
  <div class="overlay-row row">  

    <div class="container uw-body">

    

      <div class="row">

        <div class="col-md-12 uw-content" role='main'>

        <!-- ACF repeater field, two values, image and text -->
          <?php 
              // Check rows exists.
          if( have_rows('blocks') ):

              // Loop through rows.
              while( have_rows('blocks') ) : the_row();

                  // Load sub field value.
                  $image = get_sub_field('icon_image');
                  $subTitle = get_sub_field('subtitle');
                  $copyBlock = get_sub_field('copy_block');
                  $linkText = get_sub_field('link_text');
                  $linkURL = get_sub_field('link');
                          
                  // Do something...

                  ?>

                  <!-- Template -->

                  <div class="row">
                    <div class="icon">
                      <?php               
                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                          if( $image ) {
                            echo wp_get_attachment_image( $image, $size );
                        }
                      ?>
                    </div>
                    <div class="textarea">
                      <h2><?php echo $subTitle ?></h2>
                      <p>
                        <?php 
                          echo html_entity_decode($copyBlock);
                          
                          if( $linkURL ): ?>
                            <a href="<?php echo esc_url( $linkURL ); ?>"><?php echo html_entity_decode($linkText); ?></a>
                          <?php endif; ?>

                      </p>

                    </div>
                  </div>

                  <?php

              // End loop.
              endwhile;

          // No value.
          else :
              // Do something...
          endif;

          ?>

        </div>

        

      </div>

      

    </div>

</div> <!-- overlay row -->
</div> <!-- overlay fluid-container -->

<div class="container-fluid wufoo-container">
  <div class="wufoo-form-row">
    <div class="form-container">
      <h2>tell us</h2>

      <div class="form responsive-embed">


        <?php 
          $formID = get_field('wufoo_form_id');
          if($formID) {
            echo do_shortcode('[wufoo username="uwalum" formhash="'.$formID.'" autoresize="true" height="300" header="show" ssl="true" defaultv="Field5='.get_the_title() .'"]' );
          }
          
        ?>

      </div>

    </div>


  </div>
</div>

<!-- /jumpin-container -->
</div>



<?php get_footer(); ?>
