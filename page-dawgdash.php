<?php
// Jump-in Single-Page Template

wp_enqueue_script('dd23map');
wp_enqueue_style('mapbox331');
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






<div class="register-row yellow-background">            
<div class="register-row-content">              
<p><?php the_field('register_bands_text') ?>              
</p>
<a href="<?php echo get_field('getmeregistered_link') ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button"><?php the_field('register_bands_button_text') ?></a>

</div>



</div>







<div class="details-row black-background">

<div class="image">
<?php 

$detailsImage = get_field('registration_details_image');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $detailsImage ) {
  echo wp_get_attachment_image( $detailsImage, $size );
}

?>
</div>


<div class="copy">
<h2><?php html_entity_decode(the_field('registration_details_title') ) ?></h2>
<p><?php html_entity_decode(the_field('registration_details_copy') ) ?></p>
<ul>
<li><div><?php html_entity_decode(the_field('member_title') ) ?></div><div class="price">$<?php html_entity_decode(the_field('member_price') ) ?></div></li>
<li><div><?php html_entity_decode(the_field('general_public_title') ) ?></div><div class="price">$<?php html_entity_decode(the_field('general_public_price') ) ?></div></li>
<li><div><?php html_entity_decode(the_field('student_title') ) ?></div><div class="price">$<?php html_entity_decode(the_field('student_price') ) ?></div></li>
</ul>

</div>





</div>







<div class="membership-special-row light-purple-background">            
<div class="subtitle"><?php html_entity_decode(the_field('membership_band_subtitle') ) ?></div>
<div class="price">$<?php html_entity_decode(the_field('member_special_price') ) ?></div>
<div class="copy"><?php html_entity_decode(the_field('membership_band_copy') ) ?></div>

</div>



<?php 
if(get_field('registration_items_pups_image')){ ?>

<style type="text/css">
   div.registration-item.pups {
    background-image: url(<?php the_field('registration_items_pups_image'); ?>) !important;
   }
</style>

<?php }?>

<?php 
if(get_field('registration_items_dogs_image')){ ?>

<style type="text/css">
   div.registration-item.dogs {
    background-image: url(<?php the_field('registration_items_dogs_image'); ?>) ,url(<?php echo get_stylesheet_directory_uri(  );?>/assets/dawgdash23/2023_Dawg-Dash-Dawgdanna-WSECU_250x38.png) !important;
   }
</style>

<?php }?>

<?php 
if(get_field('registration_items_virtual_image')){ ?>

<style type="text/css">
   div.registration-item.virtual {
    background-image: url(<?php the_field('registration_items_virtual_image'); ?>) !important;
   }
</style>

<?php }


  $regItemCutoverTime = "09/16/2022 23:59";
  $columnSize = "col-sm-6";

  if ($UWAA->Utilities->isCurrentTimeBefore($regItemCutoverTime)) {
  $columnSize = "col-sm-4";
  }







?>





<div class="registration-item-row black-background">
<div class="registration-item <?php echo $columnSize; ?> pups">
<h2><?php html_entity_decode(the_field('registration_items_pups_title') ) ?></h2>
<p class="subhead"><?php html_entity_decode(the_field('registration_items_pups_subhead') ) ?></p>
<p class="copy"><?php html_entity_decode(the_field('registration_items_pups_copy') ) ?></p>
<p class="price">$<?php html_entity_decode(the_field('registration_items_pups_price') ) ?></p>
</div>
<div class="registration-item <?php echo $columnSize; ?> dogs">
<h2><?php html_entity_decode(the_field('registration_items_dogs_title') ) ?></h2>
<p class="subhead"><?php html_entity_decode(the_field('registration_items_dogs_subhead') ) ?></p>
<p class="copy"><?php html_entity_decode(the_field('registration_items_dogs_copy') ) ?></p>
<p class="price">$<?php html_entity_decode(the_field('registration_items_dogs_price') ) ?></p>
</div>

<?php if ($UWAA->Utilities->isCurrentTimeBefore($regItemCutoverTime)) { ?>
  
  <div class="registration-item <?php echo $columnSize; ?> virtual">
<h2><?php html_entity_decode(the_field('registration_items_virtual_title') ) ?></h2>
<p class="subhead"><?php html_entity_decode(the_field('registration_items_virtual_subhead') ) ?></p>
<p class="copy"><?php html_entity_decode(the_field('registration_items_virtual_copy') ) ?></p>
<p class="price">$<?php html_entity_decode(the_field('registration_items_virtual_price') ) ?></p>
</div>

<?php } ?>




</div>


<div class="black-background">
<div class="row no-gutters">


<div class="sponsor-block-row">
<div class="bonus-copy">
  <div class="subtitle">Members Get More!</div>
  <div class="copy">Complete your running look with a UWAA member-exclusive cherry blossom cooling buff.</div>
</div>
<div class="sponsor-block uwaa"></div>

</div>

  </div>
  </div>




<div class="register-row yellow-background">            
<div class="register-row-content">              
<p><?php the_field('register_bands_text') ?>              
</p>
<a href="<?php echo get_field('getmeregistered_link') ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button"><?php the_field('register_bands_button_text') ?></a>

</div>

</div>






<div class="black-background">
<div class="row no-gutters">


<div class="sponsor-block-row">
<a href="https://www.alaskaair.com/promo/as2216">
<div class="sponsor-block alaska"></div>
</a>
</div>

<div class="sponsor-block-row">
<a href="https://www.brooksrunning.com/en_us/blog/training-workouts/">
<div class="sponsor-block brooks half-size"></div>
</a>

<div class="sponsor-block att half-size">

</div>
</div>

</div>


</div>


<div class="map-container light-purple-background">    
<div class="row no-gutters">

<div class="container">

<div class="course-map-title-row light-purple-background">            

<div class="title">Course Map</div>


</div>

</div>

<div id='legend' style='display:none;'>
<img style="float: left;width:200px;" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/06/30130615/Dawg-Dash-Logo_504x446.png" alt="Alaska Airlines Dawg Dash 2022" />
<h1>COURSE ROUTES</h1>
<nav class='legend clearfix'>
<span style='background:#8d5dda;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<strong>5K</strong>
<br />
<span style='background:#ecc813;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><strong>10K</strong>

<br />
</div>
<div id='map'></div>



</div>
</div>


<div class="white-background">

<div class="faq-title-row light-purple-background">            

<div class="title">Frequently Asked Questions</div>


</div>

<div class="row no-gutters">



<div class="faq-row white-background">            
<div class="faq-content">              
<?php the_field('faq') ?>              


</div>



</div>

</div>


<div class="white-background">
  <div class="banner-row no-gutters">
    <div class="banner banner-sm"></div>
    <div class="banner banner-lg"></div>
    <div class="banner-background"></div>
  </div>
</div>


<div class="white-background">
<div class="row no-gutters">



<div class="faq-row white-background">            
<div class="register-row-content">              
<p style="text-align: center;"><em>Special thanks to our partners</em></p>
<p style="text-align: center;"><a href="http://alaskaair.com"><img class="aligncenter wp-image-22219" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/06/30230420/2023_Dawg-Dash-Partner-Alaska_800x270.png" alt="Alaska Airlines logo" width="204" height="90" /></a></p>
<p style="text-align: center;"><a href="https://uw.edu/alumni"><img class="aligncenter wp-image-XXXXX size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/07/07171757/2023_Dawg-Dash-Partner-UWAA_186x70.png" alt="" width="186" height="70" /></a><a href="https://www.att.com/"><img class="aligncenter wp-image-21331 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2019/08/21115831/Logo_ATT_190x70.gif" alt="logo_01_BECU" width="131" height="48" /></a><a href="https://www.becu.org/everyday-banking/debit-card/uw-card"><img class="aligncenter wp-image-29659 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2015/06/10172428/Logo_BECU_190x70.gif" alt="" width="190" height="70" /></a></p>
  <p style="text-align: center;"><a href="https://www.brooksrunning.com/"><img class="aligncenter wp-image-21340 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183156/logo_Brooks.jpg" alt="logo_Brooks" width="131" height="48" /></a> <a href="http://www.bookstore.washington.edu/home/home.taf?"><img class="aligncenter wp-image-21328 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/06/30230423/2023_Dawg-Dash-Partner-UBS_186x70-1.png" alt="logo_00_bookstore" width="131" height="48" /></a><a href="https://www.uwmedicine.org/"><img class="aligncenter wp-image-51338" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/07/06132640/UWM_ColorLogo.png" alt="" width="160" height="47" /></a><a href="https://wsecu.org/"><img class="aligncenter wp-image-21330 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183203/logo_05_WSECU.png" alt="logo_05_WSECU" width="131" height="48" /></a></p>
  
  
  </div>
  
  
  
  </div>
  
  </div>
  </div>

</div>
  
  
  
  <!-- /jumpin-container -->
  </div>
  
  
  
  <?php get_footer(); ?>
  