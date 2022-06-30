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
            <h2>kids</h2>
            <p class="subhead">husky pups run</p>
            <p class="copy">Kids under 12 can join the fun, run with the pack, and get a sweet t-shirt.</p>
            <p class="price">$10</p>
        </div>
        <div class="registration-item dogs">
            <h2>dogs</h2>
            <p class="subhead">four-legged fun</p>
            <p class="copy">Register your dog to receive a snazzy dogdanna. Two sizes available to fit pugs to pointers.</p>
            <p class="price">$15</p>
        </div>
        <div class="registration-item virtual">
            <h2>VIRTUAL</h2>
            <p class="subhead">RUN ANYWHERE</p>
            <p class="copy">Not in Seattle? We’ve got you covered. Check out our virtual options and run where you are!  </p>
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


    <div class="container-fluid white-background">
  <div class="row no-gutters">

   
      <div class="sponsor-block-row">            
            <div class="sponsor-block alaska"></div>
          
            
        </div>

        <div class="sponsor-block-row">
              <div class="sponsor-block brooks half-size"></div>
            <div class="sponsor-block alaska half-size"></div>
        </div>

    

    </div>
  </div>

  <div class="container-fluid map-container light-purple-background">
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
  <div class="row no-gutters">

    <div class="container">

      <div class="course-map-title-row light-purple-background">            
            
            <div class="title">Course Map</div>
           
            
        </div>

    </div>

   <div id='map'></div>

<script>
L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
  var map = L.mapbox.map('map')
    .setView([47.661, -122.308], 15)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/bperick/cl3xc38ar000115qmby77jmwd'));

  map.legendControl.addLegend(document.getElementById('legend').innerHTML);
</script>

    </div>
  </div>


  <div class="container-fluid white-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="faq-row white-background">            
            <div class="register-row-content">              
              <?php the_field('faq') ?>              
            
                
         </div>
            
        </div>

          </div>

    </div>
  </div>

  <div class="container-fluid white-background">
  <div class="banner-row no-gutters">
    <div class="banner banner-sm"></div>
    <div class="banner banner-lg"></div>
    

    </div>
  </div>


   <div class="container-fluid white-background">
  <div class="row no-gutters">

    <div class="container">

      <div class="faq-row white-background">            
            <div class="register-row-content">              
              <p style="text-align: center;"><em>Special thanks to our partners</em></p>
<p style="text-align: center;"><a href="http://alaskaair.com"><img class="aligncenter wp-image-22219" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2019/09/17151258/Logo_AlaskaAirlines_190x701.png" alt="Alaska Airlines logo" width="204" height="90" /></a></p>
<p style="text-align: center;"><a href="https://www.att.com/"><img class="aligncenter wp-image-21331 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2019/08/21115831/Logo_ATT_190x70.gif" alt="logo_01_BECU" width="131" height="48" /></a><a href="https://www.becu.org/everyday-banking/debit-card/uw-card"><img class="aligncenter wp-image-29659 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2015/06/10172428/Logo_BECU_190x70.gif" alt="" width="190" height="70" /></a></p>
<p style="text-align: center;"><a href="https://www.brooksrunning.com/"><img class="aligncenter wp-image-21340 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183156/logo_Brooks.jpg" alt="logo_Brooks" width="131" height="48" /></a> <a href="http://www.bookstore.washington.edu/home/home.taf?"><img class="aligncenter wp-image-21328 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183158/logo_00_bookstore1.png" alt="logo_00_bookstore" width="131" height="48" /></a><a href="https://www.uwmedicine.org/"><img class="aligncenter wp-image-51338" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2021/08/11120945/UWM_CobrandedLogo-300x88.jpg" alt="" width="160" height="47" /></a><a href="https://wsecu.org/"><img class="aligncenter wp-image-21330 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183203/logo_05_WSECU.png" alt="logo_05_WSECU" width="131" height="48" /></a></p>
            
                
         </div>
            
        </div>

          </div>

    </div>
  </div>



<!-- /jumpin-container -->
</div>



<?php get_footer(); ?>
