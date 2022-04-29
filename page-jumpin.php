<?php
// Jump-in Single-Page Template

get_header(); 



?>

<!-- Header - ACF field for side image, ACF field for header text content -->

<div class="jumpin-container">
<div class="jumpin-header no-gutters">
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
      <h1><?php the_field('page_title') ?></h1>
      <p><?php the_field('header_copy') ?></p>
    </div>
</div>


<div class="container-fluid gold-background">
  <div class="row">

    <div class="container">

      <div class="app-download gold-background">
            <!-- Gold download app row -->
            <div class="app-image">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/jumpin/Phone_Icon.png" alt="Smartphone">
            </div>
            <div class="copy-block">
              <p class="subtitle"><?php the_field('app_download_row_subtitle') ?></p>
              <p class="copy"><?php the_field('app_download_row_copy') ?></p>
            </div>
            <div class="store-icons">
              <ul class="app-store-icons">
                <li ><a class="store-icon apple" href="https://apps.apple.com/us/app/uw-alumni-association/id682824301">apple</a></li>
                <li ><a class="store-icon android" href="https://play.google.com/store/apps/details?id=edu.uw.uwaa">android</a></li>
              </ul>
            </div>
        </div>

          </div>

    </div>
  </div>

  <div class="container-fluid purple-background">
  <div class="row">

    <div class="container">

        <div class="purple-social">
            <!-- Purple social  -->
            <div class="follow-text">
              <p>follow us</p>
            </div>
            <div class="social-icons">
              <ul>
              <li>
                <a class="instagram" href="http://instagram.com/uwalum">Instagram</a>
              </li>
              <li>
                <a class="twitter" href="https://www.twitter.com/UWalum">Twitter</a>
              </li>
              <li>
                <a class="facebook" href="https://www.facebook.com/UWalum">facebook</a>
              </li>
              <li>
                <a class="linkedin" href="https://www.linkedin.com/groups?gid=40422">linkedin</a>
              </li>
            </ul>
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
                          echo $copyBlock;
                          
                          if( $linkURL ): ?>
                            <a href="<?php echo esc_url( $linkURL ); ?>"><?php echo $linkText; ?></a>
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

      <div class="form">


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
